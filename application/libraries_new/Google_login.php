<?php
// ในไฟล์ application/libraries/Google_login.php หรือ Controller
require 'vendor/autoload.php'; // เรียกใช้ Composer Autoload

use Google\Client;
use Google\Service\Oauth2;

class Google_login {
    public $google_client_id = "";
    public $google_client_secret = "";
    public $redirect_url = "";
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->helper('url_helper');
        $this->CI->load->config('google_config'); // โหลดไฟล์ config ใหม่

        $this->google_client_id = $this->CI->config->item('google_client_id', 'google_config');
        $this->google_client_secret = $this->CI->config->item('google_client_secret', 'google_config');
        $this->redirect_url = site_url("home/google_login_back");
    }

    public function setLoginButton() {
        if (empty($this->redirect_url) || empty($this->google_client_id) || empty($this->google_client_secret)) {
            return "";
        }
        $client = new Client();
        $client->setClientId($this->google_client_id);
        $client->setClientSecret($this->google_client_secret);
        $client->setRedirectUri($this->redirect_url);
        $client->addScope('profile');
        $client->addScope('email');
        $authUrl = $client->createAuthUrl();

        // ปรับปรุงปุ่มให้เป็นภาษาไทย
        return '<a class="btn btn-block btn-social btn-google" href="' . $authUrl . '"><img src="' . base_url("assets/img/google.png") . '"> เข้าสู่ระบบด้วย Google</a>';
    }

    public function handleCallback() {
        $userProfile = null;

        if (isset($_GET['code'])) {
            $client = new Client();
            $client->setClientId($this->google_client_id);
            $client->setClientSecret($this->google_client_secret);
            $client->setRedirectUri($this->redirect_url);
            $client->addScope('profile');
            $client->addScope('email');

            try {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                $oauth2 = new Oauth2($client);
                $userProfile = $oauth2->userinfo->get();
            } catch (Exception $e) {
                // จัดการข้อผิดพลาดที่นี่ เช่น โทเค็นไม่ถูกต้อง
                log_message('error', 'Google API Error: ' . $e->getMessage());
            }
        }
        return $userProfile;
    }
}
