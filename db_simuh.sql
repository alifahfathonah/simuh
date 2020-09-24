/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.10-MariaDB-log : Database - db_simuh
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simuh` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_simuh`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jk` enum('laki-laki','perempuan') DEFAULT NULL,
  `id_alamat` int(11) DEFAULT NULL,
  `no_tlp` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id_admin`,`nama`,`jk`,`id_alamat`,`no_tlp`,`status`,`username`,`password`) values 
(1,'Seftian Andy','laki-laki',0,'09899',1,'admin','d82a7cdd77a2be109dd6e7521b3e1234');

/*Table structure for table `tb_alamat` */

DROP TABLE IF EXISTS `tb_alamat`;

CREATE TABLE `tb_alamat` (
  `id_alamat` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_alamat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_alamat` */

/*Table structure for table `tb_bonus_mitra` */

DROP TABLE IF EXISTS `tb_bonus_mitra`;

CREATE TABLE `tb_bonus_mitra` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_bonus_mitra` varchar(50) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `sumber` varchar(50) DEFAULT NULL,
  `jamaah_pendaftar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_bonus_mitra` */

/*Table structure for table `tb_bukti_transfer` */

DROP TABLE IF EXISTS `tb_bukti_transfer`;

CREATE TABLE `tb_bukti_transfer` (
  `id_bukti_transfer` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) DEFAULT NULL,
  `bukti_transfer` text,
  `tgl` date DEFAULT NULL,
  PRIMARY KEY (`id_bukti_transfer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_bukti_transfer` */

insert  into `tb_bukti_transfer`(`id_bukti_transfer`,`id_user`,`bukti_transfer`,`tgl`) values 
(1,'USR532718449501','22092020024145WhatsApp Image 2020-09-19 at 06.42.03.jpeg','2020-09-22'),
(2,'USR871656793223','23092020031123WhatsApp Image 2020-09-19 at 06.42.03.jpeg','2020-09-23'),
(3,'USR938570968073','23092020124011bukti.jpeg','2020-09-23');

/*Table structure for table `tb_detail_harga` */

DROP TABLE IF EXISTS `tb_detail_harga`;

CREATE TABLE `tb_detail_harga` (
  `id_detail_harga` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) DEFAULT NULL,
  `harga_mitra` int(11) DEFAULT NULL,
  `harga_umum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_harga`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_harga` */

insert  into `tb_detail_harga`(`id_detail_harga`,`id_paket`,`harga_mitra`,`harga_umum`) values 
(1,1,4,4),
(2,2,30000000,35000000);

/*Table structure for table `tb_detail_paket` */

DROP TABLE IF EXISTS `tb_detail_paket`;

CREATE TABLE `tb_detail_paket` (
  `id_detail_paket` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) DEFAULT NULL,
  `id_maskapai` int(11) DEFAULT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_paket` */

insert  into `tb_detail_paket`(`id_detail_paket`,`id_paket`,`id_maskapai`,`id_kamar`) values 
(1,1,1,1),
(2,2,2,2),
(3,NULL,NULL,NULL),
(4,NULL,NULL,NULL),
(5,NULL,NULL,NULL),
(6,NULL,NULL,NULL);

/*Table structure for table `tb_detail_paket_hotel` */

DROP TABLE IF EXISTS `tb_detail_paket_hotel`;

CREATE TABLE `tb_detail_paket_hotel` (
  `id_detail_paket_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_detail_paket` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_paket_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_paket_hotel` */

insert  into `tb_detail_paket_hotel`(`id_detail_paket_hotel`,`id_detail_paket`,`id_hotel`) values 
(1,1,1),
(2,1,2),
(3,2,1),
(4,2,2),
(5,3,NULL),
(6,3,NULL),
(7,4,NULL),
(8,4,NULL),
(9,5,NULL),
(10,5,NULL),
(11,6,NULL),
(12,6,NULL);

/*Table structure for table `tb_hotel` */

DROP TABLE IF EXISTS `tb_hotel`;

CREATE TABLE `tb_hotel` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_hotel` */

insert  into `tb_hotel`(`id_hotel`,`nama`,`lokasi`) values 
(1,'Andalus','Makkah'),
(2,'Pulman Zamzam Madina','Madina'),
(3,'Hotel makkah','Makkah'),
(4,'Hotel madina','Madina');

/*Table structure for table `tb_jamaah` */

DROP TABLE IF EXISTS `tb_jamaah`;

CREATE TABLE `tb_jamaah` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_jamaah` varchar(50) DEFAULT NULL,
  `id_user` varbinary(50) DEFAULT NULL,
  `jenis_pendaftaran` enum('haji','umroh') DEFAULT NULL,
  `keberangkatan` varchar(50) DEFAULT NULL,
  `status` enum('meninggal','digantikan') DEFAULT NULL,
  `approval` enum('disetujui','ditolak','menunggu') DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jamaah` */

insert  into `tb_jamaah`(`no`,`id_jamaah`,`id_user`,`jenis_pendaftaran`,`keberangkatan`,`status`,`approval`,`tgl_daftar`,`id_paket`) values 
(1,'HAJ551786433840','USR532718449501','haji',NULL,NULL,'menunggu','2020-09-22',2),
(2,'UMR767503429861','USR871656793223','haji',NULL,NULL,'menunggu','2020-09-23',1),
(3,'HAJ487248520760','USR938570968073','haji',NULL,NULL,'menunggu','2020-09-23',2);

/*Table structure for table `tb_kamar` */

DROP TABLE IF EXISTS `tb_kamar`;

CREATE TABLE `tb_kamar` (
  `id_kamar` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_kamar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kamar` */

insert  into `tb_kamar`(`id_kamar`,`tipe_kamar`) values 
(1,'Single Bed'),
(2,'Double Bed'),
(3,'Triple Bed');

/*Table structure for table `tb_keberangkatan` */

DROP TABLE IF EXISTS `tb_keberangkatan`;

CREATE TABLE `tb_keberangkatan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_keberangkatan` varchar(50) DEFAULT NULL,
  `id_jamaah` varchar(50) DEFAULT NULL,
  `tgl_keberangkatan` date DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_keberangkatan` */

/*Table structure for table `tb_kepulangan` */

DROP TABLE IF EXISTS `tb_kepulangan`;

CREATE TABLE `tb_kepulangan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_kepulangan` varchar(50) DEFAULT NULL,
  `id_jamaah` varchar(50) DEFAULT NULL,
  `tgl_kepulangan` date DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kepulangan` */

/*Table structure for table `tb_khas` */

DROP TABLE IF EXISTS `tb_khas`;

CREATE TABLE `tb_khas` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_khas` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_khas` */

/*Table structure for table `tb_maskapai` */

DROP TABLE IF EXISTS `tb_maskapai`;

CREATE TABLE `tb_maskapai` (
  `id_maskapai` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_maskapai`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_maskapai` */

insert  into `tb_maskapai`(`id_maskapai`,`nama`) values 
(1,'Lion Air'),
(2,'Garuda Air'),
(3,'Batik Air');

/*Table structure for table `tb_paket` */

DROP TABLE IF EXISTS `tb_paket`;

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `bintang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_paket` */

insert  into `tb_paket`(`id_paket`,`nama`,`lama`,`bintang`) values 
(1,'rer',4,4),
(2,'haji ++',19,4);

/*Table structure for table `tb_passport` */

DROP TABLE IF EXISTS `tb_passport`;

CREATE TABLE `tb_passport` (
  `id_passport` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) DEFAULT NULL,
  `no_passport` varchar(100) DEFAULT NULL,
  `tgl_dikeluarkan` date DEFAULT NULL,
  `tempat_dikeluarkan` text,
  `berlaku_start` date DEFAULT NULL,
  `berlaku_end` date DEFAULT NULL,
  PRIMARY KEY (`id_passport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_passport` */

/*Table structure for table `tb_pembayaran` */

DROP TABLE IF EXISTS `tb_pembayaran`;

CREATE TABLE `tb_pembayaran` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembayaran` varchar(50) DEFAULT NULL,
  `id_jamaah` varchar(50) DEFAULT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `status` enum('lunas','belum') DEFAULT NULL,
  `approval` enum('sudah','belum') DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `bukti_pembayaran` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pembayaran` */

/*Table structure for table `tb_pengeluaran_khas` */

DROP TABLE IF EXISTS `tb_pengeluaran_khas`;

CREATE TABLE `tb_pengeluaran_khas` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengeluaran_khas` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tgl_pengeluaran` date DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengeluaran_khas` */

/*Table structure for table `tb_penukaran_bonus` */

DROP TABLE IF EXISTS `tb_penukaran_bonus`;

CREATE TABLE `tb_penukaran_bonus` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_penukaran_bonus` varchar(50) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `id_bonus` varchar(50) DEFAULT NULL,
  `tot_diajukan` int(11) DEFAULT NULL,
  `tot_approval` int(11) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_penukaran_bonus` */

/*Table structure for table `tb_pewarisan_jamaah` */

DROP TABLE IF EXISTS `tb_pewarisan_jamaah`;

CREATE TABLE `tb_pewarisan_jamaah` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_jamaah` varchar(50) DEFAULT NULL,
  `id_user_kepala` varchar(50) DEFAULT NULL,
  `id_user_pewaris` varchar(50) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pewarisan_jamaah` */

/*Table structure for table `tb_sumber_khas` */

DROP TABLE IF EXISTS `tb_sumber_khas`;

CREATE TABLE `tb_sumber_khas` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_sumber_khas` varchar(50) DEFAULT NULL,
  `id_khas` varchar(50) DEFAULT NULL,
  `sumber` text,
  `total` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_sumber_khas` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(15) DEFAULT NULL,
  `id_head_user` varchar(15) DEFAULT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` text,
  `jk` enum('laki-laki','perempuan') DEFAULT NULL,
  `foto` text,
  `ktp` text,
  `mitra_status` enum('mitra','nonmitra') DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`no`,`id_user`,`id_head_user`,`no_ktp`,`nama`,`tanggal_lahir`,`tempat_lahir`,`jk`,`foto`,`ktp`,`mitra_status`,`no_tlp`,`email`,`password`) values 
(1,'USR532718449501','1','091888277899','seftian andy',NULL,NULL,'laki-laki','22092020024145WhatsApp Image 2020-09-19 at 06.42.03.jpeg','22092020024145WhatsApp Image 2020-09-19 at 06.42.03.jpeg','nonmitra','08991122455','seftianandy45@gmail.com',NULL),
(2,'USR871656793223','1','829991881918','Dera Diningsih',NULL,NULL,'perempuan','23092020031123600 x 800.jpg','23092020031123umroh.jpeg','nonmitra','78882822222','seftianandy45@gmail.com',NULL),
(3,'USR938570968073','1','444434223423432','Ari Dian',NULL,NULL,'laki-laki','23092020124011600 x 800.jpg','23092020124011ktp.jpeg','nonmitra','08991122455','seftianandy45@gmail.com',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
