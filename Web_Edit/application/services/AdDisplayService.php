<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdDisplayService extends CI_Service
{
    public $is_ad_enabled = false;
    public $ad_content1 = "";
    public $ad_content1_mobile = "";
    public $ad_content2 = "";
    public $ad_content3 = "";
    public $ad_content4 = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('basic'); // Assuming basic model is used to fetch ad config
    }

    /**
     * Loads advertisement configuration from the database.
     */
    public function loadAdConfig()
    {
        $ad_config = $this->basic->get_data("ad_config");
        if (isset($ad_config[0]["status"]) && $ad_config[0]["status"] == "1") {
            $this->is_ad_enabled = true;
            $config_data = $ad_config[0];

            $this->ad_content1 = htmlspecialchars_decode($config_data["section1_html"], ENT_QUOTES);
            $this->ad_content1_mobile = htmlspecialchars_decode($config_data["section1_html_mobile"], ENT_QUOTES);
            $this->ad_content2 = htmlspecialchars_decode($config_data["section2_html"], ENT_QUOTES);
            $this->ad_content3 = htmlspecialchars_decode($config_data["section3_html"], ENT_QUOTES);
            $this->ad_content4 = htmlspecialchars_decode($config_data["section4_html"], ENT_QUOTES);

            // Set flags for individual ad sections
            // These could also be checked directly in the view using the content properties
            // For now, mirroring original behavior
            $this->is_ad_enabled1 = (!empty($this->ad_content1) || !empty($this->ad_content1_mobile));
            $this->is_ad_enabled2 = !empty($this->ad_content2);
            $this->is_ad_enabled3 = !empty($this->ad_content3);
            $this->is_ad_enabled4 = !empty($this->ad_content4);
        }
    }

    /**
     * Returns advertisement content for a specific section.
     * @param string $section_name Name of the ad section (e.g., 'section1', 'section2').
     * @param bool $is_mobile Whether to get mobile-specific content for section1.
     * @return string HTML content of the ad.
     */
    public function getAdContent(string $section_name, bool $is_mobile = false): string
    {
        if (!$this->is_ad_enabled) return '';

        switch ($section_name) {
            case 'section1':
                return $is_mobile ? $this->ad_content1_mobile : $this->ad_content1;
            case 'section2':
                return $this->ad_content2;
            case 'section3':
                return $this->ad_content3;
            case 'section4':
                return $this->ad_content4;
            default:
                return '';
        }
    }
}
