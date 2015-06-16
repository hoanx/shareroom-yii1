/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost
 Source Database       : shareroom-yii1

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : utf-8

 Date: 06/12/2015 00:09:55 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tb_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(2) DEFAULT '0' COMMENT '0: activated, 1: deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_messages`
-- ----------------------------
DROP TABLE IF EXISTS `tb_messages`;
CREATE TABLE `tb_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_type` int(11) NOT NULL DEFAULT '0' COMMENT '0: message default; 1: message new booking room',
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `from_user_fisrt_name` varchar(255) NOT NULL,
  `from_user_last_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `qty_guests` int(11) NOT NULL,
  `content` text NOT NULL,
  `status_flg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : unRead; 1:Readed',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_room_address`
-- ----------------------------
DROP TABLE IF EXISTS `tb_room_address`;
CREATE TABLE `tb_room_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address_detail` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `room_type` varchar(255) DEFAULT NULL COMMENT 'loai phong: 1:ca can ho, 2: phong rieng, 3: phong chia se',
  `accommodates` int(11) NOT NULL COMMENT 'So khach',
  `bedrooms` int(11) NOT NULL COMMENT 'Phong ngu',
  `beds` int(11) NOT NULL COMMENT 'Giuong',
  `room_size` int(11) NOT NULL COMMENT 'Dien tich phong',
  `amenities` varchar(255) NOT NULL COMMENT 'Tien nghi',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_room_images`
-- ----------------------------
DROP TABLE IF EXISTS `tb_room_images`;
CREATE TABLE `tb_room_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_address_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`room_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_room_price`
-- ----------------------------
DROP TABLE IF EXISTS `tb_room_price`;
CREATE TABLE `tb_room_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_address_id` int(11) NOT NULL,
  `price` float NOT NULL COMMENT 'Theo đêm',
  `weekly` float NOT NULL COMMENT 'Theo tuần',
  `monthly` float NOT NULL COMMENT 'Theo tháng',
  `additional_guests` float NOT NULL COMMENT 'Phí cho mỗi khách thêm',
  `cleaning_fees` float NOT NULL COMMENT 'Phí dọn dẹp',
  `cancellation` tinyint(4) DEFAULT '1' COMMENT 'Chính sách huỷ bỏ',
  `house_rules` text COMMENT 'Quy định',
  `min_nights` int(11) NOT NULL COMMENT 'Số đêm tối thiểu',
  `max_nights` int(11) NOT NULL COMMENT 'Số đêm tối đa',
  `check_in` varchar(255) NOT NULL COMMENT 'Nhận phòng sau',
  `check_out` varchar(255) NOT NULL COMMENT 'Trả phòng trước',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`room_address_id`),
  KEY `room_address_id` (`room_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_users`
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT '0',
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_picture` text,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `del_flg` tinyint(4) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tb_users_bank`
-- ----------------------------
DROP TABLE IF EXISTS `tb_users_bank`;
CREATE TABLE `tb_users_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bank_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `bank_holder_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `del_flg` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
