CREATE TABLE `google_sheets_integrations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `google_account_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `sheet_id` VARCHAR(255) NOT NULL,
  `sheet_name` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `google_account_id` (`google_account_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
