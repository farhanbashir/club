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

/*Table structure for table `sponsor_relation` */

DROP TABLE IF EXISTS `sponsor_relation`;

CREATE TABLE `sponsor_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `sponsor_content_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `sponsor_relation` */

insert  into `sponsor_relation`(`id`,`page`,`sponsor_content_id`,`name`) values (1,'page 1',36,'Test');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;