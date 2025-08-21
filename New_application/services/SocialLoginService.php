<?php
// application/services/SocialLoginService.php

class SocialLoginService extends CI_Service {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('basic');
        $this->load->library('session');
        $this->load->helper('cookie');
    }

    /**
     * Handles login and user creation for social platforms.
     * @param object|array $details User details from social login callback.
     * @param string $provider 'google' or 'facebook'.
     * @return array Status and message of the login process.
     */
    public function handleLoginCallback($details, $provider)
    {
        // 1. Find or create user
        $user = $this->findOrCreateUser($details, $provider);
        if (empty($user)) {
            return ['status' => 'error', 'message' => $this->lang->line("Failed to create or find user account.")];
        }

        // 2. Set user session
        $this->setUserSession($user);

        // 3. Handle external API integrations (Facebook, Google Pages, etc.)
        $this->handleExternalIntegrations($user, $details, $provider);
        
        return ['status' => 'success', 'message' => $this->lang->line("Login successful.")];
    }

    private function findOrCreateUser($details, $provider)
    {
        $email = $details->email ?? ($details['email'] ?? null);
        $fb_id = $details['id'] ?? null;
        $name = $details->name ?? ($details['name'] ?? null);

        // Find existing user by email or Facebook ID
        $user = $this->basic->get_data('users', ['where' => ['email' => $email, 'deleted' => '0']]);
        if (!empty($user)) {
            // Update user info if needed, e.g., link Facebook ID
            $this->basic->update_data('users', ['email' => $email], ['fb_id' => $fb_id]);
            return $user[0];
        }

        // Create a new user if not found
        $default_package = $this->basic->get_data("package", ['where' => ['is_default' => '1']]);
        $package_id = $default_package[0]['id'] ?? 0;
        $expiry_date = date("Y-m-d", strtotime('+' . ($default_package[0]['validity'] ?? 0) . ' day'));

        $insert_data = [
            'email' => $email,
            'name' => $name,
            'user_type' => 'Member',
            'status' => '1',
            'add_date' => date("Y-m-d H:i:s"),
            'package_id' => $package_id,
            'expired_date' => $expiry_date,
            'fb_id' => $fb_id,
            'affiliate_id' => $this->getAffiliateId(),
            'deleted' => '0'
        ];
        $this->basic->insert_data("users", $insert_data);

        // Track affiliate signup (moved from controller)
        $user_id = $this->db->insert_id();
        if ($insert_data['affiliate_id'] != 0 && $this->addon_exist("affiliate_system")) {
            $this->trackAffiliateSignup($insert_data['affiliate_id'], $user_id);
        }

        // Return the newly created user record
        $user = $this->basic->get_data('users', ['where' => ['id' => $user_id]]);
        return $user[0] ?? null;
    }

    private function setUserSession($user)
    {
        // Centralized session setting logic
        $this->session->set_userdata([
            'logged_in' => 1,
            'username' => $user['name'],
            'user_type' => $user['user_type'],
            'user_id' => $user['id'],
            'user_login_email' => $user['email'],
            // ... other session data
        ]);

        $this->basic->update_data("users", ['id' => $user['id']], ['last_login_at' => date("Y-m-d H:i:s")]);
    }

    private function handleExternalIntegrations($user, $details, $provider)
    {
        // This method can be run asynchronously (cron job, queue) for a better UX.
        // For now, it's simplified here.
        if ($provider === 'facebook') {
            $this->load->library('FacebookLogin');
            $this->FacebookLogin->importUserPages($user['id'], $details['access_token_set']);
        }
    }

    private function getAffiliateId()
    {
        $affiliate_id = get_cookie('affiliate_id');
        if (isset($affiliate_id) && !empty($affiliate_id)) {
            $decoded_id = bin2hex(pack("H*", $affiliate_id));
            $exploded_id = explode("-", $decoded_id);
            return $exploded_id[0] ?? 0;
        }
        return 0;
    }

    private function trackAffiliateSignup($affiliate_id, $user_id)
    {
        $visitors_data = [
            'affiliate_id' => $affiliate_id,
            'user_id' => $user_id,
            'type' => 'signup',
            'ip_address' => $this->real_ip(), // Assuming real_ip() is a defined helper
            'clicked_time' => date("Y-m-d H:i:s")
        ];
        $this->basic->insert_data('affiliate_visitors_action', $visitors_data);
        $this->affiliate_commission($affiliate_id, $user_id, "signup");
    }
}
