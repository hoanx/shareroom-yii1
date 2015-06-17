/*
SQLyog Ultimate v9.31 GA
MySQL - 5.6.21 : Database - shareroom-yii1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_admin` */

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

/*Data for the table `tb_admin` */

LOCK TABLES `tb_admin` WRITE;

insert  into `tb_admin`(`id`,`username`,`password`,`email`,`created`,`updated`,`del_flg`) values (1,'admin','cb7dae101850facf7f612731de40b82f','admin@admin.vn','2015-05-13 14:35:51','2015-05-13 14:35:54',0);

UNLOCK TABLES;

/*Table structure for table `tb_messages` */

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

/*Data for the table `tb_messages` */

LOCK TABLES `tb_messages` WRITE;

UNLOCK TABLES;

/*Table structure for table `tb_room_address` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_room_address` */

LOCK TABLES `tb_room_address` WRITE;

insert  into `tb_room_address`(`id`,`user_id`,`address_detail`,`address`,`district`,`city`,`lat`,`long`,`name`,`description`,`room_type`,`accommodates`,`bedrooms`,`beds`,`room_size`,`amenities`,`created`,`updated`,`del_flg`) values (1,3,'Ngô Thì Nhậm, Quang Trung, Hà Nội, Việt Nam','Ngô Thì Nhậm','Hà Noi','Hà Nội',21.022,105.849,'Cho thuê nhà Cầu giấy','Cho thuê nhà Cầu giấy','a:1:{i:0;s:11:\"entire_home\";}',1,2,1,34,'a:6:{i:0;s:15:\"smoking_allowed\";i:1;s:8:\"internet\";i:2;s:19:\"handicap_accessible\";i:3;s:4:\"pool\";i:4;s:3:\"gym\";i:5;s:3:\"kid\";}','2015-06-16 14:12:58','2015-06-17 13:31:28',0);

UNLOCK TABLES;

/*Table structure for table `tb_room_images` */

DROP TABLE IF EXISTS `tb_room_images`;

CREATE TABLE `tb_room_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_address_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`,`room_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `tb_room_images` */

LOCK TABLES `tb_room_images` WRITE;

insert  into `tb_room_images`(`id`,`room_address_id`,`image_name`,`created`,`updated`,`del_flg`) values (17,1,'1434525058.926.jpg','2015-06-17 14:10:58','2015-06-17 14:43:04',1),(18,1,'1434525100.2393.jpg','2015-06-17 14:11:40','2015-06-17 14:42:13',1),(19,1,'1434527006.5125.jpg','2015-06-17 14:43:26','2015-06-17 14:43:33',1),(20,1,'1434527077.8506.jpg','2015-06-17 14:44:37','2015-06-17 14:44:42',1),(21,1,'1434527163.1624.jpg','2015-06-17 14:46:03','2015-06-17 14:46:03',0),(22,1,'1434527250.1374.jpg','2015-06-17 14:47:30','2015-06-17 14:47:32',1),(23,1,'1434527264.9473.jpg','2015-06-17 14:47:44','2015-06-17 14:47:44',0);

UNLOCK TABLES;

/*Table structure for table `tb_room_price` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_room_price` */

LOCK TABLES `tb_room_price` WRITE;

insert  into `tb_room_price`(`id`,`room_address_id`,`price`,`weekly`,`monthly`,`additional_guests`,`cleaning_fees`,`cancellation`,`house_rules`,`min_nights`,`max_nights`,`check_in`,`check_out`,`created`,`updated`) values (1,1,800000,0,0,0,0,1,'',1,1,'5','16','2015-06-16 14:36:49','2015-06-17 13:32:52');

UNLOCK TABLES;

/*Table structure for table `tb_users` */

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_users` */

LOCK TABLES `tb_users` WRITE;

insert  into `tb_users`(`id`,`email`,`password`,`first_name`,`last_name`,`birthday`,`gender`,`phone_number`,`address`,`profile_picture`,`google_id`,`facebook_id`,`created`,`updated`,`del_flg`,`description`) values (1,'xuanhoa_1201@yahoo.com','shareroom.vn','Hòa','Trà Đá','1989-01-12',1,NULL,NULL,'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/s200x200/1470006_806118269435131_1527776481786918463_n.jpg?oh=502c80cdf4a1ec0c8d57c7dc2c9cb9e8&oe=55FA815C&__gda__=1443322675_f1f89e4f915631177371a68ee6a14e61',NULL,'892770294103261','2015-05-22 22:35:52','2015-05-22 22:35:52',0,''),(2,'xuanhoapro@gmail.com','shareroom.vn','Xuân Hòa','Nguyễn',NULL,1,NULL,NULL,'https://lh3.googleusercontent.com/-6SBTZCxzv6M/AAAAAAAAAAI/AAAAAAAAAH8/RGKA045KRLw/photo.jpg','109417562987108464186',NULL,'2015-05-22 23:49:15','2015-05-22 23:49:15',0,''),(3,'vipnd2003@gmail.com','bcc67d8524948bbd873e4df12c89b182','Tiến','Nguyễn',NULL,0,'+84946259905',NULL,NULL,NULL,NULL,'2015-06-16 11:28:39','2015-06-17 13:31:28',0,'');

UNLOCK TABLES;

/*Table structure for table `tb_users_bank` */

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

/*Data for the table `tb_users_bank` */

LOCK TABLES `tb_users_bank` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
