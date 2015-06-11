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

 Date: 06/11/2015 09:18:32 AM
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
--  Records of `tb_admin`
-- ----------------------------
BEGIN;
INSERT INTO `tb_admin` VALUES ('1', 'admin', 'cb7dae101850facf7f612731de40b82f', 'admin@admin.vn', '2015-05-13 14:35:51', '2015-05-13 14:35:54', '0');
COMMIT;

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
  `gia_theo_dem` float NOT NULL,
  `gia_theo_tuan` float NOT NULL,
  `gia_theo_thang` float NOT NULL,
  `phi_them_khach` float NOT NULL,
  `phi_don_dep` float NOT NULL,
  `so_dem_toi_thieu` int(11) NOT NULL,
  `so_dem_toi_da` int(11) NOT NULL,
  `time_nhan_phong` datetime NOT NULL,
  `time_tra_phong` datetime NOT NULL,
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
--  Records of `tb_users`
-- ----------------------------
BEGIN;
INSERT INTO `tb_users` VALUES ('1', 'xuanhoa_1201@yahoo.com', 'shareroom.vn', 'Hòa', 'Trà Đá', '1989-01-12', '1', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/s200x200/1470006_806118269435131_1527776481786918463_n.jpg?oh=502c80cdf4a1ec0c8d57c7dc2c9cb9e8&oe=55FA815C&__gda__=1443322675_f1f89e4f915631177371a68ee6a14e61', null, '892770294103261', '2015-05-22 22:35:52', '2015-05-22 22:35:52', '0', ''), ('2', 'xuanhoapro@gmail.com', 'shareroom.vn', 'Xuân Hòa', 'Nguyễn', null, '1', null, null, 'https://lh3.googleusercontent.com/-6SBTZCxzv6M/AAAAAAAAAAI/AAAAAAAAAH8/RGKA045KRLw/photo.jpg', '109417562987108464186', null, '2015-05-22 23:49:15', '2015-05-22 23:49:15', '0', '');
COMMIT;

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
