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
