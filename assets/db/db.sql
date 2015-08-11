/*
SQLyog Enterprise - MySQL GUI v7.02 
MySQL - 5.6.17 : Database - club
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `content` */

CREATE TABLE `content` (
  `content_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_type_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `detail_description` text,
  `end_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `data` text,
  `is_active` tinyint(1) DEFAULT '1' COMMENT '0=inactive, 1=active',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `content` */

/*Table structure for table `content_type` */

CREATE TABLE `content_type` (
  `content_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`content_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `content_type` */

insert  into `content_type`(`content_type_id`,`content`) values (1,'events'),(2,'courses'),(3,'restaurants'),(4,'promotions'),(5,'pools'),(6,'beaches'),(7,'classes'),(8,'activities'),(9,'camps');

/*Table structure for table `devices` */

CREATE TABLE `devices` (
  `device_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '0=iphone,1=android',
  `lang` tinyint(1) DEFAULT '0' COMMENT '0=en,1=ar',
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `devices` */

/*Table structure for table `image` */

CREATE TABLE `image` (
  `image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1' COMMENT '0=inactive, 1=active',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `image` */

/*Table structure for table `page` */

CREATE TABLE `page` (
  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `content` text,
  `is_active` tinyint(1) DEFAULT '1' COMMENT '0=inactive, 1=active',
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `page` */

/*Table structure for table `users` */

CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1' COMMENT '0=inactive, 1=active',
  `verified` tinyint(1) DEFAULT '0',
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`,`is_active`,`verified`,`is_admin`) values (82,'farhan.bashir2002@gmail.com','click123',1,1,0),(83,'admin@club.com','click123',1,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;