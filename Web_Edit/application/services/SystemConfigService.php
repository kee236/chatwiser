<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SystemConfigService extends CI_Service
{
    public $currentLanguage;
    public $isRtl;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->config('general_config'); // Load general config
        $this->load->helper('language'); // For loading lang files
    }

    public function setupLanguage()
    {
        $default_lang = $this->config->item('language') ?: 'english';
        $selected_lang = $this->session->userdata("selected_language") ?: $default_lang;
        $this->currentLanguage = $selected_lang;

        // Load all language files for the selected language
        $language_path = APPPATH . 'language/' . $this->currentLanguage;
        if (is_dir($language_path)) {
            $lang_files = $this->_scanLanguageFiles($language_path);
            foreach ($lang_files as $file) {
                $filename = basename($file, '_lang.php');
                $this->lang->load($filename, $this->currentLanguage);
            }
        }

        // Determine RTL status
        $this->isRtl = ($this->currentLanguage == 'arabic' || $this->currentLanguage == 'hebrew'); // Example RTL languages
    }

    private function _scanLanguageFiles($dir) {
        $result = [];
        foreach (scandir($dir) as $filename) {
            if ($filename[0] === '.') continue;
            $filePath = $dir . '/' . $filename;
            if (is_dir($filePath)) {
                $result = array_merge($result, $this->_scanLanguageFiles($filePath));
            } else if (strpos($filename, '_lang.php') !== false) {
                $result[] = $filePath;
            }
        }
        return $result;
    }

    public function setupTimezone()
    {
        $time_zone = $this->config->item('time_zone') ?: "Asia/Bangkok";
        date_default_timezone_set($time_zone);
    }

    public function getLanguageList(): array
    {
        // Example: dynamically get languages from /application/language/ directory
        $languages = [];
        $lang_dir = APPPATH . 'language/';
        if ($handle = opendir($lang_dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && is_dir($lang_dir . $entry)) {
                    $languages[$entry] = ucfirst($entry); // Simple name, consider a mapping if display name differs
                }
            }
            closedir($handle);
        }
        return $languages;
    }

    public function getThemeColorCode(string $theme_name): string
    {
        $colors = [
            'purple' => '#545096',
            'blue' => '#1193D4',
            'white' => '#303F42',
            'black' => '#1A2226',
            'green' => '#00A65A',
            'red' => '#E55053',
            'yellow' => '#F39C12'
        ];
        return $colors[$theme_name] ?? '#545096';
    }

    public function generateRandomNumber(int $length): string
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function getCurrencyIcon(string $currency_code): string
    {
        $icons = [
            'USD' => '$', 'AUD' => '$', 'CAD' => '$', 'EUR' => '€', 'ILS' => '₪',
            'NZD' => '$', 'RUB' => '₽', 'SGD' => '$', 'SEK' => 'kr', 'BRL' => 'R$',
            'THB' => '฿', // Thai Baht
            // Add more as needed
        ];
        return $icons[$currency_code] ?? '$';
    }

    // You can add disableCache() method here if needed
}
