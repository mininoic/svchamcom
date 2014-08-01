/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50171
Source Host           : localhost:3306
Source Database       : com

Target Server Type    : MYSQL
Target Server Version : 50171
File Encoding         : 65001

Date: 2014-08-01 09:46:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account_payment
-- ----------------------------
DROP TABLE IF EXISTS `account_payment`;
CREATE TABLE `account_payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `first_update` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `account_payment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `location_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`),
  KEY `country_id` (`country_id`),
  KEY `state_id` (`state_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for area_country
-- ----------------------------
DROP TABLE IF EXISTS `area_country`;
CREATE TABLE `area_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `area_country_ibfk_1` FOREIGN KEY (`id`) REFERENCES `address` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for area_district
-- ----------------------------
DROP TABLE IF EXISTS `area_district`;
CREATE TABLE `area_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `area_district_ibfk_1` FOREIGN KEY (`id`) REFERENCES `address` (`district_id`),
  CONSTRAINT `area_district_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `area_state` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for area_state
-- ----------------------------
DROP TABLE IF EXISTS `area_state`;
CREATE TABLE `area_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `area_state_ibfk_1` FOREIGN KEY (`id`) REFERENCES `address` (`state_id`),
  CONSTRAINT `area_state_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `area_country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon` varchar(255) DEFAULT NULL,
  `time_create` datetime DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_expire` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `desc` text,
  `address_id` bigint(20) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_expire` datetime DEFAULT NULL,
  `time_update` datetime DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for customer_setting
-- ----------------------------
DROP TABLE IF EXISTS `customer_setting`;
CREATE TABLE `customer_setting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` text,
  `value` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dish
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dish_category_id` int(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `long_desc` text,
  `avatar` text,
  `cover` text,
  `price` float DEFAULT NULL,
  `nutrition_value` varchar(255) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `time_create` datetime DEFAULT NULL,
  `time_update` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dish_category_id` (`dish_category_id`),
  CONSTRAINT `dish_ibfk_1` FOREIGN KEY (`dish_category_id`) REFERENCES `dish_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dish_categories
-- ----------------------------
DROP TABLE IF EXISTS `dish_categories`;
CREATE TABLE `dish_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for location
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` bigint(20) NOT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`id`) REFERENCES `address` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for moderator
-- ----------------------------
DROP TABLE IF EXISTS `moderator`;
CREATE TABLE `moderator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) DEFAULT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `reciever` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_delivery_id` bigint(20) DEFAULT NULL,
  `time_delivery` varchar(255) DEFAULT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  `is_paid` tinyint(4) DEFAULT '0',
  `is_ship` tinyint(4) DEFAULT NULL,
  `is_confirm` tinyint(4) DEFAULT NULL,
  `token_delivery` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `coupon` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buyer_id` (`buyer_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for order_dish
-- ----------------------------
DROP TABLE IF EXISTS `order_dish`;
CREATE TABLE `order_dish` (
  `order_id` bigint(20) NOT NULL,
  `dish_id` bigint(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `total_cost` float DEFAULT NULL,
  PRIMARY KEY (`order_id`,`dish_id`),
  KEY `dish_id` (`dish_id`),
  CONSTRAINT `order_dish_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `order_dish_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for order_vendor
-- ----------------------------
DROP TABLE IF EXISTS `order_vendor`;
CREATE TABLE `order_vendor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `number_order` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `vendor_id` (`vendor_id`),
  CONSTRAINT `order_vendor_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `order_vendor_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for payment_log
-- ----------------------------
DROP TABLE IF EXISTS `payment_log`;
CREATE TABLE `payment_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `action_type` tinyint(4) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  `respon` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payment_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for payment_method
-- ----------------------------
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for raw_rice
-- ----------------------------
DROP TABLE IF EXISTS `raw_rice`;
CREATE TABLE `raw_rice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ratio` float DEFAULT NULL,
  `time_update` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for registration
-- ----------------------------
DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address_id` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for review_dish
-- ----------------------------
DROP TABLE IF EXISTS `review_dish`;
CREATE TABLE `review_dish` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `referen_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `point` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referen_id` (`referen_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `review_dish_ibfk_1` FOREIGN KEY (`referen_id`) REFERENCES `dish` (`id`),
  CONSTRAINT `review_dish_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for review_set_combo
-- ----------------------------
DROP TABLE IF EXISTS `review_set_combo`;
CREATE TABLE `review_set_combo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `referen_id` int(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `point` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referen_id` (`referen_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `review_set_combo_ibfk_1` FOREIGN KEY (`referen_id`) REFERENCES `set_combo` (`id`),
  CONSTRAINT `review_set_combo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for set_combo
-- ----------------------------
DROP TABLE IF EXISTS `set_combo`;
CREATE TABLE `set_combo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `long_desc` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for set_combo_dish
-- ----------------------------
DROP TABLE IF EXISTS `set_combo_dish`;
CREATE TABLE `set_combo_dish` (
  `dish_id` bigint(20) NOT NULL,
  `set_combo_id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`dish_id`,`set_combo_id`),
  KEY `set_combo_id` (`set_combo_id`),
  CONSTRAINT `set_combo_dish_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`),
  CONSTRAINT `set_combo_dish_ibfk_2` FOREIGN KEY (`set_combo_id`) REFERENCES `set_combo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shiper
-- ----------------------------
DROP TABLE IF EXISTS `shiper`;
CREATE TABLE `shiper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `desc` text,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_expire` datetime DEFAULT NULL,
  `time_update` datetime DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shiper_users
-- ----------------------------
DROP TABLE IF EXISTS `shiper_users`;
CREATE TABLE `shiper_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `address_id` bigint(255) DEFAULT NULL,
  `type_user` tinyint(4) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  CONSTRAINT `shiper_users_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `type_customer` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vendor
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `desc` text,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_expire` datetime DEFAULT NULL,
  `time_update` datetime DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vendor_users
-- ----------------------------
DROP TABLE IF EXISTS `vendor_users`;
CREATE TABLE `vendor_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `address_id` bigint(255) DEFAULT NULL,
  `type_user` tinyint(4) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  CONSTRAINT `vendor_users_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
