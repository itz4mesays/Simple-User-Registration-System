/*
SQLyog Ultimate v8.82 
MySQL - 5.6.26 : Database - test_task
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test_task` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test_task`;

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('admin','1',1473551203),('user','10',1473638105),('user','14',1473640226),('user','15',1473640227),('user','16',1473640228),('user','17',1473640229),('user','18',1473640230),('user','19',1473640231),('user','20',1473640232),('user','21',1473640233),('user','22',1473640234),('user','23',1473640235),('user','24',1473640236),('user','25',1473640237),('user','26',1473640238),('user','27',1473640239),('user','28',1473640240),('user','29',1473640241),('user','30',1473640242),('user','31',1473640243),('user','32',1473640244),('user','33',1473640245),('user','34',1473640246),('user','35',1473640247),('user','36',1473640248),('user','37',1473640249),('user','38',1473640250),('user','39',1473640251),('user','40',1473640252),('user','41',1473640252),('user','42',1473640253),('user','43',1473640254),('user','8',1473630030),('user','9',1473638045);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('admin',1,NULL,NULL,NULL,1473551203,1473551203),('user',1,NULL,NULL,NULL,1473551203,1473551203);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1473549994),('m140506_102106_rbac_init',1473550236),('m160910_232431_create_user_table',1473550062),('m160910_233336_add_user_to_table',1473550912),('m160910_234811_create_user_registration_details',1473551777),('m160911_204920_alter_password_column',1473627049),('m160912_000033_registration_seed_data',1473640255);

/*Table structure for table `registration_details` */

DROP TABLE IF EXISTS `registration_details`;

CREATE TABLE `registration_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registration_details_user` (`user_id`),
  CONSTRAINT `fk_registration_details_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `registration_details` */

insert  into `registration_details`(`id`,`user_id`,`firstname`,`lastname`,`email`,`phone_number`,`birthday`) values (5,8,'Oyedele','Olufemii','oyedele.phemy@gmail.com','+234(80)3544-2578','1985-10-11'),(6,9,'testname','testlast','test@userreg.dev','+234(80)3124-2512','1982-01-02'),(7,10,'Unicaf','Lagos','unicaf@test.dev','+234(80)9999-9999','1976-01-02'),(9,15,'Gibson','Rosa','Shanny22@Hand.com','+234(80)1235-9999','1982-01-02'),(10,16,'Volkman','Cristopher','jRau@West.info','+234(80)1543-9999','1982-01-02'),(11,17,'Prof','Elisha','bBednar@Quigley.com','+234(80)9091-9999','1982-01-02'),(12,18,'Sanford','Tom','Lydia96@gmail.com','+234(80)9871-9999','1982-01-02'),(13,19,'Fredy','Lina','nMonahan@Mitchell.com','+234(80)9195-9999','1982-01-02'),(15,21,'Schiller','Kemmer','Rippin.Edyth@Schowalter.com','+234(80)9111-9999','1982-01-02'),(16,22,'Langworth','Cummerata','Klocko.Obie@Morar.com','+234(80)9999-9124','1982-01-02'),(17,23,'Block','Simonis','Annetta.Hansen@Rutherford.net','+234(80)9999-9139','1982-01-02'),(18,24,'Brakus','Berge','Nova05@yahoo.com','+234(80)9999-5499','1982-01-02'),(19,25,'Williamson','Emmett','Sauer.Brayan@Emmerich.com','+234(80)9999-5699','1982-01-02'),(21,27,'Carissa','Howe','nSatterfield@Lueilwitz.org','+234(80)9999-5499','1982-01-02'),(22,28,'Mack','Jeff','Sebastian.OHara@Heathcote.biz','+234(80)9710-9999','1982-01-02'),(23,29,'Crist','Britney','Felipe01@gmail.com','+234(80)8099-9999','1982-01-02'),(24,30,'Akeem','Pollich','America18@yahoo.com','+234(80)9916-9999','1982-01-02'),(25,31,'Schowalter','Goodwin','Marjory.Metz@yahoo.com','+234(80)1349-9999','1982-01-02'),(26,32,'Geovany','Boehm','oRempel@gmail.com','+234(80)0919-5499','1982-01-02'),(27,33,'Collin','Gorczany','Madonna91@gmail.com','+234(80)9956-9124','1982-01-02'),(28,34,'Reichel','Heathcote','Kshlerin.Dandre@Ryan.com','+234(80)4444-5555','1982-01-02'),(29,35,'Dayton','Hansen','Feil.Rowland@Beatty.com','+234(80)5556-4433','1982-01-02'),(30,36,'Misael','Chauncey','Conor.Koelpin@gmail.com','+234(80)9911-9449','1982-01-02'),(31,37,'Gleichner','Cronin','Nader.Sallie@Deckow.com','+234(80)9555-9909','1982-01-02'),(32,38,'Ziemann','Legros','Jettie98@gmail.com','+234(80)9987-9135','1982-01-02'),(33,39,'Abbott','Neal','OConner.Justyn@yahoo.com','+234(80)9549-9921','1982-01-02'),(34,40,'Bernadine','Bland','Adalberto43@Stoltenberg.com','+234(80)9423-9913','1982-01-02'),(35,41,'Beverly','Schiller','Aditya96@yahoo.com','+234(80)9129-9122','1982-01-02'),(36,42,'Dejah','Henderson','bTremblay@gmail.com','+234(80)9999-129','1982-01-02'),(37,43,'Reichert','Vincent','Helene.Larkin@hotmail.com','+234(80)2349-9999','1982-01-02');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password_hash`,`auth_key`,`password_reset_token`,`created_at`,`updated_at`) values (1,'admin123','$2y$13$TxH7jYfOIl8w8OB/EcWFbuoobryoYR4Ddr/yYdHlTdHCb.tsmCBky','hWKWgU4xYV1uX69YGOkZbFVuuHfP_866','WEp8sQLimB0FWpQ2o6EN0AG6bwyetxjo_1473550912','2016-09-11 01:41:52','2016-09-11 01:41:52'),(8,'oyedele123','$2y$13$7XBuP4DL5axnaQgUbzRuK.6Rp5.Y5sA7zmeBi.atRErnCUsMPPZyy','CdoqJg9x5QE4mDmttNnREk7rtmm8xm5_','','2016-09-11 22:40:30','2016-09-11 22:40:30'),(9,'test123','$2y$13$r6CKlLiapTT.Rny8Sp/GWOjjyKwk66TwqBR.wYI4BjlGbPiL50InW','7kpQWwfnZG5HXpo5al8rlfVLLgrKXE-a','','2016-09-12 00:54:05','2016-09-12 00:54:05'),(10,'unicaf012','$2y$13$nn/S/5xgjuFZAqJDUFN/NetYrO0SlX2q.C/g82Yo2UupbbXWT8Ftq','lfLzHqGKODi9YpTcdGfE06F-wJ8bh9NM','','2016-09-12 00:55:05','2016-09-12 00:55:05'),(15,'Fahey690','$2y$13$WCBHOReoCKzYlXdSEDe47uqh52Hp96Fzp552KxmzBXfyXE7Za7l1q','Z6ufy0DBqFZm4I1uMub3pB7KafIAJX2s','','2016-09-12 00:55:05',NULL),(16,'Pfannerstill690','$2y$13$/7fSJbgaGH/MKy2CLNooDO8NxNR8fLV8nDrSk/MG5429tMzFUqF6.','iU7o2S0OnJtRUAQTisBLipUqgQxfznBM','','2016-09-12 00:55:05',NULL),(17,'Connell690','$2y$13$gdv8R4ZkHwFQM9t9A3SMJ.ySwLKlHnrOQ3bqY1QObeqv4fs8h98Fu','zazh_C0fuQCPFkT79ryvh9smWlG4kqo3','','2016-09-12 00:55:05',NULL),(18,'Torphy690','$2y$13$AjyQyMTJ.x8QcaQiK0UED.DOOp4NKeSJ2Inc.c9TfG8PNiLDJTGYi','Jp--5jXgDCBrYyk0Lg0-Z2cwE9H3nM-O','','2016-09-12 00:55:05',NULL),(19,'RosenbaumI690','$2y$13$updQ7CzX0zm7LS4VFWzwMu.3YRgEcMVkNBOXcBqOqWKoUutYH3JZu','jrzscD7Io4p7D7pGyPffjDucm1z6DdGj','','2016-09-12 00:55:05',NULL),(21,'HirtheMD690','$2y$13$HsRVqIEzqD8I25ZpJrT0YOnvbdBr1/PSinnYzgIJSmnbKJjifHsd.','-xDl_10XKkzXOiOQm5juJncWbu0He6gG','','2016-09-12 00:55:05',NULL),(22,'Bosco690','$2y$13$SFiZ4GvGf8kKsQe1IdNIue9TqeNF9JjByIS5XRyVU6RJ/psQ6ePaa','geaOUWeMBygcSCyf9uxQRvfyfi50EpEW','','2016-09-12 00:55:05',NULL),(23,'Feest690','$2y$13$/px9Aww6khRw1gVphsozFO.WqGH1sjDBN3euORwxFEkT081w4PhVy','ofjJmkYAFAhPlsGZRmKG_O-Qf-RHZNcl','','2016-09-12 00:55:05',NULL),(24,'Reilly690','$2y$13$bL0noSOMyvjuM.hyEl67D.UR9Eqh/my6Tij8XM4U.9SxNCLmEeJum','VT7CeDh6DoCe0munN_L9lJJYKjfn9wee','','2016-09-12 00:55:05',NULL),(25,'Schimmel690','$2y$13$SR15T6WRZX1XnneaiZyQn.qt2Qz6jo2cWyy4kYdzoxtma0i3aLPKG','3w7G_s4VgHCZRgElXZeY6f9xaC1DNKEP','','2016-09-12 00:55:05',NULL),(27,'Schaden690','$2y$13$H.wo6kQvvXJ5l/V2wUPmMOc1sbGFL6tpMm3JnOYfBX1M3xJ4WvfcG','AN1VNHfYyZEYel3UmkNo6o6-pZykZAbu','','2016-09-12 00:55:05',NULL),(28,'Zemlak690','$2y$13$3SSA2CjdLtM/ZTL6pWgzoeiim6Z5tqgI1QubioEEbW.FD6MH7Bxra','KRP6YRDkPZfjWTmNuoAoxAMQsbEKjRq6','','2016-09-12 00:55:05',NULL),(29,'Johns690','$2y$13$KRBmEOz.Dt2JXcpuOuLC1OtvfSTeygFz//J2UybEJ4xpMrJraNOtS','_8A94UK-n_-D1bwvwfiVovzp-s5gmMep','','2016-09-12 00:55:05',NULL),(30,'Klocko690','$2y$13$BHCV7gsVC5SJtnTDWSYmVe43x/J4HM/02ai5diAbia4MO1Za2ioLS','GcjbNdQAbj3rZSvcg3JfzqHAdFiJj_wd','','2016-09-12 00:55:05',NULL),(31,'DaughertyI690','$2y$13$pNTdTlcnp4OYleJ7vKZ5FuICn1s77bxr2dPTdw16/0AWE8YMInT5q','fVZqzjs4M84VpSb9DZuP1uvn0rF6uj8m','','2016-09-12 00:55:05',NULL),(32,'Lemke690','$2y$13$hqDDWtw2GOvwNB3SG.wK6Ot22Qm0DYVG8V7gML9yaI4R5IMBsmLqW','kRVseip8kr1hRmwn1JEVQFmieA09UK8Z','','2016-09-12 00:55:05',NULL),(33,'Turcotte690','$2y$13$aB1Vd4oUwBf.YKRAvAqPvOYGlM6TmgOr5awuWQCTuh5g5NZkq9ZDC','FEXKmX6zfK2xaS9oSPUA00qb47NaUZfB','','2016-09-12 00:55:05',NULL),(34,'RomagueraMD690','$2y$13$vfofq6XddmMAJ./3vqRh2uFrgKGBVPtv61kPuDilAtVD.vzdPYKvm','6BBPdnc8vDx6juZyVu9avleyLwHouPMq','','2016-09-12 00:55:05',NULL),(35,'Okuneva690','$2y$13$YXvqzgG2qvhND.LhySsaW.jzcS2DLuKv/cGKinoDuqQVXKQ8yS/OK','trRxfUKWpRvomgD4qY-87UUTCgxxEx6-','','2016-09-12 00:55:05',NULL),(36,'Upton690','$2y$13$Pa4Faiyc5opajAG5gMd.Cu1ShLfMZ0hGB2PBGu5JBTxuRzGN2lQSa','08oef9w0FrW6f2aI-zuYIhEyENwZhNte','','2016-09-12 00:55:05',NULL),(37,'Emard690','$2y$13$Gm/ZPWQtySBqz0nk05G2.uIXDeh7oWjgjIu4sOy.K50k.hfC4du9C','9rUyYFA_2obME6EAfhDY3FY163C3GhPq','','2016-09-12 00:55:05',NULL),(38,'HughMD690','$2y$13$.DEadLtLVpMqg/Uw1amNH.DeuIwDO6Az3o2yTFuhDkwNUrKprmhUW','ybfRqjzZqbWLs9raoRfiMe4lc3gfLnls','','2016-09-12 00:55:05',NULL),(39,'Brakus690','$2y$13$snK4M5CNV3/xsHzponZgjenhfM6BH/yNgMrK0T2Gn47gD0z5W2b2i','KM7NpLWfo1nSQYibq5iYy9mQymsAIC1W','','2016-09-12 00:55:05',NULL),(40,'Wuckert690','$2y$13$h4YBdTXHXWOY1m/QAbAv1uy1jkAjlZ6.BIlKzNyTLI33hxGjxhEk.','CiqmnZ8psbPdVwjSQ8rJtiauLiBs62rM','','2016-09-12 00:55:05',NULL),(41,'Littel690','$2y$13$x6Guh385ePqY2n8vxOOAt.39rN6OXhg104Fc2xdsm/fErD3t1ZLU2','sr8FNLpE0VIx3lvQcAwsUhc0Qu603saf','','2016-09-12 00:55:05',NULL),(42,'Hintz690','$2y$13$as5ngO4MJxr1QDFaEbzPeOcongwKx//iEn/06R7XfdZc4MC9Von1q','tj1XctILxoVNLpa5XcMhzM0JqzYdc3EU','','2016-09-12 00:55:05',NULL),(43,'Lesch690','$2y$13$qgko128t5PZPWO7of.xkEuSMtvn8NM8IhdH7UwMTeXUpAC7hnqQSG','O0vmg7OMS9AwqBJPRijSG3VaTB-AEQFk','','2016-09-12 00:55:05',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
