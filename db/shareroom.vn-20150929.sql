/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : shareroom.vn

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-09-29 11:25:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_admin`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('1', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@admin.vn', '2015-05-13 14:35:51', '2015-08-25 19:25:32', '0');
INSERT INTO `tb_admin` VALUES ('2', 'manager.no1', '25d55ad283aa400af464c76d713c07ad', 'manager.no1@mailinator.com', '2015-08-25 19:31:29', '2015-08-25 19:31:29', '0');
INSERT INTO `tb_admin` VALUES ('3', 'manager.no2', '25d55ad283aa400af464c76d713c07ad', 'manager.no2@mailinator.com', '2015-08-25 19:36:14', '2015-08-25 19:36:14', '0');
INSERT INTO `tb_admin` VALUES ('4', 'nguyentuanmanh', 'e40f5f3bfd3681ac44a8b12aab32fec7', 'nguyentuanmanh@gmail.com', '2015-09-25 19:18:56', '2015-09-25 19:18:56', '0');

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
  `time_check_in` int(255) NOT NULL,
  `time_check_out` int(255) NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `room_price` float NOT NULL,
  `cleaning_fees` float NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `additional_guests` float NOT NULL COMMENT 'Số khách thêm',
  `price_additional_guests` float NOT NULL COMMENT 'Giá cho mỗi khách thêm',
  `total_amount` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1: pending; 2: Da thanh toan : 3 thanh toan loi; 4: refund',
  `booking_status` tinyint(2) NOT NULL DEFAULT '1',
  `invoice_date` datetime DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking
-- ----------------------------
INSERT INTO `tb_booking` VALUES ('1', '4', '1', '16-09-2015', '19-09-2015', '7', '7', '6', '500000', '50000', '', null, '0', '0', '1550000', 'company', '1', '1', null, null, '2015-09-11 00:57:30', '2015-09-11 01:04:46', '1');
INSERT INTO `tb_booking` VALUES ('2', '4', '1', '16-09-2015', '19-09-2015', '7', '7', '6', '500000', '50000', '', null, '0', '0', '1550000', 'company', '1', '1', null, null, '2015-09-11 00:58:52', '2015-09-11 00:58:52', '0');
INSERT INTO `tb_booking` VALUES ('3', '5', '1', '16-09-2015', '20-09-2015', '7', '7', '5', '500000', '50000', '', null, '0', '0', '2050000', 'company', '1', '1', null, null, '2015-09-13 08:42:08', '2015-09-13 08:42:08', '0');
INSERT INTO `tb_booking` VALUES ('4', '9', '1', '17-09-2015', '20-09-2015', '7', '7', '1', '500000', '50000', '', null, '0', '0', '1550000', 'smartlink', '1', '1', null, null, '2015-09-14 09:06:19', '2015-09-14 09:06:19', '0');
INSERT INTO `tb_booking` VALUES ('5', '9', '1', '17-09-2015', '20-09-2015', '7', '7', '1', '500000', '50000', '', null, '0', '0', '1550000', 'company', '1', '1', null, null, '2015-09-14 09:06:31', '2015-09-14 09:06:31', '0');
INSERT INTO `tb_booking` VALUES ('6', '9', '22', '25-09-2015', '15-10-2015', '11', '9', '3', '1000000', '50000', '', null, '1', '2000000', '22050000', 'company', '1', '1', null, null, '2015-09-25 19:43:29', '2015-09-25 19:43:29', '0');
INSERT INTO `tb_booking` VALUES ('7', '4', '19', '29-09-2015', '30-09-2015', '6', '10', '2', '1774000', '0', '', null, '0', '0', '1774000', 'company', '1', '1', null, null, '2015-09-25 22:58:10', '2015-09-25 22:58:10', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_history
-- ----------------------------
INSERT INTO `tb_booking_history` VALUES ('1', '1', 'modern apartment homestay', '12 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '12 Lê Thái Tổ', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0298', '105.851', '2015-09-11 00:57:30', '2015-09-11 00:57:30', '0');
INSERT INTO `tb_booking_history` VALUES ('2', '2', 'modern apartment homestay', '12 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '12 Lê Thái Tổ', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0298', '105.851', '2015-09-11 00:58:52', '2015-09-11 00:58:52', '0');
INSERT INTO `tb_booking_history` VALUES ('3', '3', 'modern apartment homestay', '12 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '12 Lê Thái Tổ', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0298', '105.851', '2015-09-13 08:42:08', '2015-09-13 08:42:08', '0');
INSERT INTO `tb_booking_history` VALUES ('4', '4', 'modern apartment homestay', '12 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '12 Lê Thái Tổ', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0298', '105.851', '2015-09-14 09:06:19', '2015-09-14 09:06:19', '0');
INSERT INTO `tb_booking_history` VALUES ('5', '5', 'modern apartment homestay', '12 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '12 Lê Thái Tổ', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0298', '105.851', '2015-09-14 09:06:31', '2015-09-14 09:06:31', '0');
INSERT INTO `tb_booking_history` VALUES ('6', '6', 'Chia sẻ nhà 4 tầng tại đường Trần Nhân Tông, Hai Bà Trưng, Hà Nội', 'Số nhà 16 nghách 192/27 đường Kim Giang, Thanh Xuân, Hà Nội', 'Ngõ 52 Trần Nhân Tông', 'Hai Bà Trưng', 'Hà Nội', '21.0176', '105.848', '2015-09-25 19:43:29', '2015-09-25 19:43:29', '0');
INSERT INTO `tb_booking_history` VALUES ('7', '7', 'Le Thanh Ton Serviced Apartment', '56 Le Thanh Ton, Quận 1, TP. Hồ Chí Minh, Việt Nam', '56 Le Thanh Ton', 'Quận 1', 'Hồ Chí Minh', '10.7787', '106.703', '2015-09-25 22:58:10', '2015-09-25 22:58:10', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_user
-- ----------------------------
INSERT INTO `tb_booking_user` VALUES ('1', '1', '4', 'Mac', 'Tuan', 'so 18 to 12 phường Tô Hiệu', 'macngoctuan209@gmail.com', '0999999999', '2015-09-11 00:57:30', '2015-09-11 00:57:30');
INSERT INTO `tb_booking_user` VALUES ('2', '2', '4', 'Mac', 'Tuan', 'so 18 to 12 phường Tô Hiệu', 'macngoctuan209@gmail.com', '0999999999', '2015-09-11 00:58:52', '2015-09-11 00:58:52');
INSERT INTO `tb_booking_user` VALUES ('3', '3', '5', 'Xuan', 'Duc', '', 'xuanducsla@gmail.com', '', '2015-09-13 08:42:08', '2015-09-13 08:42:08');
INSERT INTO `tb_booking_user` VALUES ('4', '4', '9', 'Nguyễn Tuấn', 'Mạnh', 'Hà nội', 'ntmanh90ksth@gmail.com', '01676348455', '2015-09-14 09:06:19', '2015-09-14 09:06:19');
INSERT INTO `tb_booking_user` VALUES ('5', '5', '9', 'Nguyễn Tuấn', 'Mạnh', 'Hà nội', 'ntmanh90ksth@gmail.com', '01676348455', '2015-09-14 09:06:31', '2015-09-14 09:06:31');
INSERT INTO `tb_booking_user` VALUES ('6', '6', '9', 'Nguyễn', 'Mạnh', 'Kim Giang, Thanh Xuân, Hà Nội', 'ntmanh90ksth@gmail.com', '0938811807', '2015-09-25 19:43:29', '2015-09-25 19:43:29');
INSERT INTO `tb_booking_user` VALUES ('7', '7', '4', 'Mac', 'Tuan', '', 'macngoctuan209@gmail.com', '0931687866', '2015-09-25 22:58:10', '2015-09-25 22:58:10');

-- ----------------------------
-- Table structure for `tb_conversation`
-- ----------------------------
DROP TABLE IF EXISTS `tb_conversation`;
CREATE TABLE `tb_conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `status_flg` int(11) DEFAULT '0',
  `last_message_id` int(11) DEFAULT NULL,
  `read_flg` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_conversation
-- ----------------------------
INSERT INTO `tb_conversation` VALUES ('1', '4', '3', '1', '1', '1', '0', '2015-09-11 00:57:30', '2015-09-11 00:57:30', '0');
INSERT INTO `tb_conversation` VALUES ('2', '4', '3', '2', '1', '2', '0', '2015-09-11 00:58:52', '2015-09-11 00:58:52', '0');
INSERT INTO `tb_conversation` VALUES ('3', '5', '3', '3', '1', '3', '0', '2015-09-13 08:42:08', '2015-09-13 08:42:08', '0');
INSERT INTO `tb_conversation` VALUES ('4', '9', '3', '4', '1', '4', '0', '2015-09-14 09:06:19', '2015-09-14 09:06:19', '0');
INSERT INTO `tb_conversation` VALUES ('5', '9', '3', '5', '1', '5', '0', '2015-09-14 09:06:31', '2015-09-14 09:06:31', '0');
INSERT INTO `tb_conversation` VALUES ('6', '9', '9', '6', '1', '7', '0', '2015-09-25 19:43:29', '2015-09-25 19:43:29', '0');
INSERT INTO `tb_conversation` VALUES ('7', '4', '3', '7', '1', '8', '0', '2015-09-25 22:58:10', '2015-09-25 22:58:10', '0');

-- ----------------------------
-- Table structure for `tb_coupon`
-- ----------------------------
DROP TABLE IF EXISTS `tb_coupon`;
CREATE TABLE `tb_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) NOT NULL,
  `discount_amount_percent` int(11) NOT NULL COMMENT 'discount theo %',
  `period` date DEFAULT NULL,
  `coupon_uses` int(11) NOT NULL DEFAULT '0' COMMENT 'so lan su dung ma coupon',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_coupon
-- ----------------------------
INSERT INTO `tb_coupon` VALUES ('1', 'Y5HD4VX7UE5W9B', '10', '2015-07-31', '0', '2015-07-16 19:19:42', '2015-07-16 19:19:46', '0');
INSERT INTO `tb_coupon` VALUES ('2', 'M1IESFT90TGZU4', '3', null, '0', '2015-07-17 17:56:49', '2015-09-16 18:27:35', '1');
INSERT INTO `tb_coupon` VALUES ('3', 'FCVW3DKYDNAQBI', '15', null, '0', '2015-07-17 17:59:38', '2015-07-17 17:59:38', '0');
INSERT INTO `tb_coupon` VALUES ('4', 'VDXJ1FF1L98336', '10', '2015-09-26', '0', '2015-09-16 18:26:56', '2015-09-16 18:26:56', '0');

-- ----------------------------
-- Table structure for `tb_messages`
-- ----------------------------
DROP TABLE IF EXISTS `tb_messages`;
CREATE TABLE `tb_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0' COMMENT '0: message default; 1: message new booking room',
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `content` text,
  `status_flg` tinyint(4) DEFAULT '0',
  `read_flg` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_messages
-- ----------------------------
INSERT INTO `tb_messages` VALUES ('1', '1', '1', '4', '3', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '1', '2015-09-11 00:57:30', '2015-09-11 00:57:30', null);
INSERT INTO `tb_messages` VALUES ('2', '2', '1', '4', '3', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '1', '2015-09-11 00:58:52', '2015-09-11 00:58:52', null);
INSERT INTO `tb_messages` VALUES ('3', '3', '1', '5', '3', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '1', '2015-09-13 08:42:08', '2015-09-13 08:42:08', null);
INSERT INTO `tb_messages` VALUES ('4', '4', '1', '9', '3', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '1', '2015-09-14 09:06:19', '2015-09-14 09:06:19', null);
INSERT INTO `tb_messages` VALUES ('5', '5', '1', '9', '3', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '1', '2015-09-14 09:06:31', '2015-09-14 09:06:31', null);
INSERT INTO `tb_messages` VALUES ('6', '3', '0', '3', '5', 'alo \r\n', '0', '0', '2015-09-14 17:10:16', '2015-09-14 17:10:16', null);
INSERT INTO `tb_messages` VALUES ('7', '6', '1', '9', '9', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '1', '2015-09-25 19:43:29', '2015-09-25 19:43:29', null);
INSERT INTO `tb_messages` VALUES ('8', '7', '1', '4', '3', 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.', '1', '0', '2015-09-25 22:58:10', '2015-09-25 22:58:10', null);

-- ----------------------------
-- Table structure for `tb_room_address`
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
  `description` text NOT NULL,
  `room_type` varchar(255) DEFAULT NULL COMMENT 'loai phong: 1:ca can ho, 2: phong rieng, 3: phong chia se',
  `accommodates` int(11) NOT NULL COMMENT 'So khach',
  `bedrooms` int(11) NOT NULL COMMENT 'Phong ngu',
  `beds` int(11) NOT NULL COMMENT 'Giuong',
  `room_size` int(11) NOT NULL COMMENT 'Dien tich phong',
  `amenities` text NOT NULL COMMENT 'Tien nghi',
  `status_flg` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_address
-- ----------------------------
INSERT INTO `tb_room_address` VALUES ('1', '3', '12 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '12 Lê Thái Tổ', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0298', '105.851', 'modern apartment homestay', 'Căn hộ nằm cạnh hồ hoàn kiếm. cách hàng trống 5 phút đi bộ, cách hàng bạc 15 phút đi bộ. \r\nView đẹp, không khí trong lành, thoáng mát\r\nNội thất hiện đại\r\nChủ nhà thân thiện ', 'a:1:{i:0;s:11:\"entire_home\";}', '6', '3', '3', '200', 'a:5:{i:0;s:15:\"smoking_allowed\";i:1;s:8:\"internet\";i:2;s:19:\"handicap_accessible\";i:3;s:7:\"parking\";i:4;s:7:\"hot_tub\";}', '0', '2015-09-11 00:09:12', '2015-09-16 18:09:07', '1');
INSERT INTO `tb_room_address` VALUES ('2', '3', '92 Hàng Trống, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '92 Hàng Trống', 'Ha Noi City', 'Hanoi', '21.0297', '105.85', 'homestay miệt vườn ', 'The Atrium is located right in the center of Old Quarter, very handy area, close to most of the attractions. ', 'a:3:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";i:2;s:10:\"share_room\";}', '7', '5', '5', '500', 'a:6:{i:0;s:2:\"tv\";i:1;s:8:\"internet\";i:2;s:20:\"elevator_in_building\";i:3;s:7:\"kitchen\";i:4;s:3:\"gym\";i:5;s:3:\"kid\";}', '0', '2015-09-11 22:16:54', '2015-09-11 22:19:20', '1');
INSERT INTO `tb_room_address` VALUES ('3', '3', '21 Thọ Xương, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '21 Thọ Xương', 'Quận Hoàn Kiếm', 'Hà Nội', '21.0286', '105.848', 'homestay miệt vườn ', 'The Atrium is located right in the center of Old Quarter, very handy area, close to most of the attractions. The bustle and noise of the Old Quarter streets is left behind as you enter the hotel through its’ unassuming street entrance. Inside, the hotel o', 'a:3:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";i:2;s:10:\"share_room\";}', '5', '4', '3', '300', 'a:5:{i:0;s:2:\"tv\";i:1;s:20:\"elevator_in_building\";i:2;s:7:\"kitchen\";i:3;s:3:\"gym\";i:4;s:3:\"kid\";}', '0', '2015-09-11 22:20:41', '2015-09-16 18:09:14', '1');
INSERT INTO `tb_room_address` VALUES ('4', '6', 'TL102, Chiềng Sơn, Mộc Châu, Sơn La, Việt Nam', 'TL102', 'Mộc châu', 'Sơn La', '20.7547', '104.604', 'Du lịch pha luông', 'Phòng khép kín đầy đủ tiện nghi sạch đẹp, có nóng lạnh wifi cho khách đi du lịch mộc châu và pha luông .có dẫn đường leo đỉnh pha luông.phòng có đầy đủ loại phòng .phòng khép kín phòng 1 giường ,phòng 2 giường ,phòng 3 giường ,phù hợp với khách đi du lịch', 'a:1:{i:0;s:12:\"private_room\";}', '16', '8', '1', '15', 'a:7:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";}', '1', '2015-09-13 12:59:31', '2015-09-14 21:30:21', '1');
INSERT INTO `tb_room_address` VALUES ('5', '8', 'Công Ty Chè Mộc Châu, Nông trường Mộc Châu, Son La, Vietnam', 'Công Ty Chè Mộc Châu', 'Mộc Châu', 'Sơn La', '20.8335', '104.694', 'HOMESTAY MỘC CHÂU', 'Nằm ở giữa thung lũng chè xinh đẹp tại làng chè 69, thị trấn nông trường Mộc Châu, Homestay Mộc Châu là điểm đến lý tưởng với 4 phòng ngủ rộng rãi,vệ sinh năng lượng mặt trời hiện đại. \r\nHomestay Mộc Châu là nơi tuyệt vời để tận hưởng vẻ đẹp của những đồi', 'a:2:{i:0;s:12:\"private_room\";i:1;s:10:\"share_room\";}', '16', '4', '7', '100', 'a:4:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:3:\"kid\";}', '0', '2015-09-13 22:19:33', '2015-09-13 22:19:33', '0');
INSERT INTO `tb_room_address` VALUES ('6', '11', 'TL102, Chiềng Sơn, Mộc Châu, Sơn La, Việt Nam', 'TL102', 'Mộc châu', 'Sơn La', '20.7529', '104.603', 'Có phòng cho thuê', 'Phòng khép kín sạch sẽ an ninh đảm bảo có chỗ để xe ô tô, wifi nóng lạnh ti vi đầy đủ ,nhà mình là chỗ nghỉ dừng chân để leo đỉnh pha luông mộc châu sơn la nhé 1 trong tứ đỉnh phía bắc ,', 'a:1:{i:0;s:12:\"private_room\";}', '16', '8', '1', '15', 'a:7:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";}', '1', '2015-09-14 20:25:16', '2015-09-14 20:31:17', '0');
INSERT INTO `tb_room_address` VALUES ('7', '12', 'ấp 2, xã Hiếu Liêm, Vĩnh Cửu, Đồng Nai, Vietnam', 'ấp 2, xã Hiếu Liêm, Vĩnh Cửu, Đồng Nai, Vietnam', 'Vĩnh Cửu', 'Dong Nai', '11.1112', '106.971', 'CHIM BÓI CÁ HOMESTAY - KINGFISHER NEST HOMESTAY', 'Cách Sài Gòn 70km ', 'a:1:{i:0;s:10:\"share_room\";}', '16', '2', '16', '100', 'a:7:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:3:\"kid\";}', '0', '2015-09-15 00:00:01', '2015-09-15 00:00:01', '0');
INSERT INTO `tb_room_address` VALUES ('8', '3', '10 Nhà Chung, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '10 Nhà Chung', 'hà nội', 'Hà Nội', '21.0282', '105.849', 'moderrn', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.', 'a:2:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";}', '6', '5', '6', '300', 'a:5:{i:0;s:12:\"pets_allowed\";i:1;s:16:\"air_conditioning\";i:2;s:4:\"pool\";i:3;s:6:\"washer\";i:4;s:9:\"breakfast\";}', '0', '2015-09-15 10:01:46', '2015-09-18 23:51:53', '1');
INSERT INTO `tb_room_address` VALUES ('9', '14', 'Một Tháng Tư, tt. Cát Bà, Cát Hải, Hải Phòng, Việt Nam', 'Một Tháng Tư', 'Cát Hải - Cát Bà ', 'Hải Phòng', '20.7241', '107.05', 'Khách Sạn Đảo Cát Bà - Gía Rẻ / View Biển /Chất Lượng Tốt Nhất', 'Khách Sạn Vien Dong Ocean Views tọa lạc giữa khu trung tâm du lịch đảo Cát Bà , đối diện sân khấu và quảng trường cách các bãi biển đẹp nổi tiếng Cát Cò 1 , 2 , 3  - 400m . \r\nLà một địa điểm không thể bỏ qua khi đến với Đảo Ngọc Cát Bà - Hãy liên hệ trực ', 'a:1:{i:0;s:12:\"private_room\";}', '4', '10', '2', '32', 'a:15:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:20:\"elevator_in_building\";i:6;s:19:\"handicap_accessible\";i:7;s:4:\"pool\";i:8;s:7:\"kitchen\";i:9;s:7:\"parking\";i:10;s:6:\"washer\";i:11;s:3:\"gym\";i:12;s:7:\"hot_tub\";i:13;s:9:\"breakfast\";i:14;s:3:\"kid\";}', '1', '2015-09-15 19:15:58', '2015-09-15 19:33:14', '0');
INSERT INTO `tb_room_address` VALUES ('10', '16', 'ĐT712, Hiệp Nhơn, Tân Thuận, Hàm Thuận Nam, Bình Thuận, Việt Nam', 'ĐT712', 'bình thuận', 'Bình Thuận', '10.7683', '107.893', 'du lịch giá rẻ phan thiết _mũi né _lagi ', 'chuyên thiết kế các tour bụi giá rẻ ,hdv thộ địa tất cả các địa điểm trong tỉnh ,các dịch vụ giá rẻ ,hộ trợ các bạn du lịch phan thiết ,,, cac dịch vu du lịch bụi ,,,phòng nhà nghỉ bình dân ,du lịch ngủ lều ,vvv', 'a:1:{i:0;s:11:\"entire_home\";}', '16', '1', '10', '20', 'a:8:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";i:7;s:9:\"breakfast\";}', '1', '2015-09-16 17:01:13', '2015-09-17 09:52:15', '0');
INSERT INTO `tb_room_address` VALUES ('11', '17', '473 Trần Hưng Đạo, Sơn Trà, Da Nang, Vietnam', '473 Trần Hưng Đạo', 'Sơn Trà', 'Đà Nẵng', '16.0652', '108.23', 'Đà Nẵng Homestay', 'Cách sân bay 2km, ga tàu 2km, biển Mỹ Khê 1,5km, cạnh cầu Rồng, đối diện cầu Tình Yêu...\r\nGiá cực rẻ', 'a:1:{i:0;s:10:\"share_room\";}', '16', '3', '10', '45', 'a:5:{i:0;s:2:\"tv\";i:1;s:8:\"internet\";i:2;s:16:\"air_conditioning\";i:3;s:7:\"parking\";i:4;s:7:\"hot_tub\";}', '0', '2015-09-16 22:04:38', '2015-09-16 22:04:38', '0');
INSERT INTO `tb_room_address` VALUES ('12', '18', '191 Trưng Nữ Vương, Hòa Thuận Đông, Q. Hải Châu, Đà Nẵng, Vietnam', '191 Trưng Nữ Vương', 'Da Nang', 'Đà Nẵng', '16.054', '108.22', 'Khách Sạn Kay Đà Nẵng  ', 'Khách Sạn Kay Đà Nẵng  ', 'a:2:{i:0;s:12:\"private_room\";i:1;s:10:\"share_room\";}', '1', '1', '1', '44', 'a:4:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:8:\"internet\";i:3;s:3:\"gym\";}', '0', '2015-09-17 10:35:00', '2015-09-18 23:55:34', '1');
INSERT INTO `tb_room_address` VALUES ('13', '8', 'Công Ty Chè Mộc Châu, Nông trường Mộc Châu, Son La, Vietnam', 'Công Ty Chè Mộc Châu', 'Mộc Châu', 'Sơn La', '20.8335', '104.694', 'HOMESTAY MỘC CHÂU', 'Nằm giữa đồi chè Mộc Châu xanh bạt ngàn, homestay Mộc Châu là điểm đến lý tưởng khi bạn mở cửa ra là cả một màu xanh bất tận. Với vệ sinh năng lượng mặt trời, phòng rộng tiện nghi sạch sẽ, thoáng mát sẽ đem đến cho bạn cảm giác thoải mái nhất.\r\nHơn thế nữ', 'a:2:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";}', '16', '4', '1', '100', 'a:7:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:19:\"handicap_accessible\";i:4;s:7:\"kitchen\";i:5;s:6:\"washer\";i:6;s:3:\"kid\";}', '0', '2015-09-18 08:09:58', '2015-09-18 08:09:58', '0');
INSERT INTO `tb_room_address` VALUES ('14', '3', '25 Nhà Chung, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '25 Nhà Chung', 'hoàn kiếm', 'Hà Nội', '21.028', '105.85', 'cho thuê phòng quận hoàn kiếm', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác ', 'a:3:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";i:2;s:10:\"share_room\";}', '7', '4', '4', '200', 'a:5:{i:0;s:12:\"pets_allowed\";i:1;s:16:\"air_conditioning\";i:2;s:4:\"pool\";i:3;s:6:\"washer\";i:4;s:9:\"breakfast\";}', '0', '2015-09-18 23:40:57', '2015-09-23 21:32:19', '1');
INSERT INTO `tb_room_address` VALUES ('15', '3', '29 Ấu Triệu, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '29 Ấu Triệu', 'hai ba trung', 'Hà Nội', '21.028', '105.848', 'cho thuê phòng quận hai ba trưng', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác ', 'a:3:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";i:2;s:10:\"share_room\";}', '5', '5', '5', '500', 'a:5:{i:0;s:2:\"tv\";i:1;s:20:\"elevator_in_building\";i:2;s:7:\"kitchen\";i:3;s:3:\"gym\";i:4;s:3:\"kid\";}', '0', '2015-09-19 18:38:40', '2015-09-23 22:12:54', '1');
INSERT INTO `tb_room_address` VALUES ('16', '20', '102/4 Cống Quỳnh, Hồ Chí Minh, Việt Nam', '102/4 Cống Quỳnh', 'Hồ Chí Minh', 'Hồ Chí Minh', '10.7647', '106.691', 'Phòng Tập thể giá rẻ', 'Phòng tập thể với 6, hoặc 8 giường. Ngay trung tâm quận 1, phù hợp với các đoàn khách du lịch, tây ba lô. \r\nGiá phòng: 6$/giường/đêm.', 'a:1:{i:0;s:10:\"share_room\";}', '16', '5', '16', '30', 'a:2:{i:0;s:8:\"internet\";i:1;s:16:\"air_conditioning\";}', '0', '2015-09-20 13:49:47', '2015-09-20 13:49:47', '0');
INSERT INTO `tb_room_address` VALUES ('17', '20', '102 Cống Quỳnh, Hồ Chí Minh, Việt Nam', '102 Cống Quỳnh', 'Hồ Chí Minh', 'Hồ Chí Minh', '10.7648', '106.691', 'Phòng double', 'Nằm ở khu trung tâm Quận 1, Khách sạn là sự lựa chọn ưu tiên của nhiều đoàn khách du lịch, Với giá cả hợp lý, tiện nghi đầy đủ, luôn luôn được dọn dẹp sạch sẽ. \r\nGiá phòng : 20$/phòng/đêm.', 'a:1:{i:0;s:12:\"private_room\";}', '2', '1', '1', '30', 'a:2:{i:0;s:8:\"internet\";i:1;s:16:\"air_conditioning\";}', '0', '2015-09-20 13:57:27', '2015-09-20 13:57:27', '0');
INSERT INTO `tb_room_address` VALUES ('18', '23', '161E/8 Lạc Long Quân, Hồ Chí Minh, Việt Nam', '161E/8 Lạc Long Quân', 'Hồ Chí Minh', 'Hồ Chí Minh', '10.7631', '106.64', 'NHÀ KHÔNG NGƯỜI TRÔNG COI CẦN CHO THUÊ ', 'Diện tích : 3*11 \r\nPhòng khách : 1, phòng ngủ: 2, bếp : 1 , nhà vệ sinh : 1\r\nDo không có người trông nhà cần cho thuê , \r\ntiện nghi ; 1 máy lạnh, 1 máy tắm nước nóng , 1 bếp gas, tủ chén , 2 nệm . tử đồ ...', 'a:1:{i:0;s:11:\"entire_home\";}', '4', '2', '2', '33', 'a:3:{i:0;s:8:\"internet\";i:1;s:16:\"air_conditioning\";i:2;s:6:\"washer\";}', '0', '2015-09-23 15:11:34', '2015-09-23 15:11:34', '0');
INSERT INTO `tb_room_address` VALUES ('19', '3', '56 Le Thanh Ton, Quận 1, TP. Hồ Chí Minh, Việt Nam', '56 Le Thanh Ton', 'Quận 1', 'Hồ Chí Minh', '10.7787', '106.703', 'Le Thanh Ton Serviced Apartment', 'Le Thanh Ton Serviced Apartment cung cấp chỗ nghỉ tại Thành phố Hồ Chí Minh và Wi-Fi miễn phí. Trung tâm mua sắm Parkson cách đó 100 m.\r\n\r\nChỗ nghỉ tại đây được trang bị máy lạnh và khu vực tiếp khách. Ngoài ra còn có nhà bếp với lò nướng và lò vi sóng. B', 'a:1:{i:0;s:11:\"entire_home\";}', '2', '1', '1', '45', 'a:9:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:19:\"handicap_accessible\";i:5;s:7:\"kitchen\";i:6;s:7:\"parking\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";}', '1', '2015-09-23 22:20:29', '2015-09-23 22:26:57', '0');
INSERT INTO `tb_room_address` VALUES ('20', '24', '324/35-37 Hoang Van Thu, Quận Tân Bình, TP. Hồ Chí Minh, Việt Nam', '324/35-37 Hoang Van Thu', 'Quận Tân Bình', 'Hồ Chí Minh', '10.7926', '106.696', 'Golden Globe Apartment', 'Tọa lạc tại một vị trí thuận tiện ở Thành phố Hồ Chí Minh, Golden Globe Apartment có chỗ ở giản dị và trang nhã với truy cập Wi-Fi miễn phí trong toàn bộ khuôn viên. Nơi đây cung cấp dịch vụ dọn phòng hàng ngày và các căn hộ với đầy đủ tiện nghi', 'a:1:{i:0;s:11:\"entire_home\";}', '4', '2', '2', '90', 'a:12:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:19:\"handicap_accessible\";i:5;s:4:\"pool\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:3:\"gym\";i:10;s:7:\"hot_tub\";i:11;s:3:\"kid\";}', '1', '2015-09-25 00:17:08', '2015-09-25 00:19:11', '0');
INSERT INTO `tb_room_address` VALUES ('21', '24', '324/35-37 Hoang Van Thu, Quận Tân Bình, TP. Hồ Chí Minh, Việt Nam', '324/35-37 Hoang Van Thu', 'Quận Tân Bình', 'Hồ Chí Minh', '10.792', '106.696', 'Golden Globe Apartment', 'Tọa lạc tại một vị trí thuận tiện ở Thành phố Hồ Chí Minh, Golden Globe Apartment có chỗ ở giản dị và trang nhã với truy cập Wi-Fi miễn phí trong toàn bộ khuôn viên. Nơi đây cung cấp dịch vụ dọn phòng hàng ngày và các căn hộ với đầy đủ tiện nghi', 'a:1:{i:0;s:11:\"entire_home\";}', '2', '1', '1', '60', 'a:12:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:19:\"handicap_accessible\";i:5;s:4:\"pool\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:3:\"gym\";i:10;s:7:\"hot_tub\";i:11;s:3:\"kid\";}', '1', '2015-09-25 00:23:05', '2015-09-25 00:24:25', '0');
INSERT INTO `tb_room_address` VALUES ('22', '9', 'Số nhà 16 nghách 192/27 đường Kim Giang, Thanh Xuân, Hà Nội', 'Ngõ 52 Trần Nhân Tông', 'Hai Bà Trưng', 'Hà Nội', '21.0176', '105.848', 'Chia sẻ nhà 4 tầng tại đường Trần Nhân Tông, Hai Bà Trưng, Hà Nội', 'Tôi có 4 phòng riêng thuộc tòa nhà 4 tầng tại đường  Trần Nhân Tông, Hai Bà Trưng, Hà Nội. Quý khách nào đi phượt có nhu cầu tìm nhà ở trong thời gian ngắn xin vui lòng liên hệ với anh Nguyễn Tuấn Mạnh theo số điện thại 0938 811 807', 'a:1:{i:0;s:12:\"private_room\";}', '4', '4', '2', '30', 'a:12:{i:0;s:12:\"pets_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:20:\"elevator_in_building\";i:5;s:19:\"handicap_accessible\";i:6;s:4:\"pool\";i:7;s:7:\"kitchen\";i:8;s:7:\"parking\";i:9;s:6:\"washer\";i:10;s:3:\"gym\";i:11;s:9:\"breakfast\";}', '1', '2015-09-25 19:31:29', '2015-09-25 19:40:37', '0');
INSERT INTO `tb_room_address` VALUES ('23', '25', 'Hon Gai Wharf, Hạ Long, Việt Nam', 'Hon Gai Wharf', 'tp. Hạ Long', 'Quảng Ninh', '20.9516', '107.072', 'Signature Halong Cruise', 'Là một chiếc thuyền gỗ truyền thống, Signature Halong Cruise cung cấp các suite sang trọng nhìn ra cảnh quan tuyệt đẹp của Vịnh Hạ Long nổi tiếng, được UNESCO công nhận là di sản thế giới. Du thuyền có một sân thượng phơi nắng trên tầng mái, nơi tổ chức c', 'a:1:{i:0;s:12:\"private_room\";}', '4', '1', '2', '45', 'a:8:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";i:7;s:3:\"kid\";}', '0', '2015-09-27 08:49:56', '2015-09-27 09:15:15', '1');
INSERT INTO `tb_room_address` VALUES ('24', '26', 'Van Lam, Ninh Hai, Ninh Bình, Việt Nam', 'Van Lam', 'Ninh Hải', 'Ninh Bình', '20.2167', '105.938', 'Tam Coc Backpacker Hostel', 'Với Wi-Fi miễn phí và nhà hàng, Tam Coc Backpacker Hostel cung cấp chỗ nghỉ tại tỉnh Ninh Bình. Trong nơi nghỉ này có quầy bar.\r\nTrong khuôn viên chỗ nghỉ có lễ tân 24 giờ, sảnh khách chung, trung tâm dịch vụ doanh nhân và cửa hàng quà tặng.\r\nNhà trọ có bàn bida và dịch vụ cho thuê xe đạp. Động Tam Cốc cách Tam Coc Backpacker Hostel 200 m, còn Đền Thái Vi cách đó 1,1 km.', 'a:1:{i:0;s:10:\"share_room\";}', '10', '1', '10', '30', 'a:9:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";i:7;s:7:\"hot_tub\";i:8;s:3:\"kid\";}', '1', '2015-09-27 09:42:18', '2015-09-27 16:33:09', '0');
INSERT INTO `tb_room_address` VALUES ('25', '26', 'Tam Coc Backpacker Hostel ', 'Van Lam, Ninh Hai, Ninh Bình, Việt Nam', 'Ninh Hải', 'Ninh Bình', '20.2167', '105.938', 'Tam Coc Backpacker Hostel ', 'Với Wi-Fi miễn phí và nhà hàng, Tam Coc Backpacker Hostel cung cấp chỗ nghỉ tại tỉnh Ninh Bình. Trong nơi nghỉ này có quầy bar.\r\nTrong khuôn viên chỗ nghỉ có lễ tân 24 giờ, sảnh khách chung, trung tâm dịch vụ doanh nhân và cửa hàng quà tặng.\r\nNhà trọ có bàn bida và dịch vụ cho thuê xe đạp. Động Tam Cốc cách Tam Coc Backpacker Hostel 200 m, còn Đền Thái Vi cách đó 1,1 km.', 'a:2:{i:0;s:12:\"private_room\";i:1;s:10:\"share_room\";}', '2', '1', '2', '28', 'a:9:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";i:7;s:7:\"hot_tub\";i:8;s:3:\"kid\";}', '1', '2015-09-27 09:54:04', '2015-09-27 16:32:53', '0');
INSERT INTO `tb_room_address` VALUES ('26', '26', 'Van Lam, Ninh Hai, Ninh Bình, Việt Nam', 'Van Lam', 'Ninh Hải', 'Ninh Bình', '20.2167', '105.938', 'Tam Coc Backpacker Hostel ', 'Với Wi-Fi miễn phí và nhà hàng, Tam Coc Backpacker Hostel cung cấp chỗ nghỉ tại tỉnh Ninh Bình. Trong nơi nghỉ này có quầy bar.\r\nTrong khuôn viên chỗ nghỉ có lễ tân 24 giờ, sảnh khách chung, trung tâm dịch vụ doanh nhân và cửa hàng quà tặng.\r\nNhà trọ có bàn bida và dịch vụ cho thuê xe đạp. Động Tam Cốc cách Tam Coc Backpacker Hostel 200 m, còn Đền Thái Vi cách đó 1,1 km.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '3', '28', 'a:10:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:19:\"handicap_accessible\";i:5;s:7:\"kitchen\";i:6;s:7:\"parking\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";i:9;s:3:\"kid\";}', '1', '2015-09-27 10:39:58', '2015-09-27 16:33:29', '0');
INSERT INTO `tb_room_address` VALUES ('27', '27', 'Thon Kha Luong, Ninh Thang, Hoa Lu, Ninh Bình, Việt Nam', 'Thon Kha Luong, Ninh Thang', 'Hoa Lu', 'Ninh Bình', '20.2232', '105.942', 'Tam Coc Homestay', 'Tam Coc Homestay cung cấp chỗ ở thân thiện với vật nuôi tại thành phố Ninh Bình, cách động Tam Cốc 1 km, và có hiên phơi nắng cũng như Wi-Fi miễn phí. Trong khuôn viên nơi này có quầy bar. Chỗ đỗ xe riêng cũng được cung cấp miễn phí tại chỗ.\r\nMột số phòng có khu vực tiếp khách để thư giãn sau một ngày bận rộn. Một số phòng cho tầm nhìn ra cảnh núi non hoặc hồ nước. Mỗi phòng đều đi kèm phòng tắm riêng hoặc chung. Ngoài ra còn được trang bị TV.\r\nChỗ nghỉ này có quầy lễ tân 24 giờ.\r\nTrong khu vực có một loạt các hoạt động như đi xe đạp và câu cá. Đền Thái Vi nằm trong bán kính 1,3 km từ Tam Coc Homestay trong khi Chùa Bích Động cách đó 2,8 km.', 'a:1:{i:0;s:10:\"share_room\";}', '8', '1', '8', '28', 'a:9:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:19:\"handicap_accessible\";i:5;s:7:\"kitchen\";i:6;s:7:\"parking\";i:7;s:7:\"hot_tub\";i:8;s:3:\"kid\";}', '1', '2015-09-27 10:58:29', '2015-09-27 16:24:27', '0');
INSERT INTO `tb_room_address` VALUES ('28', '27', 'Thon Kha Luong, Ninh Thang, Hoa Lu, Ninh Bình, Việt Nam', 'Thon Kha Luong, Ninh Thang', 'Hoa Lu', 'Ninh Bình', '20.2232', '105.942', 'Tam Coc Homestay', 'Tam Coc Homestay cung cấp chỗ ở thân thiện với vật nuôi tại thành phố Ninh Bình, cách động Tam Cốc 1 km, và có hiên phơi nắng cũng như Wi-Fi miễn phí. Trong khuôn viên nơi này có quầy bar. Chỗ đỗ xe riêng cũng được cung cấp miễn phí tại chỗ.\r\nMột số phòng có khu vực tiếp khách để thư giãn sau một ngày bận rộn. Một số phòng cho tầm nhìn ra cảnh núi non hoặc hồ nước. Mỗi phòng đều đi kèm phòng tắm riêng hoặc chung. Ngoài ra còn được trang bị TV.\r\nChỗ nghỉ này có quầy lễ tân 24 giờ.\r\nTrong khu vực có một loạt các hoạt động như đi xe đạp và câu cá. Đền Thái Vi nằm trong bán kính 1,3 km từ Tam Coc Homestay trong khi Chùa Bích Động cách đó 2,8 km.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '2', '29', 'a:9:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:19:\"handicap_accessible\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";i:7;s:7:\"hot_tub\";i:8;s:3:\"kid\";}', '1', '2015-09-27 11:58:52', '2015-09-27 16:24:44', '0');
INSERT INTO `tb_room_address` VALUES ('29', '27', 'Thon Kha Luong, Ninh Thang, Hoa Lu, Ninh Bình, Việt Nam', 'Thon Kha Luong, Ninh Thang', 'Hoa Lu', 'Ninh Bình', '20.2232', '105.942', 'Tam Coc Homestay ', 'Tam Coc Homestay cung cấp chỗ ở thân thiện với vật nuôi tại thành phố Ninh Bình, cách động Tam Cốc 1 km, và có hiên phơi nắng cũng như Wi-Fi miễn phí. Trong khuôn viên nơi này có quầy bar. Chỗ đỗ xe riêng cũng được cung cấp miễn phí tại chỗ.\r\nMột số phòng có khu vực tiếp khách để thư giãn sau một ngày bận rộn. Một số phòng cho tầm nhìn ra cảnh núi non hoặc hồ nước. Mỗi phòng đều đi kèm phòng tắm riêng hoặc chung. Ngoài ra còn được trang bị TV.\r\nChỗ nghỉ này có quầy lễ tân 24 giờ.\r\nTrong khu vực có một loạt các hoạt động như đi xe đạp và câu cá. Đền Thái Vi nằm trong bán kính 1,3 km từ Tam Coc Homestay trong khi Chùa Bích Động cách đó 2,8 km.\r\n', 'a:1:{i:0;s:12:\"private_room\";}', '2', '1', '1', '29', 'a:10:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:19:\"handicap_accessible\";i:5;s:7:\"kitchen\";i:6;s:7:\"parking\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";i:9;s:3:\"kid\";}', '1', '2015-09-27 15:38:42', '2015-09-27 16:25:08', '0');
INSERT INTO `tb_room_address` VALUES ('30', '27', 'Thon Kha Luong, Ninh Thang, Hoa Lu, Ninh Bình, Việt Nam', 'Thon Kha Luong, Ninh Thang', 'Hoa Lu', 'Ninh Bình', '20.2232', '105.942', 'Tam Coc Homestay ', 'Tam Coc Homestay cung cấp chỗ ở thân thiện với vật nuôi tại thành phố Ninh Bình, cách động Tam Cốc 1 km, và có hiên phơi nắng cũng như Wi-Fi miễn phí. Trong khuôn viên nơi này có quầy bar. Chỗ đỗ xe riêng cũng được cung cấp miễn phí tại chỗ.\r\nMột số phòng có khu vực tiếp khách để thư giãn sau một ngày bận rộn. Một số phòng cho tầm nhìn ra cảnh núi non hoặc hồ nước. Mỗi phòng đều đi kèm phòng tắm riêng hoặc chung. Ngoài ra còn được trang bị TV.\r\nChỗ nghỉ này có quầy lễ tân 24 giờ.\r\nTrong khu vực có một loạt các hoạt động như đi xe đạp và câu cá. Đền Thái Vi nằm trong bán kính 1,3 km từ Tam Coc Homestay trong khi Chùa Bích Động cách đó 2,8 km.', 'a:1:{i:0;s:12:\"private_room\";}', '4', '1', '2', '404000', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-27 15:50:51', '2015-09-27 16:25:24', '0');
INSERT INTO `tb_room_address` VALUES ('31', '28', 'Ninh Hai, Hoa Lu, Ninh Bình, Việt Nam', 'Ninh Hai', 'tp. Ninh Bình', 'Ninh Bình', '20.2176', '105.962', 'Lang Viet Co - Co Vien Lau ', 'Nằm ở trung tâm tổ hợp du lịch Tam Cốc-Bích Động, Lang Viet Co có 24 ngôi nhà cổ từ thế kỷ 18 đến thế kỷ 20 tại một làng Việt cổ. Nơi nghỉ này có Wi-Fi miễn phí tại khu vực lễ tân.\r\nĐược làm từ loại gỗ quý, các phòng đặc trưng với những đồ chạm khắc bằng gỗ công phu và đi kèm máy lạnh cùng tiện nghi sưởi. Phòng tắm gồm có tiện nghi vòi sen nóng lạnh.\r\nLang Viet có những khu vườn đáng yêu và nhìn ra núi non xung quanh\r\nLang Viet Co nằm trong bán kính 15 phút lái xe từ Ga tàu Ninh Bình và Bến xe Ninh Bình. Bến thuyền Tam Cốc chỉ cách đó 300 m.', 'a:1:{i:0;s:12:\"private_room\";}', '2', '1', '1', '12', 'a:10:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:19:\"handicap_accessible\";i:5;s:7:\"kitchen\";i:6;s:7:\"parking\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";i:9;s:3:\"kid\";}', '1', '2015-09-27 18:52:43', '2015-09-27 18:53:58', '0');
INSERT INTO `tb_room_address` VALUES ('32', '28', 'Ninh Hai, Hoa Lu, Ninh Bình, Việt Nam', 'Ninh Hai, Hoa Lu', 'tp. Ninh Bình', 'Ninh Bình', '20.2175', '105.962', 'Lang Viet Co - Co Vien Lau ', 'Nằm ở trung tâm tổ hợp du lịch Tam Cốc-Bích Động, Lang Viet Co có 24 ngôi nhà cổ từ thế kỷ 18 đến thế kỷ 20 tại một làng Việt cổ. Nơi nghỉ này có Wi-Fi miễn phí tại khu vực lễ tân.\r\nĐược làm từ loại gỗ quý, các phòng đặc trưng với những đồ chạm khắc bằng gỗ công phu và đi kèm máy lạnh cùng tiện nghi sưởi. Phòng tắm gồm có tiện nghi vòi sen nóng lạnh.\r\nLang Viet có những khu vườn đáng yêu và nhìn ra núi non xung quanh\r\nLang Viet Co nằm trong bán kính 15 phút lái xe từ Ga tàu Ninh Bình và Bến xe Ninh Bình. Bến thuyền Tam Cốc chỉ cách đó 300 m.', 'a:1:{i:0;s:12:\"private_room\";}', '2', '1', '2', '20', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-27 18:58:07', '2015-09-27 18:59:21', '0');
INSERT INTO `tb_room_address` VALUES ('33', '29', 'Lang Noi, Gia Lap, Gia Vien, Ninh Bình, Việt Nam', 'Lang Noi, Gia Lap', 'Gia Vien ', 'Ninh Bình', '20.3521', '105.898', 'Van Long Homestay', 'Van Long Homestay cung cấp các phòng nghỉ tại tỉnh Ninh Bình. Trong khuôn viên có quầy bar. Tại nơi nghỉ cũng có chỗ đỗ xe riêng miễn phí.\r\nNơi đây có truyền hình vệ tinh màn hình phẳng và máy vi tính. Một số chỗ ở đi kèm khu vực tiếp khách để tạo thuận tiện cho quý khách. Các phòng cụ thể có sân hiên hoặc ban công.\r\nVan Long Homestay có quầy lễ tân 24 giờ. Nơi nghỉ nhà dân này cũng cung cấp xe đạp và xe hơi cho thuê.\r\nNơi nghỉ cách Cố đô Hoa Lư 8 km và Khu du lịch Sinh thái Tràng An 10 km.', 'a:1:{i:0;s:12:\"private_room\";}', '2', '1', '1', '30', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-27 23:23:41', '2015-09-27 23:27:54', '0');
INSERT INTO `tb_room_address` VALUES ('34', '30', 'Khe Ha, Ninh Xuan, Hoa Lu, Ninh Binh, Xuân Sơn, Việt Nam', 'Khe Ha, Ninh Xuan', 'Hoa Lu', 'Ninh Bình', '20.2313', '105.939', 'Mua Cave Eco Lodge ', 'Nằm cách trung tâm thành phố 6 km, Mua Cave Eco Lodge cung cấp chỗ ở yên tĩnh và tiện nghi với truy cập Wi-Fi miễn phí trong toàn bộ khuôn viên. Chỗ nghỉ này có lễ tân làm việc 24/24 và bãi đỗ xe miễn phí ngay trong khuôn viên.\r\nCác phòng nghỉ máy lạnh tại đây có sàn lát gạch, tủ quần áo, màn chống muỗi, TV và khu vực tiếp khách. Minibar và ấm đun nước điện cũng được trang bị trong phòng. Phòng tắm riêng đi kèm bồn tắm hoặc vòi sen, dép và đồ vệ sinh cá nhân miễn phí.\r\nTại Mua Cave Eco Lodge, du khách có thể thuê xe đạp để khám phá khu vực và ghé thăm các điểm tham quan gần đó. Dịch vụ thu đổi ngoại tệ, tiện nghi để hành lý và sắp xếp tour du lịch cũng có tại đây. Dịch vụ đưa đón và vận chuyển sân bay có thể được cung cấp với một khoản phụ phí.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '1', '30', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-27 23:51:35', '2015-09-27 23:53:51', '0');
INSERT INTO `tb_room_address` VALUES ('35', '31', 'Trang An village, Truong Yen commune, Hoa Lu district, Ninh Binh province, Ninh Bình, Việt Nam', 'Tràng An', 'Hoa Lu', 'Ninh Bình', '20.2668', '105.919', 'Trang An Farm Stay ', 'Tọa lạc giữa những ngọn núi đầy cây xanh tươi tốt, Trang An Farm Stay cung cấp chỗ ở yên tĩnh và thoải mái với truy cập Wi-Fi miễn phí trong toàn bộ khuôn viên. Nơi nghỉ này có quầy lễ tân 24 giờ với đội ngũ nhân viên thân thiện có khả năng giao tiếp thành thạo bằng tiếng Anh.\r\nChỗ nghỉ nhà dân này nằm trong bán kính 1 km từ khu du lịch sinh thái Tràng An và 1,5 km Cố Đô Hoa Lư. Hang Múa cách nơi nghỉ này 5 km trong khi Chùa Bái Đính và Tam Cốc đều nằm cách đó trong vòng 7 km lái xe. Du khách đi khoảng 35 km là tới Vườn Quốc gia Cúc Phương.\r\nĐược trang trí nội thất đơn giản, các phòng nghỉ tại đây có quạt máy, sàn gỗ, tủ quần áo, màn chống muỗi, bàn làm việc và khu vực tiếp khách. Phòng tắm riêng đi kèm tiện nghi vòi sen và khăn tắm.\r\nTại Trang An Farm Stay, du khách có thể tận hưởng các hoạt động như đi bộ đường dài, đi xe đạp và câu cá ngay trong khuôn viên. Dịch vụ giữ hành lý, giặt là và đặt vé được cung cấp tại đây trong khi các hoạt động du lịch cũng có thể được thu xếp cho khách. Dịch vụ đưa đón sân bay được cung cấp với một khoản phụ phí.\r\nChỗ ở này có nhà hàng, nơi du khách có thể thưởng thức tuyển chọn các món ăn ngon của địa phương. Đồ uống sau bữa ăn được phục vụ tại quán bar.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '1', '24', 'a:10:{i:0;s:15:\"smoking_allowed\";i:1;s:2:\"tv\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:19:\"handicap_accessible\";i:5;s:7:\"kitchen\";i:6;s:7:\"parking\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";i:9;s:3:\"kid\";}', '1', '2015-09-28 00:06:58', '2015-09-28 00:08:14', '0');
INSERT INTO `tb_room_address` VALUES ('36', '32', 'Tam Coc, Bich Dong, Ninh Bình, Việt Nam', 'Tam Coc, Bich Dong', 'Ninh Bình', 'Ninh Bình', '20.2182', '105.918', 'Tam Coc Eco-Lodge', 'Tam Coc Eco-Lodge tọa lạc ở thành phố Ninh Bình và được bao quanh bởi cảnh quan núi non xanh mát. Nơi nghỉ này phục vụ bữa sáng theo thực đơn lập sẵn hàng ngày và cung cấp Wi-Fi miễn phí trong toàn khuôn viên.\r\nNhà nghỉ bằng gỗ này cách các điểm tham quan ngắm cảnh nổi tiếng ở khu du lịch Tràng An 15 km. Chùa Bái Đính cách đó 25 km.\r\nMỗi phòng tại đây đều được trang bị truyền hình cáp màn hình phẳng, tủ quần áo, ấm đun nước điện và minibar. Phòng tắm riêng đi kèm tiện nghi vòi sen, đồ vệ sinh cá nhân cùng máy sấy tóc. Dịch vụ phòng cũng được cung cấp.\r\nDu khách có thể sắp xếp các hoạt động như đi bộ đường dài, đi xe đạp và câu cá. Nhân viên tại quầy lễ tân 24 giờ có thể hỗ trợ khách với các dịch vụ giữ hành lý, giặt ủi và đưa đón sân bay.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '1', '30', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-28 00:24:48', '2015-09-28 00:27:02', '0');
INSERT INTO `tb_room_address` VALUES ('37', '32', 'Tam Coc, Bich Dong, Ninh Bình, Việt Nam', 'Tam Coc, Bich Dong', 'Ninh Bình', 'Ninh Bình', '20.2183', '105.918', 'Tam Coc Eco-Lodge ', 'Tam Coc Eco-Lodge tọa lạc ở thành phố Ninh Bình và được bao quanh bởi cảnh quan núi non xanh mát. Nơi nghỉ này phục vụ bữa sáng theo thực đơn lập sẵn hàng ngày và cung cấp Wi-Fi miễn phí trong toàn khuôn viên.\r\nNhà nghỉ bằng gỗ này cách các điểm tham quan ngắm cảnh nổi tiếng ở khu du lịch Tràng An 15 km. Chùa Bái Đính cách đó 25 km.\r\nMỗi phòng tại đây đều được trang bị truyền hình cáp màn hình phẳng, tủ quần áo, ấm đun nước điện và minibar. Phòng tắm riêng đi kèm tiện nghi vòi sen, đồ vệ sinh cá nhân cùng máy sấy tóc. Dịch vụ phòng cũng được cung cấp.\r\nDu khách có thể sắp xếp các hoạt động như đi bộ đường dài, đi xe đạp và câu cá. Nhân viên tại quầy lễ tân 24 giờ có thể hỗ trợ khách với các dịch vụ giữ hành lý, giặt ủi và đưa đón sân bay.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '2', '30', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-28 00:31:22', '2015-09-28 00:32:35', '0');
INSERT INTO `tb_room_address` VALUES ('38', '32', 'Tam Cốc Bích Động, Ninh Hải, Ninh Bình, Việt Nam', 'Tam Cốc Bích Động', 'Ninh Hải', 'Ninh Bình', '20.2173', '105.936', 'Tam Coc Eco-Lodge ', 'Tam Coc Eco-Lodge tọa lạc ở thành phố Ninh Bình và được bao quanh bởi cảnh quan núi non xanh mát. Nơi nghỉ này phục vụ bữa sáng theo thực đơn lập sẵn hàng ngày và cung cấp Wi-Fi miễn phí trong toàn khuôn viên.\r\nNhà nghỉ bằng gỗ này cách các điểm tham quan ngắm cảnh nổi tiếng ở khu du lịch Tràng An 15 km. Chùa Bái Đính cách đó 25 km.\r\nMỗi phòng tại đây đều được trang bị truyền hình cáp màn hình phẳng, tủ quần áo, ấm đun nước điện và minibar. Phòng tắm riêng đi kèm tiện nghi vòi sen, đồ vệ sinh cá nhân cùng máy sấy tóc. Dịch vụ phòng cũng được cung cấp.\r\nDu khách có thể sắp xếp các hoạt động như đi bộ đường dài, đi xe đạp và câu cá. Nhân viên tại quầy lễ tân 24 giờ có thể hỗ trợ khách với các dịch vụ giữ hành lý, giặt ủi và đưa đón sân bay.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '3', '40', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-28 00:36:24', '2015-09-28 00:37:35', '0');
INSERT INTO `tb_room_address` VALUES ('39', '32', 'Tam Coc, Bich Dong, Ninh Bình, Việt Nam', 'Tam Coc, Bich Dong', 'Ninh Bình', 'Ninh Bình', '20.2183', '105.918', 'Tam Coc Eco-Lodge ', 'Tam Coc Eco-Lodge tọa lạc ở thành phố Ninh Bình và được bao quanh bởi cảnh quan núi non xanh mát. Nơi nghỉ này phục vụ bữa sáng theo thực đơn lập sẵn hàng ngày và cung cấp Wi-Fi miễn phí trong toàn khuôn viên.\r\nNhà nghỉ bằng gỗ này cách các điểm tham quan ngắm cảnh nổi tiếng ở khu du lịch Tràng An 15 km. Chùa Bái Đính cách đó 25 km.\r\nMỗi phòng tại đây đều được trang bị truyền hình cáp màn hình phẳng, tủ quần áo, ấm đun nước điện và minibar. Phòng tắm riêng đi kèm tiện nghi vòi sen, đồ vệ sinh cá nhân cùng máy sấy tóc. Dịch vụ phòng cũng được cung cấp.\r\nDu khách có thể sắp xếp các hoạt động như đi bộ đường dài, đi xe đạp và câu cá. Nhân viên tại quầy lễ tân 24 giờ có thể hỗ trợ khách với các dịch vụ giữ hành lý, giặt ủi và đưa đón sân bay.', 'a:1:{i:0;s:12:\"private_room\";}', '4', '1', '3', '40', 'a:11:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:7:\"parking\";i:8;s:6:\"washer\";i:9;s:7:\"hot_tub\";i:10;s:3:\"kid\";}', '1', '2015-09-28 00:41:39', '2015-09-28 00:42:59', '0');
INSERT INTO `tb_room_address` VALUES ('40', '33', 'Hon Gai Wharf, Hạ Long, Việt Nam', 'Hon Gai Wharf', 'tp. Hạ Long', 'Quảng Ninh', '20.9493', '107.072', 'Signature Halong Cruise ', 'Là một chiếc thuyền gỗ truyền thống, Signature Halong Cruise cung cấp các suite sang trọng nhìn ra cảnh quan tuyệt đẹp của Vịnh Hạ Long nổi tiếng, được UNESCO công nhận là di sản thế giới. Du thuyền có một sân thượng phơi nắng trên tầng mái, nơi tổ chức các bài tập Thái Cực Quyền miễn phí.\r\nDãy suite máy lạnh lấy cảm hứng từ phong cách Pháp với sàn gỗ, tủ quần áo, khu vực tiếp khách và TV màn hình phẳng với các kênh truyền hình cáp. Két an toàn và minibar cũng được cung cấp cho quý khách. Phòng tắm đi kèm bồn tắm, máy sấy tóc, dép đi trong nhà và đồ dùng vệ sinh miễn phí.\r\nDịch vụ lễ tân 24 giờ của Signature Halong Cruise có thể hỗ trợ quý khách với dịch vụ giữ hành lý. Trong suốt chuyến hành trình trên Vịnh Hạ Long, quý khách có thể trả thêm phí để tham gia các hoạt động khác nhau như câu cá, lặn biển và chèo thuyền kayak. Dịch vụ mát xa trị liệu cũng có thể được sắp xếp theo yêu cầu của quý khách.\r\nNhà hàng trên tàu phục vụ đa dạng các món ẩm thực Việt Nam và phương Tây hấp dẫn từ 7:00 đến 21:00. Thực đơn đồ uống và các món ăn nhẹ phong phú được cung cấp tại quầy bar. Du khách cũng có thể thưởng thức các bữa ăn trong sự thoải mái ngay tại phòng nghỉ của mình.\r\nSignature Halong Cruise mất khoảng 4 giờ để đến Đảo Cát Bà. Sân bay Quốc tế Cát Bi ở cách đó 80 km, còn sân bay quốc tế Nội Bài cách 170 km.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '1', '28', 'a:10:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";i:9;s:3:\"kid\";}', '1', '2015-09-28 20:22:26', '2015-09-28 20:24:34', '0');
INSERT INTO `tb_room_address` VALUES ('41', '33', 'Hon Gai Wharf, Hạ Long, Việt Nam', 'Hon Gai Wharf', 'tp. Hạ Long', 'Quảng Ninh', '20.9493', '107.072', 'Signature Halong Cruise ', 'Là một chiếc thuyền gỗ truyền thống, Signature Halong Cruise cung cấp các suite sang trọng nhìn ra cảnh quan tuyệt đẹp của Vịnh Hạ Long nổi tiếng, được UNESCO công nhận là di sản thế giới. Du thuyền có một sân thượng phơi nắng trên tầng mái, nơi tổ chức các bài tập Thái Cực Quyền miễn phí.\r\nDãy suite máy lạnh lấy cảm hứng từ phong cách Pháp với sàn gỗ, tủ quần áo, khu vực tiếp khách và TV màn hình phẳng với các kênh truyền hình cáp. Két an toàn và minibar cũng được cung cấp cho quý khách. Phòng tắm đi kèm bồn tắm, máy sấy tóc, dép đi trong nhà và đồ dùng vệ sinh miễn phí.\r\nDịch vụ lễ tân 24 giờ của Signature Halong Cruise có thể hỗ trợ quý khách với dịch vụ giữ hành lý. Trong suốt chuyến hành trình trên Vịnh Hạ Long, quý khách có thể trả thêm phí để tham gia các hoạt động khác nhau như câu cá, lặn biển và chèo thuyền kayak. Dịch vụ mát xa trị liệu cũng có thể được sắp xếp theo yêu cầu của quý khách.\r\nNhà hàng trên tàu phục vụ đa dạng các món ẩm thực Việt Nam và phương Tây hấp dẫn từ 7:00 đến 21:00. Thực đơn đồ uống và các món ăn nhẹ phong phú được cung cấp tại quầy bar. Du khách cũng có thể thưởng thức các bữa ăn trong sự thoải mái ngay tại phòng nghỉ của mình.\r\nSignature Halong Cruise mất khoảng 4 giờ để đến Đảo Cát Bà. Sân bay Quốc tế Cát Bi ở cách đó 80 km, còn sân bay quốc tế Nội Bài cách 170 km.', 'a:1:{i:0;s:12:\"private_room\";}', '3', '1', '1', '28', 'a:10:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:2:\"tv\";i:3;s:8:\"internet\";i:4;s:16:\"air_conditioning\";i:5;s:19:\"handicap_accessible\";i:6;s:7:\"kitchen\";i:7;s:6:\"washer\";i:8;s:7:\"hot_tub\";i:9;s:3:\"kid\";}', '0', '2015-09-28 20:23:11', '2015-09-28 20:23:11', '0');
INSERT INTO `tb_room_address` VALUES ('42', '3', '69 Đinh Tiên Hoàng, Lý Thái Tổ, Hoàn Kiếm, Hà Nội, Việt Nam', '69 Đinh Tiên Hoàng', 'hoàn kiếm', 'Hà Nội', '21.0284', '105.853', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các ', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các ', 'a:1:{i:0;s:12:\"private_room\";}', '8', '6', '7', '30', 'a:5:{i:0;s:15:\"smoking_allowed\";i:1;s:8:\"internet\";i:2;s:19:\"handicap_accessible\";i:3;s:7:\"parking\";i:4;s:7:\"hot_tub\";}', '0', '2015-09-28 22:40:54', '2015-09-28 23:29:27', '0');
INSERT INTO `tb_room_address` VALUES ('43', '3', '24 Lê Thái Tổ, Hàng Trống, Hoàn Kiếm, Hà Nội, Việt Nam', '24 Lê Thái Tổ', 'hoàn kiếm ', 'Hà Nội', '21.0277', '105.851', 'Phòng gần hồ gươm', 'ể bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.ể bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.ể bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.ể bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.', 'a:3:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";i:2;s:10:\"share_room\";}', '6', '5', '4', '40', 'a:4:{i:0;s:20:\"elevator_in_building\";i:1;s:7:\"kitchen\";i:2;s:3:\"gym\";i:3;s:3:\"kid\";}', '0', '2015-09-28 23:34:58', '2015-09-28 23:40:54', '0');
INSERT INTO `tb_room_address` VALUES ('44', '3', 'TL195, Phụng Công, Văn Giang, Hưng Yên, Việt Nam', 'TL195', 'hưng yên ', 'Hưng Yên', '20.9504', '105.925', 'Phòng cho thuê gần thành phố', 'bản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuêbản đồ để hiển thị vị trí phòng cho thuê', 'a:1:{i:0;s:12:\"private_room\";}', '1', '1', '1', '40', 'a:10:{i:0;s:12:\"pets_allowed\";i:1;s:2:\"tv\";i:2;s:16:\"air_conditioning\";i:3;s:20:\"elevator_in_building\";i:4;s:4:\"pool\";i:5;s:7:\"kitchen\";i:6;s:6:\"washer\";i:7;s:3:\"gym\";i:8;s:9:\"breakfast\";i:9;s:3:\"kid\";}', '0', '2015-09-28 23:38:02', '2015-09-28 23:38:02', '0');

-- ----------------------------
-- Table structure for `tb_room_images`
-- ----------------------------
DROP TABLE IF EXISTS `tb_room_images`;
CREATE TABLE `tb_room_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_address_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`,`room_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_images
-- ----------------------------
INSERT INTO `tb_room_images` VALUES ('1', '1', '1441905207.2668.jpg', '2015-09-11 00:13:27', '2015-09-11 00:13:27', '0');
INSERT INTO `tb_room_images` VALUES ('2', '1', '1441905218.0069.jpg', '2015-09-11 00:13:38', '2015-09-11 00:13:38', '0');
INSERT INTO `tb_room_images` VALUES ('3', '1', '1441905226.368.jpg', '2015-09-11 00:13:46', '2015-09-11 00:13:46', '0');
INSERT INTO `tb_room_images` VALUES ('4', '1', '1441905235.698.jpg', '2015-09-11 00:13:55', '2015-09-11 00:13:55', '0');
INSERT INTO `tb_room_images` VALUES ('5', '1', '1441905244.1673.jpg', '2015-09-11 00:14:04', '2015-09-11 00:14:04', '0');
INSERT INTO `tb_room_images` VALUES ('6', '1', '1441905253.4285.jpg', '2015-09-11 00:14:13', '2015-09-11 00:14:13', '0');
INSERT INTO `tb_room_images` VALUES ('7', '1', '1441905269.5685.jpg', '2015-09-11 00:14:29', '2015-09-11 00:14:29', '0');
INSERT INTO `tb_room_images` VALUES ('8', '2', '1441984677.2374.jpg', '2015-09-11 22:17:57', '2015-09-11 22:17:57', '0');
INSERT INTO `tb_room_images` VALUES ('9', '2', '1441984693.4144.jpg', '2015-09-11 22:18:13', '2015-09-11 22:18:13', '0');
INSERT INTO `tb_room_images` VALUES ('10', '2', '1441984703.1819.jpg', '2015-09-11 22:18:23', '2015-09-11 22:18:23', '0');
INSERT INTO `tb_room_images` VALUES ('11', '2', '1441984714.4077.jpg', '2015-09-11 22:18:34', '2015-09-11 22:18:34', '0');
INSERT INTO `tb_room_images` VALUES ('12', '3', '1441984877.9887.jpg', '2015-09-11 22:21:17', '2015-09-11 22:21:17', '0');
INSERT INTO `tb_room_images` VALUES ('13', '3', '1441984902.2306.jpg', '2015-09-11 22:21:42', '2015-09-11 22:21:42', '0');
INSERT INTO `tb_room_images` VALUES ('14', '3', '1441984919.9897.jpg', '2015-09-11 22:21:59', '2015-09-11 22:21:59', '0');
INSERT INTO `tb_room_images` VALUES ('15', '3', '1441984957.0306.jpg', '2015-09-11 22:22:37', '2015-09-11 22:22:37', '0');
INSERT INTO `tb_room_images` VALUES ('16', '3', '1441985050.1978.jpg', '2015-09-11 22:24:10', '2015-09-11 22:24:10', '0');
INSERT INTO `tb_room_images` VALUES ('17', '3', '1441985061.1961.jpg', '2015-09-11 22:24:21', '2015-09-11 22:24:21', '0');
INSERT INTO `tb_room_images` VALUES ('18', '4', '1442124317.9991.jpg', '2015-09-13 13:05:18', '2015-09-13 13:05:18', '0');
INSERT INTO `tb_room_images` VALUES ('19', '5', '1442157793.2073.jpg', '2015-09-13 22:23:13', '2015-09-13 22:23:13', '0');
INSERT INTO `tb_room_images` VALUES ('20', '4', '1442215814.4799.jpg', '2015-09-14 14:30:14', '2015-09-14 14:30:32', '1');
INSERT INTO `tb_room_images` VALUES ('21', '4', '1442215840.4482.jpg', '2015-09-14 14:30:40', '2015-09-14 14:30:40', '0');
INSERT INTO `tb_room_images` VALUES ('22', '4', '1442215867.0435.jpg', '2015-09-14 14:31:07', '2015-09-14 14:31:07', '0');
INSERT INTO `tb_room_images` VALUES ('23', '4', '1442215925.6789.jpg', '2015-09-14 14:32:05', '2015-09-14 14:32:05', '0');
INSERT INTO `tb_room_images` VALUES ('24', '4', '1442215960.0012.jpg', '2015-09-14 14:32:40', '2015-09-14 14:32:40', '0');
INSERT INTO `tb_room_images` VALUES ('25', '4', '1442216022.2153.jpg', '2015-09-14 14:33:42', '2015-09-14 14:33:42', '0');
INSERT INTO `tb_room_images` VALUES ('26', '4', '1442216123.8685.jpg', '2015-09-14 14:35:23', '2015-09-14 14:35:23', '0');
INSERT INTO `tb_room_images` VALUES ('27', '4', '1442216200.8265.jpg', '2015-09-14 14:36:40', '2015-09-14 14:36:40', '0');
INSERT INTO `tb_room_images` VALUES ('28', '4', '1442216284.1796.jpg', '2015-09-14 14:38:04', '2015-09-14 14:38:04', '0');
INSERT INTO `tb_room_images` VALUES ('29', '4', '1442216318.0287.jpg', '2015-09-14 14:38:38', '2015-09-14 14:38:38', '0');
INSERT INTO `tb_room_images` VALUES ('30', '6', '1442237198.4804.jpg', '2015-09-14 20:26:38', '2015-09-14 20:26:48', '1');
INSERT INTO `tb_room_images` VALUES ('31', '6', '1442237218.8462.jpg', '2015-09-14 20:26:58', '2015-09-14 20:26:58', '0');
INSERT INTO `tb_room_images` VALUES ('32', '6', '1442237246.1891.jpg', '2015-09-14 20:27:26', '2015-09-14 20:27:26', '0');
INSERT INTO `tb_room_images` VALUES ('33', '6', '1442237270.917.jpg', '2015-09-14 20:27:50', '2015-09-14 20:27:50', '0');
INSERT INTO `tb_room_images` VALUES ('34', '6', '1442237291.5366.jpg', '2015-09-14 20:28:11', '2015-09-14 20:28:11', '0');
INSERT INTO `tb_room_images` VALUES ('35', '6', '1442237310.9439.jpg', '2015-09-14 20:28:30', '2015-09-14 20:28:30', '0');
INSERT INTO `tb_room_images` VALUES ('36', '6', '1442237336.4912.jpg', '2015-09-14 20:28:56', '2015-09-14 20:28:56', '0');
INSERT INTO `tb_room_images` VALUES ('37', '7', '1442251084.7043.jpg', '2015-09-15 00:18:04', '2015-09-15 00:18:04', '0');
INSERT INTO `tb_room_images` VALUES ('38', '7', '1442251096.1825.jpg', '2015-09-15 00:18:16', '2015-09-15 00:18:16', '0');
INSERT INTO `tb_room_images` VALUES ('39', '7', '1442251109.4592.jpg', '2015-09-15 00:18:29', '2015-09-15 00:18:29', '0');
INSERT INTO `tb_room_images` VALUES ('40', '7', '1442251121.5036.jpg', '2015-09-15 00:18:41', '2015-09-15 00:18:41', '0');
INSERT INTO `tb_room_images` VALUES ('41', '7', '1442251159.8041.jpg', '2015-09-15 00:19:19', '2015-09-15 00:19:19', '0');
INSERT INTO `tb_room_images` VALUES ('42', '7', '1442251201.2358.jpg', '2015-09-15 00:20:01', '2015-09-15 00:20:01', '0');
INSERT INTO `tb_room_images` VALUES ('43', '7', '1442251322.1273.jpg', '2015-09-15 00:22:02', '2015-09-15 00:22:02', '0');
INSERT INTO `tb_room_images` VALUES ('44', '7', '1442251354.7169.jpg', '2015-09-15 00:22:34', '2015-09-15 00:22:34', '0');
INSERT INTO `tb_room_images` VALUES ('45', '7', '1442251376.9995.jpg', '2015-09-15 00:22:57', '2015-09-15 00:22:57', '0');
INSERT INTO `tb_room_images` VALUES ('46', '7', '1442251402.4284.jpg', '2015-09-15 00:23:22', '2015-09-15 00:23:22', '0');
INSERT INTO `tb_room_images` VALUES ('47', '7', '1442251413.1288.jpg', '2015-09-15 00:23:33', '2015-09-15 00:23:33', '0');
INSERT INTO `tb_room_images` VALUES ('48', '8', '1442286164.2368.jpg', '2015-09-15 10:02:44', '2015-09-15 10:02:44', '0');
INSERT INTO `tb_room_images` VALUES ('49', '8', '1442286176.9228.jpg', '2015-09-15 10:02:56', '2015-09-15 10:02:56', '0');
INSERT INTO `tb_room_images` VALUES ('50', '8', '1442286185.3401.jpg', '2015-09-15 10:03:05', '2015-09-15 10:03:05', '0');
INSERT INTO `tb_room_images` VALUES ('51', '8', '1442286203.9679.jpg', '2015-09-15 10:03:23', '2015-09-15 10:03:23', '0');
INSERT INTO `tb_room_images` VALUES ('52', '8', '1442286211.1695.jpg', '2015-09-15 10:03:31', '2015-09-15 10:03:31', '0');
INSERT INTO `tb_room_images` VALUES ('53', '8', '1442286219.9956.jpg', '2015-09-15 10:03:40', '2015-09-15 10:03:40', '0');
INSERT INTO `tb_room_images` VALUES ('54', '9', '1442319765.165.jpg', '2015-09-15 19:22:45', '2015-09-15 19:22:45', '0');
INSERT INTO `tb_room_images` VALUES ('55', '9', '1442319783.2376.jpg', '2015-09-15 19:23:03', '2015-09-15 19:23:03', '0');
INSERT INTO `tb_room_images` VALUES ('56', '9', '1442319792.2438.jpg', '2015-09-15 19:23:12', '2015-09-15 19:23:12', '0');
INSERT INTO `tb_room_images` VALUES ('57', '9', '1442319802.5701.jpg', '2015-09-15 19:23:22', '2015-09-15 19:23:22', '0');
INSERT INTO `tb_room_images` VALUES ('58', '9', '1442320048.6355.jpg', '2015-09-15 19:27:28', '2015-09-15 19:27:28', '0');
INSERT INTO `tb_room_images` VALUES ('59', '9', '1442320061.4532.png', '2015-09-15 19:27:41', '2015-09-15 19:27:41', '0');
INSERT INTO `tb_room_images` VALUES ('60', '8', '1442402339.5256.jpg', '2015-09-16 18:18:59', '2015-09-16 18:19:16', '1');
INSERT INTO `tb_room_images` VALUES ('61', '8', '1442402374.8472.jpg', '2015-09-16 18:19:34', '2015-09-16 18:19:42', '1');
INSERT INTO `tb_room_images` VALUES ('62', '8', '1442402464.1665.jpg', '2015-09-16 18:21:04', '2015-09-16 18:21:07', '1');
INSERT INTO `tb_room_images` VALUES ('63', '10', '1442403570.4089.jpg', '2015-09-16 18:39:30', '2015-09-16 18:39:30', '0');
INSERT INTO `tb_room_images` VALUES ('64', '10', '1442403710.9648.jpg', '2015-09-16 18:41:50', '2015-09-16 18:41:50', '0');
INSERT INTO `tb_room_images` VALUES ('65', '10', '1442403774.4054.jpg', '2015-09-16 18:42:54', '2015-09-16 18:42:54', '0');
INSERT INTO `tb_room_images` VALUES ('66', '10', '1442403845.0305.jpg', '2015-09-16 18:44:05', '2015-09-16 18:44:05', '0');
INSERT INTO `tb_room_images` VALUES ('67', '10', '1442403883.8257.jpg', '2015-09-16 18:44:43', '2015-09-16 18:44:43', '0');
INSERT INTO `tb_room_images` VALUES ('68', '10', '1442404059.7254.jpg', '2015-09-16 18:47:39', '2015-09-16 18:47:39', '0');
INSERT INTO `tb_room_images` VALUES ('69', '10', '1442404091.788.jpg', '2015-09-16 18:48:11', '2015-09-16 18:48:11', '0');
INSERT INTO `tb_room_images` VALUES ('70', '10', '1442404218.5144.jpg', '2015-09-16 18:50:18', '2015-09-16 18:50:18', '0');
INSERT INTO `tb_room_images` VALUES ('71', '10', '1442457781.863.jpg', '2015-09-17 09:43:01', '2015-09-17 09:43:01', '0');
INSERT INTO `tb_room_images` VALUES ('72', '10', '1442457808.508.jpg', '2015-09-17 09:43:28', '2015-09-17 09:43:28', '0');
INSERT INTO `tb_room_images` VALUES ('73', '10', '1442457972.6721.jpg', '2015-09-17 09:46:12', '2015-09-17 09:46:12', '0');
INSERT INTO `tb_room_images` VALUES ('74', '10', '1442458190.0973.jpg', '2015-09-17 09:49:50', '2015-09-17 09:49:50', '0');
INSERT INTO `tb_room_images` VALUES ('75', '10', '1442458235.5265.jpg', '2015-09-17 09:50:35', '2015-09-17 09:50:35', '0');
INSERT INTO `tb_room_images` VALUES ('76', '12', '1442460925.2081.jpg', '2015-09-17 10:35:25', '2015-09-17 10:35:25', '0');
INSERT INTO `tb_room_images` VALUES ('77', '12', '1442462268.6101.jpg', '2015-09-17 10:57:48', '2015-09-17 10:57:48', '0');
INSERT INTO `tb_room_images` VALUES ('78', '12', '1442462283.5284.jpg', '2015-09-17 10:58:03', '2015-09-17 10:58:03', '0');
INSERT INTO `tb_room_images` VALUES ('79', '12', '1442462459.3411.png', '2015-09-17 11:00:59', '2015-09-17 11:00:59', '0');
INSERT INTO `tb_room_images` VALUES ('80', '12', '1442464054.6835.png', '2015-09-17 11:27:34', '2015-09-17 11:27:34', '0');
INSERT INTO `tb_room_images` VALUES ('81', '12', '1442464164.3965.png', '2015-09-17 11:29:24', '2015-09-17 11:29:24', '0');
INSERT INTO `tb_room_images` VALUES ('82', '8', '1442500105.4441.jpg', '2015-09-17 21:28:25', '2015-09-17 21:28:25', '0');
INSERT INTO `tb_room_images` VALUES ('83', '8', '1442500118.5081.jpg', '2015-09-17 21:28:38', '2015-09-17 21:28:38', '0');
INSERT INTO `tb_room_images` VALUES ('84', '13', '1442538713.8843.jpg', '2015-09-18 08:11:53', '2015-09-18 08:11:53', '0');
INSERT INTO `tb_room_images` VALUES ('85', '13', '1442538741.4306.jpg', '2015-09-18 08:12:21', '2015-09-18 08:12:21', '0');
INSERT INTO `tb_room_images` VALUES ('86', '13', '1442538768.9585.jpg', '2015-09-18 08:12:48', '2015-09-18 08:12:48', '0');
INSERT INTO `tb_room_images` VALUES ('87', '13', '1442538791.9971.jpg', '2015-09-18 08:13:12', '2015-09-18 08:13:12', '0');
INSERT INTO `tb_room_images` VALUES ('88', '13', '1442538811.1283.jpg', '2015-09-18 08:13:31', '2015-09-18 08:13:31', '0');
INSERT INTO `tb_room_images` VALUES ('89', '13', '1442538862.8414.jpg', '2015-09-18 08:14:22', '2015-09-18 08:14:22', '0');
INSERT INTO `tb_room_images` VALUES ('90', '13', '1442539042.5835.jpg', '2015-09-18 08:17:22', '2015-09-18 08:17:22', '0');
INSERT INTO `tb_room_images` VALUES ('91', '13', '1442539061.7216.jpg', '2015-09-18 08:17:41', '2015-09-18 08:17:41', '0');
INSERT INTO `tb_room_images` VALUES ('92', '13', '1442539084.1311.jpg', '2015-09-18 08:18:04', '2015-09-18 08:18:04', '0');
INSERT INTO `tb_room_images` VALUES ('93', '13', '1442539230.131.jpg', '2015-09-18 08:20:30', '2015-09-18 08:20:30', '0');
INSERT INTO `tb_room_images` VALUES ('94', '13', '1442539288.6431.jpg', '2015-09-18 08:21:28', '2015-09-18 08:21:28', '0');
INSERT INTO `tb_room_images` VALUES ('95', '13', '1442539326.0262.jpg', '2015-09-18 08:22:06', '2015-09-18 08:22:06', '0');
INSERT INTO `tb_room_images` VALUES ('96', '13', '1442539376.6084.jpg', '2015-09-18 08:22:56', '2015-09-18 08:22:56', '0');
INSERT INTO `tb_room_images` VALUES ('97', '13', '1442539508.6959.jpg', '2015-09-18 08:25:08', '2015-09-18 08:25:08', '0');
INSERT INTO `tb_room_images` VALUES ('98', '13', '1442539564.0026.jpg', '2015-09-18 08:26:04', '2015-09-18 08:26:04', '0');
INSERT INTO `tb_room_images` VALUES ('99', '14', '1442594511.347.jpg', '2015-09-18 23:41:51', '2015-09-18 23:41:51', '0');
INSERT INTO `tb_room_images` VALUES ('100', '14', '1442594517.1508.jpg', '2015-09-18 23:41:57', '2015-09-18 23:41:57', '0');
INSERT INTO `tb_room_images` VALUES ('101', '14', '1442594522.9409.jpg', '2015-09-18 23:42:02', '2015-09-18 23:42:02', '0');
INSERT INTO `tb_room_images` VALUES ('102', '14', '1442594529.5459.jpg', '2015-09-18 23:42:09', '2015-09-18 23:42:09', '0');
INSERT INTO `tb_room_images` VALUES ('103', '14', '1442594536.4245.jpg', '2015-09-18 23:42:16', '2015-09-18 23:42:16', '0');
INSERT INTO `tb_room_images` VALUES ('104', '14', '1442594542.2338.jpg', '2015-09-18 23:42:22', '2015-09-18 23:42:22', '0');
INSERT INTO `tb_room_images` VALUES ('105', '15', '1442662755.9734.jpg', '2015-09-19 18:39:15', '2015-09-19 18:39:15', '0');
INSERT INTO `tb_room_images` VALUES ('106', '15', '1442662761.9517.jpg', '2015-09-19 18:39:21', '2015-09-19 18:39:21', '0');
INSERT INTO `tb_room_images` VALUES ('107', '15', '1442662771.3725.jpg', '2015-09-19 18:39:31', '2015-09-19 18:39:31', '0');
INSERT INTO `tb_room_images` VALUES ('108', '15', '1442662780.3145.jpg', '2015-09-19 18:39:40', '2015-09-19 18:39:40', '0');
INSERT INTO `tb_room_images` VALUES ('109', '15', '1442662796.7884.jpg', '2015-09-19 18:39:56', '2015-09-19 18:39:56', '0');
INSERT INTO `tb_room_images` VALUES ('110', '15', '1442662804.907.jpg', '2015-09-19 18:40:04', '2015-09-19 18:40:04', '0');
INSERT INTO `tb_room_images` VALUES ('111', '16', '1442731909.8835.jpg', '2015-09-20 13:51:49', '2015-09-20 13:51:49', '0');
INSERT INTO `tb_room_images` VALUES ('112', '17', '1442732301.5823.jpg', '2015-09-20 13:58:21', '2015-09-20 13:58:21', '0');
INSERT INTO `tb_room_images` VALUES ('113', '19', '1443021893.4123.jpg', '2015-09-23 22:24:53', '2015-09-23 22:24:53', '0');
INSERT INTO `tb_room_images` VALUES ('114', '19', '1443021926.2429.jpg', '2015-09-23 22:25:26', '2015-09-23 22:25:26', '0');
INSERT INTO `tb_room_images` VALUES ('115', '19', '1443021935.505.jpg', '2015-09-23 22:25:35', '2015-09-23 22:25:35', '0');
INSERT INTO `tb_room_images` VALUES ('116', '19', '1443021946.9087.jpg', '2015-09-23 22:25:46', '2015-09-23 22:25:46', '0');
INSERT INTO `tb_room_images` VALUES ('117', '19', '1443021956.2295.jpg', '2015-09-23 22:25:56', '2015-09-23 22:25:56', '0');
INSERT INTO `tb_room_images` VALUES ('118', '19', '1443021978.2038.jpg', '2015-09-23 22:26:18', '2015-09-23 22:26:18', '0');
INSERT INTO `tb_room_images` VALUES ('119', '19', '1443021989.2521.jpg', '2015-09-23 22:26:29', '2015-09-23 22:26:29', '0');
INSERT INTO `tb_room_images` VALUES ('120', '20', '1443115129.2893.jpg', '2015-09-25 00:18:49', '2015-09-25 00:18:49', '0');
INSERT INTO `tb_room_images` VALUES ('121', '20', '1443115133.7211.jpg', '2015-09-25 00:18:53', '2015-09-25 00:18:53', '0');
INSERT INTO `tb_room_images` VALUES ('122', '20', '1443115137.5942.jpg', '2015-09-25 00:18:57', '2015-09-25 00:18:57', '0');
INSERT INTO `tb_room_images` VALUES ('123', '20', '1443115140.7876.jpg', '2015-09-25 00:19:00', '2015-09-25 00:19:00', '0');
INSERT INTO `tb_room_images` VALUES ('124', '20', '1443115145.1436.jpg', '2015-09-25 00:19:05', '2015-09-25 00:19:05', '0');
INSERT INTO `tb_room_images` VALUES ('125', '20', '1443115151.7736.jpg', '2015-09-25 00:19:11', '2015-09-25 00:19:11', '0');
INSERT INTO `tb_room_images` VALUES ('126', '20', '1443115159.2876.jpg', '2015-09-25 00:19:19', '2015-09-25 00:19:19', '0');
INSERT INTO `tb_room_images` VALUES ('127', '20', '1443115164.3661.jpg', '2015-09-25 00:19:24', '2015-09-25 00:19:24', '0');
INSERT INTO `tb_room_images` VALUES ('128', '20', '1443115168.3913.jpg', '2015-09-25 00:19:28', '2015-09-25 00:19:28', '0');
INSERT INTO `tb_room_images` VALUES ('129', '20', '1443115171.8552.jpg', '2015-09-25 00:19:31', '2015-09-25 00:19:31', '0');
INSERT INTO `tb_room_images` VALUES ('130', '21', '1443115439.6619.jpg', '2015-09-25 00:23:59', '2015-09-25 00:23:59', '0');
INSERT INTO `tb_room_images` VALUES ('131', '21', '1443115442.9568.jpg', '2015-09-25 00:24:02', '2015-09-25 00:24:02', '0');
INSERT INTO `tb_room_images` VALUES ('132', '21', '1443115447.3939.jpg', '2015-09-25 00:24:07', '2015-09-25 00:24:07', '0');
INSERT INTO `tb_room_images` VALUES ('133', '21', '1443115454.178.jpg', '2015-09-25 00:24:14', '2015-09-25 00:24:14', '0');
INSERT INTO `tb_room_images` VALUES ('134', '21', '1443115460.7629.jpg', '2015-09-25 00:24:20', '2015-09-25 00:24:20', '0');
INSERT INTO `tb_room_images` VALUES ('135', '21', '1443115465.3302.jpg', '2015-09-25 00:24:25', '2015-09-25 00:24:25', '0');
INSERT INTO `tb_room_images` VALUES ('136', '21', '1443115469.2886.jpg', '2015-09-25 00:24:29', '2015-09-25 00:24:29', '0');
INSERT INTO `tb_room_images` VALUES ('137', '21', '1443115475.973.jpg', '2015-09-25 00:24:35', '2015-09-25 00:24:35', '0');
INSERT INTO `tb_room_images` VALUES ('138', '22', '1443184417.7809.jpg', '2015-09-25 19:33:37', '2015-09-25 19:33:37', '0');
INSERT INTO `tb_room_images` VALUES ('139', '22', '1443184420.5843.jpg', '2015-09-25 19:33:40', '2015-09-25 19:33:40', '0');
INSERT INTO `tb_room_images` VALUES ('140', '22', '1443184422.9911.jpg', '2015-09-25 19:33:42', '2015-09-25 19:33:42', '0');
INSERT INTO `tb_room_images` VALUES ('141', '22', '1443184717.4927.jpg', '2015-09-25 19:38:37', '2015-09-25 19:38:37', '0');
INSERT INTO `tb_room_images` VALUES ('142', '22', '1443184720.0373.jpg', '2015-09-25 19:38:40', '2015-09-25 19:38:40', '0');
INSERT INTO `tb_room_images` VALUES ('143', '22', '1443184722.0961.jpg', '2015-09-25 19:38:42', '2015-09-25 19:38:42', '0');
INSERT INTO `tb_room_images` VALUES ('144', '23', '1443318666.9586.jpg', '2015-09-27 08:51:06', '2015-09-27 08:51:06', '0');
INSERT INTO `tb_room_images` VALUES ('145', '23', '1443318669.4939.jpg', '2015-09-27 08:51:09', '2015-09-27 08:51:09', '0');
INSERT INTO `tb_room_images` VALUES ('146', '23', '1443318672.8842.jpg', '2015-09-27 08:51:12', '2015-09-27 08:51:12', '0');
INSERT INTO `tb_room_images` VALUES ('147', '23', '1443318675.9336.jpg', '2015-09-27 08:51:15', '2015-09-27 08:51:15', '0');
INSERT INTO `tb_room_images` VALUES ('148', '23', '1443318678.4437.jpg', '2015-09-27 08:51:18', '2015-09-27 08:51:18', '0');
INSERT INTO `tb_room_images` VALUES ('149', '23', '1443318681.0645.jpg', '2015-09-27 08:51:21', '2015-09-27 08:51:21', '0');
INSERT INTO `tb_room_images` VALUES ('150', '24', '1443321793.7907.jpg', '2015-09-27 09:43:13', '2015-09-27 09:43:13', '0');
INSERT INTO `tb_room_images` VALUES ('151', '24', '1443321797.8208.jpg', '2015-09-27 09:43:17', '2015-09-27 09:43:17', '0');
INSERT INTO `tb_room_images` VALUES ('152', '24', '1443321801.868.jpg', '2015-09-27 09:43:21', '2015-09-27 09:43:21', '0');
INSERT INTO `tb_room_images` VALUES ('153', '24', '1443321804.6933.jpg', '2015-09-27 09:43:24', '2015-09-27 09:43:24', '0');
INSERT INTO `tb_room_images` VALUES ('154', '24', '1443321861.5815.jpg', '2015-09-27 09:44:21', '2015-09-27 09:44:21', '0');
INSERT INTO `tb_room_images` VALUES ('155', '24', '1443321868.5335.jpg', '2015-09-27 09:44:28', '2015-09-27 09:44:28', '0');
INSERT INTO `tb_room_images` VALUES ('156', '25', '1443322768.6868.jpg', '2015-09-27 09:59:28', '2015-09-27 09:59:28', '0');
INSERT INTO `tb_room_images` VALUES ('157', '25', '1443322773.1521.jpg', '2015-09-27 09:59:33', '2015-09-27 09:59:33', '0');
INSERT INTO `tb_room_images` VALUES ('158', '25', '1443322776.8742.jpg', '2015-09-27 09:59:36', '2015-09-27 09:59:36', '0');
INSERT INTO `tb_room_images` VALUES ('159', '25', '1443322780.4274.jpg', '2015-09-27 09:59:40', '2015-09-27 09:59:40', '0');
INSERT INTO `tb_room_images` VALUES ('160', '25', '1443322787.1666.jpg', '2015-09-27 09:59:47', '2015-09-27 09:59:47', '0');
INSERT INTO `tb_room_images` VALUES ('161', '25', '1443322791.0301.jpg', '2015-09-27 09:59:51', '2015-09-27 09:59:51', '0');
INSERT INTO `tb_room_images` VALUES ('162', '26', '1443325242.184.jpg', '2015-09-27 10:40:42', '2015-09-27 10:40:42', '0');
INSERT INTO `tb_room_images` VALUES ('163', '26', '1443325245.4485.jpg', '2015-09-27 10:40:45', '2015-09-27 10:40:45', '0');
INSERT INTO `tb_room_images` VALUES ('164', '26', '1443325249.2229.jpg', '2015-09-27 10:40:49', '2015-09-27 10:40:49', '0');
INSERT INTO `tb_room_images` VALUES ('165', '26', '1443325254.0596.jpg', '2015-09-27 10:40:54', '2015-09-27 10:40:54', '0');
INSERT INTO `tb_room_images` VALUES ('166', '26', '1443325258.5376.jpg', '2015-09-27 10:40:58', '2015-09-27 10:40:58', '0');
INSERT INTO `tb_room_images` VALUES ('167', '26', '1443325270.1892.jpg', '2015-09-27 10:41:10', '2015-09-27 10:41:10', '0');
INSERT INTO `tb_room_images` VALUES ('168', '26', '1443325275.3675.jpg', '2015-09-27 10:41:15', '2015-09-27 10:41:15', '0');
INSERT INTO `tb_room_images` VALUES ('169', '27', '1443329112.9589.jpg', '2015-09-27 11:45:12', '2015-09-27 11:45:12', '0');
INSERT INTO `tb_room_images` VALUES ('170', '27', '1443329119.2553.jpg', '2015-09-27 11:45:19', '2015-09-27 11:45:19', '0');
INSERT INTO `tb_room_images` VALUES ('171', '27', '1443329125.2434.jpg', '2015-09-27 11:45:25', '2015-09-27 11:45:25', '0');
INSERT INTO `tb_room_images` VALUES ('172', '27', '1443329133.2158.jpg', '2015-09-27 11:45:33', '2015-09-27 11:45:33', '0');
INSERT INTO `tb_room_images` VALUES ('173', '27', '1443329139.0088.jpg', '2015-09-27 11:45:39', '2015-09-27 11:45:39', '0');
INSERT INTO `tb_room_images` VALUES ('174', '27', '1443329142.6862.jpg', '2015-09-27 11:45:42', '2015-09-27 11:45:42', '0');
INSERT INTO `tb_room_images` VALUES ('175', '27', '1443329163.3409.jpg', '2015-09-27 11:46:03', '2015-09-27 11:46:03', '0');
INSERT INTO `tb_room_images` VALUES ('176', '27', '1443329166.3846.jpg', '2015-09-27 11:46:06', '2015-09-27 11:46:06', '0');
INSERT INTO `tb_room_images` VALUES ('177', '27', '1443329487.3884.jpg', '2015-09-27 11:51:27', '2015-09-27 11:51:27', '0');
INSERT INTO `tb_room_images` VALUES ('178', '28', '1443330008.2175.jpg', '2015-09-27 12:00:08', '2015-09-27 12:00:08', '0');
INSERT INTO `tb_room_images` VALUES ('179', '28', '1443330012.7656.jpg', '2015-09-27 12:00:12', '2015-09-27 12:00:12', '0');
INSERT INTO `tb_room_images` VALUES ('180', '28', '1443330016.984.jpg', '2015-09-27 12:00:16', '2015-09-27 12:00:16', '0');
INSERT INTO `tb_room_images` VALUES ('181', '28', '1443330023.7057.jpg', '2015-09-27 12:00:23', '2015-09-27 12:00:23', '0');
INSERT INTO `tb_room_images` VALUES ('182', '28', '1443330033.2166.jpg', '2015-09-27 12:00:33', '2015-09-27 12:00:33', '0');
INSERT INTO `tb_room_images` VALUES ('183', '28', '1443330073.9503.jpg', '2015-09-27 12:01:13', '2015-09-27 12:01:13', '0');
INSERT INTO `tb_room_images` VALUES ('184', '28', '1443330094.1952.jpg', '2015-09-27 12:01:34', '2015-09-27 12:01:34', '0');
INSERT INTO `tb_room_images` VALUES ('185', '29', '1443343174.0699.jpg', '2015-09-27 15:39:34', '2015-09-27 15:39:34', '0');
INSERT INTO `tb_room_images` VALUES ('186', '29', '1443343180.9441.jpg', '2015-09-27 15:39:40', '2015-09-27 15:39:40', '0');
INSERT INTO `tb_room_images` VALUES ('187', '29', '1443343185.1112.jpg', '2015-09-27 15:39:45', '2015-09-27 15:39:45', '0');
INSERT INTO `tb_room_images` VALUES ('188', '29', '1443343190.9499.jpg', '2015-09-27 15:39:50', '2015-09-27 15:39:50', '0');
INSERT INTO `tb_room_images` VALUES ('189', '29', '1443343198.8088.jpg', '2015-09-27 15:39:58', '2015-09-27 15:39:58', '0');
INSERT INTO `tb_room_images` VALUES ('190', '29', '1443343207.601.jpg', '2015-09-27 15:40:07', '2015-09-27 15:40:07', '0');
INSERT INTO `tb_room_images` VALUES ('191', '29', '1443343217.7739.jpg', '2015-09-27 15:40:17', '2015-09-27 15:40:17', '0');
INSERT INTO `tb_room_images` VALUES ('192', '30', '1443343887.3692.jpg', '2015-09-27 15:51:27', '2015-09-27 15:51:27', '0');
INSERT INTO `tb_room_images` VALUES ('193', '30', '1443343891.1331.jpg', '2015-09-27 15:51:31', '2015-09-27 15:51:31', '0');
INSERT INTO `tb_room_images` VALUES ('194', '30', '1443343894.2636.jpg', '2015-09-27 15:51:34', '2015-09-27 15:51:34', '0');
INSERT INTO `tb_room_images` VALUES ('195', '30', '1443343911.9035.jpg', '2015-09-27 15:51:51', '2015-09-27 15:51:51', '0');
INSERT INTO `tb_room_images` VALUES ('196', '30', '1443343918.7562.jpg', '2015-09-27 15:51:58', '2015-09-27 15:51:58', '0');
INSERT INTO `tb_room_images` VALUES ('197', '30', '1443343925.3598.jpg', '2015-09-27 15:52:05', '2015-09-27 15:52:05', '0');
INSERT INTO `tb_room_images` VALUES ('198', '30', '1443343934.1946.jpg', '2015-09-27 15:52:14', '2015-09-27 15:52:14', '0');
INSERT INTO `tb_room_images` VALUES ('199', '30', '1443343939.9132.jpg', '2015-09-27 15:52:19', '2015-09-27 15:52:19', '0');
INSERT INTO `tb_room_images` VALUES ('200', '30', '1443343944.7042.jpg', '2015-09-27 15:52:24', '2015-09-27 15:52:24', '0');
INSERT INTO `tb_room_images` VALUES ('201', '31', '1443354813.5499.jpg', '2015-09-27 18:53:33', '2015-09-27 18:53:33', '0');
INSERT INTO `tb_room_images` VALUES ('202', '31', '1443354817.8573.jpg', '2015-09-27 18:53:37', '2015-09-27 18:53:37', '0');
INSERT INTO `tb_room_images` VALUES ('203', '31', '1443354823.3647.jpg', '2015-09-27 18:53:43', '2015-09-27 18:53:43', '0');
INSERT INTO `tb_room_images` VALUES ('204', '31', '1443354828.3419.jpg', '2015-09-27 18:53:48', '2015-09-27 18:53:48', '0');
INSERT INTO `tb_room_images` VALUES ('205', '31', '1443354832.8989.jpg', '2015-09-27 18:53:52', '2015-09-27 18:53:52', '0');
INSERT INTO `tb_room_images` VALUES ('206', '31', '1443354838.3102.jpg', '2015-09-27 18:53:58', '2015-09-27 18:53:58', '0');
INSERT INTO `tb_room_images` VALUES ('207', '31', '1443354873.1844.jpg', '2015-09-27 18:54:33', '2015-09-27 18:54:33', '0');
INSERT INTO `tb_room_images` VALUES ('208', '31', '1443354879.8984.jpg', '2015-09-27 18:54:39', '2015-09-27 18:54:39', '0');
INSERT INTO `tb_room_images` VALUES ('209', '32', '1443355128.5976.jpg', '2015-09-27 18:58:48', '2015-09-27 18:58:48', '0');
INSERT INTO `tb_room_images` VALUES ('210', '32', '1443355136.043.jpg', '2015-09-27 18:58:56', '2015-09-27 18:58:56', '0');
INSERT INTO `tb_room_images` VALUES ('211', '32', '1443355141.8644.jpg', '2015-09-27 18:59:01', '2015-09-27 18:59:01', '0');
INSERT INTO `tb_room_images` VALUES ('212', '32', '1443355147.2405.jpg', '2015-09-27 18:59:07', '2015-09-27 18:59:07', '0');
INSERT INTO `tb_room_images` VALUES ('213', '32', '1443355153.4207.jpg', '2015-09-27 18:59:13', '2015-09-27 18:59:13', '0');
INSERT INTO `tb_room_images` VALUES ('214', '32', '1443355161.2535.jpg', '2015-09-27 18:59:21', '2015-09-27 18:59:21', '0');
INSERT INTO `tb_room_images` VALUES ('215', '33', '1443371236.9126.jpg', '2015-09-27 23:27:16', '2015-09-27 23:27:16', '0');
INSERT INTO `tb_room_images` VALUES ('216', '33', '1443371245.4035.jpg', '2015-09-27 23:27:25', '2015-09-27 23:27:25', '0');
INSERT INTO `tb_room_images` VALUES ('217', '33', '1443371252.0437.jpg', '2015-09-27 23:27:32', '2015-09-27 23:27:32', '0');
INSERT INTO `tb_room_images` VALUES ('218', '33', '1443371264.7765.jpg', '2015-09-27 23:27:44', '2015-09-27 23:27:44', '0');
INSERT INTO `tb_room_images` VALUES ('219', '33', '1443371270.4044.jpg', '2015-09-27 23:27:50', '2015-09-27 23:27:50', '0');
INSERT INTO `tb_room_images` VALUES ('220', '33', '1443371274.4919.jpg', '2015-09-27 23:27:54', '2015-09-27 23:27:54', '0');
INSERT INTO `tb_room_images` VALUES ('221', '33', '1443371289.1564.jpg', '2015-09-27 23:28:09', '2015-09-27 23:28:09', '0');
INSERT INTO `tb_room_images` VALUES ('222', '33', '1443371297.2861.jpg', '2015-09-27 23:28:17', '2015-09-27 23:28:17', '0');
INSERT INTO `tb_room_images` VALUES ('223', '33', '1443371306.288.jpg', '2015-09-27 23:28:26', '2015-09-27 23:28:26', '0');
INSERT INTO `tb_room_images` VALUES ('224', '33', '1443371310.5712.jpg', '2015-09-27 23:28:30', '2015-09-27 23:28:30', '0');
INSERT INTO `tb_room_images` VALUES ('225', '34', '1443372797.9466.jpg', '2015-09-27 23:53:17', '2015-09-27 23:53:17', '0');
INSERT INTO `tb_room_images` VALUES ('226', '34', '1443372807.0768.jpg', '2015-09-27 23:53:27', '2015-09-27 23:53:27', '0');
INSERT INTO `tb_room_images` VALUES ('227', '34', '1443372812.2265.jpg', '2015-09-27 23:53:32', '2015-09-27 23:53:32', '0');
INSERT INTO `tb_room_images` VALUES ('228', '34', '1443372818.0317.jpg', '2015-09-27 23:53:38', '2015-09-27 23:53:38', '0');
INSERT INTO `tb_room_images` VALUES ('229', '34', '1443372824.4779.jpg', '2015-09-27 23:53:44', '2015-09-27 23:53:44', '0');
INSERT INTO `tb_room_images` VALUES ('230', '34', '1443372831.4685.jpg', '2015-09-27 23:53:51', '2015-09-27 23:53:51', '0');
INSERT INTO `tb_room_images` VALUES ('231', '34', '1443372834.7377.jpg', '2015-09-27 23:53:54', '2015-09-27 23:53:54', '0');
INSERT INTO `tb_room_images` VALUES ('232', '34', '1443372843.6951.jpg', '2015-09-27 23:54:03', '2015-09-27 23:54:03', '0');
INSERT INTO `tb_room_images` VALUES ('233', '34', '1443372853.5434.jpg', '2015-09-27 23:54:13', '2015-09-27 23:54:13', '0');
INSERT INTO `tb_room_images` VALUES ('234', '34', '1443372865.6957.jpg', '2015-09-27 23:54:25', '2015-09-27 23:54:25', '0');
INSERT INTO `tb_room_images` VALUES ('235', '35', '1443373666.1069.jpg', '2015-09-28 00:07:46', '2015-09-28 00:07:46', '0');
INSERT INTO `tb_room_images` VALUES ('236', '35', '1443373671.5308.jpg', '2015-09-28 00:07:51', '2015-09-28 00:07:51', '0');
INSERT INTO `tb_room_images` VALUES ('237', '35', '1443373674.7754.jpg', '2015-09-28 00:07:54', '2015-09-28 00:07:54', '0');
INSERT INTO `tb_room_images` VALUES ('238', '35', '1443373681.7672.jpg', '2015-09-28 00:08:01', '2015-09-28 00:08:01', '0');
INSERT INTO `tb_room_images` VALUES ('239', '35', '1443373685.9735.jpg', '2015-09-28 00:08:05', '2015-09-28 00:08:05', '0');
INSERT INTO `tb_room_images` VALUES ('240', '35', '1443373694.5001.jpg', '2015-09-28 00:08:14', '2015-09-28 00:08:14', '0');
INSERT INTO `tb_room_images` VALUES ('241', '35', '1443373700.7617.jpg', '2015-09-28 00:08:20', '2015-09-28 00:08:20', '0');
INSERT INTO `tb_room_images` VALUES ('242', '35', '1443373706.313.jpg', '2015-09-28 00:08:26', '2015-09-28 00:08:26', '0');
INSERT INTO `tb_room_images` VALUES ('243', '35', '1443373720.6485.jpg', '2015-09-28 00:08:40', '2015-09-28 00:08:40', '0');
INSERT INTO `tb_room_images` VALUES ('244', '35', '1443373725.2878.jpg', '2015-09-28 00:08:45', '2015-09-28 00:08:45', '0');
INSERT INTO `tb_room_images` VALUES ('245', '35', '1443373729.7847.jpg', '2015-09-28 00:08:49', '2015-09-28 00:08:49', '0');
INSERT INTO `tb_room_images` VALUES ('246', '35', '1443373798.4969.jpg', '2015-09-28 00:09:58', '2015-09-28 00:09:58', '0');
INSERT INTO `tb_room_images` VALUES ('247', '36', '1443374788.8118.jpg', '2015-09-28 00:26:28', '2015-09-28 00:26:28', '0');
INSERT INTO `tb_room_images` VALUES ('248', '36', '1443374795.7916.jpg', '2015-09-28 00:26:35', '2015-09-28 00:26:35', '0');
INSERT INTO `tb_room_images` VALUES ('249', '36', '1443374802.8673.jpg', '2015-09-28 00:26:42', '2015-09-28 00:26:42', '0');
INSERT INTO `tb_room_images` VALUES ('250', '36', '1443374812.1772.jpg', '2015-09-28 00:26:52', '2015-09-28 00:26:52', '0');
INSERT INTO `tb_room_images` VALUES ('251', '36', '1443374816.9327.jpg', '2015-09-28 00:26:56', '2015-09-28 00:26:56', '0');
INSERT INTO `tb_room_images` VALUES ('252', '36', '1443374822.9074.jpg', '2015-09-28 00:27:02', '2015-09-28 00:27:02', '0');
INSERT INTO `tb_room_images` VALUES ('253', '37', '1443375116.6991.jpg', '2015-09-28 00:31:56', '2015-09-28 00:31:56', '0');
INSERT INTO `tb_room_images` VALUES ('254', '37', '1443375126.6719.jpg', '2015-09-28 00:32:06', '2015-09-28 00:32:06', '0');
INSERT INTO `tb_room_images` VALUES ('255', '37', '1443375132.4813.jpg', '2015-09-28 00:32:12', '2015-09-28 00:32:12', '0');
INSERT INTO `tb_room_images` VALUES ('256', '37', '1443375142.1568.jpg', '2015-09-28 00:32:22', '2015-09-28 00:32:22', '0');
INSERT INTO `tb_room_images` VALUES ('257', '37', '1443375148.3049.jpg', '2015-09-28 00:32:28', '2015-09-28 00:32:28', '0');
INSERT INTO `tb_room_images` VALUES ('258', '37', '1443375155.4721.jpg', '2015-09-28 00:32:35', '2015-09-28 00:32:35', '0');
INSERT INTO `tb_room_images` VALUES ('259', '38', '1443375421.627.jpg', '2015-09-28 00:37:01', '2015-09-28 00:37:01', '0');
INSERT INTO `tb_room_images` VALUES ('260', '38', '1443375428.2521.jpg', '2015-09-28 00:37:08', '2015-09-28 00:37:08', '0');
INSERT INTO `tb_room_images` VALUES ('261', '38', '1443375437.4258.jpg', '2015-09-28 00:37:17', '2015-09-28 00:37:17', '0');
INSERT INTO `tb_room_images` VALUES ('262', '38', '1443375442.7124.jpg', '2015-09-28 00:37:22', '2015-09-28 00:37:22', '0');
INSERT INTO `tb_room_images` VALUES ('263', '38', '1443375448.2655.jpg', '2015-09-28 00:37:28', '2015-09-28 00:37:28', '0');
INSERT INTO `tb_room_images` VALUES ('264', '38', '1443375455.389.jpg', '2015-09-28 00:37:35', '2015-09-28 00:37:35', '0');
INSERT INTO `tb_room_images` VALUES ('265', '39', '1443375736.8481.jpg', '2015-09-28 00:42:16', '2015-09-28 00:42:16', '0');
INSERT INTO `tb_room_images` VALUES ('266', '39', '1443375748.1317.jpg', '2015-09-28 00:42:28', '2015-09-28 00:42:28', '0');
INSERT INTO `tb_room_images` VALUES ('267', '39', '1443375751.9797.jpg', '2015-09-28 00:42:31', '2015-09-28 00:42:31', '0');
INSERT INTO `tb_room_images` VALUES ('268', '39', '1443375768.6776.jpg', '2015-09-28 00:42:48', '2015-09-28 00:42:48', '0');
INSERT INTO `tb_room_images` VALUES ('269', '39', '1443375775.5056.jpg', '2015-09-28 00:42:55', '2015-09-28 00:42:55', '0');
INSERT INTO `tb_room_images` VALUES ('270', '39', '1443375779.4689.jpg', '2015-09-28 00:42:59', '2015-09-28 00:42:59', '0');
INSERT INTO `tb_room_images` VALUES ('271', '40', '1443446662.6642.jpg', '2015-09-28 20:24:22', '2015-09-28 20:24:22', '0');
INSERT INTO `tb_room_images` VALUES ('272', '40', '1443446664.7829.jpg', '2015-09-28 20:24:24', '2015-09-28 20:24:24', '0');
INSERT INTO `tb_room_images` VALUES ('273', '40', '1443446667.7056.jpg', '2015-09-28 20:24:27', '2015-09-28 20:24:27', '0');
INSERT INTO `tb_room_images` VALUES ('274', '40', '1443446670.0252.jpg', '2015-09-28 20:24:30', '2015-09-28 20:24:30', '0');
INSERT INTO `tb_room_images` VALUES ('275', '40', '1443446672.2616.jpg', '2015-09-28 20:24:32', '2015-09-28 20:24:32', '0');
INSERT INTO `tb_room_images` VALUES ('276', '40', '1443446674.6752.jpg', '2015-09-28 20:24:34', '2015-09-28 20:24:34', '0');
INSERT INTO `tb_room_images` VALUES ('277', '42', '1443457677.8021.jpg', '2015-09-28 23:27:57', '2015-09-28 23:27:57', '0');
INSERT INTO `tb_room_images` VALUES ('278', '42', '1443457682.7375.jpg', '2015-09-28 23:28:02', '2015-09-28 23:28:02', '0');
INSERT INTO `tb_room_images` VALUES ('279', '42', '1443457687.1717.jpg', '2015-09-28 23:28:07', '2015-09-28 23:28:07', '0');
INSERT INTO `tb_room_images` VALUES ('280', '42', '1443457694.3266.jpg', '2015-09-28 23:28:14', '2015-09-28 23:28:14', '0');
INSERT INTO `tb_room_images` VALUES ('281', '42', '1443457700.2013.jpg', '2015-09-28 23:28:20', '2015-09-28 23:28:20', '0');
INSERT INTO `tb_room_images` VALUES ('282', '42', '1443457707.295.jpg', '2015-09-28 23:28:27', '2015-09-28 23:28:27', '0');
INSERT INTO `tb_room_images` VALUES ('283', '43', '1443458319.9227.jpg', '2015-09-28 23:38:39', '2015-09-28 23:38:39', '0');
INSERT INTO `tb_room_images` VALUES ('284', '43', '1443458344.1046.jpg', '2015-09-28 23:39:04', '2015-09-28 23:39:04', '0');
INSERT INTO `tb_room_images` VALUES ('285', '43', '1443458356.7245.jpg', '2015-09-28 23:39:16', '2015-09-28 23:39:16', '0');
INSERT INTO `tb_room_images` VALUES ('286', '43', '1443458367.4262.jpg', '2015-09-28 23:39:27', '2015-09-28 23:39:27', '0');
INSERT INTO `tb_room_images` VALUES ('287', '43', '1443458380.7471.jpg', '2015-09-28 23:39:40', '2015-09-28 23:39:40', '0');
INSERT INTO `tb_room_images` VALUES ('288', '43', '1443458388.932.jpg', '2015-09-28 23:39:48', '2015-09-28 23:39:48', '0');

-- ----------------------------
-- Table structure for `tb_room_price`
-- ----------------------------
DROP TABLE IF EXISTS `tb_room_price`;
CREATE TABLE `tb_room_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_address_id` int(11) NOT NULL,
  `price` float NOT NULL COMMENT 'Theo đêm',
  `weekly` float NOT NULL COMMENT 'Theo tuần',
  `monthly` float NOT NULL COMMENT 'Theo tháng',
  `additional_guests` float NOT NULL COMMENT 'Phí cho mỗi khách thêm',
  `guest_per_night` int(11) NOT NULL,
  `cleaning_fees` float NOT NULL COMMENT 'Phí dọn dẹp',
  `cleaning_fees_day` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: phi vs theo 1 lan o; 2: phi vs tinh theo ngay',
  `cancellation` tinyint(4) DEFAULT '1' COMMENT 'Chính sách huỷ bỏ',
  `house_rules` text COMMENT 'Quy định',
  `min_nights` int(11) NOT NULL COMMENT 'Số đêm tối thiểu',
  `max_nights` int(11) NOT NULL COMMENT 'Số đêm tối đa',
  `check_in` varchar(255) NOT NULL COMMENT 'Nhận phòng sau',
  `check_out` varchar(255) NOT NULL COMMENT 'Trả phòng trước',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`room_address_id`),
  KEY `room_address_id` (`room_address_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_price
-- ----------------------------
INSERT INTO `tb_room_price` VALUES ('1', '1', '500000', '400000', '14000000', '0', '1', '50000', '1', '3', 'Về trước 11h tối', '3', '5', '7', '7', '2015-09-11 00:13:09', '2015-09-11 00:13:09');
INSERT INTO `tb_room_price` VALUES ('2', '2', '80000', '0', '0', '0', '1', '0', '1', '1', '', '1', '4', '6', '7', '2015-09-11 22:17:29', '2015-09-11 22:17:29');
INSERT INTO `tb_room_price` VALUES ('3', '3', '80000', '0', '0', '0', '1', '0', '1', '1', '', '1', '4', '6', '8', '2015-09-11 22:21:03', '2015-09-11 22:21:03');
INSERT INTO `tb_room_price` VALUES ('4', '4', '150000', '150000', '1200000', '0', '3', '0', '1', '1', '', '1', '180', '0', '0', '2015-09-13 13:03:53', '2015-09-13 13:03:53');
INSERT INTO `tb_room_price` VALUES ('5', '5', '40000', '40000', '40000', '0', '1', '0', '2', '1', 'Làm bất kỳ điều gì bạn thích', '1', '20', '0', '0', '2015-09-13 22:21:52', '2015-09-13 22:21:52');
INSERT INTO `tb_room_price` VALUES ('6', '6', '150000', '150000', '120000', '0', '1', '0', '1', '1', '', '1', '180', '0', '0', '2015-09-14 20:26:07', '2015-09-14 20:26:07');
INSERT INTO `tb_room_price` VALUES ('7', '7', '150000', '100000', '80000', '0', '1', '30000', '1', '2', 'Giá không bao gồm ăn sáng, các chương trình tham quan, đạp xe trong rừng...etc', '1', '30', '10', '12', '2015-09-15 00:06:39', '2015-09-15 00:06:39');
INSERT INTO `tb_room_price` VALUES ('8', '8', '100000', '0', '0', '0', '1', '0', '1', '1', '', '3', '6', '10', '8', '2015-09-15 10:02:06', '2015-09-15 10:02:06');
INSERT INTO `tb_room_price` VALUES ('9', '9', '300000', '200000', '180', '50', '2', '0', '2', '1', 'Không tổ chức cờ bạc trong phòng & sử dụng chất kích thích bị pháp luật nghiêm cấm .', '1', '30', '12', '12', '2015-09-15 19:22:16', '2015-09-15 19:32:46');
INSERT INTO `tb_room_price` VALUES ('10', '10', '120000', '0', '0', '50', '1', '0', '1', '1', '', '1', '1', '10', '12', '2015-09-16 17:03:46', '2015-09-17 09:41:38');
INSERT INTO `tb_room_price` VALUES ('11', '11', '80000', '0', '0', '0', '1', '0', '1', '1', '', '1', '1', '12', '12', '2015-09-16 22:05:45', '2015-09-16 22:05:45');
INSERT INTO `tb_room_price` VALUES ('12', '12', '550000', '0', '0', '0', '1', '0', '1', '1', '', '1', '11', '11', '10', '2015-09-17 10:35:21', '2015-09-17 10:35:21');
INSERT INTO `tb_room_price` VALUES ('13', '13', '40000', '40000', '40000', '0', '1', '0', '1', '1', '', '1', '20', '0', '0', '2015-09-18 08:11:11', '2015-09-18 08:28:27');
INSERT INTO `tb_room_price` VALUES ('14', '14', '700000', '0', '0', '0', '1', '0', '1', '3', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.', '2', '7', '14', '16', '2015-09-18 23:41:35', '2015-09-18 23:41:35');
INSERT INTO `tb_room_price` VALUES ('15', '15', '500000', '0', '0', '0', '1', '0', '1', '1', 'Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.', '4', '8', '4', '8', '2015-09-19 18:39:01', '2015-09-19 18:39:01');
INSERT INTO `tb_room_price` VALUES ('16', '16', '135000', '0', '0', '0', '1', '0', '1', '1', '', '1', '180', '14', '12', '2015-09-20 13:51:16', '2015-09-20 13:51:16');
INSERT INTO `tb_room_price` VALUES ('17', '17', '450000', '0', '0', '0', '1', '0', '1', '1', '', '1', '180', '14', '12', '2015-09-20 13:58:01', '2015-09-20 13:58:01');
INSERT INTO `tb_room_price` VALUES ('18', '18', '400000', '0', '6000000', '0', '1', '0', '1', '1', '', '1', '1', '0', '0', '2015-09-23 15:12:24', '2015-09-23 15:12:24');
INSERT INTO `tb_room_price` VALUES ('19', '19', '1774000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '6', '10', '2015-09-23 22:24:26', '2015-09-23 22:25:07');
INSERT INTO `tb_room_price` VALUES ('20', '20', '1573000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-25 00:18:35', '2015-09-25 00:18:35');
INSERT INTO `tb_room_price` VALUES ('21', '21', '1235000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-25 00:23:46', '2015-09-25 00:23:46');
INSERT INTO `tb_room_price` VALUES ('22', '22', '200000', '1000000', '3500000', '100000', '2', '50000', '1', '1', '', '1', '180', '11', '9', '2015-09-25 19:33:03', '2015-09-25 19:33:03');
INSERT INTO `tb_room_price` VALUES ('23', '23', '31958000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 08:50:40', '2015-09-27 08:50:40');
INSERT INTO `tb_room_price` VALUES ('24', '24', '157000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 09:42:56', '2015-09-27 09:44:49');
INSERT INTO `tb_room_price` VALUES ('25', '25', '404000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 09:54:33', '2015-09-27 09:54:33');
INSERT INTO `tb_room_price` VALUES ('26', '26', '573000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 10:40:32', '2015-09-27 10:40:32');
INSERT INTO `tb_room_price` VALUES ('27', '27', '157000', '0', '0', '157000', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 10:59:20', '2015-09-27 10:59:20');
INSERT INTO `tb_room_price` VALUES ('28', '28', '606000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 11:59:51', '2015-09-27 11:59:51');
INSERT INTO `tb_room_price` VALUES ('29', '29', '494000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 15:39:19', '2015-09-27 15:39:19');
INSERT INTO `tb_room_price` VALUES ('30', '30', '404000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 15:51:20', '2015-09-27 15:51:20');
INSERT INTO `tb_room_price` VALUES ('31', '31', '629000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 18:53:18', '2015-09-27 18:53:18');
INSERT INTO `tb_room_price` VALUES ('32', '32', '943000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 18:58:37', '2015-09-27 18:58:37');
INSERT INTO `tb_room_price` VALUES ('33', '33', '359000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 23:26:45', '2015-09-27 23:26:45');
INSERT INTO `tb_room_price` VALUES ('34', '34', '831000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-27 23:53:01', '2015-09-27 23:53:01');
INSERT INTO `tb_room_price` VALUES ('35', '35', '786000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-28 00:07:35', '2015-09-28 00:07:35');
INSERT INTO `tb_room_price` VALUES ('36', '36', '831000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-28 00:25:14', '2015-09-28 00:25:14');
INSERT INTO `tb_room_price` VALUES ('37', '37', '831000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-28 00:31:45', '2015-09-28 00:31:45');
INSERT INTO `tb_room_price` VALUES ('38', '38', '943000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-28 00:36:50', '2015-09-28 00:36:50');
INSERT INTO `tb_room_price` VALUES ('39', '39', '1101000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-28 00:42:08', '2015-09-28 00:42:08');
INSERT INTO `tb_room_price` VALUES ('40', '41', '9855000', '0', '0', '0', '1', '0', '1', '3', '', '1', '30', '7', '8', '2015-09-28 20:24:12', '2015-09-28 20:24:12');
INSERT INTO `tb_room_price` VALUES ('41', '42', '300000', '0', '0', '0', '1', '0', '1', '3', '', '1', '13', '7', '8', '2015-09-28 22:41:07', '2015-09-28 22:55:55');
INSERT INTO `tb_room_price` VALUES ('42', '43', '1000000', '0', '0', '0', '1', '0', '1', '1', '', '1', '13', '8', '2', '2015-09-28 23:35:17', '2015-09-28 23:35:17');
INSERT INTO `tb_room_price` VALUES ('43', '44', '500000', '0', '0', '0', '1', '0', '1', '3', '', '12', '8', '11', '18', '2015-09-28 23:38:30', '2015-09-28 23:38:30');

-- ----------------------------
-- Table structure for `tb_room_set`
-- ----------------------------
DROP TABLE IF EXISTS `tb_room_set`;
CREATE TABLE `tb_room_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_address_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_set
-- ----------------------------
INSERT INTO `tb_room_set` VALUES ('1', '1', '2015-09-11');
INSERT INTO `tb_room_set` VALUES ('2', '1', '2015-09-12');
INSERT INTO `tb_room_set` VALUES ('3', '1', '2015-09-13');
INSERT INTO `tb_room_set` VALUES ('4', '1', '2015-09-14');
INSERT INTO `tb_room_set` VALUES ('5', '1', '2015-09-15');
INSERT INTO `tb_room_set` VALUES ('6', '1', '2015-10-13');

-- ----------------------------
-- Table structure for `tb_users`
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO `tb_users` VALUES ('1', 'xuanhoa_1201@yahoo.com', 'shareroom.vn', 'Hòa', 'Trà Đá', '1989-01-12', '1', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/s200x200/1470006_806118269435131_1527776481786918463_n.jpg?oh=1df8b5f7d1703307c8e0404c23e88d01&oe=5671285C&__gda__=1453690675_31b37ea44932782faecef836524e6186', null, '892770294103261', '2015-09-10 23:06:25', '2015-09-10 23:06:25', '0', '');
INSERT INTO `tb_users` VALUES ('2', 'xuanhoapro@gmail.com', 'shareroom.vn', 'Xuân Hòa', 'Nguyễn', null, '1', null, null, 'https://lh3.googleusercontent.com/-6SBTZCxzv6M/AAAAAAAAAAI/AAAAAAAAAH8/RGKA045KRLw/photo.jpg', '109417562987108464186', null, '2015-09-10 23:07:36', '2015-09-10 23:07:36', '0', '');
INSERT INTO `tb_users` VALUES ('3', 'macngoctuan276@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Tuấn', 'Mạc', null, '1', '0903365719', 'số 18 tổ 12 phường tô hiệu tp hà nội', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xlf1/v/t1.0-1/p200x200/11960260_654924417976787_2233955819490796467_n.jpg?oh=865728025bbceb7520cdb14aab3c754a&oe=56A8DBF4&__gda__=1448930344_bfc484f4632c78d70ec35350a4a46c81', null, '628143017321594', '2015-09-10 23:16:24', '2015-09-28 23:38:02', '0', '');
INSERT INTO `tb_users` VALUES ('4', 'macngoctuan209@gmail.com', 'shareroom.vn', 'Mac', 'Tuan', '1988-09-20', '1', '0931687866', '', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '106032588798188126011', null, '2015-09-10 23:20:27', '2015-09-11 20:36:27', '0', '');
INSERT INTO `tb_users` VALUES ('5', 'xuanducsla@gmail.com', 'shareroom.vn', 'Xuan', 'Duc', null, '1', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/s200x200/10615442_620082111441628_5369151835209575039_n.jpg?oh=8f37b98475e321190fdfaaddaaee0899&oe=56A05085&__gda__=1450088716_1df98bcb8ccb6966e81e9431c71485fb', null, '830867383696432', '2015-09-13 08:38:24', '2015-09-13 08:38:24', '0', '');
INSERT INTO `tb_users` VALUES ('6', 'Baongoctk5ol@gmail.com', 'shareroom.vn', 'Phạm', 'Dũng', null, '1', '0989636794', 'Chiềng sơn mộc châu sơn la', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xat1/v/t1.0-1/p200x200/11329850_768597266593297_1990093683204835043_n.jpg?oh=b1e03fa71ef5c6defd0d6a6ddb380352&oe=56AA0253&__gda__=1449494132_0f495ee9f99b68772069e88c60755b85', null, '820467528072937', '2015-09-13 12:47:47', '2015-09-14 14:44:36', '0', '');
INSERT INTO `tb_users` VALUES ('7', 'lethitang95@gmail.com', 'shareroom.vn', 'Nunu', 'Bé', null, '2', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/s200x200/11350778_1643382485945778_2453030790311417529_n.jpg?oh=25e57ca6ffcb8b643a3f6b0dc119204c&oe=566B1BBE&__gda__=1449338044_fa3526f8ab7a622a1f343d77b3aea655', null, '1646100245674002', '2015-09-13 20:00:01', '2015-09-13 20:00:01', '0', '');
INSERT INTO `tb_users` VALUES ('8', 'thao241294@gmail.com', 'shareroom.vn', 'Nguyen', 'thao', '1994-12-24', '2', '01628557345', 'Làng chè 69, thị trấn nông trường Mộc Châu, Mộc Châu, Sơn La', 'https://lh3.googleusercontent.com/-pVRFNySQ_Yw/AAAAAAAAAAI/AAAAAAAAAD8/35dZ0fagKCE/photo.jpg', '117696068624477655205', null, '2015-09-13 21:17:59', '2015-09-18 08:09:58', '0', 'Nằm giữa thung lũng chè Mộc Châu xinh đẹp, homestay Mộc Châu là địa điểm nghỉ ngơi rộng rãi, tiện nghi với vệ sinh năng lượng mặt trời cùng không gian thoáng đãng, ngút ngàn của những đồi chè xanh ngát.\r\n');
INSERT INTO `tb_users` VALUES ('9', 'ntmanh90ksth@gmail.com', 'shareroom.vn', 'Nguyễn', 'Mạnh', null, '1', '0938811807', null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xtp1/v/t1.0-1/p200x200/11866374_908993289171898_5468133948866139396_n.jpg?oh=96463ae4705249e93627bc1333d9dc6e&oe=56A0A5C8&__gda__=1453115652_506268fdb2245a03e485ca4f7f5f0a6b', null, '922976621106898', '2015-09-14 09:04:18', '2015-09-25 19:31:29', '0', '');
INSERT INTO `tb_users` VALUES ('10', 'goodguy_apa@yahoo.com.vn', 'shareroom.vn', 'Thành', 'Đô', null, '1', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/p200x200/11846522_773797796062881_3167697277728744046_n.jpg?oh=2ac2c67d48df5b4028585d82bacdab55&oe=566FB1AA&__gda__=1450160833_c97c71a13d7bbca55b5a409139e250dc', null, '789484591160868', '2015-09-14 09:26:06', '2015-09-14 09:26:06', '0', '');
INSERT INTO `tb_users` VALUES ('11', 'Ditimem_trongmuonvancainick@yahoo.com', 'shareroom.vn', 'Phạm', 'Dũng', null, '1', '0989636794', null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xat1/v/t1.0-1/p200x200/11329850_768597266593297_1990093683204835043_n.jpg?oh=b1e03fa71ef5c6defd0d6a6ddb380352&oe=56AA0253&__gda__=1449494132_0f495ee9f99b68772069e88c60755b85', null, '820467528072937', '2015-09-14 20:06:51', '2015-09-14 20:25:16', '0', '');
INSERT INTO `tb_users` VALUES ('12', 'vietkingfisher@hotmail.com', 'b4769fc3dfcf616ed64a1e7e5658e3ef', 'Hieu ', 'Kingfisher', '1984-09-19', '1', '0948409265', 'Ấp 2, xã Hiếu Liêm, huyện Vĩnh Cửu, tỉnh Đồng Nai', null, null, null, '2015-09-14 22:53:17', '2015-09-15 00:00:01', '0', 'Chào các bạn trẻ và Du khách tương lại, \r\nTôi tên Hiếu, hãy gọi tôi là Hiếu Kingfisher (Chim Bói Cá, đó là doanh nghiệp do tôi start up tại Vĩnh Cửu, Đồng Nai). Là một người yêu rừng như yêu chính bản thân mình, cũng như bao người trẻ tôi trăn trở về cuộc sống và lựa chọn của mình. Cuộc sống và kinh nghiệm không lựa chọn sự an toàn mà luôn muốn chinh phục thách thức chính bản thân mình, xem giới hạn của mình ở đâu. Từ bỏ công việc nhà nước, tôi bước vào con đường khởi nghiệp với mô hình Du lịch bền vững, trách nhiệm cộng đồng, và tôi đã khởi nghiệp như vậy. Tôi đã xây dựng nên ước mơ của mình với nhiều lời cho tôi kẻ điên khùng với căn nhà sàn giữa một vùng quê miền Đông. \r\nBạn muốn nghe nhiều và trải nghiệm về câu chuyện của tôi, hãy ghé nhà sàn Kingfisher Nest Dong Nai.\r\nTham khảo về tôi tại http://goo.gl/eowm8C\r\nHoặc: http://goo.gl/SXlC0j\r\n\r\nRất hân hạnh được đón tiếp các bạn tại căn nhà của tôi\r\n');
INSERT INTO `tb_users` VALUES ('13', 'dangtung93@icloud.com', 'shareroom.vn', 'Đặng Viết', 'Tùng', null, '1', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpt1/v/t1.0-1/p200x200/11217656_1039138422764644_6386307268506050434_n.jpg?oh=18bb69385e5fd1e9c77aee15ab389172&oe=565D384B&__gda__=1449778304_0ddc4d884213673fda73c151c5c8046e', null, '1026173890727764', '2015-09-15 10:20:31', '2015-09-15 10:20:31', '0', '');
INSERT INTO `tb_users` VALUES ('14', 'luongcatba@yahoo.com', 'shareroom.vn', 'Luong', 'Le', null, '1', '0947165588', null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xta1/v/t1.0-1/p200x200/10712976_10202779413701665_3936852996419156984_n.jpg?oh=a8c6269c5b9eaa57e83a7fe87d0b8acd&oe=56A1FCA8&__gda__=1449329111_0f65eca4446678d1150cb1f2411bf187', null, '10204643863871754', '2015-09-15 19:03:50', '2015-09-15 19:15:58', '0', '');
INSERT INTO `tb_users` VALUES ('15', 'anfrohel@yahoo.com', '1ae629ad230936ae33943b93d07222cc', 'Long', 'Hoang', null, '0', null, null, null, null, null, '2015-09-16 08:34:49', '2015-09-16 08:34:49', '0', '');
INSERT INTO `tb_users` VALUES ('16', 'duykhanhn075@gmail.com', '2850e57639c0f9a8bb7d135eb67dc266', ' nguyễn duy ', 'khánh ', null, '1', '0984879330 , 0926706487', 'phan thiết _bình thuận ', null, null, null, '2015-09-16 16:38:01', '2015-09-16 18:37:16', '0', 'dịch vu du lịch giá rẻ phan thiết ,homestay ,hdv thộ địa ,cac dịch vụ giá rẻ .dịch vụ du lịch ngủ lều ,vv');
INSERT INTO `tb_users` VALUES ('17', 'doan.army@gmail.com', '4caf1747613d524963a041fd1cb49163', 'Phương Đoàn', 'Phạm Công', null, '0', '0935150674', null, null, null, null, '2015-09-16 21:56:03', '2015-09-16 22:04:38', '0', '');
INSERT INTO `tb_users` VALUES ('18', 'vipnd2003@gmail.com', 'shareroom.vn', 'Nguyễn', 'Tiến', null, '1', '092222222', null, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '100858759562285370492', null, '2015-09-17 10:33:23', '2015-09-17 10:35:00', '0', '');
INSERT INTO `tb_users` VALUES ('19', 'xgemquy@gmail.com', 'e899bb34408bcc2ccaa6291b6e226d7f', 'quy', 'luu', null, '0', null, null, null, null, null, '2015-09-19 11:07:54', '2015-09-19 11:07:54', '0', '');
INSERT INTO `tb_users` VALUES ('20', 'ngocthachhostel1606@gmail.com', 'shareroom.vn', 'Ngọc Thạch', 'Hostel', null, '1', '0906305839', null, 'https://lh4.googleusercontent.com/-3Z2So-gwemg/AAAAAAAAAAI/AAAAAAAAABU/sYE1GF5Y0-M/photo.jpg', '110429893706925369921', null, '2015-09-20 13:45:37', '2015-09-20 13:57:27', '0', '');
INSERT INTO `tb_users` VALUES ('21', 'pearlapartment@yahoo.com', 'e890f806dfd189052ca7b39ac29da142', 'Quang', 'Tran Van', null, '0', null, null, null, null, null, '2015-09-21 20:37:25', '2015-09-21 20:37:25', '0', '');
INSERT INTO `tb_users` VALUES ('22', 'phanvanliem@gmail.com', 'shareroom.vn', 'Phan', 'Liêm', null, '1', null, null, 'https://lh5.googleusercontent.com/-VWlUtojOlhU/AAAAAAAAAAI/AAAAAAAASbY/W79TsMkRNkI/photo.jpg', '105599263666279473068', null, '2015-09-22 09:19:32', '2015-09-22 09:19:32', '0', '');
INSERT INTO `tb_users` VALUES ('23', 'ngocgoldsun@gmail.com', '069d647685f47ae012faef7491207ded', 'Nguyen', 'Ngoc', null, '0', '0918388674', null, null, null, null, '2015-09-23 15:07:12', '2015-09-23 15:11:34', '0', '');
INSERT INTO `tb_users` VALUES ('24', 'nguyenlananh@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Lan Anh', 'Nguyen', null, '0', '0902822222', null, null, null, null, '2015-09-24 23:58:27', '2015-09-25 00:23:05', '0', '');
INSERT INTO `tb_users` VALUES ('25', 'nguyenanhtuan@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'tuan', 'nguyen anh', null, '0', '00439351268', null, null, null, null, '2015-09-27 08:43:33', '2015-09-27 08:49:56', '0', '');
INSERT INTO `tb_users` VALUES ('26', 'tamcocecolodge@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Tam Coc', 'Ecolodge', null, '0', '0303595595', null, null, null, null, '2015-09-27 09:22:09', '2015-09-27 10:39:58', '0', '');
INSERT INTO `tb_users` VALUES ('27', 'tamcochomestay@gmail.com', '6ebe76c9fb411be97b3b0d48b791a7c9', 'Homestay', 'Tam Coc', null, '0', '0974966198', null, null, null, null, '2015-09-27 10:49:20', '2015-09-27 15:50:51', '0', '');
INSERT INTO `tb_users` VALUES ('28', 'langvietco@gmail.com', 'be2121aa20143faf67c8c7d66209cbf6', 'Lang Viet', 'Co', null, '0', '0303591718', null, null, null, null, '2015-09-27 18:47:52', '2015-09-27 18:58:07', '0', '');
INSERT INTO `tb_users` VALUES ('29', 'vanlonghomestay@gmail.com', '6d45e4570cc8fd21d1b0c5055572e865', 'Homestay', 'Van Long', null, '0', '0976612772', null, null, null, null, '2015-09-27 23:08:05', '2015-09-27 23:23:41', '0', '');
INSERT INTO `tb_users` VALUES ('30', 'muacaveecolodge@gmail.com', 'bea649830cd8b3503534a6086fb2b653', 'Eco Lodge', 'Mua Cave ', null, '0', '0904301028', null, null, null, null, '2015-09-27 23:47:03', '2015-09-27 23:51:35', '0', '');
INSERT INTO `tb_users` VALUES ('31', 'tranganfarmstay@gmail.com', '2e6a1d5ab02b258250470762c6ed6f3a', 'FarmStay', 'Trang An', null, '0', '0946888804', null, null, null, null, '2015-09-28 00:02:56', '2015-09-28 00:06:58', '0', '');
INSERT INTO `tb_users` VALUES ('32', 'tamcoc@gmail.com', '1820a7f6c57c2652e4faad0610d4ed3b', 'Eco Lodge', 'Tam Coc', null, '0', '0303618789', null, null, null, null, '2015-09-28 00:17:14', '2015-09-28 00:41:39', '0', '');
INSERT INTO `tb_users` VALUES ('33', 'signaturehalongcruise@gmail.com', 'd8ef9c18f7c318988dd48e880ed7b047', 'Ha Long Cruise', 'Signature', null, '0', '0439351268', null, null, null, null, '2015-09-28 20:09:09', '2015-09-28 20:23:11', '0', '');

-- ----------------------------
-- Table structure for `tb_users_bank`
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users_bank
-- ----------------------------
INSERT INTO `tb_users_bank` VALUES ('1', '3', '41110000287792', 'Ngân hàng đầu tư và phát triển Việt Nam (BIDV)', 'Chi nhánh thành phố Sơn La ', 'Mạc Ngọc Tuấn', '2015-09-10 23:33:27', '2015-09-10 23:33:27', '0');
INSERT INTO `tb_users_bank` VALUES ('2', '6', '7902205035933', 'Ngân hàng nông nghiệp', 'Mộc châu', 'Phạm tiến dũng', '2015-09-13 13:07:34', '2015-09-13 13:07:34', '0');
INSERT INTO `tb_users_bank` VALUES ('3', '11', '7902205035933', 'Ngân hàng nông nghiệp và pháy triển nông thôn', 'Mộc châu', 'Phạm tiến dũng', '2015-09-14 20:30:42', '2015-09-14 20:30:42', '0');
INSERT INTO `tb_users_bank` VALUES ('4', '12', '7001001007623', 'Ngân hàng Vietcombank ', 'Ham Nghi', 'Nguyễn Đình Hiếu', '2015-09-14 23:50:26', '2015-09-14 23:50:26', '0');
INSERT INTO `tb_users_bank` VALUES ('5', '16', '711a84453706', 'viettinbank ', 'hàm thuận nam _bình thuận ', 'nguyễn duy khánh ', '2015-09-16 17:08:54', '2015-09-16 17:09:03', '0');
INSERT INTO `tb_users_bank` VALUES ('6', '8', '41210000065126', 'BIDV', 'BIDV chi nhánh thị trấn nông trường Mộc Châu', 'Nguyễn Thị Thanh Thaỏ', '2015-09-18 08:01:41', '2015-09-18 08:29:22', '0');
INSERT INTO `tb_users_bank` VALUES ('7', '20', '101010006645837', 'Ngân hàng thương mại công thương ', 'Chi nhánh 3 - Quận 1', 'Cái Thị Diễm Thoa', '2015-09-20 13:53:32', '2015-09-20 13:53:32', '0');

-- ----------------------------
-- Table structure for `tb_wishlist`
-- ----------------------------
DROP TABLE IF EXISTS `tb_wishlist`;
CREATE TABLE `tb_wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `room_address_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` int(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_wishlist
-- ----------------------------
