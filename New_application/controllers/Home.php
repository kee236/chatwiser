<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    // ... (ส่วนการประกาศตัวแปร)

    public function __construct()
    {
        parent::__construct();
        set_time_limit(0);

        // โหลด Helper ที่จำเป็น
        $this->load->helper(['my_helper', 'addon_helper', 'bot_helper', 'cookie']);
        
        // ตรวจสอบการติดตั้งก่อน
        $this->_check_installation();

        // โหลดฐานข้อมูลและ Model เมื่อจำเป็น
        $this->load->database();
        $this->load->model('basic');
        
        // ตั้งค่าภาษาและโซนเวลา
        $this->_setup_language();
        $this->_setup_timezone();

        // จัดการ Session และข้อมูลผู้ใช้
        $this->_setup_user_session();
        
        // จัดการ Affiliate และ CSRF
        $this->_handle_affiliate_cookie();
        $this->_enforce_security();
    }

    private function _check_installation()
    {
        $segment = $this->uri->segment(2);
        if ($segment != "installation" && $segment != "installation_action") {
            if (file_exists(APPPATH . 'install.txt')) {
                redirect('home/installation', 'location');
            }
        }
    }

    private function _setup_language()
    {
        $default_lang = $this->config->item('language') ?: 'english';
        $selected_lang = $this->session->userdata("selected_language") ?: $default_lang;

        $path = str_replace('\\', '/', APPPATH . '/language/' . $selected_lang);
        $files = $this->_scanAll($path);
        
        foreach ($files as $file) {
            $current_file = $file['file'] ?? '';
            $filename = basename($current_file, '_lang.php');
            if (strpos($filename, '_lang') !== false) {
                $this->lang->load($filename, $selected_lang);
            }
        }
    }

    private function _setup_timezone()
    {
        $time_zone = $this->config->item('time_zone') ?: "Asia/Bangkok";
        date_default_timezone_set($time_zone);
    }
    
    private function _setup_user_session()
    {
        if ($this->session->userdata('logged_in') == 1) {
            $user_info = $this->session->userdata();
            $this->user_id = $user_info["user_id"];
            $this->real_user_id = $user_info["real_user_id"];
            $this->is_manager = $user_info["is_manager"];

            $package_info = ($this->is_manager == 1) ? $user_info["role_info"] : $user_info["package_info"];
            $module_ids = ($this->is_manager == 1) ? array_keys(json_decode($package_info["module_access"] ?? '[]', true)) : explode(',', $package_info["module_ids"] ?? '');
            
            $this->module_access = $module_ids;
            $this->session->set_userdata('module_access', $this->module_access);

            if ($this->is_manager == 1) {
                $this->team_access = json_decode($package_info["module_access"] ?? '[]', true);
                $this->team_allowed_pages = $this->session->userdata('team_allowed_pages');
                $this->session->set_userdata('team_access', $this->team_access);
            }
        }
    }

    private function _handle_affiliate_cookie()
    {
        if (isset($_GET['ref']) && !empty($_GET['ref'])) {
            $affiliate_id = $this->input->get('ref', true);
            set_cookie('affiliate_id', $affiliate_id, 604800); // 7 days

            $this->load->service('AffiliateService');
            $this->AffiliateService->trackClick($affiliate_id);
        }
    }

    private function _enforce_security()
    {
        // บังคับใช้ HTTPS
        if ($this->config->item('force_https') == '1' && !isset($_SERVER['HTTPS'])) {
            redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'refresh');
        }

        // จัดการ CSRF token
        if ($this->session->userdata('csrf_token_session') == "") {
            $this->session->set_userdata('csrf_token_session', bin2hex(random_bytes(32)));
        }

        // หากมีการล็อกอินจากที่อื่น ให้บังคับล็อกเอาท์
        if ($this->session->userdata('log_me_out') == '1') {
            $this->session->sess_destroy();
            redirect('home/login_page', 'location');
        }
    }
    





public function access_forbidden()
{
    $data = array(
        "page_title" => $this->lang->line("Access Denied"),
        "message" => $this->lang->line("You do not have permission to access this content")
    );
    $this->load->view('page/error_view', $data);
}

public function error_404()
{
    $data = array(
        "page_title" => $this->lang->line("Page Not Found"),
        "message" => $this->lang->line("The page you are looking for does not exist")
    );
    $this->load->view('page/error_view', $data);
}



public function login_page($is_team_login = '0')
{
    // ย้ายการตรวจสอบและโหลดไลบรารีไปไว้ใน Controller หรือ Helper
    if ($this->session->userdata('logged_in') == 1) redirect('dashboard', 'location');

    $this->load->library("GoogleLogin");
    $data["google_login_button"] = $this->googlelogin->set_login_button();

    $this->load->library("FacebookLogin");
    $data['fb_login_button'] = $this->facebooklogin->getLoginButton(site_url("home/facebook_login_back"));

    $data["page_title"] = $this->lang->line("Login");
    $data['is_team_login'] = $is_team_login;

    // เรียกใช้ฟังก์ชัน Controller ที่จัดระเบียบแล้ว
    $this->_subscription_viewcontroller($data);
}

public function login($is_team_login = '0')
{
    // ใช้ password_verify() แทน md5()
    if ($this->form_validation->run() == FALSE) {
        $this->login_page($is_team_login);
        return;
    }

    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password', TRUE);

    $table = ($is_team_login == '1') ? 'team_members' : 'users';
    $where = array('email' => $username, "deleted" => "0", "status" => "1");
    $info = $this->basic->get_data($table, array("where" => $where), '', '', '', '', '', '', 1);

    if ($info['extra_index']['num_rows'] == 0) {
        $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
        redirect(uri_string());
    }

    $hashed_password = $info[0]['password'];
    if (!password_verify($password, $hashed_password)) {
        // กรณีรหัสผ่านไม่ตรงกัน
        $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
        redirect(uri_string());
    }

    // ตั้งค่า session และ redirect ไปยัง dashboard
    $this->session->set_userdata('logged_in', 1);
    $this->session->set_userdata('user_id', $info[0]['id']);
    // ... (ส่วนที่เหลือของการตั้งค่า session)
    redirect('dashboard', 'location');
}




public function _front_viewcontroller($data = array())
{
    $this->load->helper('theme'); // โหลด helper
    $loadthemebody = $this->config->item('theme_front') ?: "purple";
    $data['THEMECOLORCODE'] = get_theme_color_code($loadthemebody);

    $current_theme = $this->config->item('current_theme') ?: 'modern';
    $data['body_load'] = load_theme_view('site/' . $current_theme . '/theme_front.php');

    $this->load->view($data['body_load'], $data);
}




    /**
     * Handles Google login callback and user creation.
     */
    public function google_login_back()
    {
        $this->load->library('GoogleLogin');
        $user_details = $this->googlelogin->getUserDetails();

        if (empty($user_details) || empty($user_details->email)) {
            $this->session->set_flashdata('login_msg', $this->lang->line("Unable to retrieve Google account details."));
            redirect('home/login_page');
        }

        // Use a dedicated service to handle all login logic
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
     * @param string $config_id Facebook App configuration ID.
     */
    public function facebook_login_back()
    {
        $this->session->set_userdata('social_login_session_set', 1);
        $this->load->library('FacebookLogin'); // ใช้ชื่อที่ปรับปรุงแล้ว

        $redirect_url = site_url("home/facebook_login_back");
        $user_details = $this->facebooklogin->getLoginCallbackInfo($redirect_url);

        if (empty($user_details) || !isset($user_details['id'])) {
            $this->session->set_flashdata('login_msg', $this->lang->line("ไม่สามารถเชื่อมต่อกับบัญชี Facebook ของคุณได้ กรุณาลองใหม่อีกครั้ง"));
            redirect("home/login_page");
        }

        $this->load->service('SocialLoginService'); // โหลด Social Login Service
        $login_result = $this->SocialLoginService->handleLoginCallback($user_details, 'facebook');

        if ($login_result['status'] === 'success') {
            redirect('dashboard', 'location');
        } else {
            $this->session->set_flashdata('login_msg', $login_result['message']);
            redirect('home/login_page');
        }
    }

    /**
     * Handles user logout and redirects to login page.
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_msg', $this->lang->line("คุณออกจากระบบเรียบร้อยแล้ว"));
        redirect('home/login_page', 'location');
    }
}

    // ... (ส่วนฟังก์ชันอื่นๆ ที่เหลือ)
}
