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

/*Table structure for table `hash_tags_image` */

DROP TABLE IF EXISTS `hash_tags_image`;

CREATE TABLE `hash_tags_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_tag_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `hash_tags_image` */

insert  into `hash_tags_image`(`id`,`hash_tag_id`,`image`) values (4,1,'https://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/s150x150/e35/11820545_541744059312623_1696670973_n.jpg'),(5,1,'https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/s150x150/e35/11373858_483485028500716_24494052_n.jpg'),(7,1,'https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/s150x150/e35/11850204_1643277529277893_205429810_n.jpg'),(8,1,'https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/s150x150/e35/11350791_415058468618922_542542988_n.jpg'),(10,2,'https://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/s150x150/e35/c0.15.1080.1080/11850095_1115995771763503_2124167344_n.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;