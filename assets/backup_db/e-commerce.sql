-- คำสั่งสำหรับยกเลิกตารางเดิม (ถ้ามี) เพื่อให้สามารถรัน Script นี้ซ้ำได้
DROP TABLE IF EXISTS `ci_sessions`;
DROP TABLE IF EXISTS `activity_log`;
DROP TABLE IF EXISTS `login_attempts`;
DROP TABLE IF EXISTS `forgot_password`;
DROP TABLE IF EXISTS `usage_log`;
DROP TABLE IF EXISTS `package_transactions`;
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `package_module_limits`; -- หากมีการจัดการ limit ราย module
DROP TABLE IF EXISTS `package`;
DROP TABLE IF EXISTS `global_payment_settings`;
DROP TABLE IF EXISTS `ecommerce_reviews`;
DROP TABLE IF EXISTS `ecommerce_delivery_boys`;
DROP TABLE IF EXISTS `ecommerce_coupons`;
DROP TABLE IF EXISTS `ecommerce_product_prices`;
DROP TABLE IF EXISTS `ecommerce_product_attributes`;
DROP TABLE IF EXISTS `ecommerce_attributes`;
DROP TABLE IF EXISTS `ecommerce_products`;
DROP TABLE IF EXISTS `ecommerce_categories`;
DROP TABLE IF EXISTS `ecommerce_config`;
DROP TABLE IF EXISTS `ecommerce_cart_items`;
DROP TABLE IF EXISTS `ecommerce_cart`;
DROP TABLE IF EXISTS `ecommerce_stores`;
DROP TABLE IF EXISTS `zone_locations`;
DROP TABLE IF EXISTS `shipping_rates`;
DROP TABLE IF EXISTS `shipping_zones`;
DROP TABLE IF EXISTS `shipping_methods`;
DROP TABLE IF EXISTS `bank_accounts`;
DROP TABLE IF EXISTS `districts`;
DROP TABLE IF EXISTS `amphures`;
DROP TABLE IF EXISTS `provinces`;
DROP TABLE IF EXISTS `modules`;
DROP TABLE IF EXISTS `users`;





--
-- ตาราง: `users` - ตารางสำหรับข้อมูลผู้ใช้งานระบบ
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('Admin','Member','Staff') NOT NULL DEFAULT 'Member',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `current_package_id` int(11) DEFAULT NULL COMMENT 'Package ID ที่ใช้งานปัจจุบัน',
  `package_start_date` date DEFAULT NULL,
  `package_expired_date` date DEFAULT NULL,
  `last_payment_method` varchar(50) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `modules` - ตารางสำหรับโมดูลหรือคุณสมบัติของระบบ
--
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL UNIQUE,
  `description` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_add_on` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'เป็น Add-on ที่สามารถเปิด/ปิดได้หรือไม่',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `provinces` - ตารางเก็บรายชื่อจังหวัดของประเทศไทย
-- (ใช้ข้อมูลจาก `https://github.com/earthchie/amphures`)
--
CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_th` varchar(150) NOT NULL,
  `name_en` varchar(150) NOT NULL,
  `geography_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `amphures` - ตารางเก็บรายชื่ออำเภอ/เขตของประเทศไทย
--
CREATE TABLE `amphures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_th` varchar(150) NOT NULL,
  `name_en` varchar(150) NOT NULL,
  `province_id` int(11) NOT NULL,
  `geography_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province_id` (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `districts` - ตารางเก็บรายชื่อตำบล/แขวงของประเทศไทย
--
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_th` varchar(150) NOT NULL,
  `name_en` varchar(150) NOT NULL,
  `amphure_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `geography_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `amphure_id` (`amphure_id`),
  KEY `province_id` (`province_id`),
  KEY `zip_code` (`zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- ตาราง: `bank_accounts` - ตารางสำหรับบัญชีธนาคารของร้านค้า
--
CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL COMMENT 'ID ร้านค้าที่เกี่ยวข้อง (NULL ถ้าเป็นบัญชีกลาง)',
  `bank_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `qr_code_image` varchar(255) DEFAULT NULL COMMENT 'Path หรือ URL รูปภาพ QR Code สำหรับบัญชีนี้',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `shipping_methods` - ตารางสำหรับวิธีการจัดส่ง
--
CREATE TABLE `shipping_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `shipping_zones` - ตารางสำหรับเขตการจัดส่ง (อาจอ้างอิงจากรหัสไปรษณีย์)
--
CREATE TABLE `shipping_zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `zone_locations` - ตารางสำหรับกำหนดพื้นที่ในแต่ละ Zone (เช่น รหัสไปรษณีย์ใน Zone)
--
CREATE TABLE `zone_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL,
  `location_type` enum('province_id','amphure_id','district_id','zip_code') NOT NULL,
  `location_code` varchar(20) NOT NULL COMMENT 'ID หรือรหัสไปรษณีย์ของ location',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `zone_id` (`zone_id`),
  KEY `location_code` (`location_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `shipping_rates` - ตารางสำหรับค่าจัดส่งในแต่ละ Zone/Method/Weight
--
CREATE TABLE `shipping_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_method_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `min_weight_kg` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_weight_kg` decimal(10,2) NOT NULL DEFAULT '99999.99',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shipping_method_id` (`shipping_method_id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_stores` - ตารางสำหรับร้านค้า E-commerce
--
CREATE TABLE `ecommerce_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'เจ้าของร้านค้า',
  `store_name` varchar(255) NOT NULL,
  `store_email` varchar(255) DEFAULT NULL,
  `store_phone` varchar(50) DEFAULT NULL,
  `store_address` text DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `amphure_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `province_id` (`province_id`),
  KEY `amphure_id` (`amphure_id`),
  KEY `district_id` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_config` - ตารางตั้งค่าเฉพาะร้านค้า (Payment, Shipping)
--
CREATE TABLE `ecommerce_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL UNIQUE,
  `currency` varchar(10) NOT NULL DEFAULT 'THB',
  `manual_payment_enabled` enum('0','1') NOT NULL DEFAULT '0',
  `manual_payment_instruction` text DEFAULT NULL,
  `omise_enabled` enum('0','1') NOT NULL DEFAULT '0',
  `omise_public_key` varchar(255) DEFAULT NULL,
  `omise_secret_key` varchar(255) DEFAULT NULL,
  `omise_mode` enum('test','live') NOT NULL DEFAULT 'test',
  `2c2p_enabled` enum('0','1') NOT NULL DEFAULT '0',
  `2c2p_merchant_id` varchar(255) DEFAULT NULL,
  `2c2p_secret_key` varchar(255) DEFAULT NULL,
  `2c2p_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `promptpay_enabled` enum('0','1') NOT NULL DEFAULT '0',
  `promptpay_account_name` varchar(255) DEFAULT NULL,
  `promptpay_account_number` varchar(50) DEFAULT NULL,
  `bank_transfer_enabled` enum('0','1') NOT NULL DEFAULT '0',
  -- เพิ่มการตั้งค่าอื่นๆ ที่เกี่ยวกับร้านค้า (เช่น Google Analytics ID, WhatsApp Number)
  `google_analytics_id` varchar(50) DEFAULT NULL,
  `whatsapp_number` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_categories` - ตารางสำหรับหมวดหมู่สินค้า E-commerce
--
CREATE TABLE `ecommerce_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_products` - ตารางสำหรับสินค้า E-commerce
--
CREATE TABLE `ecommerce_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text,
  `original_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `featured_image` text DEFAULT NULL, -- อาจเก็บเป็น JSON array ของหลายรูป
  `stock_quantity` int(11) NOT NULL DEFAULT '0',
  `weight_kg` decimal(10,2) NOT NULL DEFAULT '0.00',
  `category_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_attributes` - ตารางสำหรับคุณสมบัติสินค้า (เช่น สี, ขนาด)
--
CREATE TABLE `ecommerce_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_type` enum('dropdown','radio','color') NOT NULL DEFAULT 'dropdown',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_product_attributes` - ตารางสำหรับค่าคุณสมบัติสินค้า (เช่น สี: แดง, น้ำเงิน)
--
CREATE TABLE `ecommerce_product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `attribute_option_name` varchar(255) NOT NULL,
  `color_code` varchar(50) DEFAULT NULL, -- สำหรับ attribute_type เป็น color
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_product_prices` - ตารางสำหรับราคาที่แตกต่างกันตามคุณสมบัติสินค้า
--
CREATE TABLE `ecommerce_product_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_option_id` int(11) NOT NULL,
  `price_indicator` enum('+','-') NOT NULL DEFAULT '+',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock_quantity` int(11) DEFAULT NULL COMMENT 'Stock สำหรับ SKU เฉพาะ',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `attribute_option_id` (`attribute_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- ตาราง: `ecommerce_cart` - ตารางสำหรับข้อมูลตะกร้าสินค้า/คำสั่งซื้อหลัก
--
CREATE TABLE `ecommerce_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'ID ผู้ใช้งาน (ถ้าเป็น member)',
  `store_id` int(11) NOT NULL,
  `buyer_first_name` varchar(255) NOT NULL,
  `buyer_last_name` varchar(255) NOT NULL,
  `buyer_email` varchar(255) DEFAULT NULL,
  `buyer_mobile` varchar(50) NOT NULL,
  `buyer_address` text NOT NULL COMMENT 'ที่อยู่บรรทัดที่ 1',
  `buyer_province_id` int(11) NOT NULL,
  `buyer_amphure_id` int(11) NOT NULL,
  `buyer_district_id` int(11) NOT NULL,
  `buyer_zip` varchar(10) NOT NULL,
  `shipping_method_id` int(11) DEFAULT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sub_total` decimal(10,2) NOT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL COMMENT 'PromptPay, Bank_Transfer, Omise, 2C2P, Manual etc.',
  `order_status` enum('pending','processing','shipped','delivered','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `delivery_note` text DEFAULT NULL,
  `tracking_code` varchar(255) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL COMMENT 'เวลาที่ชำระเงินสำเร็จ',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `store_id` (`store_id`),
  KEY `buyer_province_id` (`buyer_province_id`),
  KEY `buyer_amphure_id` (`buyer_amphure_id`),
  KEY `buyer_district_id` (`buyer_district_id`),
  KEY `shipping_method_id` (`shipping_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_cart_items` - ตารางสำหรับรายละเอียดสินค้าในตะกร้า/คำสั่งซื้อ
--
CREATE TABLE `ecommerce_cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `attribute_info_json` text DEFAULT NULL COMMENT 'JSON string ของ attribute และ option ที่เลือก',
  `item_total` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_coupons` - ตารางสำหรับคูปองส่วนลด E-commerce
--
CREATE TABLE `ecommerce_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL UNIQUE,
  `discount_type` enum('percentage','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `usage_limit` int(11) DEFAULT NULL COMMENT 'จำนวนครั้งที่ใช้ได้ทั้งหมด (NULL=ไม่จำกัด)',
  `usage_count` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `coupon_code` (`coupon_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_reviews` - ตารางสำหรับรีวิวสินค้า
--
CREATE TABLE `ecommerce_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'ID ผู้รีวิว (ถ้าเป็น member)',
  `reviewer_name` varchar(255) NOT NULL,
  `reviewer_email` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL COMMENT 'คะแนนรีวิว 1-5',
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `ecommerce_delivery_boys` - ตารางสำหรับพนักงานส่งของ E-commerce
--
CREATE TABLE `ecommerce_delivery_boys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `global_payment_settings` - ตารางตั้งค่า Payment Gateway ระดับแพลตฟอร์ม (สำหรับ Package Subscription)
--
CREATE TABLE `global_payment_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(10) NOT NULL DEFAULT 'THB',
  `paypal_email` varchar(255) DEFAULT NULL,
  `paypal_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `stripe_secret_key` varchar(255) DEFAULT NULL,
  `stripe_publishable_key` varchar(255) DEFAULT NULL,
  `stripe_mode` enum('test','live') NOT NULL DEFAULT 'test',
  `manual_payment_enabled` enum('0','1') NOT NULL DEFAULT '0',
  `manual_payment_instruction` text DEFAULT NULL,
  `promptpay_enabled` enum('0','1') NOT NULL DEFAULT '0',
  `promptpay_account_name` varchar(255) DEFAULT NULL,
  `promptpay_account_number` varchar(50) DEFAULT NULL,
  `bank_transfer_enabled` enum('0','1') NOT NULL DEFAULT '0',
  -- เพิ่มช่องทางการชำระเงินอื่นๆ ที่คุณต้องการใช้ในระดับ Global สำหรับแพ็กเกจ (ถ้ามี)
  -- ลบช่องทางต่างประเทศที่ไม่ใช้ เช่น Mollie, Razorpay, Paystack, Mercadopago, SSLCommerz, SenangPay, Instamojo, Toyyibpay, Xendit, Myfatoorah, Paymaya
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `package` - ตารางสำหรับแพ็กเกจการสมัครสมาชิก
--
CREATE TABLE `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL UNIQUE,
  `price` decimal(10,2) NOT NULL,
  `validity_days` int(11) NOT NULL COMMENT 'จำนวนวันของแพ็กเกจ',
  `is_default` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'แพ็กเกจเริ่มต้นหรือไม่',
  `visible` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'แสดงผลให้เลือกซื้อหรือไม่',
  `highlight` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'แพ็กเกจแนะนำหรือไม่',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ตาราง: `package_module_limits` - ตารางสำหรับกำหนดขีดจำกัดการใช้งานโมดูลในแต่ละแพ็กเกจ (ถ้ายังต้องการ)
--
CREATE TABLE `package_module_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `monthly_limit` int(11) NOT NULL DEFAULT '-1' COMMENT '-1 = Unlimited',
  `bulk_limit` int(11) NOT NULL DEFAULT '-1' COMMENT '-1 = Unlim