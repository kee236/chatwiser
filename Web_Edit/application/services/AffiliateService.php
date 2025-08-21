<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AffiliateService extends CI_Service
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('basic');
        $this->load->helper('cookie'); // Ensure cookie helper is loaded
    }

    /**
     * Handles referral cookie from URL parameter and tracks click.
     */
    public function handleReferralCookie()
    {
        if (isset($_GET['ref']) && !empty($_GET['ref'])) {
            $affiliate_code = $this->input->get('ref', true); // Sanitize input
            set_cookie('affiliate_id', $affiliate_code, 604800); // Set cookie for 7 days

            // Decode affiliate ID to actual user ID
            $aff_user_id = $this->decodeAffiliateCode($affiliate_code);

            if ($aff_user_id > 0) {
                $this->trackClick($aff_user_id);
            }
        }
    }

    /**
     * Tracks an affiliate click.
     * @param int $affiliate_user_id The actual user ID of the affiliate.
     */
    public function trackClick(int $affiliate_user_id)
    {
        $visitor_ip = $this->input->ip_address(); // Get actual IP address
        $click_data = [
            'affiliate_id' => $affiliate_user_id,
            'type' => 'click',
            'ip_address' => $visitor_ip,
            'clicked_time' => date("Y-m-d H:i:s")
        ];
        $this->basic->insert_data("affiliate_visitors_action", $click_data);
        // Consider adding a simple log here or a return value
    }

    /**
     * Tracks an affiliate signup.
     * @param int $affiliate_user_id The actual user ID of the affiliate.
     * @param int $new_user_id The ID of the newly signed up user.
     */
    public function trackSignup(int $affiliate_user_id, int $new_user_id)
    {
        $visitor_ip = $this->input->ip_address();
        $signup_data = [
            'affiliate_id' => $affiliate_user_id,
            'user_id' => $new_user_id,
            'type' => 'signup',
            'ip_address' => $visitor_ip,
            'clicked_time' => date("Y-m-d H:i:s")
        ];
        $this->basic->insert_data('affiliate_visitors_action', $signup_data);

        // Call commission logic (assuming affiliate_commission is a helper/model method)
        if (method_exists($this->CI, 'affiliate_commission')) { // Or call a specific model/service
            $this->CI->affiliate_commission($affiliate_user_id, $new_user_id, "signup");
        }
    }

    /**
     * Decodes the affiliate code to get the actual user ID.
     * (This logic depends on how you encode the affiliate ID in the first place)
     * @param string $encoded_id The encoded affiliate ID from the URL.
     * @return int The decoded affiliate user ID or 0 if invalid.
     */
    public function decodeAffiliateCode(string $encoded_id): int
    {
        // This is a placeholder. Your encoding/decoding logic for affiliate ID should be robust.
        // The original code used pack("H*", $affiliate_id) and explode("-").
        // For example, if it's base64_encode(user_id . '-' . random_string)
        // you'd do base64_decode() and then explode.
        // Example:
        // $decoded_binary = pack("H*", $encoded_id); // Assuming original encoding was hex
        // $parts = explode("-", $decoded_binary);
        // return (int) ($parts[0] ?? 0);

        // For now, assuming direct pass through or a simple decoding:
        if (is_numeric($encoded_id)) return (int) $encoded_id; // If it's just the ID

        // If it's a more complex encoding like 'user_id-random_hash'
        $parts = explode('-', $encoded_id);
        return (int) ($parts[0] ?? 0);
    }
}
