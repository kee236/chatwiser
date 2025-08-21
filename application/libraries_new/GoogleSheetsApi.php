<?php
// application/libraries/GoogleSheetsApi.php

use Google\Client;
use Google\Service\Drive;
use Google\Service\Sheets;
use Google\Service\Oauth2;

class GoogleSheetsApi
{
    private $CI;
    private $client;
    public $google_client_id;
    public $google_client_secret;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->config('google_api');

        $this->google_client_id = $this->CI->config->item('google_client_id');
        $this->google_client_secret = $this->CI->config->item('google_client_secret');
    }

    private function setupClient(string $redirectUri, array $scopes = []): Client
    {
        $client = new Client();
        $client->setClientId($this->google_client_id);
        $client->setClientSecret($this->google_client_secret);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setRedirectUri($redirectUri);
        if (!empty($scopes)) {
            $client->addScope($scopes);
        }
        return $client;
    }

    public function getAuthUrl(string $redirectUri, string $type = 'sheets'): string
    {
        $scopes = [
            Sheets::SPREADSHEETS,
            Drive::DRIVE_FILE,
            Oauth2::USERINFO_EMAIL,
            Oauth2::USERINFO_PROFILE
        ];

        $client = $this->setupClient($redirectUri, $scopes);
        return $client->createAuthUrl();
    }

    public function getAccessTokenInfo(string $code, string $redirectUri): array
    {
        $client = $this->setupClient($redirectUri);
        $token = $client->fetchAccessTokenWithAuthCode($code);
        if (isset($token['error'])) {
            return ['error' => true, 'message' => $token['error_description']];
        }

        $client->setAccessToken($token);
        $oauth2 = new Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        return [
            'error' => false,
            'access_token' => $token['access_token'] ?? '',
            'refresh_token' => $token['refresh_token'] ?? '',
            'email' => $userInfo->email ?? '',
            'name' => $userInfo->givenName ?? '',
            'picture' => $userInfo->picture ?? ''
        ];
    }

    public function refreshAccessToken(string $refreshToken): ?string
    {
        $client = new Client();
        $client->setClientId($this->google_client_id);
        $client->setClientSecret($this->google_client_secret);
        $client->setAccessType('offline');
        
        $client->refreshToken($refreshToken);
        $newToken = $client->getAccessToken();
        
        return $newToken['access_token'] ?? null;
    }

    // ฟังก์ชันอื่นๆ เช่น get_google_sheet_list, create_google_sheet...
    // สามารถย้ายมาจากโค้ดเดิมและปรับใช้กับ Client ใหม่ได้เลย
}
