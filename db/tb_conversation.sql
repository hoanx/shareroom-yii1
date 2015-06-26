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
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `qty_guests` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tb_conversation` */

LOCK TABLES `tb_conversation` WRITE;

insert  into `tb_conversation`(`id`,`from_id`,`to_id`,`start_date`,`end_date`,`qty_guests`,`created`,`updated`,`del_flg`) values (1,3,3,NULL,NULL,NULL,'2015-06-26 17:22:59','2015-06-26 17:22:59',0),(2,3,3,NULL,NULL,NULL,'2015-06-26 17:26:40','2015-06-26 17:26:40',0),(3,3,3,'0000-00-00','0000-00-00',800000,'2015-06-26 17:45:24','2015-06-26 17:45:24',0),(4,3,3,'0000-00-00','0000-00-00',800000,'2015-06-26 17:46:24','2015-06-26 17:46:24',0),(5,3,3,'0000-00-00','0000-00-00',800000,'2015-06-26 17:46:58','2015-06-26 17:46:58',0),(6,3,3,'0000-00-00','0000-00-00',800000,'2015-06-26 17:47:13','2015-06-26 17:47:13',0),(7,3,3,'0000-00-00','0000-00-00',800000,'2015-06-26 17:47:29','2015-06-26 17:47:29',0);

UNLOCK TABLES;

/*Table structure for table `tb_messages` */

DROP TABLE IF EXISTS `tb_messages`;

CREATE TABLE `tb_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0' COMMENT '0: message default; 1: message new booking room',
  `from_user_id` int(11) NOT NULL,
  `content` text,
  `status_flg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : unRead; 1:Readed',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `del_flg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_messages` */

LOCK TABLES `tb_messages` WRITE;

insert  into `tb_messages`(`id`,`conversation_id`,`message_type`,`from_user_id`,`content`,`status_flg`,`created`,`updated`,`del_flg`) values (1,2,1,3,'',0,'2015-06-26 17:26:40','2015-06-26 17:26:40',NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
