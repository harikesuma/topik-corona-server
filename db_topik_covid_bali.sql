/*
SQLyog Ultimate v12.4.3 (64 bit)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_admin` */

/*Table structure for table `tb_gejala` */

DROP TABLE IF EXISTS `tb_gejala`;

CREATE TABLE `tb_gejala` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kategori_gejala_id` int(5) DEFAULT NULL,
  `gejala` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_gejala_id` (`kategori_gejala_id`),
  CONSTRAINT `tb_gejala_ibfk_1` FOREIGN KEY (`kategori_gejala_id`) REFERENCES `tb_kategori_gejala` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_gejala` */

/*Table structure for table `tb_kategori_gejala` */

DROP TABLE IF EXISTS `tb_kategori_gejala`;

CREATE TABLE `tb_kategori_gejala` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kategori_gejala` */

/*Table structure for table `tb_news` */

DROP TABLE IF EXISTS `tb_news`;

CREATE TABLE `tb_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(5) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `click` int(10) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `tb_news_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tb_admin` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_news` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user_gejala` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
