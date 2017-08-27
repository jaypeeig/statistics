/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.9-MariaDB : Database - surveydb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`surveydb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `surveydb`;

/*Table structure for table `surveytable` */

DROP TABLE IF EXISTS `surveytable`;

CREATE TABLE `surveytable` (
  `survey_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kpop` int(10) unsigned DEFAULT NULL,
  `rnb` int(10) unsigned DEFAULT NULL,
  `opm` int(10) unsigned DEFAULT NULL,
  `rock` int(10) unsigned DEFAULT NULL,
  `lovesong` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `surveytable` */

insert  into `surveytable`(`survey_id`,`name`,`kpop`,`rnb`,`opm`,`rock`,`lovesong`) values (1,'Agaloos, John Paul',0,1,5,2,4),(2,'Alcular, Jasper',2,0,0,7,7),(3,'Atienza, Romnick James',0,2,7,0,7),(4,'Averion, Jayson',0,0,2,0,3),(5,'Bagatchalion, Kharl Kenneth',0,2,1,0,4),(6,'Baysa, Era',0,3,7,7,2),(7,'Bendita, Erein',0,0,2,6,3),(8,'Bermas, Hazel',1,0,3,6,8),(9,'Blaza, Marvin',3,2,1,3,4),(10,'Calangan, Jay-r',5,3,1,4,4),(11,'Capangada, Wendel',7,4,3,2,1),(12,'CastaÃ±ares, Jonathan',1,1,2,2,4),(13,'CedeÃ±o, Mc Arthur',2,3,3,1,2),(14,'De Guzman, Gelyn',0,1,6,5,3),(15,'Dipalac, Jayson Paulo',0,2,2,1,0),(16,'Dulohan, Shena',5,4,3,2,1),(17,'Dumaliang, Vanessa',0,1,0,2,4),(18,'Esteban, Jason',3,1,1,3,5),(19,'Flores, Froilan',2,6,1,3,5),(20,'Galvez, Sergio',1,6,1,3,4),(21,'Gorospe, Glydel',3,2,1,2,5),(22,'Himbing, Justfer',0,6,2,3,1),(23,'Julianda, Kenneth Jay',2,0,1,3,2),(24,'Luterte, Kylyn Angel',3,3,1,3,3),(25,'Manalo, Jeckson',7,6,2,3,5),(26,'Marfil, Claudine Gail',7,1,1,1,2),(27,'Molina, German Joseph',4,1,7,3,1),(28,'Naron, Anjanette',5,3,1,3,7),(29,'Navarra, Kristell',2,1,2,4,5),(30,'Navarroza, Carissa',1,6,7,3,5),(31,'Ocon, Jiselle',3,3,1,7,1),(32,'Panal, Charlot Nesnia',0,6,1,3,4),(33,'Paragsa, Ginnie Rose',0,6,1,1,1),(34,'PiÃ±as, Kaye Ann',2,2,2,2,2),(35,'Pis-an, Jason',4,3,6,3,1),(36,'Reyes, Sharen Kai',7,6,7,7,7),(37,'Rivera, Valen Paulo',2,6,1,3,4),(38,'Ruiz, Lorenz Jose',1,6,1,6,2),(39,'Sadino, Nelson',4,3,2,7,6),(40,'Ureta, Shara Mae',3,1,1,3,5),(41,'Villanueva, Al-Jhon',3,1,1,3,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
