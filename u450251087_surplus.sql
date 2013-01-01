
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2012 at 10:29 AM
-- Server version: 5.1.66
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u450251087_surplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE IF NOT EXISTS `jenis` (
  `kode_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kode_jenis`, `nama_jenis`) VALUES
(1, 'sosial'),
(2, 'rumah tangga'),
(3, 'instansi'),
(4, 'niaga'),
(5, 'industri'),
(6, 'lain');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `kode_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode_kecamatan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`kode_kecamatan`, `nama_kecamatan`) VALUES
(1, 'Banyumanik'),
(2, 'Candisari'),
(3, 'Gajahmungkur'),
(4, 'Gayamsari'),
(5, 'Genuk'),
(6, 'Gunungpati'),
(7, 'Mijen'),
(8, 'Ngaliyan'),
(9, 'Pedurungan'),
(10, 'Semarang Barat'),
(11, 'Semarang Selatan'),
(12, 'Semarang Tengah'),
(13, 'Semarang Timur'),
(14, 'Semarang Utara'),
(15, 'Tembalang'),
(16, 'Tugu');

-- --------------------------------------------------------

--
-- Table structure for table `surplus_admin`
--

CREATE TABLE IF NOT EXISTS `surplus_admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surplus_admin`
--

INSERT INTO `surplus_admin` (`username`, `password`, `last_login_time`) VALUES
('admin', '8625d264595d742b8e79fac6df213f8fccf03f1e7c1ee8aeb2dfbf35af09922e', '2012-12-26 08:02:26'),
('p1r473', '8625d264595d742b8e79fac6df213f8fccf03f1e7c1ee8aeb2dfbf35af09922e', '2012-12-25 16:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `surplus_konsumen`
--

CREATE TABLE IF NOT EXISTS `surplus_konsumen` (
  `kode_konsumen` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_konsumen` varchar(60) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kode_kecamatan` int(11) DEFAULT NULL,
  `jenis` int(11) DEFAULT '6',
  `kebutuhan_air` double DEFAULT NULL,
  `okupansi` double DEFAULT NULL,
  PRIMARY KEY (`kode_konsumen`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `surplus_konsumen`
--

INSERT INTO `surplus_konsumen` (`kode_konsumen`, `nama_konsumen`, `alamat`, `kode_kecamatan`, `jenis`, `kebutuhan_air`, `okupansi`) VALUES
(3, 'joko', 'genuk indah', 5, 4, 500, 15),
(7, 'ujang', 'jl borokokok', 2, 4, 350, 5),
(8, 'aji', 'mbuh', 1, 2, 50, 30),
(13, 'tes', 'asdasd', 1, 1, 200, 60),
(14, 'Legiman', 'JL. Gondangan no.15', 3, 2, 30, 10),
(15, 'Agung', 'JL. Lemah Gempal 4 no.9', 10, 1, 50, 15),
(16, 'Adit', 'JL. Lemah Gempal 5 no.19', 10, 1, 150, 15),
(17, 'Indra', 'JL. Bulu Stalan 4 no.20', 10, 2, 100, 10),
(18, 'Nia Kurnia', 'JL. Suyudono no13', 10, 2, 120, 10),
(19, 'Sinta Irawati', 'JL. Manokwari no.66', 1, 1, 200, 20),
(20, 'Gendon Prakos', 'JL. Somali no.33', 1, 4, 250, 15),
(21, 'Agus Salim', 'JL. Lemah Gempal 4 no.6', 10, 1, 20, 20),
(22, 'Aminudin', 'JL. Suyudono no.14', 10, 2, 200, 15),
(23, 'Saripah', 'JL. Kamulipan no.30', 12, 6, 300, 30),
(24, 'Endika', 'JL. Bulu Stalan 4 no.22', 10, 2, 250, 15),
(25, 'Galuh Pangkali', 'JL. Sego Makmur no.9', 16, 1, 175, 20),
(26, 'Junaedi', 'JL. Sego Makmur no.7', 16, 1, 250, 15),
(27, 'Sumiyati', 'JL. Gondola no.16', 15, 2, 140, 15),
(28, 'Firza Wijoyo', 'JL. Lemah Gempal 4 no.8', 10, 2, 200, 15),
(29, 'Danisia', 'JL. Pelajar no.20', 9, 4, 200, 20),
(30, 'Maya Septi', 'JL. Bulu Stalan 4 no.25', 10, 2, 200, 20),
(31, 'Panji', 'JL. Suyudono no.20', 10, 5, 400, 40),
(32, 'Joni', 'JL.Menoreh no.46', 8, 2, 250, 10),
(33, 'Sony Dwi', 'JL.pemuda no.8', 12, 1, 150, 15),
(34, 'Sanita', 'JL. sadewa no.5', 12, 2, 150, 15),
(35, 'Dwiyan', 'JL. sadewa no.14', 12, 5, 400, 45),
(36, 'Doyok', 'JL. Sumbodro', 12, 2, 200, 15),
(37, 'Andre', 'JL. Lemah Gempal 7 no.2', 10, 2, 200, 20),
(38, 'Sumiyem', 'Jl. Somplak no.55', 12, 5, 450, 30),
(39, 'Julian', 'JL. Tanahireng no.4', 11, 1, 250, 20),
(40, 'Sumaidin', 'JL. sadewa no.22', 12, 2, 150, 5),
(41, 'Watiyem', 'JL. Pelajar no.16', 13, 6, 370, 20),
(42, 'Harada', 'JL. Bima no.20', 14, 3, 500, 75),
(43, 'Ganta Wijaya', 'JL. Bima no.50', 14, 3, 250, 50),
(44, 'Wijayo', 'JL. Flamboyan no.56', 14, 2, 350, 75),
(45, 'Fandi', 'JL. Bima no.24', 14, 4, 300, 70),
(46, 'Saliyem', 'JL. Sego Makmur no.14', 16, 6, 375, 55),
(47, 'Anna', 'JL. Lemah Gempal 7 no.4', 10, 2, 250, 40),
(48, 'Widodo', 'JL. Pelajar no.18', 12, 5, 500, 80);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
