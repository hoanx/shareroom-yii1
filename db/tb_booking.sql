/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : shareroom-yii1

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-06-25 17:04:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_booking`
-- ----------------------------
DROP TABLE IF EXISTS `tb_booking`;
CREATE TABLE `tb_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `room_address_id` int(11) NOT NULL,
  `check_in` varchar(255) NOT NULL,
  `check_out` varchar(255) NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `room_price` float NOT NULL,
  `cleaning_fees` float NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status_flg` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0: pending; 1: Da thanh toan : 2 thanh toan loi; 3: refund',
  `invoice_date` datetime DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking
-- ----------------------------
INSERT INTO `tb_booking` VALUES ('1', '2', '1', '25-06-2015 12:00', '08-07-2015 12:00', '3', '700000', '0', null, null, '9100000', 'company', '0', null, null, '2015-06-25 17:01:14', '2015-06-25 17:01:14', '0');

-- ----------------------------
-- Table structure for `tb_booking_history`
-- ----------------------------
DROP TABLE IF EXISTS `tb_booking_history`;
CREATE TABLE `tb_booking_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_address_detail` varchar(255) NOT NULL,
  `room_address` varchar(255) NOT NULL,
  `room_district` varchar(255) NOT NULL,
  `room_city` varchar(255) NOT NULL,
  `room_lat` float NOT NULL,
  `room_long` float NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_history
-- ----------------------------
INSERT INTO `tb_booking_history` VALUES ('1', '1', 'cho thue van phong', '16 Láng Hạ, Thành Công, Ba Đình, Hà Nội, Vietnam', '16 Láng Hạ', 'Ba Đình', 'Hà Nội', '21.0186', '105.816', '2015-06-25 17:01:14', '2015-06-25 17:01:14', '0');

-- ----------------------------
-- Table structure for `tb_booking_payment`
-- ----------------------------
DROP TABLE IF EXISTS `tb_booking_payment`;
CREATE TABLE `tb_booking_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `bank_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `bank_holder_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `card_code` varchar(255) DEFAULT NULL,
  `card_expire` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_payment
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_booking_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_booking_user`;
CREATE TABLE `tb_booking_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_user
-- ----------------------------
INSERT INTO `tb_booking_user` VALUES ('1', '1', '2', 'Xuân Hòa', 'Nguyễn', '', 'xuanhoapro@gmail.com', '0985050225', '2015-06-25 17:01:14', '2015-06-25 17:01:14');

-- ----------------------------
-- Table structure for `tb_coupon`
-- ----------------------------
DROP TABLE IF EXISTS `tb_coupon`;
CREATE TABLE `tb_coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_amount` int(11) NOT NULL COMMENT 'discount theo %',
  `period` date DEFAULT NULL,
  `coupon_uses` int(11) DEFAULT NULL COMMENT 'so lan su dung ma coupon',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_coupon
-- ----------------------------
