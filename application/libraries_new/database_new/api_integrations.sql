CREATE TABLE `api_integrations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `service_name` VARCHAR(50) NOT NULL,
  `api_key` TEXT NOT NULL,
  `api_model` VARCHAR(50) DEFAULT NULL,
  `last_used_at` DATETIME DEFAULT NULL,
  `monthly_usage_count` INT(11) NOT NULL DEFAULT '0',
  `is_active` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
