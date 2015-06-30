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
/*Table structure for table `tb_conversation` */

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

/*Data for the table `tb_conversation` */

LOCK TABLES `tb_conversation` WRITE;

insert  into `tb_conversation`(`id`,`from_id`,`to_id`,`booking_id`,`status_flg`,`last_message_id`,`read_flg`,`created`,`updated`,`del_flg`) values (1,3,3,1,1,1,0,'2015-06-26 17:57:59','2015-06-26 17:57:59',0),(2,3,3,2,2,2,0,'2015-06-30 14:08:54','2015-06-30 14:08:54',0);

UNLOCK TABLES;

/*Table structure for table `tb_messages` */

DROP TABLE IF EXISTS `tb_messages`;

CREATE TABLE `tb_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0' COMMENT '0: message default; 1: message new booking room',
  `from_user_id` int(11) NOT NULL,
  `content` text,
  `status_flg` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_messages` */

LOCK TABLES `tb_messages` WRITE;

insert  into `tb_messages`(`id`,`conversation_id`,`message_type`,`from_user_id`,`content`,`status_flg`,`created`,`updated`,`del_flg`) values (1,1,1,3,'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.',1,'2015-06-26 17:57:59','2015-06-26 17:57:59',NULL),(2,2,1,3,'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.',1,'2015-06-30 14:08:54','2015-06-30 14:08:54',NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
