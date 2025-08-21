<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['default_page_url'] = 'dashboard';
$config['product_name'] = 'ช่างแชทบอท';
$config['product_short_name'] = 'ChatBot';
$config['product_version'] = '1.0.0'; // Updated version
$config['slogan'] = 'ครบทุกเครื่องมือการตลาดออนไลน์ในที่เดียว';

$config['institute_address1'] = '123 ถนนสุขุมวิท';
$config['institute_address2'] = 'แขวงคลองเตย, กรุงเทพมหานคร 10110';
$config['institute_email'] = 'support@yourdomain.com';
$config['institute_mobile'] = '+66912345678';

$config['time_zone'] = 'Asia/Bangkok'; // ตั้งค่าโซนเวลาประเทศไทย
$config['language'] = 'thai'; // ตั้งค่าภาษาไทยเริ่มต้น

// File upload limits (MB)
$config['image_upload_limit'] = '2';
$config['video_upload_limit'] = '15';
$config['audio_upload_limit'] = '5';
$config['file_upload_limit'] = '15';

$config['email_sending_option'] = 'php_mail'; // หรือ 'smtp'
$config['force_https'] = '1'; // บังคับใช้ HTTPS
$config['enable_signup_form'] = '1';
$config['enable_support'] = '1';
$config['enable_facebook_login'] = '1'; // เพิ่มการตั้งค่าสำหรับ Facebook Login

// Master password - ควรย้ายไปอยู่ใน .env และดึงมาใช้ด้วย getenv()
// $config['master_password_hash'] = 'HASH_OF_YOUR_MASTER_PASSWORD';

// Session config - ensure database session is set up in application/config/database.php
$config['sess_use_database'] = TRUE;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_driver'] = 'database';

// Other limits and settings
$config['messengerbot_subscriber_avatar_download_limit_per_cron_job'] = '25';
$config['messengerbot_subscriber_profile_update_limit_per_cron_job'] = '100';
// ... อื่นๆ ที่เกี่ยวข้องกับการทำงานของบอทและรายงาน
