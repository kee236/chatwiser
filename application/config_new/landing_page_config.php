<?php
// application/config/landing_page_config.php

// การตั้งค่าทั่วไปของหน้า Landing Page
$config['theme_front'] = 'purple'; // เลือกธีมสีของหน้าเว็บไซต์
$config['display_landing_page'] = '1'; // แสดงหน้า Landing Page (1 = เปิด, 0 = ปิด)

// ข้อมูล Social Media สำหรับติดต่อ
$config['facebook'] = 'https://www.facebook.com/your-business-page';
$config['line_official'] = 'https://lin.ee/your-line-official'; // เพิ่ม Line Official Account
$config['tiktok'] = 'https://www.tiktok.com/@your-business'; // เพิ่ม TikTok
$config['youtube'] = 'https://www.youtube.com/channel/your-channel-id';

// วิดีโอแนะนำสินค้าและรีวิว
$config['display_video_block'] = '1'; // แสดงบล็อกวิดีโอ (1 = เปิด, 0 = ปิด)
$config['promo_video'] = 'https://www.youtube.com/embed/your-promo-video-id'; // ใส่ embed URL ของวิดีโอ
$config['customer_review_video'] = 'https://www.youtube.com/embed/your-customer-review-video-id'; // เพิ่มวิดีโอรีวิวจากลูกค้า

// ข้อมูลรีวิวจากลูกค้า (สามารถเพิ่มได้ตามต้องการ)
$config['display_review_block'] = '1'; // แสดงบล็อกรีวิว (1 = เปิด, 0 = ปิด)
$config['customer_review'] = array(
   array(
       'name' => 'คุณสมใจ',
       'title' => 'เจ้าของร้านเสื้อผ้าออนไลน์',
       'image_path' => 'assets/site_new/img/client/สมใจ.jpg',
       'review' => 'ระบบจัดการออเดอร์อัตโนมัติช่วยให้ชีวิตง่ายขึ้นมาก ไม่ต้องตอบแชทลูกค้ายันดึกอีกต่อไป',
    ),
   array(
       'name' => 'คุณมานะ',
       'title' => 'เจ้าของธุรกิจ SME',
       'image_path' => 'assets/site_new/img/client/มานะ.jpg',
       'review' => 'ไม่พลาดทุกออเดอร์จากคอมเมนต์ ทำให้ยอดขายเพิ่มขึ้นอย่างเห็นได้ชัด ระบบใช้ง่ายและมีประสิทธิภาพสูงครับ!',
    ),
   array(
       'name' => 'คุณแก้ว',
       'title' => 'ผู้จัดการร้านค้า',
       'image_path' => 'assets/site_new/img/client/แก้ว.jpg',
       'review' => 'ลูกค้าทักมาเยอะแค่ไหนก็เอาอยู่ ระบบตอบกลับเร็วมาก แถมยังปิดการขายให้เสร็จสรรพ',
    ),
);

// วิดีโอสอนการใช้งานระบบ (Tutorials)
$config['custom_video'] = array(
   array(
     'thumbnail' => 'assets/site_new/img/tutorial/thumbnail-1.jpg',
     'title' => 'วิธีตั้งค่า Facebook และ Instagram',
     'video_url' => 'https://www.youtube.com/watch?v=your-video-id-1',
   ),
   array(
     'thumbnail' => 'assets/site_new/img/tutorial/thumbnail-2.jpg',
     'title' => 'การจัดการโพสต์และดูดคอมเมนต์',
     'video_url' => 'https://www.youtube.com/watch?v=your-video-id-2',
   ),
   array(
     'thumbnail' => 'assets/site_new/img/tutorial/thumbnail-3.jpg',
     'title' => 'การเชื่อมต่อระบบขนส่งและการชำระเงิน',
     'video_url' => 'https://www.youtube.com/watch?v=your-video-id-3',
   ),
   array(
     'thumbnail' => 'assets/site_new/img/tutorial/thumbnail-4.jpg',
     'title' => 'ภาพรวมการใช้งานระบบ (Full Demo)',
     'video_url' => 'https://www.youtube.com/watch?v=your-video-id-4',
   ),
);
