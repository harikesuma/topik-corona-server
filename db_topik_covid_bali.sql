/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - db_topik_covid_bali
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_topik_covid_bali` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_topik_covid_bali`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id`,`nama`,`username`,`email`,`password`) values 
(16,'Admin','admin','admin@email.com','$2y$10$OGZaQoaKYPK3ya0KqebQEOxKQyWUkJjYC3QYaeCeJA0.krVfCiJm2');

/*Table structure for table `tb_gejala` */

DROP TABLE IF EXISTS `tb_gejala`;

CREATE TABLE `tb_gejala` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kategori_gejala_id` int(5) DEFAULT NULL,
  `gejala` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_gejala_id` (`kategori_gejala_id`),
  CONSTRAINT `tb_gejala_ibfk_1` FOREIGN KEY (`kategori_gejala_id`) REFERENCES `tb_kategori_gejala` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_gejala` */

insert  into `tb_gejala`(`id`,`kategori_gejala_id`,`gejala`) values 
(1,1,'demam'),
(2,1,'batuk kering'),
(3,1,'kelelahan'),
(4,2,'sakit dan nyeri'),
(5,2,'sakit tenggorokan'),
(6,2,'diare'),
(7,2,'konjungtivitis'),
(8,2,'sakit kepala'),
(9,2,'kehilangan kemampuan mencium bau'),
(10,2,'ruam pada kulit atau perubahan warna jari tangan atau kaki'),
(11,3,'kesulitan bernafas'),
(12,3,'nyeri atau tekanan di dada'),
(13,3,'kehilangan bicara dan bergerak');

/*Table structure for table `tb_kategori_gejala` */

DROP TABLE IF EXISTS `tb_kategori_gejala`;

CREATE TABLE `tb_kategori_gejala` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kategori_gejala` */

insert  into `tb_kategori_gejala`(`id`,`kategori`) values 
(1,'umum'),
(2,'kurang umum'),
(3,'serius');

/*Table structure for table `tb_news` */

DROP TABLE IF EXISTS `tb_news`;

CREATE TABLE `tb_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(5) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `click` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `tb_news_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tb_admin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_news` */

insert  into `tb_news`(`id`,`admin_id`,`judul`,`deskripsi`,`foto`,`click`,`tanggal`) values 
(1,16,'Ada Monyet Nyangkut di Pohon Pisang Goreng Keju','Ini Deskripsi Ya Bambang','https://res.cloudinary.com/randomize721/image/upload/v1592911004/ayr9mogcthgaakebr3wr.jpg',0,'2020-06-23');

/*Table structure for table `tb_sebaran_pasien` */

DROP TABLE IF EXISTS `tb_sebaran_pasien`;

CREATE TABLE `tb_sebaran_pasien` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kabupaten` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `level` int(5) DEFAULT NULL,
  `ppln` int(5) DEFAULT NULL,
  `ppdn` int(5) DEFAULT NULL,
  `tl` int(5) DEFAULT NULL,
  `lainya` int(5) DEFAULT NULL,
  `perawatan` int(5) DEFAULT NULL,
  `sembuh` int(5) DEFAULT NULL,
  `meninggal` int(5) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_sebaran_pasien` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('P','W') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`nama`,`email`,`password`,`jenis_kelamin`,`alamat`) values 
(2,'hari kesuma 78','hari@gmail.com','$2y$10$nMO73WcmvWTVyMcN92b/CuwGic5HSsc8e6KK3H2RUaOeeLthBnSAS','P','jl. sakura'),
(3,'omang','omang@gmail.com','$2y$10$AX2giPBApsxUElHIMZUI8.UKH75IWCDoE2PAGI5mfWaQlvL.0BmrW','W','jl. gunung soputan'),
(6,'ansela','ansel@gmail.com','$2y$10$3YuvUOqZjlFsGkqCDcgjyOSGTMNVyVAh/CQSs9UiK21Ij8u7Gq54u','W','jl. sentana');

/*Table structure for table `tb_user_gejala` */

DROP TABLE IF EXISTS `tb_user_gejala`;

CREATE TABLE `tb_user_gejala` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gejala_id` int(5) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `gejala_id` (`gejala_id`),
  CONSTRAINT `tb_user_gejala_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`),
  CONSTRAINT `tb_user_gejala_ibfk_2` FOREIGN KEY (`gejala_id`) REFERENCES `tb_gejala` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user_gejala` */

insert  into `tb_user_gejala`(`id`,`user_id`,`gejala_id`,`tanggal`) values 
(3,2,9,NULL),
(5,2,7,NULL),
(7,2,4,NULL),
(9,2,2,NULL),
(10,2,3,NULL),
(11,2,4,NULL),
(13,2,7,NULL),
(15,2,4,NULL),
(16,2,5,NULL),
(18,2,6,NULL),
(21,2,11,NULL),
(23,2,11,NULL),
(25,2,5,NULL),
(26,2,10,NULL),
(28,2,10,NULL),
(29,2,1,NULL),
(30,2,2,NULL),
(31,2,4,NULL),
(32,2,5,NULL),
(33,2,6,NULL),
(34,2,7,NULL),
(35,2,8,NULL),
(36,2,5,NULL),
(37,2,6,NULL),
(38,2,7,NULL),
(40,2,2,NULL),
(41,2,3,NULL),
(42,2,4,NULL),
(43,2,1,NULL),
(44,2,2,NULL),
(45,2,3,NULL),
(46,2,4,NULL),
(47,2,1,NULL),
(48,2,2,NULL),
(49,2,3,NULL),
(50,2,4,NULL),
(51,2,1,NULL),
(52,2,2,NULL),
(53,2,3,NULL),
(54,2,4,NULL),
(55,2,7,NULL),
(56,2,8,NULL),
(57,2,7,NULL),
(58,2,8,NULL),
(59,2,10,'2020-06-21'),
(60,2,11,'2020-06-21'),
(61,2,8,'2020-06-21'),
(62,2,10,'2020-06-21'),
(63,2,8,'2020-06-21'),
(64,2,9,'2020-06-21'),
(65,2,9,'2020-06-21'),
(66,2,10,'2020-06-21'),
(67,2,11,'2020-06-21'),
(68,2,9,'2020-06-21'),
(69,2,12,'2020-06-21'),
(70,2,13,'2020-06-21'),
(71,6,7,'2020-06-21'),
(72,6,8,'2020-06-21'),
(73,6,9,'2020-06-21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
