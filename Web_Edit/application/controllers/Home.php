<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @category controller
 * class Home
 *
 * This controller handles core application functionalities including:
 * - Application initialization and setup.
 * - User authentication (login, logout, social logins).
 * - System-wide configurations (timezone, language, caching).
 * - Routing to different view layers (frontend, admin, subscription).
 * - Basic error handling.
 */
class Home extends CI_Controller
{
    // Public properties for common data accessible throughout the controller
    public $language;
    public $is_rtl;
    public $user_id;
    public $real_user_id;
    public $is_manager = 0;
    public $team_allowed_pages = [];
    public $is_demo; // Indicates if the application is in demo mode

    // Properties for advertisement content (should ideally be loaded from a service/model)
    public $ad_content1;
    public $ad_content1_mobile;
    public $ad_content2;
    public $ad_content3;
    public $ad_content4;

    // Application version and strict AJAX call settings
    public $APP_VERSION;
    public $strict_ajax_call = false; // Default to false for local dev, enable for production

    /**
     * Constructor: Initializes common settings and loads necessary libraries/helpers.
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        set_time_limit(0); // Set no time limit for script execution (consider server limits)
        ignore_user_abort(TRUE); // Script continues even if user aborts connection

        // Load necessary helpers
        $this->load->helpers(array('my_helper', 'addon_helper', 'bot_helper', 'cookie', 'url'));

        // Load configuration files
        $this->load->config('general_config'); // Assuming this is your main config file
        $this->load->config('landing_page_config'); // For frontend landing page settings

        // Initialize basic properties from config
        $this->is_demo = $this->config->item("is_demo") ?: "0";

        // Load database and basic model
        $this->load->database();
        $this->load->model('basic');

        // Load core services for system-wide functionalities
        $this->load->service('SystemConfigService'); // Handles timezone, language, cache
        $this->load->service('AffiliateService'); // Handles affiliate tracking
        $this->load->service('AdDisplayService'); // Handles advertisement display logic

        // Initialize language and timezone
        $this->SystemConfigService->setupLanguage();
        $this->SystemConfigService->setupTimezone();
        $this->language = $this->SystemConfigService->currentLanguage;
        $this->is_rtl = $this->SystemConfigService->isRtl;

        // Initialize advertisement data
        $this->AdDisplayService->loadAdConfig();
        $this->ad_content1 = $this->AdDisplayService->ad_content1;
        $this->ad_content1_mobile = $this->AdDisplayService->ad_content1_mobile;
        $this->ad_content2 = $this->AdDisplayService->ad_content2;
        $this->ad_content3 = $this->AdDisplayService->ad_content3;
        $this->ad_content4 = $this->AdDisplayService->ad_content4;

        // Handle security measures
        $this->_enforce_security();

        // Check for installation file on non-installation routes
        $this->_check_installation();

        // Load user session data if logged in
        $this->_load_user_session_data();

        // Set database collation for utf8mb4 (assuming MySQL 5.5.3+ for full UTF-8 support)
        // This is typically done at the database/table level or in database.php config for persistent settings.
        // For runtime, ensure your database connection charset is utf8mb4 in application/config/database.php
        $this->db->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        $this->db->query("SET SESSION sql_mode = ''"); // Disable strict mode if needed for legacy queries

        // Handle affiliate cookie if present
        $this->AffiliateService->handleReferralCookie();
    }

    /**
     * Checks for installation file and redirects if necessary.
     */
    private function _check_installation()
    {
        $segment = $this->uri->segment(2);
        if ($segment != "installation" && $segment != "installation_action") {
            if (file_exists(APPPATH . 'install.txt')) {
                redirect('home/installation', 'location');
            }
        }
    }

    /**
     * Loads user session data and sets properties.
     */
    private function _load_user_session_data()
    {
        if ($this->session->userdata('logged_in') == 1) {
            $this->user_id = $this->session->userdata("user_id");
            $this->real_user_id = $this->session->userdata("real_user_id");
            $this->is_manager = $this->session->userdata("is_manager");

            $package_info = ($this->is_manager == 1) ? $this->session->userdata("role_info") : $this->session->userdata("package_info");
            $module_ids = ($this->is_manager == 1) ? array_keys(json_decode($package_info["module_access"] ?? '[]', true)) : explode(',', $package_info["module_ids"] ?? '');

            $this->module_access = $module_ids;
            $this->session->set_userdata('module_access', $this->module_access);

            if ($this->is_manager == 1) {
                $this->team_access = json_decode($package_info["module_access"] ?? '[]', true);
                $this->team_allowed_pages = $this->session->userdata('team_allowed_pages');
                $this->session->set_userdata('team_access', $this->team_access);
            }
        }
        $this->session->set_userdata("is_mobile", is_mobile() ? '1' : '0'); // Set mobile status in session
    }

    /**
     * Enforces security measures like HTTPS and CSRF tokens.
     */
    private function _enforce_security()
    {
        // Enforce HTTPS
        if ($this->config->item('force_https') == '1' && !isset($_SERVER['HTTPS'])) {
            redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'refresh');
        }

        // CSRF Token generation
        if ($this->session->userdata('csrf_token_session') == "") {
            $this->session->set_userdata('csrf_token_session', bin2hex(random_bytes(32)));
        }

        // Force logout if session indicates so
        if ($this->session->userdata('log_me_out') == '1') {
            $this->logout();
        }

        // Allow AJAX CORS for specific development environments (DO NOT USE IN PRODUCTION WITHOUT CAUTION)
        $hostname = str_replace(['http://', 'https://'], ['', ''], base_url());
        $hostname_parts = explode('/', $hostname);
        $clean_hostname = trim($hostname_parts[0] ?? 'localhost', '/');

        if (in_array($clean_hostname, ['localhost', 'chatpion.test'])) { // Replace 'chatpion.test' with your local dev domain
            $this->strict_ajax_call = false;
        }

        if (!$this->strict_ajax_call) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Credentials: true');
        }
    }

    /**
     * Displays the installation page if the application is not yet installed.
     */
    public function installation()
    {
        if (!file_exists(APPPATH . 'install.txt')) {
            redirect('home/login_page', 'location');
        }
        $data = array(
            "body" => "front/install", // Assuming this view exists
            "page_title" => $this->lang->line("Install Package"),
            "language_info" => $this->SystemConfigService->getLanguageList() // Use service method
        );
        $this->_subscription_viewcontroller($data);
    }

    /**
     * Handles the display of the homepage or redirects to login if landing page is disabled.
     */
    public function index()
    {
        $display_landing_page = $this->config->item('display_landing_page') ?: '0';

        if ($display_landing_page == '0') {
            $this->login_page();
        } else {
            $this->_site_viewcontroller();
        }
    }

    /**
     * Displays the login page.
     * @param string $is_team_login '1' for team login, '0' for regular user login.
     */
    public function login_page($is_team_login = '0')
    {
        if (file_exists(APPPATH . 'install.txt')) {
            redirect('home/installation', 'location');
        }
        if ($this->session->userdata('logged_in') == 1) {
            redirect('dashboard', 'location');
        }

        $this->load->library("GoogleLogin"); // Your custom Google Login library
        $data["google_login_button"] = $this->googlelogin->setLoginButton(); // Renamed function for consistency

        $data['fb_login_button'] = "";
        // Load FacebookLogin library only if enabled and PHP version is compatible
        if ($this->config->item('enable_facebook_login') == '1' && function_exists('version_compare') && version_compare(PHP_VERSION, '5.4.0', '>=')) {
            $this->session->set_userdata('social_login_session_set', 1);
            $this->load->library("FacebookLogin"); // Your custom Facebook Login library
            $data['fb_login_button'] = $this->facebooklogin->getLoginButton(site_url("home/facebook_login_back"));
        }

        $data["page_title"] = $this->lang->line("Login");
        $data['is_team_login'] = $is_team_login;
        // Check if team member addon is active
        $data['is_exist_team_member_addon'] = $this->addon_exist("team_member");

        // Determine default username/password for demo mode
        $data['default_user'] = "";
        $data['default_pass'] = "";
        if ($this->is_demo == '1') {
            $data['default_user'] = "admin@example.com"; // Placeholder, use actual demo user
            $data['default_pass'] = "password"; // Placeholder, use actual demo password
        }

        // Load the appropriate login view based on theme
        $current_theme = $this->config->item('current_theme') ?: 'modern';
        $body_load = file_exists(APPPATH . 'views/site/' . $current_theme . '/login.php') ?
            'site/' . $current_theme . '/login' :
            'site/modern/login';

        $data["body"] = $body_load;
        $this->_subscription_viewcontroller($data);
    }

    /**
     * Handles the regular user/team login process (email/password).
     * @param string $is_team_login '1' for team login, '0' for regular user login.
     */
    public function login($is_team_login = '0')
    {
        if (file_exists(APPPATH . 'install.txt')) {
            redirect('home/installation', 'location');
        }
        if ($this->session->userdata('logged_in') == 1) {
            redirect('dashboard', 'location');
        }

        $this->form_validation->set_rules('username', '<b>' . $this->lang->line("email") . '</b>', 'trim|required');
        $this->form_validation->set_rules('password', '<b>' . $this->lang->line("password") . '</b>', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>'); // Better error display

        if ($this->form_validation->run() == false) {
            $this->login_page($is_team_login);
            return; // Important: return after redirect
        }

        // CSRF Token check is usually handled by CI's security class automatically if enabled in config/hooks
        // $this->csrf_token_check(); // Assuming this is a custom method, remove if CI's native CSRF is used

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $table = ($is_team_login == '1') ? 'team_members' : 'users';
        $where = ['email' => $username, "deleted" => "0", "status" => "1"];

        // If not team login and master password is set (only for super admin bypassing regular password)
        // Master password check logic should ideally be handled within a secure authentication service
        // and master_password should be hashed in an .env file or DB.
        // For demonstration, simplified:
        if ($is_team_login == '0' && $this->config->item('master_password') != '') {
            if (password_verify($password, getenv('MASTER_PASSWORD_HASH') ?: '')) { // Assume MASTER_PASSWORD_HASH is in .env
                $user_info = $this->basic->get_data($table, ['where' => ['email' => $username, "deleted" => "0", "status" => "1"]], '', '', '', '', '', '', 1);
            } else {
                $user_info = $this->basic->get_data($table, ['where' => ['email' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), "deleted" => "0", "status" => "1"]], '', '', '', '', '', '', 1);
            }
        } else {
            $user_info = $this->basic->get_data($table, ['where' => ['email' => $username, "deleted" => "0", "status" => "1"]], '', '', '', '', '', '', 1);
        }

        if (empty($user_info)) { // Check if user_info is empty
            $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
            redirect(uri_string());
        }

        $user_data = $user_info[0];

        // Password verification for non-master password logins
        if ($is_team_login == '0' && $this->config->item('master_password') != '' && !password_verify($password, getenv('MASTER_PASSWORD_HASH') ?: '')) {
             if (!password_verify($password, $user_data['password'])) {
                $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
                redirect(uri_string());
             }
        }
        else if ($is_team_login == '1' && !password_verify($password, $user_data['password'])) {
            $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
            redirect(uri_string());
        }

        // Check if Admin tries to log in via regular member login (only for team login context)
        if ($is_team_login == '0' && $user_data['user_type'] == 'Admin') {
            $this->session->set_flashdata('login_msg', $this->lang->line("You have admin account in this system, please login to your admin account."));
            redirect("home/login_page");
        }

        // Delegate setting user session to SocialLoginService (centralized logic)
        $this->load->service('SocialLoginService');
        $this->SocialLoginService->setUserSession($user_data, $is_team_login);

        // Update last login time and IP
        $this->basic->update_data("users", ["id" => $user_data['id']], ["last_login_at" => date("Y-m-d H:i:s"), 'last_login_ip' => $this->input->ip_address()]);

        redirect('dashboard', 'location');
    }

    /**
     * Handles Google login callback.
     */
    public function google_login_back()
    {
        $this->load->library('GoogleLogin'); // Your custom GoogleLogin library
        $user_details = $this->googlelogin->getUserDetails(); // Assumes this returns user info or null/error

        if (empty($user_details) || !isset($user_details->email)) {
            $this->session->set_flashdata('login_msg', $this->lang->line("ไม่สามารถดึงข้อมูลบัญชี Google ของคุณได้ กรุณาลองใหม่อีกครั้ง"));
            redirect('home/login_page');
            return;
        }

        $this->load->service('SocialLoginService');
        $login_result = $this->SocialLoginService->handleLoginCallback($user_details, 'google');

        if ($login_result['status'] === 'success') {
            redirect('dashboard', 'location');
        } else {
            $this->session->set_flashdata('login_msg', $login_result['message']);
            redirect('home/login_page');
        }
    }

    /**
     * Handles Facebook login callback.
     */
    public function facebook_login_back()
    {
        $this->session->set_userdata('social_login_session_set', 1);
        $this->load->library('FacebookLogin'); // Your custom FacebookLogin library

        $redirect_url = site_url("home/facebook_login_back");
        $user_details = $this->facebooklogin->getLoginCallbackInfo($redirect_url);

        if (empty($user_details) || !isset($user_details['id'])) {
            $this->session->set_flashdata('login_msg', $this->lang->line("ไม่สามารถดึงข้อมูลบัญชี Facebook ของคุณได้ กรุณาลองใหม่อีกครั้ง"));
            redirect("home/login_page");
            return;
        }

        $this->load->service('SocialLoginService');
        $login_result = $this->SocialLoginService->handleLoginCallback($user_details, 'facebook');

        if ($login_result['status'] === 'success') {
            redirect('dashboard', 'location');
        } else {
            $this->session->set_flashdata('login_msg', $login_result['message']);
            redirect('home/login_page');
        }
    }

    /**
     * Logs the user out and destroys the session.
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_msg', $this->lang->line("คุณออกจากระบบเรียบร้อยแล้ว"));
        redirect('home/login_page', 'location');
    }

    /**
     * Displays an "Access Denied" error page.
     */
    public function access_forbidden()
    {
        $data = array(
            "page_title" => $this->lang->line("Access Denied"),
            "message" => $this->lang->line("You do not have permission to access this content")
        );
        $this->load->view('page/error_view', $data); // Assuming page/error_view.php for custom error page
    }

    /**
     * Displays a "404 Not Found" error page.
     */
    public function error_404()
    {
        $data = array(
            "page_title" => $this->lang->line("Page Not Found"),
            "message" => $this->lang->line("The page you are looking for does not exist")
        );
        $this->load->view('page/error_view', $data); // Assuming page/error_view.php for custom error page
    }

    /**
     * Loads the view for subscription-related pages.
     * @param array $data Data to pass to the view.
     */
    public function _subscription_viewcontroller($data = array())
    {
        $current_theme = $this->config->item('current_theme') ?: 'modern';
        $data['body'] = $data['body'] ?? "site/modern/blank";
        $data['page_title'] = $data['page_title'] ?? "";

        // Use a helper function or service for theme path resolution
        $theme_load = file_exists(APPPATH . 'views/site/' . $current_theme . '/subscription_theme.php') ?
            'site/' . $current_theme . '/subscription_theme' :
            'site/modern/subscription_theme';

        $data['is_rtl'] = $this->is_rtl;
        $this->load->view($theme_load, $data);
    }

    /**
     * Loads the frontend view for landing pages.
     * @param array $data Data to pass to the view.
     */

public function _subscription_viewcontroller($data = array())
    {
        $current_theme = $this->config->item('current_theme') ?: 'modern';
        $data['body'] = $data['body'] ?? "site/modern/blank";
        $data['page_title'] = $data['page_title'] ?? "";

        // Use a helper function or service for theme path resolution
        $theme_load = file_exists(APPPATH . 'views/site/' . $current_theme . '/subscription_theme.php') ?
            'site/' . $current_theme . '/subscription_theme' :
            'site/modern/subscription_theme';

        $data['is_rtl'] = $this->is_rtl;
        $this->load->view($theme_load, $data);
    }

    /**
     * Loads the frontend view for landing pages.
     * @param array $data Data to pass to the view.
     */
    public function _front_viewcontroller($data = array())
    {
        // $this->SystemConfigService->disableCache(); // Call service method for caching
        $data['body'] = $data['body'] ?? $this->config->item('default_page_url');
        $data['page_title'] = $data['page_title'] ?? "";

        // Get theme color from config/service
        $loadthemebody = $this->config->item('theme_front') ?: "purple";
        $data['THEMECOLORCODE'] = $this->SystemConfigService->getThemeColorCode($loadthemebody);

        $current_theme = $this->config->item('current_theme') ?: 'modern';
        $body_load = file_exists(APPPATH . 'views/site/' . $current_theme . '/theme_front.php') ?
            'site/' . $current_theme . '/theme_front' :
            'site/modern/theme_front';

        // License check should be handled by LicenseService or a hook
        // if (file_exists(APPPATH . 'core/licence_type.txt')) $this->LicenseService->checkLicenseAction();

        $data['is_rtl'] = $this->is_rtl;
        $this->load->view($body_load, $data);
    }

    /**
     * Loads the main admin/member dashboard view.
     * @param array $data Data to pass to the view.
     */
    public function _viewcontroller($data = array())
    {
        $data['body'] = $data['body'] ?? $this->config->item('default_page_url');
        $data['page_title'] = $data['page_title'] ?? $this->lang->line("Admin Panel");

        // Set unique download ID for session if not set
        if ($this->session->userdata('download_id_front') == "") {
            $this->session->set_userdata('download_id_front', md5(time() . $this->SystemConfigService->generateRandomNumber(10)));
        }

        // Fetch Facebook account switching info
        if ($this->session->userdata('user_type') == 'Admin' || in_array(65, $this->module_access)) {
            $fb_rx_account_switching_info = $this->basic->get_data("facebook_rx_fb_user_info", ["where" => ["user_id" => $this->user_id]]);
            $data["fb_rx_account_switching_info"] = [];
            foreach ($fb_rx_account_switching_info as $value) {
                $data["fb_rx_account_switching_info"][$value["id"]] = ['name' => $value["name"], 'access_token' => $value['access_token']];
            }
        }

        $data["language_info"] = $this->SystemConfigService->getLanguageList(); // Use service method
        // $data["themes"] = $this->SystemConfigService->getThemeList(); // Assuming you have these methods
        // $data["themes_front"] = $this->SystemConfigService->getFrontThemeList();

  // Load menu data (consider caching for performance)
        $data['menus'] = $this->basic->get_data('menu', '', '', '', '', '', 'serial asc');
        $data['menu_child_1_map'] = $this->_map_menu_children('menu_child_1', 'parent_id');
        $data['menu_child_2_map'] = $this->_map_menu_children('menu_child_2', 'parent_child');

        // Announcement data
        $this->db->where($this->LivechatService->getAnnouncementWhereClause($this->user_id, $this->is_manager, $this->real_user_id));
        $data['annoucement_data'] = $this->basic->get_data("announcement", $where = '', $select = '', $join = '', $limit = '', $start = NULL, $order_by = 'created_at DESC');

        // Browser notification status
        $browser_notification = $this->basic->get_data("users", ["where" => ['id' => $this->user_id]], ['browser_notification_enabled']);
        $data['browser_notification_enabled'] = $browser_notification[0]['browser_notification_enabled'] ?? '0';

        $data['is_rtl'] = $this->is_rtl;
        // if (!isset($data['media_type'])) $data['media_type'] = $this->using_media_type; // This needs to be set from somewhere else

        $this->load->view('admin/theme/theme', $data); // Assuming main admin theme
    }

    /**
     * Helper to map menu children.
     * @param string $table_name Table name (e.g., 'menu_child_1', 'menu_child_2')
     * @param string $parent_key Key for parent ID (e.g., 'parent_id', 'parent_child')
     * @return array Mapped array of menu children.
     */
    private function _map_menu_children(string $table_name, string $parent_key): array
    {
        $mapped_data = [];
        $children = $this->basic->get_data($table_name, '', '', '', '', '', 'serial asc');
        foreach ($children as $single_child) {
            $mapped_data[$single_child[$parent_key]][$single_child['id']] = $single_child;
        }
        return $mapped_data;
    }

    /**
     * Loads the site view controller (for public facing pages).
     * @param array $data Data to pass to the view.
     */
    public function _site_viewcontroller($data = array())
    {
        // Load ad configuration via AdDisplayService
        $this->AdDisplayService->loadAdConfig();

        $data['page_title'] = $data['page_title'] ?? "";

        // Fetch pricing and currency info from payment config
        $payment_config = $this->basic->get_data("payment_config");
        $currency = $payment_config[0]['currency'] ?? "THB"; // Default to THB
        $data['price'] = 0; // Default price
        $data['currency'] = $currency;
        $data["curency_icon"] = $this->SystemConfigService->getCurrencyIcon($currency);

        // Captcha for contact page (moved from constructor for specific page)
        $data['contact_num1'] = $this->SystemConfigService->generateRandomNumber(2);
        $data['contact_num2'] = $this->SystemConfigService->generateRandomNumber(1);
        $contact_captcha = $data['contact_num1'] + $data['contact_num2'];
        $this->session->set_userdata("contact_captcha", $contact_captcha);

        $data["language_info"] = $this->SystemConfigService->getLanguageList(); // Use service method
        $data["pricing_table_data"] = $this->basic->get_data("package", ["where" => ["is_default" => "0", "price > " => 0, "validity >" => 0, "visible" => "1"]], '', '', '', NULL, 'CAST(`price` AS SIGNED)');
        $data["default_package"] = $this->basic->get_data("package", ["where" => ["is_default" => "1", "validity >" => 0, "price" => "Trial"]]);

        // Get theme color from config/service
        $loadthemebody = $this->config->item('theme_front') ?: "purple";
        $data['THEMECOLORCODE'] = $this->SystemConfigService->getThemeColorCode($loadthemebody);

        $current_theme = $this->config->item('current_theme') ?: 'modern';
        $body_load = file_exists(APPPATH . 'views/site/' . $current_theme . '/index.php') ?
            'site/' . $current_theme . '/index' :
            'site/modern/index';

        // License check should be handled by LicenseService or a hook
        // if (file_exists(APPPATH . 'core/licence_type.txt')) $this->LicenseService->checkLicenseAction();
        $data['is_rtl'] = $this->is_rtl;
        $this->load->view($body_load, $data);
    }

    /**
     * Recursively scans a directory for files (moved from original _scanAll)
     * This might be better as a helper function or part of a FileUtilityService.
     */
    private function _scanAll($dir) {
        $result = [];
        foreach (scandir($dir) as $filename) {
            if ($filename[0] === '.') continue;
            $filePath = $dir . '/' . $filename;
            if (is_dir($filePath)) {
                $result = array_merge($result, $this->_scanAll($filePath));
            } else {
                $result[] = ['file' => $filePath];
            }
        }
        return $result;
    }
}