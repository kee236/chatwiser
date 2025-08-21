<?php
// application/config/facebook_api.php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Facebook Application API Settings
|--------------------------------------------------------------------------
|
| These settings are for connecting your application to Facebook Graph API.
| It's highly recommended to use environment variables for actual production values
| and load them securely (e.g., via getenv() or a custom config loader).
| For local development, you can put the values directly here.
|
*/

// Facebook App ID (Get this from Facebook Developer Console)
$config['facebook_app_id'] = getenv('FACEBOOK_APP_ID') ?: 'YOUR_FACEBOOK_APP_ID';

// Facebook App Secret (Keep this highly confidential)
$config['facebook_app_secret'] = getenv('FACEBOOK_APP_SECRET') ?: 'YOUR_FACEBOOK_APP_SECRET';

// Default Graph API Version to use (e.g., 'v19.0')
// Always use a stable and relatively recent version.
$config['facebook_graph_version'] = 'v19.0';
