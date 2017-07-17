/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.24-MariaDB : Database - db_cti
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cti` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values (1,'Admin','admin'),(2,'Master Link','Head Marketing Eksekutif'),(3,'Partner Link','Marketing Eksekutif');

/*Table structure for table `parent_categories` */

DROP TABLE IF EXISTS `parent_categories`;

CREATE TABLE `parent_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `parent_categories` */

insert  into `parent_categories`(`id`,`name`,`created_at`,`updated_at`) values (1,'Ayah','2017-06-18 18:43:32','0000-00-00 00:00:00'),(2,'Ibu','2017-06-18 18:43:36','0000-00-00 00:00:00'),(3,'Wali','2017-06-18 18:43:41','0000-00-00 00:00:00');

/*Table structure for table `parents` */

DROP TABLE IF EXISTS `parents`;

CREATE TABLE `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `income` text,
  `parent_category_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `parents` */

insert  into `parents`(`id`,`nik`,`name`,`date_of_birth`,`education`,`job`,`income`,`parent_category_id`,`student_id`,`created_at`,`updated_at`) values (1,'1234567','Ida Bagus Kania','2017-06-02','P4BA','Buruh Mrade','Rp. 1.000.000 - Rp. 2.000.000',1,1,'2017-06-20 23:32:23','2017-06-20 18:32:23'),(2,'1234561','Ida Ayu Anggreni','2017-06-28','SMK','Pedagang','Lebih dari Rp. 20.000.000',2,1,'2017-06-20 18:34:22','2017-06-20 18:34:22');

/*Table structure for table `programs` */

DROP TABLE IF EXISTS `programs`;

CREATE TABLE `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `programs` */

insert  into `programs`(`id`,`name`,`description`,`created_at`,`updated_at`) values (1,'Culinary','culinary','2017-06-18 18:44:38','0000-00-00 00:00:00'),(2,'Housekeeping','Housekeeping','2017-06-18 18:45:00','0000-00-00 00:00:00');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(4) DEFAULT NULL,
  `point` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`id`,`level`,`point`,`created_at`,`updated_at`) values (1,1,650000,'2017-07-17 18:17:27','2017-06-20 05:04:45'),(2,2,500000,'2017-07-17 18:17:43','0000-00-00 00:00:00'),(3,3,200000,'2017-07-17 18:17:48','0000-00-00 00:00:00');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `rt` varchar(100) DEFAULT NULL,
  `rw` varchar(100) DEFAULT NULL,
  `sub_district` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `type_of_stay` varchar(255) DEFAULT NULL,
  `transportation` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`place_of_birth`,`date_of_birth`,`gender`,`program_id`,`religion`,`nik`,`nisn`,`npwp`,`nationality`,`street`,`village`,`rt`,`rw`,`sub_district`,`district`,`province`,`type_of_stay`,`transportation`,`phone`,`email`,`status`,`user_id`,`created_at`,`updated_at`) values (1,'Gus Purwania','Gianyar','1995-04-14','Laki-Laki',2,'Hindu','123456789','123456789','','Indonesia','Mas','Mas','-','-','Ubud','Gianyar','Bali','Bersama Orang Tua','Motor','085738009350','guspurwania@gmail.com',1,4,'2017-07-17 18:27:23','2017-07-17 13:27:23'),(2,'Gus Purwania','Gianyar','2017-06-14','Laki-Laki',1,'Islam','123456','23232','234343','Indonesia','Mas, Ubud, Gianyar, Bali','Mas','-','-','Ubud','Ubud','Bali','Bersama Orang Tua','Motor','85738009350','guspurwania@gmail.com',1,7,'2017-07-17 18:27:46','2017-07-17 13:27:46');

/*Table structure for table `transfers` */

DROP TABLE IF EXISTS `transfers`;

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `point_before` double DEFAULT NULL,
  `total_transfer` double DEFAULT NULL,
  `point_after` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `note` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `transfers` */

insert  into `transfers`(`id`,`user_id`,`point_before`,`total_transfer`,`point_after`,`status`,`note`,`created_at`,`updated_at`) values (5,4,500000,50000,450000,1,NULL,'2017-06-28 08:23:02','2017-06-28 03:23:02'),(6,4,450000,50000,400000,1,'11.jpg','2017-06-28 09:27:32','2017-06-28 04:27:32');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `photo` text,
  `ktp` text,
  `kk` text,
  `address` text,
  `rt` varchar(100) DEFAULT NULL,
  `rw` varchar(100) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `sub_district` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `point` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`full_name`,`phone`,`account_number`,`account_name`,`bank_name`,`group_id`,`photo`,`ktp`,`kk`,`address`,`rt`,`rw`,`province`,`district`,`sub_district`,`job`,`point`,`user_id`,`status`,`updated_at`,`created_at`) values (4,'::1','guspurwania','$2y$08$IWG5exZK4gQqY5DFyZbkuu0Pc6Fm/YF7.bD7xbMJYpxUnoCacii.C',NULL,'guspurwania@gmail.com',NULL,NULL,NULL,NULL,1497784046,1500289736,1,'Gus Purwania','085738009350','192394858747584','Gus Purwania','Bank BNI',2,'avatar2.jpg','avatar3.jpg','avatar1.jpg','Br. Kawan, Mas',NULL,NULL,'Bali','Gianyar','Ubud','Freelance',1900000,0,1,'2017-07-17 13:27:46',NULL),(7,'::1',NULL,'$2y$08$axY9jJhXgym7SJbIfb0AreXA9VoA.ntmOBNdwZw.5RGfzqME95c5i',NULL,'cloud.transsystem@gmail.com',NULL,NULL,NULL,NULL,1497889167,1500288834,1,'Gede Purwania','85738009350','88888888888','Gus Purwania',NULL,3,'1.jpg','2.jpg','3.jpg','Br. Kawan, Mas, Ubud, Gianyar, Bali',NULL,NULL,'Bali','Ubud','Ubud','Kerja',500000,4,1,'2017-07-17 13:27:46',NULL),(8,'::1','guspur','$2y$08$IWG5exZK4gQqY5DFyZbkuu0Pc6Fm/YF7.bD7xbMJYpxUnoCacii.C',NULL,'gus.devil@yahoo.com',NULL,NULL,NULL,NULL,1497784046,1500290750,1,'Gus Purwania','085738009350','192394858747584','Gus Purwania',NULL,1,'avatar2.jpg','avatar3.jpg','avatar1.jpg','Br. Kawan, Mas',NULL,NULL,'Bali','Gianyar','Ubud','Freelance',500000,0,0,'2017-06-21 04:49:39',NULL),(9,'::1','agusmaha','$2y$08$AF3FoV/H8xboCozT9P6S0OmwC7hb2VlruFD.9I5T.1A0K5eiM25pC',NULL,'agusa.mahasadhu@gmail.com',NULL,NULL,NULL,NULL,1500290004,1500290147,1,'Agus Mahasadhu','85738009350','2934899','Agus','Mandiri',3,'Untitled-2_copy.JPG','Untitled-2_copy1.JPG','Untitled-2_copy2.JPG','Denpasar',NULL,NULL,'Bali','Denpasar','Denpasar','Pelajar',0,4,1,'2017-07-17 13:15:31',NULL);

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
