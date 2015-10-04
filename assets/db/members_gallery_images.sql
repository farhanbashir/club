/*
SQLyog Enterprise - MySQL GUI v7.15 
MySQL - 5.6.17 : Database - club
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`club` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `club`;

/*Table structure for table `members_gallery_images` */

DROP TABLE IF EXISTS `members_gallery_images`;

CREATE TABLE `members_gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `members_gallery_images` */

insert  into `members_gallery_images`(`id`,`image`) values (5,'https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/s150x150/e35/12093769_794205780725719_1107314734_n.jpg'),(6,'https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/s150x150/e35/12142272_1648221972114265_372745922_n.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;