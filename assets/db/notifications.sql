create table `notifications`( `notification_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT , `send_to` tinyint(1) DEFAULT '0' COMMENT '0=all,1=android,2=iphone', `notification` varchar(200) , `datetime` datetime DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`notification_id`))  