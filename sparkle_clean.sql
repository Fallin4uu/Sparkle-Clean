SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `sparkle_clean`
CREATE DATABASE IF NOT EXISTS `sparkle_clean` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sparkle_clean`;

CREATE TABLE `admins` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(150) DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `role` ENUM('superadmin','moderator') NOT NULL DEFAULT 'moderator',
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=2;

CREATE TABLE `clients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(20) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `registered_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `nid_number` VARCHAR(20) DEFAULT NULL,
  `nid_front_url` VARCHAR(255) DEFAULT NULL,
  `nid_back_url` VARCHAR(255) DEFAULT NULL,
  `nid_verified` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=2;

CREATE TABLE `services` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `service_name` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `icon_url` VARCHAR(255) DEFAULT NULL,
  `base_fee` DECIMAL(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=5;

CREATE TABLE `workers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(150) NOT NULL,
  `specialty` VARCHAR(100) DEFAULT NULL,
  `bio` TEXT DEFAULT NULL,
  `photo_url` VARCHAR(255) DEFAULT NULL,
  `hire_date` DATE DEFAULT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=4;

CREATE TABLE `contact_messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `message` TEXT NOT NULL,
  `submitted_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `is_read` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `appointments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `client_id` INT(11) NOT NULL,
  `service_id` INT(11) NOT NULL,
  `appointment_date` DATETIME NOT NULL,
  `address` TEXT NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `status` ENUM('Pending','Confirmed','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reviews` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `client_id` INT(11) NOT NULL,
  `service_id` INT(11) DEFAULT NULL,
  `rating` TINYINT(4) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `comment` TEXT DEFAULT NULL,
  `review_date` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Password: admin123
INSERT INTO `admins` (`id`, `username`, `password`, `full_name`, `email`, `role`) VALUES
(1, 'admin', '$2y$10$eI8.4w.yN.1c0o5XbJ3W7e.KzG4y.v.gG5.zF8B.qY7.uG2.oQ2iK', 'Administrator', 'admin@sparkleclean.com', 'superadmin');

INSERT INTO `clients` (`id`, `full_name`, `email`, `password`, `phone_number`, `address`, `registered_at`, `nid_number`, `nid_front_url`, `nid_back_url`, `nid_verified`) VALUES
(1, 'Ashfaq', 'ark@gmail.com', '$2y$10$23EDqg/t6HGBZ5dPe3Ju.up8WGGaNcKlSSRdoIeGezQ..YEyMZXQW', '01631238293', NULL, '2025-09-09 00:53:51', '62986491230', NULL, NULL, 0);

INSERT INTO `services` (`id`, `service_name`, `description`, `icon_url`, `base_fee`) VALUES
(1, 'Residential Cleaning', 'Comprehensive cleaning solutions for your home, from regular upkeep to deep cleaning.', 'https://img.icons8.com/fluency/96/000000/house.png', '120.00'),
(2, 'Commercial Cleaning', 'Keep your office or business premises spotless with our professional cleaning teams.', 'https://img.icons8.com/fluency/96/000000/office-building.png', '250.00'),
(3, 'Carpet & Upholstery', 'Deep cleaning for carpets and furniture to remove stains, dust, and allergens.', 'https://img.icons8.com/fluency/96/000000/carpet.png', '90.00'),
(4, 'Move-Out Cleaning', 'A thorough, top-to-bottom cleaning to ensure you get your security deposit back.', 'https://img.icons8.com/fluency/96/000000/move-by-trolley.png', '300.00');

INSERT INTO `workers` (`id`, `full_name`, `specialty`, `bio`, `photo_url`, `hire_date`, `is_active`) VALUES
(1, 'Maria Garcia', 'Residential Deep Cleaning', 'With over 10 years of experience, Maria ensures every corner of your home is immaculate.', 'https://placehold.co/300x300/EFEFEF/333333?text=Maria', NULL, 1),
(2, 'David Chen', 'Commercial & Office Spaces', 'David specializes in creating clean and productive work environments for businesses of all sizes.', 'https://placehold.co/300x300/EFEFEF/333333?text=David', NULL, 1),
(3, 'Aisha Khan', 'Carpet & Upholstery Expert', 'Aisha uses the latest techniques and eco-friendly solutions to rejuvenate your carpets and furniture.', 'https://placehold.co/300x300/EFEFEF/333333?text=Aisha', NULL, 1);

COMMIT;
