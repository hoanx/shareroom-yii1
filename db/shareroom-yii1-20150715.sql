/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : shareroom-yii1

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-07-15 21:29:07
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('1', 'admin', 'cb7dae101850facf7f612731de40b82f', 'admin@admin.vn', '2015-05-13 14:35:51', '2015-05-13 14:35:54', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking
-- ----------------------------
INSERT INTO `tb_booking` VALUES ('1', '2', '1', '25-06-2015', '08-07-2015', '12', '12', '3', '700000', '0', null, null, '0', '0', '9100000', 'company', '1', '1', null, null, '2015-06-25 17:01:14', '2015-06-30 13:49:44', '0');
INSERT INTO `tb_booking` VALUES ('2', '1', '1', '10-07-2015', '19-07-2015', '12', '12', '1', '700000', '0', null, null, '0', '0', '6300000', 'banktranfer', '1', '1', null, null, '2015-06-25 20:28:47', '2015-06-30 13:53:05', '0');
INSERT INTO `tb_booking` VALUES ('3', '1', '2', '08-07-2015', '10-07-2015', '0', '0', '1', '180000', '0', null, null, '0', '0', '360000', 'company', '1', '1', null, null, '2015-06-26 18:00:12', '2015-06-26 18:00:12', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_history
-- ----------------------------
INSERT INTO `tb_booking_history` VALUES ('1', '1', 'Cho thuê nhà riêng Nguyễn Trãi', '16 Láng Hạ, Thành Công, Ba Đình, Hà Nội, Vietnam', '16 Láng Hạ', 'Ba Đình', 'Hà Nội', '21.0186', '105.816', '2015-06-25 17:01:14', '2015-06-25 17:01:14', '0');
INSERT INTO `tb_booking_history` VALUES ('2', '2', 'Cho thuê nhà riêng Nguyễn Trãi', '16 Láng Hạ, Thành Công, Ba Đình, Hà Nội, Vietnam', '16 Láng Hạ', 'Ba Đình', 'Hà Nội', '21.0186', '105.816', '2015-06-25 20:28:47', '2015-06-25 20:28:47', '0');
INSERT INTO `tb_booking_history` VALUES ('3', '3', 'Cho thuê nhà riêng Nguyễn Trãi', '272 Nguyễn Trãi, Thanh Xuân Trung, Thanh Xuân, Hà Nội, Vietnam', '272 Nguyễn Trãi', 'Thanh Xuân', 'Hà Nội', '20.9974', '105.811', '2015-06-26 18:00:12', '2015-06-26 18:00:12', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booking_user
-- ----------------------------
INSERT INTO `tb_booking_user` VALUES ('1', '1', '2', 'Xuân Hòa', 'Nguyễn', '', 'xuanhoapro@gmail.com', '0985050225', '2015-06-25 17:01:14', '2015-06-25 17:01:14');
INSERT INTO `tb_booking_user` VALUES ('2', '2', '1', 'Hòa', 'Trà Đá', '', 'xuanhoa_1201@yahoo.com', '0985050225', '2015-06-25 20:28:47', '2015-06-25 20:28:47');
INSERT INTO `tb_booking_user` VALUES ('3', '3', '1', 'Hòa', 'Trà Đá', '', 'xuanhoa_1201@yahoo.com', '', '2015-06-26 18:00:12', '2015-06-26 18:00:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_conversation
-- ----------------------------
INSERT INTO `tb_conversation` VALUES ('1', '3', '2', '1', '3', '5', '1', '2015-06-26 17:57:59', '2015-06-30 18:26:13', '0');
INSERT INTO `tb_conversation` VALUES ('2', '3', '2', '2', '2', '3', '0', '2015-06-30 14:08:54', '2015-06-30 16:12:09', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_messages
-- ----------------------------
INSERT INTO `tb_messages` VALUES ('1', '1', '1', '2', '1', 'Chúc mừng! Bạn có một yêu cầu đặt phòng! Vui lòng xem xét kỹ yêu cầu đặt phòng của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt phòng.', '1', '1', '2015-06-26 17:57:59', '2015-06-26 17:57:59', null);
INSERT INTO `tb_messages` VALUES ('2', '2', '1', '1', '2', 'Chúc mừng! Bạn có một yêu cầu đặt phòng! Vui lòng xem xét kỹ yêu cầu đặt phòng của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt phòng.', '1', '1', '2015-06-30 14:08:54', '2015-06-30 14:08:54', null);
INSERT INTO `tb_messages` VALUES ('3', '2', '1', '2', '1', 'Chúc mừng! Bạn đã đặt phòng thành công.', '2', '1', '2015-06-30 16:12:09', '2015-06-30 16:12:09', null);
INSERT INTO `tb_messages` VALUES ('4', '1', '1', '1', '2', 'Bạn đã từ chối yêu cầu đặt phòng.Chúng tôi khuyến khích bạn chấp nhận yêu cầu đặt phòng nếu bài đăng của bạn còn trống và bạn cảm thấy thoải mái với khách. Trải nghiệm tốt và bài nhận xét tích cực sẽ giúp bạn tăng thứ hạng trên Shareroom.', '3', '1', '2015-06-30 16:13:04', '2015-06-30 16:13:04', null);
INSERT INTO `tb_messages` VALUES ('5', '1', '1', '1', '2', 'Bạn đã từ chối yêu cầu đặt phòng.Chúng tôi khuyến khích bạn chấp nhận yêu cầu đặt phòng nếu bài đăng của bạn còn trống và bạn cảm thấy thoải mái với khách. Trải nghiệm tốt và bài nhận xét tích cực sẽ giúp bạn tăng thứ hạng trên Shareroom.', '3', '1', '2015-06-30 16:13:14', '2015-06-30 16:13:14', null);
INSERT INTO `tb_messages` VALUES ('8', '1', '0', '1', '2', 'Xin lỗi ko thể cho thuê vì giá rẻ quá', '0', '1', '2015-06-30 17:34:13', '2015-06-30 17:34:13', null);
INSERT INTO `tb_messages` VALUES ('9', '1', '0', '1', '2', 'Sorry about that', '0', '1', '2015-06-30 17:34:59', '2015-06-30 17:34:59', null);
INSERT INTO `tb_messages` VALUES ('10', '1', '0', '1', '2', 'Ok thanks', '0', '1', '2015-07-01 08:26:58', '2015-07-01 08:26:58', null);

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
  `description` varchar(255) NOT NULL,
  `room_type` varchar(255) DEFAULT NULL COMMENT 'loai phong: 1:ca can ho, 2: phong rieng, 3: phong chia se',
  `accommodates` int(11) NOT NULL COMMENT 'So khach',
  `bedrooms` int(11) NOT NULL COMMENT 'Phong ngu',
  `beds` int(11) NOT NULL COMMENT 'Giuong',
  `room_size` int(11) NOT NULL COMMENT 'Dien tich phong',
  `amenities` varchar(255) NOT NULL COMMENT 'Tien nghi',
  `status_flg` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_address
-- ----------------------------
INSERT INTO `tb_room_address` VALUES ('1', '2', '16 Láng Hạ, Thành Công, Ba Đình, Hà Nội, Vietnam', '16 Láng Hạ', 'Ba Đình', 'Hà Nội', '21.0186', '105.816', 'Cho thuê văn phòng Láng Hạ', 'Tòa nhà Ford Thăng Long 105 Láng Hạ còn trống những diện tích như sau:\r\n45m2, 60m2, 105m2, 108m2, 53m.\r\nCơ sở vật chất hiện đại, thiết kế sang trọng theo tiêu chuẩn xứng tầm quốc tế.\r\n\r\n- Tòa nhà nằm trên một trong những trục đường giao thông chính của th', 'a:1:{i:0;s:10:\"share_room\";}', '5', '1', '1', '50', 'a:6:{i:0;s:15:\"smoking_allowed\";i:1;s:12:\"pets_allowed\";i:2;s:8:\"internet\";i:3;s:16:\"air_conditioning\";i:4;s:20:\"elevator_in_building\";i:5;s:7:\"parking\";}', '1', '2015-06-17 08:59:36', '2015-06-30 15:33:56', '0');
INSERT INTO `tb_room_address` VALUES ('2', '2', '272 Nguyễn Trãi, Thanh Xuân Trung, Thanh Xuân, Hà Nội, Vietnam', '272 Nguyễn Trãi', 'Thanh Xuân', 'Hà Nội', '20.9974', '105.811', 'Cho thuê nhà riêng Nguyễn Trãi', 'Cho thuê nhà riêng Nguyễn Trãi – Ngã tư sở, diện tích 28m x 4 tầng, 3 phòng ngủ, có nóng lạnh, bếp, tủ bếp, có ban công rộng phơi quần áo, điện nước tự thanh toán theo hóa đơn, ngõ rộng, tiện đi lại, gần chợ', 'a:3:{i:0;s:11:\"entire_home\";i:1;s:12:\"private_room\";i:2;s:10:\"share_room\";}', '16', '6', '6', '112', 'a:7:{i:0;s:15:\"smoking_allowed\";i:1;s:8:\"internet\";i:2;s:16:\"air_conditioning\";i:3;s:20:\"elevator_in_building\";i:4;s:7:\"kitchen\";i:5;s:7:\"parking\";i:6;s:6:\"washer\";}', '1', '2015-06-19 10:10:34', '2015-06-30 15:34:58', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_images
-- ----------------------------
INSERT INTO `tb_room_images` VALUES ('1', '1', '1434524845.3691.jpg', '2015-06-17 14:07:25', '2015-06-19 09:07:58', '1');
INSERT INTO `tb_room_images` VALUES ('2', '1', '1434524900.2232.jpg', '2015-06-17 14:08:20', '2015-06-18 14:50:57', '1');
INSERT INTO `tb_room_images` VALUES ('3', '1', '1434613887.484.jpg', '2015-06-18 14:51:27', '2015-06-25 15:25:26', '1');
INSERT INTO `tb_room_images` VALUES ('4', '1', '1434679655.7807.jpg', '2015-06-19 09:07:35', '2015-06-25 15:25:25', '1');
INSERT INTO `tb_room_images` VALUES ('5', '2', '1434683509.1121.jpg', '2015-06-19 10:11:49', '2015-06-19 10:12:08', '1');
INSERT INTO `tb_room_images` VALUES ('6', '2', '1434683781.9757.jpg', '2015-06-19 10:16:22', '2015-06-19 10:16:22', '0');
INSERT INTO `tb_room_images` VALUES ('7', '2', '1434683786.925.jpg', '2015-06-19 10:16:26', '2015-06-19 10:16:26', '0');
INSERT INTO `tb_room_images` VALUES ('8', '1', '1435220733.0611.jpg', '2015-06-25 15:25:33', '2015-06-25 15:25:33', '0');
INSERT INTO `tb_room_images` VALUES ('9', '1', '1435220738.3822.jpg', '2015-06-25 15:25:38', '2015-06-25 15:25:38', '0');
INSERT INTO `tb_room_images` VALUES ('10', '1', '1435220741.9532.jpg', '2015-06-25 15:25:41', '2015-06-25 15:25:41', '0');
INSERT INTO `tb_room_images` VALUES ('11', '1', '1435653016.2287.jpg', '2015-06-30 15:30:16', '2015-06-30 15:30:16', '0');
INSERT INTO `tb_room_images` VALUES ('12', '1', '1435653023.1381.jpg', '2015-06-30 15:30:23', '2015-06-30 15:30:23', '0');
INSERT INTO `tb_room_images` VALUES ('13', '1', '1435653036.0938.jpg', '2015-06-30 15:30:36', '2015-06-30 15:30:36', '0');
INSERT INTO `tb_room_images` VALUES ('14', '2', '1435653259.5816.jpg', '2015-06-30 15:34:19', '2015-06-30 15:34:19', '0');
INSERT INTO `tb_room_images` VALUES ('15', '2', '1435653273.7964.jpg', '2015-06-30 15:34:33', '2015-06-30 15:34:33', '0');
INSERT INTO `tb_room_images` VALUES ('16', '2', '1435653280.6898.jpg', '2015-06-30 15:34:40', '2015-06-30 15:34:40', '0');
INSERT INTO `tb_room_images` VALUES ('17', '2', '1435653292.1055.jpg', '2015-06-30 15:34:52', '2015-06-30 15:34:52', '0');

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
  KEY `room_address_id` (`room_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_room_price
-- ----------------------------
INSERT INTO `tb_room_price` VALUES ('1', '1', '800000', '700000', '600000', '100000', '3', '100000', '2', '1', '', '3', '9', '12', '12', '2015-06-17 13:54:51', '2015-07-07 19:53:41');
INSERT INTO `tb_room_price` VALUES ('2', '2', '180000', '0', '4800000', '0', '0', '0', '1', '1', 'Quy định của nhà nước', '1', '1', '0', '0', '2015-06-19 10:11:34', '2015-06-19 10:11:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO `tb_users` VALUES ('1', 'xuanhoa_1201@yahoo.com', 'shareroom.vn', 'Hòa', 'Trà Đá', '1989-01-12', '1', null, null, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/s200x200/1470006_806118269435131_1527776481786918463_n.jpg?oh=502c80cdf4a1ec0c8d57c7dc2c9cb9e8&oe=55FA815C&__gda__=1443322675_f1f89e4f915631177371a68ee6a14e61', null, '892770294103261', '2015-05-22 22:35:52', '2015-05-22 22:35:52', '0', '');
INSERT INTO `tb_users` VALUES ('2', 'xuanhoapro@gmail.com', 'shareroom.vn', 'Xuân Hòa', 'Nguyễn', '2010-02-17', '1', '0985050225', '', 'https://lh3.googleusercontent.com/-6SBTZCxzv6M/AAAAAAAAAAI/AAAAAAAAAH8/RGKA045KRLw/photo.jpg', '109417562987108464186', null, '2015-05-22 23:49:15', '2015-07-08 14:12:22', '0', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users_bank
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_wishlist
-- ----------------------------
