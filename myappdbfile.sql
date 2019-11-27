-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.10 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for my_app
CREATE DATABASE IF NOT EXISTS `my_app` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `my_app`;

-- Dumping structure for table my_app.found_items
CREATE TABLE IF NOT EXISTS `found_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(50) DEFAULT NULL,
  `finder_contact` varchar(50) DEFAULT NULL,
  `date_posted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table my_app.items
CREATE TABLE IF NOT EXISTS `items` (
  `owner_username` varchar(50) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `item_category` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`registration_number`),
  KEY `owner_rel` (`owner_username`),
  CONSTRAINT `owner_rel` FOREIGN KEY (`owner_username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table my_app.lost_items
CREATE TABLE IF NOT EXISTS `lost_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(50) NOT NULL,
  `owner_contact` varchar(50) NOT NULL,
  `date_lost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `registration_number` (`registration_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table my_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
