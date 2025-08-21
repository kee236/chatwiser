<?php
// application/libraries/FacebookLogin.php

// Ensure Composer autoloader is available
// If Composer is not loaded globally in CI, add 'require_once FCPATH . 'vendor/autoload.php';'
// in your main index.php or a hook.
// For CodeIgniter 3, it's common to set $config['composer_autoload'] = TRUE; in application/config/config.php

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookLogin
{
    private $CI;
    private $fb; // Facebook SDK instance
    private $app_id;
    private $app_secret;
    private $redirect_uri;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->config('facebook_api'); // โหลดไฟล์ตั้งค่า Facebook API
        $this->CI->load->helper('url'); // เพื่อใช้ base_url() หรือ site_url()

        $this->app_id = $this->CI->config->item('facebook_app_id');
        $this->app_secret = $this->CI->config->item('facebook_app_secret');

        // ตั้งค่า Facebook SDK
        try {
            $this->fb = new Facebook([
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => 'v19.0', // ใช้วิธีเวอร์ชันล่าสุดที่เสถียร
            ]);
        } catch (FacebookSDKException $e) {
            // ควรมีการบันทึก Log ข้อผิดพลาดจริงใน Production
            log_message('error', 'Facebook SDK init error: ' . $e->getMessage());
            // ในที่นี้จะปล่อยให้ตัวแปร $fb เป็น null และฟังก์ชันอื่นๆ จะจัดการต่อ
            $this->fb = null;
        }
    }

    /**
     * Generates the Facebook login URL for user authentication.
     * @param string $redirect_uri The URL to redirect to after successful login.
     * @param array $permissions Array of required permissions (scopes).
     * @return string The Facebook login URL.
     */
    public function getLoginButton(string $redirect_uri, array $permissions = []): string
    {
        if (empty($this->app_id) || empty($this->app_secret) || empty($redirect_uri) || $this->fb === null) {
            // หากค่าที่จำเป็นไม่ครบหรือ SDK ไม่ได้ถูก Init ให้ส่งค่าว่างกลับไป
            return '<div class="alert alert-warning text-center">'. $this->CI->lang->line("Facebook Login is not configured.") .'</div>';
        }

        $this->redirect_uri = $redirect_uri;
        $helper = $this->fb->getRedirectLoginHelper();

        // กำหนดสิทธิ์ที่จำเป็นสำหรับการเข้าถึงข้อมูลผู้ใช้และเพจ
        $default_permissions = [
            'email',
            'public_profile',
            'pages_show_list',
            'pages_read_engagement',
            'pages_manage_posts',
            'pages_manage_ads', // เพิ่มเผื่อไว้สำหรับการโฆษณา
            'pages_read_user_content', // เพื่อดึงคอมเมนต์
            'pages_messaging', // เพื่อจัดการแชทบอท
            'instagram_basic', // สำหรับ Instagram Basic Display API
            'instagram_manage_comments', // สำหรับ Instagram comment bot
            'instagram_manage_messages' // สำหรับ Instagram messenger bot
        ];

        // รวมสิทธิ์เริ่มต้นกับสิทธิ์ที่ส่งเข้ามาเพิ่มเติม
        $permissions = array_unique(array_merge($default_permissions, $permissions));

        $loginUrl = $helper->getLoginUrl($this->redirect_uri, $permissions);

        // ข้อความปุ่มเป็นภาษาไทย
        return '<a class="btn btn-block btn-social btn-facebook" href="' . htmlspecialchars($loginUrl) . '">
                    <i class="fab fa-facebook-f"></i> '. $this->CI->lang->line("Sign in with Facebook") .'
                </a>';
    }

    /**
     * Handles the callback from Facebook after user login.
     * Retrieves user access token and user profile information.
     * @param string $redirect_uri The same redirect URL used in getLoginButton().
     * @return array|null Returns user data array on success, or null on failure.
     */
    public function getLoginCallbackInfo(string $redirect_uri): ?array
    {
        if ($this->fb === null) {
            return null; // SDK ไม่ได้ถูก Init
        }

        $this->redirect_uri = $redirect_uri;
        $helper = $this->fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken($this->redirect_uri);
        } catch (FacebookResponseException $e) {
            // Graph API errors like permissions denied, invalid token
            log_message('error', 'Facebook Graph Response Error: ' . $e->getMessage());
            $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("Facebook API responded with an error.") . ' ' . $this->CI->lang->line("Please check your app settings or try again."));
            return null;
        } catch (FacebookSDKException $e) {
            // SDK errors like fails to generate a redirect login URL
            log_message('error', 'Facebook SDK Error: ' . $e->getMessage());
            $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("An error occurred during Facebook login. Please try again."));
            return null;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                log_message('error', 'Facebook Login Error: ' . $helper->getErrorReason() . ' - ' . $helper->getErrorDescription());
                $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("Facebook login was cancelled or an error occurred.") . ' ' . $this->CI->lang->line("Reason") . ': ' . $helper->getErrorDescription());
            } else {
                log_message('error', 'Facebook Login Error: Bad request.');
                $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("Bad request during Facebook login."));
            }
            return null;
        }

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $this->fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        // Validation (these will throw FacebookSDKException if they fail)
        $tokenMetadata->validateAppId($this->app_id);
        // If you know the user ID this access token belongs to, you can validate it here
        // $tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        $longLivedAccessToken = $accessToken;
        // Exchanges a short-lived access token for a long-lived one
        if (!$accessToken->isLongLived()) {
            try {
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                log_message('error', 'Error getting long-lived access token: ' . $e->getMessage());
                $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("Could not obtain a long-lived Facebook access token. Please try again."));
                return null;
            }
        }

        // Fetch user profile
        try {
            $response = $this->fb->get('/me?fields=id,name,email,picture', $longLivedAccessToken->getValue());
            $user = $response->getGraphUser();

            return [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail() ?? null, // Email might not always be available
                'picture' => $user->getPicture()->getUrl() ?? null,
                'access_token_set' => $longLivedAccessToken->getValue(),
                'long_lived_token' => true,
            ];

        } catch (FacebookResponseException $e) {
            log_message('error', 'Graph API error getting user profile: ' . $e->getMessage());
            $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("Failed to retrieve user profile from Facebook.") . ' ' . $this->CI->lang->line("Please ensure all necessary permissions are granted."));
            return null;
        } catch (FacebookSDKException $e) {
            log_message('error', 'SDK error getting user profile: ' . $e->getMessage());
            $this->CI->session->set_flashdata('login_msg', $this->CI->lang->line("An unexpected error occurred during Facebook profile retrieval."));
            return null;
        }
    }

    /**
     * Imports user's Facebook pages and associated Instagram Business Accounts.
     * This method should ideally be called in the background (e.g., cron job or queue)
     * after initial user login for better UX.
     * @param int $user_id The ID of the user in your system.
     * @param string $user_access_token Long-lived user access token.
     * @return array Status of the import operation.
     */
    public function importUserPages(int $user_id, string $user_access_token): array
    {
        if ($this->fb === null) {
            return ['status' => 'error', 'message' => $this->CI->lang->line("Facebook SDK is not initialized.")];
        }

        $this->CI->load->model('basic'); // Ensure model is loaded
        // This is a placeholder for facebook_rx_config_id logic.
        // You might have a system-wide app, or user's own app.
        $facebook_rx_config_id = 0; // Replace with logic to get appropriate config_id

        try {
            // Get pages the user manages
            $response = $this->fb->get('/me/accounts?fields=id,name,access_token,picture.width(100).height(100),cover,emails,username,instagram_business_account{id,username,followers_count,media_count,website,biography}', $user_access_token);
            $pages = $response->getGraphEdge();

            $imported_pages_count = 0;
            foreach ($pages as $page) {
                // Prepare page data
                $page_data = [
                    'user_id' => $user_id,
                    'facebook_rx_fb_user_info_id' => $facebook_rx_config_id, // This needs to be the ID from facebook_rx_fb_user_info table
                    'page_id' => $page->getId(),
                    'page_cover' => $page->getField('cover') ? $page->getField('cover')->getProperty('source') : null,
                    'page_profile' => $page->getField('picture') ? $page->getField('picture')->getProperty('url') : null,
                    'page_name' => $page->getName(),
                    'username' => $page->getUsername() ?? null,
                    'page_access_token' => $page->getAccessToken(),
                    'page_email' => $page->getEmail() ?? null,
                    'add_date' => date('Y-m-d H:i:s'),
                    'deleted' => '0',
                ];

                // Check for Instagram Business Account
                $instagram_business_account = $page->getField('instagram_business_account');
                if ($instagram_business_account) {
                    $page_data['has_instagram'] = '1';
                    $page_data['instagram_business_account_id'] = $instagram_business_account->getId();
                    $page_data['insta_username'] = $instagram_business_account->getField('username');
                    $page_data['insta_followers_count'] = $instagram_business_account->getField('followers_count');
                    $page_data['insta_media_count'] = $instagram_business_account->getField('media_count');
                    $page_data['insta_website'] = $instagram_business_account->getField('website');
                    $page_data['insta_biography'] = $instagram_business_account->getField('biography');
                } else {
                    $page_data['has_instagram'] = '0';
                    $page_data['instagram_business_account_id'] = null;
                }

                // Insert or Update page info in database
                $where = ['facebook_rx_fb_user_info_id' => $facebook_rx_config_id, 'page_id' => $page->getId()];
                if ($this->basic->is_exist('facebook_rx_fb_page_info', $where)) {
                    $this->basic->update_data('facebook_rx_fb_page_info', $where, $page_data);
                } else {
                    // Check module usage limits before inserting a new page
                    // This logic should be externalized to a UsageService
                    // Example: $this->CI->load->service('UsageService'); $status = $this->CI->UsageService->checkModuleUsage(65, 1);
                    // if ($status == "limit_crossed") return ['status' => 'error', 'message' => $this->CI->lang->line("Module limit is over for Facebook pages.")];
                    
                    $this->basic->insert_data('facebook_rx_fb_page_info', $page_data);
                    // $this->CI->UsageService->insertUsageLog(65, 1); // Log usage
                }
                $imported_pages_count++;
            }
            return ['status' => 'success', 'message' => $this->CI->lang->line("Successfully imported") . " {$imported_pages_count} " . $this->CI->lang->line("pages.")];

        } catch (FacebookResponseException $e) {
            log_message('error', 'Graph API error importing pages: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $this->CI->lang->line("Failed to import Facebook pages.") . ' ' . $this->CI->lang->line("Reason") . ': ' . $e->getMessage()];
        } catch (FacebookSDKException $e) {
            log_message('error', 'SDK error importing pages: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $this->CI->lang->line("An unexpected error occurred during page import.")];
        }
    }

    /**
     * Checks if a Facebook Page has an associated Instagram Business Account.
     * (This functionality is integrated into importUserPages() now, but can be standalone if needed)
     * @param string $page_id
     * @param string $page_access_token
     * @return string|null Instagram Business Account ID if found, null otherwise.
     */
    public function instagram_account_check_by_id(string $page_id, string $page_access_token): ?string
    {
        if ($this->fb === null) return null;
        try {
            $response = $this->fb->get("/{$page_id}?fields=instagram_business_account", $page_access_token);
            $graphNode = $response->getGraphNode();
            return $graphNode->getField('instagram_business_account') ? $graphNode->getField('instagram_business_account')->getId() : null;
        } catch (FacebookResponseException $e) {
            log_message('error', 'Error checking Instagram Business Account: ' . $e->getMessage());
            return null;
        } catch (FacebookSDKException $e) {
            log_message('error', 'SDK error checking Instagram Business Account: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieves detailed information about an Instagram Business Account.
     * (This functionality is integrated into importUserPages() now, but can be standalone if needed)
     * @param string $instagram_business_account_id
     * @param string $page_access_token
     * @return array|null Instagram account info array if found, null otherwise.
     */
    public function instagram_account_info(string $instagram_business_account_id, string $page_access_token): ?array
    {
        if ($this->fb === null) return null;
        try {
            $response = $this->fb->get("/{$instagram_business_account_id}?fields=username,followers_count,media_count,website,biography", $page_access_token);
            return $response->getGraphNode()->asArray();
        } catch (FacebookResponseException $e) {
            log_message('error', 'Error getting Instagram Business Account info: ' . $e->getMessage());
            return null;
        } catch (FacebookSDKException $e) {
            log_message('error', 'SDK error getting Instagram Business Account info: ' . $e->getMessage());
            return null;
        }
    }
}
