<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    // ... (ส่วนอื่นๆ ของ Controller)

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
