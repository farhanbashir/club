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

/*Table structure for table `hash_tag` */

DROP TABLE IF EXISTS `hash_tag`;

CREATE TABLE `hash_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `hash_tag` */

insert  into `hash_tag`(`id`,`hash_tag`) values (1,'Face');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;