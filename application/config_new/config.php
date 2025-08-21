<?php
// application/config/config.php

// ข้อมูลทั่วไปของผลิตภัณฑ์
$config['default_page_url'] = 'home'; // เปลี่ยนเป็นหน้าหลักที่เหมาะสม
$config['product_name'] = 'ช่างแชทบอท'; // ชื่อผลิตภัณฑ์ในภาษาไทย
$config['product_short_name'] = 'ChatBot'; 
$config['product_version'] = '9.4.3';
$config['slogan'] = 'ครบทุกเครื่องมือการตลาดออนไลน์ในที่เดียว'; // สโลแกนในภาษาไทย

// ข้อมูลติดต่อองค์กร
$config['institute_address1'] = '123 ถนนสุขุมวิท, แขวงคลองเตย, กรุงเทพมหานคร';
$config['institute_address2'] = 'ประเทศไทย 10110';
$config['institute_email'] = 'support@yourdomain.com';
$config['institute_mobile'] = '+669xxxxxx'; // เบอร์โทรศัพท์ในไทย

// การตั้งค่าภาษาและเวลา
$config['time_zone'] = 'Asia/Bangkok';
$config['language'] = 'thai'; // ตั้งค่าภาษาเริ่มต้นเป็นไทย

// การตั้งค่าความปลอดภัย
$config['force_https'] = '1';
$config['enable_signup_form'] = '1';
$config['enable_support'] = '1';

// การตั้งค่าเซสชั่น (เปลี่ยนเป็นใช้ฐานข้อมูลเพื่อความปลอดภัย)
$config['sess_use_database'] = TRUE;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_driver'] = 'database'; // กำหนด driver สำหรับ session

// การตั้งค่าลิมิตการอัปโหลดไฟล์ (เป็นค่าเริ่มต้น)
$config['image_upload_limit'] = '2'; // 2 MB
$config['video_upload_limit'] = '15'; // 15 MB
$config['audio_upload_limit'] = '5'; // 5 MB
$config['file_upload_limit'] = '15'; // 15 MB

// การตั้งค่าการทำงานเบื้องหลัง (Cron Job)
$config['messengerbot_subscriber_avatar_download_limit_per_cron_job'] = '25';
$config['messengerbot_subscriber_profile_update_limit_per_cron_job'] = '100';

// ค่าการตั้งค่าที่ควรกำหนดในฐานข้อมูลหรือไฟล์ .env
// $config['master_password'] = '';
// $config['email_sending_option'] = 'php_mail'; 
// $config['facebook_poster_group_enable_disable'] = '0';
// $config['persistent_menu_copyright_text'] = '';
// ข้อมูลเหล่านี้ควรกำหนดในหน้า Admin Panel หรือไฟล์ที่ปลอดภัย
