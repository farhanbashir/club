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

/*Table structure for table `pdf` */

DROP TABLE IF EXISTS `pdf`;

CREATE TABLE `pdf` (
  `pdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `content_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pdf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `pdf` */

insert  into `pdf`(`pdf_id`,`path`,`content_id`,`is_active`) values (1,'http://localhost/club/assets/uploads/pdf/classes/50/fda4.pdf',50,0),(2,'http://localhost/club/assets/uploads/pdf/classes/50/0400012818527_680002523070.pdf',50,0),(3,'http://localhost/club/assets/uploads/pdf/classes/50/fda5.pdf',50,0),(4,'http://localhost/club/assets/uploads/pdf/classes/50/fda6.pdf',50,0),(5,'http://localhost/club/assets/uploads/pdf/classes/50/fda7.pdf',50,1),(6,'http://localhost/club/assets/uploads/pdf/classes/52/fda.pdf',52,0),(7,'http://localhost/club/assets/uploads/pdf/classes/52/fda1.pdf',52,0),(8,'http://localhost/club/assets/uploads/pdf/classes/52/fda2.pdf',52,0),(9,'http://localhost/club/assets/uploads/pdf/classes/52/fda3.pdf',52,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;