-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2026 at 02:05 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lecttrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', '2025-11-20 20:41:33', '2025-11-20 20:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lecturer_id` int UNSIGNED DEFAULT NULL,
  `date_submit` date NOT NULL,
  `date_end` date NOT NULL,
  `selection` varchar(50) NOT NULL,
  `time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lecturer` (`lecturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=364 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `lecturer_id`, `date_submit`, `date_end`, `selection`, `time`, `location`, `remarks`) VALUES
(24, 112, '2025-10-12', '2025-10-13', 'PROGRAM', '09:15:00', 'Putrajaya', 'Training session'),
(15, 1, '2025-11-19', '2025-11-20', 'MESYUARAT', '03:05:00', 'Georgtown', 'meeting'),
(14, 6, '2025-11-20', '2025-11-22', 'PROGRAM', '03:04:00', 'Kuala Lumpur', 'meeting'),
(13, 9, '2025-11-19', '2025-11-20', 'MESYUARAT', '04:42:00', 'KVBP', 'bercuti'),
(12, 1, '2025-11-19', '2025-11-19', 'MESYUARAT', '03:26:00', 'Kuala Lumpur', 'meeting'),
(25, 112, '2025-09-30', '2025-10-01', 'OTHERS', '14:20:00', 'Johor Bahru', 'Family matters'),
(18, 111, '2025-11-19', '2025-11-21', 'MESYUARAT', '11:02:00', 'Kuala Lumpur', 'meeting'),
(19, 109, '2025-11-19', '2025-11-20', 'PROGRAM', '21:53:00', 'KV mas', 'meeting'),
(20, 112, '2025-11-19', '2025-11-22', 'OTHERS', '22:57:00', 'KVBP', 'makan ii'),
(21, 112, '2025-11-05', '2025-11-08', 'CUTI(MC)', '13:23:00', 'KVBP', 'sakit'),
(22, 112, '2025-11-28', '2025-11-29', 'MESYUARAT', '16:52:00', 'Balik Pulau', 'meeting'),
(44, 112, '2025-12-17', '2025-12-27', 'MESYUARAT', '00:37:00', 'kv', 'test'),
(26, 112, '2025-11-10', '2025-11-12', 'MESYUARAT', '11:45:00', 'KVBP', 'meeting with HQ'),
(27, 112, '2025-12-01', '2025-12-01', 'CUTI(MC)', '08:00:00', 'Home', 'sick leave'),
(28, 112, '2025-11-20', '2025-11-29', 'PROGRAM', '09:39:00', 'Balik Pulau', 'makan blik pulau'),
(29, 112, '2025-11-20', '2025-11-22', 'PROGRAM', '10:05:00', 'Sg Ara', 'makan ii'),
(30, 113, '2025-11-20', '2025-11-22', 'OTHERS', '10:28:00', 'Palestine', 'Bagi makan orang'),
(31, 108, '2025-11-20', '2025-11-27', 'MESYUARAT', '12:37:00', 'Bayan Lepas', 'Meeting Perdana'),
(32, 108, '2025-11-20', '2025-11-25', 'OTHERS', '12:38:00', 'Georgtown', 'Majlis Perpisahan'),
(33, 108, '2025-11-20', '2025-11-15', 'CUTI(MC)', '12:40:00', 'Pahang', 'Bagi makan orang'),
(34, 114, '2025-11-21', '2025-11-22', 'MESYUARAT', '02:38:00', 'Pahang', 'Jalan ii'),
(35, 116, '2025-11-22', '2025-11-22', 'MESYUARAT', '05:01:00', 'New York', 'meeting'),
(36, 113, '2025-11-21', '2025-11-26', 'PROGRAM', '10:11:00', 'Pahang', 'Meeting Perdana'),
(37, 116, '2025-11-26', '2025-11-28', 'PROGRAM', '20:47:00', 'Kajang', 'Meet and Great'),
(50, 116, '2025-12-13', '2025-12-13', 'CUTI(MC)', '20:16:00', 'Hospital Balik Pulau', 'sakit'),
(49, 112, '2025-12-13', '2025-12-13', 'MESYUARAT', '21:04:00', 'Pulau Jerejak', 'Meeting Perdana'),
(48, 112, '2025-12-08', '2025-12-08', 'MESYUARAT', '07:37:00', 'Termeloh', 'sakit'),
(41, 111, '2025-12-17', '2025-12-30', 'KURSUS/BENGKEL', '15:35:00', 'Sg Ara', 'makan ii'),
(42, 113, '2025-12-04', '2025-12-04', 'KURSUS/BENGKEL', '21:36:00', 'Kuala Lumpur', 'makan ii'),
(43, 112, '2025-12-04', '2025-12-04', 'MESYUARAT', '23:40:00', 'Georgtown', 'Sukan Badan Binasa'),
(45, 112, '2025-12-05', '2025-12-06', 'KURSUS/BENGKEL', '01:39:00', 'kolej', 'sakit'),
(46, 112, '2025-12-05', '2025-12-06', 'MESYUARAT', '12:42:00', 'amsyar', 'amsyar'),
(51, 116, '2025-12-13', '2025-12-13', 'OTHERS', '21:17:00', 'subang', 'jshs'),
(52, 111, '2025-12-13', '2025-12-13', 'MESYUARAT', '21:22:00', 'Kelang', 'nna'),
(53, 114, '2025-12-13', '2025-12-13', 'MESYUARAT', '23:02:00', 'Langkawi', 'masuri'),
(54, 113, '2025-12-14', '2025-12-14', 'CUTI(MC)', '15:56:00', 'New York', 'Jalan ii'),
(55, 113, '2025-12-14', '2025-12-14', 'MESYUARAT', '17:58:00', 'Balik Pulau', 'Bagi makan orang'),
(56, 101, '2025-02-03', '2025-02-03', 'MESYUARAT', '09:00:00', 'Kuala Lumpur', 'Meeting pentadbiran'),
(57, 102, '2025-02-05', '2025-02-06', 'PROGRAM', '10:15:00', 'Putrajaya', 'Program rasmi'),
(58, 103, '2025-02-07', '2025-02-07', 'OTHERS', '14:30:00', 'Bayan Lepas', 'Urusan peribadi'),
(59, 104, '2025-02-10', '2025-02-11', 'KURSUS/BENGKEL', '08:45:00', 'Johor Bahru', 'Kursus peningkatan'),
(60, 105, '2025-02-12', '2025-02-12', 'MESYUARAT', '11:00:00', 'Georgetown', 'Mesyuarat dalaman'),
(61, 106, '2025-02-15', '2025-02-15', 'CUTI(MC)', '09:20:00', 'Hospital Pulau Pinang', 'Demam'),
(62, 107, '2025-02-18', '2025-02-19', 'PROGRAM', '13:10:00', 'Ipoh', 'Program akademik'),
(63, 108, '2025-02-21', '2025-02-21', 'MESYUARAT', '16:40:00', 'Alor Setar', 'Mesyuarat zon'),
(64, 109, '2025-02-25', '2025-02-25', 'OTHERS', '10:00:00', 'Kangar', 'Urusan rasmi'),
(65, 110, '2025-05-03', '2025-05-03', 'MESYUARAT', '09:30:00', 'Seremban', 'Mesyuarat bulanan'),
(66, 111, '2025-05-07', '2025-05-08', 'PROGRAM', '10:00:00', 'Melaka', 'Program komuniti'),
(67, 112, '2025-05-10', '2025-05-10', 'OTHERS', '14:15:00', 'Muar', 'Urusan keluarga'),
(68, 113, '2025-05-14', '2025-05-15', 'KURSUS/BENGKEL', '08:30:00', 'Shah Alam', 'Bengkel ICT'),
(69, 114, '2025-05-18', '2025-05-18', 'MESYUARAT', '11:45:00', 'Klang', 'Mesyuarat khas'),
(70, 115, '2025-05-25', '2025-05-25', 'CUTI(MC)', '09:00:00', 'Klinik Kesihatan', 'Sakit perut'),
(71, 116, '2025-12-17', '2025-12-17', 'MESYUARAT', '08:00:00', 'KVBP', 'Mesyuarat akhir tahun'),
(72, 117, '2025-12-17', '2025-12-17', 'PROGRAM', '09:15:00', 'Putrajaya', 'Program penutup'),
(73, 118, '2025-12-17', '2025-12-17', 'OTHERS', '10:30:00', 'Bangi', 'Urusan rasmi'),
(74, 119, '2025-12-17', '2025-12-17', 'MESYUARAT', '11:45:00', 'Cyberjaya', 'Mesyuarat projek'),
(75, 120, '2025-12-17', '2025-12-17', 'KURSUS/BENGKEL', '13:00:00', 'Kajang', 'Latihan dalaman'),
(76, 121, '2025-12-17', '2025-12-17', 'PROGRAM', '14:30:00', 'Serdang', 'Program pelajar'),
(77, 122, '2025-12-17', '2025-12-17', 'MESYUARAT', '15:45:00', 'Ampang', 'Mesyuarat khas'),
(78, 123, '2025-12-17', '2025-12-17', 'OTHERS', '16:30:00', 'Gombak', 'Urusan luar'),
(79, 124, '2025-12-17', '2025-12-17', 'MESYUARAT', '17:15:00', 'Rawang', 'Mesyuarat petang'),
(80, 125, '2025-12-17', '2025-12-17', 'CUTI(MC)', '09:00:00', 'Hospital Selayang', 'Sakit kepala'),
(81, 155, '2025-12-17', '2025-12-17', 'MESYUARAT', '00:36:00', 'KVBP', 'Meeting Perdana'),
(82, 155, '2025-12-17', '2025-12-17', 'KURSUS/BENGKEL', '02:43:00', 'Kuala Lumpur', 'sakit'),
(83, 155, '2025-12-17', '2025-12-17', 'KURSUS/BENGKEL', '01:54:00', 'KVBP', 'Meeting Perdana'),
(84, 123, '2025-12-17', '2025-12-17', 'KURSUS/BENGKEL', '00:57:00', 'KV mas', 'Bagi makan orang'),
(85, 124, '2025-12-18', '2025-12-18', 'MESYUARAT', '09:51:00', 'Kubang Semang', 'makan'),
(86, 128, '2025-12-18', '2025-12-18', 'CUTI(MC)', '09:53:00', 'Hospital', 'saja'),
(87, 167, '2025-12-18', '2025-12-18', 'CUTI(MC)', '09:55:00', 'LA', 'test drive'),
(88, 1, '2026-01-05', '2026-01-05', 'MESYUARAT', '09:00:00', 'KVBP', 'Mesyuarat Awal Tahun'),
(89, 6, '2026-01-05', '2026-01-06', 'PROGRAM', '10:30:00', 'Putrajaya', 'Program Transformasi'),
(90, 9, '2026-01-06', '2026-01-06', 'KURSUS/BENGKEL', '08:00:00', 'Kuala Lumpur', 'Bengkel ICT'),
(91, 101, '2026-01-07', '2026-01-07', 'MESYUARAT', '14:00:00', 'Bilik Gerakan', 'Perancangan Strategik'),
(92, 102, '2026-01-08', '2026-01-08', 'CUTI(MC)', '09:00:00', 'Klinik', 'Demam'),
(93, 103, '2026-01-10', '2026-01-12', 'PROGRAM', '08:30:00', 'Pulau Pinang', 'Kem Kepimpinan'),
(94, 104, '2026-01-12', '2026-01-12', 'MESYUARAT', '11:00:00', 'KVBP', 'Mesyuarat Jabatan'),
(95, 105, '2026-01-13', '2026-01-13', 'OTHERS', '15:00:00', 'Georgetown', 'Urusan Bank'),
(96, 106, '2026-01-14', '2026-01-15', 'KURSUS/BENGKEL', '09:00:00', 'Ipoh', 'Kursus Pedagogi'),
(97, 107, '2026-01-15', '2026-01-15', 'MESYUARAT', '10:00:00', 'KVBP', 'Taklimat Peperiksaan'),
(98, 108, '2026-01-16', '2026-01-16', 'CUTI(MC)', '08:30:00', 'Hospital', 'Rawatan Susulan'),
(99, 109, '2026-01-19', '2026-01-19', 'PROGRAM', '09:00:00', 'Balik Pulau', 'Program Motivasi'),
(100, 110, '2026-01-20', '2026-01-20', 'MESYUARAT', '14:30:00', 'KVBP', 'Mesyuarat Disiplin'),
(101, 111, '2026-01-21', '2026-01-22', 'KURSUS/BENGKEL', '08:00:00', 'Shah Alam', 'Latihan Teknikal'),
(102, 112, '2026-01-22', '2026-01-22', 'OTHERS', '11:00:00', 'Kangar', 'Urusan Rasmi JPW'),
(103, 113, '2026-01-23', '2026-01-23', 'MESYUARAT', '09:30:00', 'KVBP', 'Mesyuarat Kewangan'),
(104, 114, '2026-01-26', '2026-01-26', 'PROGRAM', '08:00:00', 'Alor Setar', 'Program Sukan'),
(105, 115, '2026-01-27', '2026-01-27', 'CUTI(MC)', '10:00:00', 'Rumah', 'Selesema'),
(106, 116, '2026-01-28', '2026-01-29', 'KURSUS/BENGKEL', '09:00:00', 'Melaka', 'Bengkel Penulisan'),
(107, 117, '2026-01-29', '2026-01-29', 'MESYUARAT', '15:00:00', 'KVBP', 'Post-Mortem Program'),
(108, 118, '2026-01-30', '2026-01-30', 'OTHERS', '08:30:00', 'Bayan Lepas', 'Ziarah Kebajikan'),
(109, 119, '2026-01-05', '2026-01-05', 'MESYUARAT', '09:00:00', 'KVBP', 'Unit Mesyuarat'),
(110, 120, '2026-01-06', '2026-01-06', 'PROGRAM', '10:00:00', 'KVBP', 'Perhimpunan Rasmi'),
(111, 121, '2026-01-07', '2026-01-07', 'OTHERS', '14:00:00', 'Balik Pulau', 'Urusan Luar'),
(112, 122, '2026-01-08', '2026-01-08', 'KURSUS/BENGKEL', '08:00:00', 'KVBP', 'Internal Sharing'),
(113, 123, '2026-01-09', '2026-01-09', 'MESYUARAT', '11:00:00', 'KVBP', 'AJK Kantin'),
(114, 124, '2026-01-12', '2026-01-12', 'CUTI(MC)', '09:00:00', 'Klinik Kesihatan', 'Sakit Kepala'),
(115, 125, '2026-01-13', '2026-01-13', 'PROGRAM', '08:30:00', 'KVBP', 'Latihan Kebakaran'),
(116, 155, '2026-01-14', '2026-01-14', 'MESYUARAT', '14:00:00', 'Cyberjaya', 'Meeting HQ'),
(117, 167, '2026-01-15', '2026-01-15', 'OTHERS', '10:00:00', 'KVBP', 'Pantau Projek'),
(118, 1, '2026-01-16', '2026-01-16', 'KURSUS/BENGKEL', '08:30:00', 'Kuala Lumpur', 'HRMIS Training'),
(119, 6, '2026-01-19', '2026-01-19', 'MESYUARAT', '09:00:00', 'KVBP', 'Mesyuarat ISO'),
(120, 9, '2026-01-20', '2026-01-20', 'PROGRAM', '10:00:00', 'Putrajaya', 'Majlis Anugerah'),
(121, 101, '2026-01-21', '2026-01-21', 'CUTI(MC)', '08:00:00', 'Rumah', 'Rehat'),
(122, 112, '2026-01-22', '2026-01-23', 'PROGRAM', '09:00:00', 'Batu Kawan', 'Ekspo Kerjaya'),
(123, 113, '2026-01-26', '2026-01-26', 'MESYUARAT', '14:00:00', 'KVBP', 'Unit Kokurikulum'),
(124, 114, '2026-01-27', '2026-01-27', 'OTHERS', '11:00:00', 'Balik Pulau', 'Urusan Peribadi'),
(125, 116, '2026-01-28', '2026-01-28', 'KURSUS/BENGKEL', '08:30:00', 'KVBP', 'Bengkel OBE'),
(126, 125, '2026-01-29', '2026-01-29', 'MESYUARAT', '10:00:00', 'KVBP', 'AJK Surau'),
(127, 155, '2026-01-30', '2026-01-30', 'PROGRAM', '09:00:00', 'KVBP', 'Gotong Royong'),
(128, 1, '2026-02-02', '2026-02-02', 'MESYUARAT', '09:00:00', 'KVBP', 'Mesyuarat Bulanan'),
(129, 6, '2026-02-03', '2026-02-03', 'PROGRAM', '08:30:00', 'KVBP', 'Hari Terbuka'),
(130, 9, '2026-02-04', '2026-02-04', 'OTHERS', '14:00:00', 'Bayan Lepas', 'Urusan JPW'),
(131, 101, '2026-02-05', '2026-02-05', 'KURSUS/BENGKEL', '09:00:00', 'KVBP', 'Latihan Dalaman'),
(132, 102, '2026-02-06', '2026-02-06', 'CUTI(MC)', '08:00:00', 'Klinik', 'Sakit Perut'),
(133, 103, '2026-02-09', '2026-02-09', 'MESYUARAT', '11:00:00', 'KVBP', 'AJK Disiplin'),
(134, 104, '2026-02-10', '2026-02-11', 'PROGRAM', '08:00:00', 'Kajang', 'Kem Kepimpinan'),
(135, 105, '2026-02-11', '2026-02-11', 'OTHERS', '15:00:00', 'KVBP', 'Urusan Stor'),
(136, 106, '2026-02-12', '2026-02-12', 'MESYUARAT', '09:30:00', 'KVBP', 'Mesyuarat HEM'),
(137, 107, '2026-02-13', '2026-02-13', 'CUTI(MC)', '08:30:00', 'Hospital', 'Checkup'),
(138, 108, '2026-02-16', '2026-02-16', 'PROGRAM', '09:00:00', 'KVBP', 'Minggu Akademik'),
(139, 109, '2026-02-17', '2026-02-17', 'KURSUS/BENGKEL', '10:00:00', 'Seremban', 'Bengkel Teknikal'),
(140, 110, '2026-02-18', '2026-02-18', 'MESYUARAT', '14:00:00', 'KVBP', 'Unit Peperiksaan'),
(141, 111, '2026-02-19', '2026-02-19', 'OTHERS', '11:00:00', 'Putrajaya', 'Taklimat KPM'),
(142, 112, '2026-02-20', '2026-02-20', 'PROGRAM', '08:30:00', 'KVBP', 'Hari Sukan'),
(143, 113, '2026-02-23', '2026-02-23', 'MESYUARAT', '09:00:00', 'KVBP', 'Mesyuarat Kurikulum'),
(144, 114, '2026-02-24', '2026-02-24', 'CUTI(MC)', '10:00:00', 'Klinik', 'Migrain'),
(145, 115, '2026-02-25', '2026-02-26', 'KURSUS/BENGKEL', '08:00:00', 'Melaka', 'Kursus Integriti'),
(146, 116, '2026-02-26', '2026-02-26', 'MESYUARAT', '15:00:00', 'KVBP', 'AJK Kebajikan'),
(147, 117, '2026-02-27', '2026-02-27', 'OTHERS', '08:30:00', 'Balik Pulau', 'Urusan Luar'),
(148, 118, '2026-02-02', '2026-02-02', 'MESYUARAT', '14:00:00', 'KVBP', 'Unit ICT'),
(149, 119, '2026-02-03', '2026-02-03', 'PROGRAM', '09:00:00', 'KVBP', 'Pelancaran Bulan Bahasa'),
(150, 120, '2026-02-04', '2026-02-04', 'CUTI(MC)', '08:00:00', 'Rumah', 'Demam Panas'),
(151, 121, '2026-02-05', '2026-02-05', 'KURSUS/BENGKEL', '09:00:00', 'KVBP', 'Micro-teaching'),
(152, 122, '2026-02-06', '2026-02-06', 'MESYUARAT', '10:30:00', 'KVBP', 'Mesyuarat Kantin'),
(153, 123, '2026-02-09', '2026-02-09', 'OTHERS', '11:00:00', 'Georgetown', 'Hantar Dokumen'),
(154, 124, '2026-02-10', '2026-02-10', 'PROGRAM', '08:00:00', 'KVBP', 'Latihan Nasyid'),
(155, 125, '2026-02-11', '2026-02-11', 'MESYUARAT', '14:00:00', 'KVBP', 'Unit Perpustakaan'),
(156, 155, '2026-02-12', '2026-02-12', 'CUTI(MC)', '09:00:00', 'Klinik Kesihatan', 'Sakit Kaki'),
(157, 167, '2026-02-13', '2026-02-13', 'PROGRAM', '09:00:00', 'KVBP', 'Tayangan Video'),
(158, 101, '2026-02-16', '2026-02-16', 'KURSUS/BENGKEL', '08:30:00', 'Kuala Lumpur', 'Digital Learning'),
(159, 112, '2026-02-17', '2026-02-17', 'MESYUARAT', '10:00:00', 'KVBP', 'AJK Audit'),
(160, 113, '2026-02-18', '2026-02-18', 'OTHERS', '15:00:00', 'Balik Pulau', 'Urusan Kenderaan'),
(161, 114, '2026-02-19', '2026-02-19', 'PROGRAM', '09:00:00', 'KVBP', 'Ceramah Agama'),
(162, 115, '2026-02-20', '2026-02-20', 'MESYUARAT', '08:30:00', 'KVBP', 'Mesyuarat Guru'),
(163, 1, '2026-01-02', '2026-01-02', 'MESYUARAT', '08:00:00', 'KVBP', 'Persediaan Bilik Darjah'),
(164, 6, '2026-01-02', '2026-01-02', 'PROGRAM', '08:30:00', 'KVBP', 'Pendaftaran Pelajar'),
(165, 9, '2026-01-02', '2026-01-02', 'OTHERS', '09:00:00', 'Balik Pulau', 'Urusan Bank'),
(166, 101, '2026-01-02', '2026-01-02', 'KURSUS/BENGKEL', '09:15:00', 'KVBP', 'Latihan Dalaman'),
(167, 102, '2026-01-02', '2026-01-02', 'MESYUARAT', '09:30:00', 'Bilik Gerakan', 'Mesyuarat Unit'),
(168, 103, '2026-01-02', '2026-01-02', 'CUTI(MC)', '08:00:00', 'Klinik', 'Sakit Perut'),
(169, 104, '2026-01-02', '2026-01-02', 'PROGRAM', '10:00:00', 'KVBP', 'Taklimat Disiplin'),
(170, 105, '2026-01-02', '2026-01-02', 'OTHERS', '10:30:00', 'Pejabat Pos', 'Urusan Surat'),
(171, 106, '2026-01-02', '2026-01-02', 'MESYUARAT', '11:00:00', 'KVBP', 'Mesyuarat Panitia'),
(172, 107, '2026-01-02', '2026-01-02', 'KURSUS/BENGKEL', '11:30:00', 'Online', 'Webinar Google'),
(173, 108, '2026-01-02', '2026-01-02', 'PROGRAM', '12:00:00', 'Padang KV', 'Latihan Sukan'),
(174, 109, '2026-01-02', '2026-01-02', 'OTHERS', '14:00:00', 'KVBP', 'Kemas Fail'),
(175, 110, '2026-01-02', '2026-01-02', 'MESYUARAT', '14:30:00', 'KVBP', 'Mesyuarat Kantin'),
(176, 111, '2026-01-02', '2026-01-02', 'CUTI(MC)', '08:30:00', 'Rumah', 'Demam'),
(177, 112, '2026-01-02', '2026-01-02', 'PROGRAM', '15:00:00', 'KVBP', 'Gotong-royong'),
(178, 113, '2026-01-02', '2026-01-02', 'KURSUS/BENGKEL', '15:30:00', 'Lab 1', 'Bengkel Software'),
(179, 114, '2026-01-02', '2026-01-02', 'OTHERS', '16:00:00', 'KVBP', 'Susun Inventori'),
(180, 115, '2026-01-02', '2026-01-02', 'MESYUARAT', '08:45:00', 'KVBP', 'Unit Kokurikulum'),
(181, 116, '2026-01-02', '2026-01-02', 'PROGRAM', '09:45:00', 'KVBP', 'Ceramah Kerjaya'),
(182, 117, '2026-01-02', '2026-01-02', 'CUTI(MC)', '10:00:00', 'Hospital', 'Checkup Gigi'),
(183, 118, '2026-01-02', '2026-01-02', 'MESYUARAT', '11:15:00', 'KVBP', 'Mesyuarat ISO'),
(184, 119, '2026-01-02', '2026-01-02', 'KURSUS/BENGKEL', '13:00:00', 'KVBP', 'Taklimat OBE'),
(185, 120, '2026-01-02', '2026-01-02', 'OTHERS', '14:15:00', 'KVBP', 'Pantau Projek'),
(186, 121, '2026-01-02', '2026-01-02', 'PROGRAM', '15:45:00', 'KVBP', 'Raptai Perhimpunan'),
(187, 155, '2026-01-02', '2026-01-02', 'MESYUARAT', '16:30:00', 'KVBP', 'Unit Kebajikan'),
(188, 1, '2026-01-03', '2026-01-03', 'PROGRAM', '08:00:00', 'KVBP', 'Hari Orientasi'),
(189, 6, '2026-01-03', '2026-01-03', 'MESYUARAT', '08:10:00', 'KVBP', 'Mesyuarat Pagi'),
(190, 9, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '08:20:00', 'KVBP', 'Bengkel Teknikal'),
(191, 101, '2026-01-03', '2026-01-03', 'OTHERS', '08:30:00', 'KVBP', 'Urusan Stor'),
(192, 102, '2026-01-03', '2026-01-03', 'MESYUARAT', '08:40:00', 'KVBP', 'AJK Disiplin'),
(193, 103, '2026-01-03', '2026-01-03', 'PROGRAM', '08:50:00', 'KVBP', 'Sukaneka'),
(194, 104, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '09:00:00', 'KVBP', 'Latihan ICT'),
(195, 105, '2026-01-03', '2026-01-03', 'OTHERS', '09:10:00', 'KVBP', 'Kutipan Data'),
(196, 106, '2026-01-03', '2026-01-03', 'CUTI(MC)', '09:20:00', 'Klinik', 'Migrain'),
(197, 107, '2026-01-03', '2026-01-03', 'MESYUARAT', '09:30:00', 'KVBP', 'Mesyuarat Kewangan'),
(198, 108, '2026-01-03', '2026-01-03', 'PROGRAM', '09:40:00', 'KVBP', 'Kem Motivasi'),
(199, 109, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '09:50:00', 'Online', 'Kursus HRMIS'),
(200, 110, '2026-01-03', '2026-01-03', 'OTHERS', '10:00:00', 'KVBP', 'Urusan Pelajar'),
(201, 111, '2026-01-03', '2026-01-03', 'MESYUARAT', '10:10:00', 'KVBP', 'Unit HEM'),
(202, 112, '2026-01-03', '2026-01-03', 'PROGRAM', '10:20:00', 'KVBP', 'Majlis Doa Selamat'),
(203, 113, '2026-01-03', '2026-01-03', 'CUTI(MC)', '10:30:00', 'Rumah', 'Sakit Tekak'),
(204, 114, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '10:40:00', 'KVBP', 'Sharing Session'),
(205, 115, '2026-01-03', '2026-01-03', 'OTHERS', '10:50:00', 'KVBP', 'Pemeriksaan Aset'),
(206, 116, '2026-01-03', '2026-01-03', 'MESYUARAT', '11:00:00', 'KVBP', 'AJK Kantin'),
(207, 117, '2026-01-03', '2026-01-03', 'PROGRAM', '11:10:00', 'KVBP', 'Pameran Kerjaya'),
(208, 118, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '11:20:00', 'KVBP', 'Latihan Fire Drill'),
(209, 119, '2026-01-03', '2026-01-03', 'OTHERS', '11:30:00', 'KVBP', 'Lawatan Industri'),
(210, 120, '2026-01-03', '2026-01-03', 'MESYUARAT', '11:40:00', 'KVBP', 'Unit Jadual'),
(211, 121, '2026-01-03', '2026-01-03', 'PROGRAM', '11:50:00', 'KVBP', 'Ceramah Agama'),
(212, 122, '2026-01-03', '2026-01-03', 'CUTI(MC)', '12:00:00', 'Hospital', 'Checkup Bulanan'),
(213, 123, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '12:10:00', 'KVBP', 'Bengkel Pedagogi'),
(214, 124, '2026-01-03', '2026-01-03', 'OTHERS', '12:20:00', 'KVBP', 'Inventori Makmal'),
(215, 125, '2026-01-03', '2026-01-03', 'MESYUARAT', '12:30:00', 'KVBP', 'Unit ICT'),
(216, 155, '2026-01-03', '2026-01-03', 'PROGRAM', '12:40:00', 'KVBP', 'Majlis Persaraan'),
(217, 156, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '13:00:00', 'KVBP', 'Taklimat Keselamatan'),
(218, 157, '2026-01-03', '2026-01-03', 'OTHERS', '13:10:00', 'KVBP', 'Audit Dalaman'),
(219, 158, '2026-01-03', '2026-01-03', 'MESYUARAT', '13:20:00', 'KVBP', 'AJK Surau'),
(220, 159, '2026-01-03', '2026-01-03', 'PROGRAM', '13:30:00', 'KVBP', 'Minggu TVET'),
(221, 160, '2026-01-03', '2026-01-03', 'CUTI(MC)', '13:40:00', 'Rumah', 'Selesema'),
(222, 162, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '13:50:00', 'KVBP', 'Bengkel Excel'),
(223, 163, '2026-01-03', '2026-01-03', 'OTHERS', '14:00:00', 'KVBP', 'Siap Sedia Makmal'),
(224, 1, '2026-01-03', '2026-01-03', 'MESYUARAT', '14:10:00', 'KVBP', 'Post-Mortem Pendaftaran'),
(225, 6, '2026-01-03', '2026-01-03', 'PROGRAM', '14:20:00', 'KVBP', 'Sukan Petang'),
(226, 9, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '14:30:00', 'KVBP', 'Bengkel Adobe'),
(227, 101, '2026-01-03', '2026-01-03', 'OTHERS', '14:40:00', 'KVBP', 'Kemas Fail'),
(228, 102, '2026-01-03', '2026-01-03', 'MESYUARAT', '14:50:00', 'KVBP', 'AJK Kebajikan'),
(229, 103, '2026-01-03', '2026-01-03', 'PROGRAM', '15:00:00', 'KVBP', 'Aktiviti Kelab'),
(230, 104, '2026-01-03', '2026-01-03', 'CUTI(MC)', '15:10:00', 'Klinik', 'Sakit Mata'),
(231, 105, '2026-01-03', '2026-01-03', 'MESYUARAT', '15:20:00', 'KVBP', 'AJK Perpustakaan'),
(232, 106, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '15:30:00', 'KVBP', 'Latihan VLE'),
(233, 107, '2026-01-03', '2026-01-03', 'OTHERS', '15:40:00', 'KVBP', 'Servis PC'),
(234, 108, '2026-01-03', '2026-01-03', 'PROGRAM', '15:50:00', 'KVBP', 'Latihan Kawad'),
(235, 109, '2026-01-03', '2026-01-03', 'MESYUARAT', '16:00:00', 'KVBP', 'Unit Disiplin'),
(236, 110, '2026-01-03', '2026-01-03', 'KURSUS/BENGKEL', '16:10:00', 'Online', 'Bengkel Canva'),
(237, 111, '2026-01-03', '2026-01-03', 'OTHERS', '16:20:00', 'KVBP', 'Penyediaan Laporan'),
(238, 112, '2026-01-03', '2026-01-03', 'MESYUARAT', '16:30:00', 'KVBP', 'Unit Kaunseling'),
(239, 113, '2026-01-03', '2026-01-03', 'PROGRAM', '16:40:00', 'KVBP', 'Tayangan Video'),
(240, 114, '2026-01-03', '2026-01-03', 'CUTI(MC)', '16:50:00', 'Rumah', 'Sakit Belakang'),
(241, 115, '2026-01-03', '2026-01-03', 'OTHERS', '17:00:00', 'KVBP', 'Urusan Logistik'),
(242, 1, '2025-12-25', '2025-12-25', 'OTHERS', '09:00:00', 'KVBP', 'Persediaan Cuti'),
(243, 6, '2025-12-25', '2025-12-25', 'CUTI(MC)', '08:00:00', 'Klinik', 'Demam Selsema'),
(244, 9, '2025-12-26', '2025-12-26', 'PROGRAM', '10:00:00', 'KVBP', 'Majlis Kesyukuran'),
(245, 101, '2025-12-26', '2025-12-26', 'MESYUARAT', '14:00:00', 'KVBP', 'Mesyuarat Akhir Tahun'),
(246, 102, '2025-12-27', '2025-12-27', 'KURSUS/BENGKEL', '09:00:00', 'Hotel Seri Malaysia', 'Bengkel Pengurusan'),
(247, 103, '2025-12-27', '2025-12-27', 'OTHERS', '11:00:00', 'Georgetown', 'Urusan Jabatan'),
(248, 104, '2025-12-28', '2025-12-28', 'PROGRAM', '08:00:00', 'Padang KV', 'Latihan Kecergasan'),
(249, 105, '2025-12-28', '2025-12-28', 'CUTI(MC)', '10:00:00', 'Rumah', 'Migrain'),
(250, 106, '2025-12-29', '2025-12-29', 'MESYUARAT', '09:00:00', 'KVBP', 'Unit Kurikulum'),
(251, 107, '2025-12-29', '2025-12-29', 'KURSUS/BENGKEL', '14:00:00', 'Lab ICT', 'Training Networking'),
(252, 108, '2025-12-29', '2025-12-29', 'OTHERS', '15:30:00', 'KVBP', 'Servis Aset'),
(253, 109, '2025-12-30', '2025-12-30', 'PROGRAM', '09:00:00', 'KVBP', 'Gotong Royong Perdana'),
(254, 110, '2025-12-30', '2025-12-30', 'MESYUARAT', '11:00:00', 'KVBP', 'Mesyuarat Kokurikulum'),
(255, 111, '2025-12-30', '2025-12-30', 'CUTI(MC)', '08:30:00', 'Klinik Kesihatan', 'Checkup Jantung'),
(256, 112, '2025-12-30', '2025-12-30', 'OTHERS', '14:30:00', 'Putrajaya', 'Taklimat KPM'),
(257, 113, '2025-12-31', '2025-12-31', 'PROGRAM', '20:00:00', 'Dataran KV', 'Ambang Tahun Baru'),
(258, 114, '2025-12-31', '2025-12-31', 'MESYUARAT', '09:00:00', 'KVBP', 'Mesyuarat Disiplin'),
(259, 115, '2025-12-31', '2025-12-31', 'KURSUS/BENGKEL', '10:30:00', 'KVBP', 'Taklimat SPLG'),
(260, 116, '2025-12-31', '2025-12-31', 'OTHERS', '14:00:00', 'KVBP', 'Kutipan Data Akhir'),
(261, 117, '2025-12-31', '2025-12-31', 'CUTI(MC)', '09:00:00', 'Hospital', 'Rawatan Lanjut'),
(262, 118, '2025-12-25', '2025-12-25', 'MESYUARAT', '10:00:00', 'KVBP', 'Mesyuarat HEM'),
(263, 119, '2025-12-26', '2025-12-26', 'PROGRAM', '08:30:00', 'KVBP', 'Ceramah Motivasi'),
(264, 120, '2025-12-27', '2025-12-27', 'OTHERS', '15:00:00', 'KVBP', 'Inventori Stor'),
(265, 121, '2025-12-28', '2025-12-28', 'CUTI(MC)', '08:00:00', 'Klinik', 'Demam'),
(266, 122, '2025-12-29', '2025-12-29', 'KURSUS/BENGKEL', '09:00:00', 'Online', 'Kursus OBE'),
(267, 123, '2025-12-30', '2025-12-30', 'MESYUARAT', '14:00:00', 'KVBP', 'Mesyuarat ICT'),
(268, 124, '2025-12-31', '2025-12-31', 'OTHERS', '11:00:00', 'KVBP', 'Kemas Bilik Guru'),
(269, 125, '2025-12-31', '2025-12-31', 'PROGRAM', '15:00:00', 'KVBP', 'Jamuan Akhir Tahun'),
(270, 155, '2025-12-29', '2025-12-29', 'MESYUARAT', '09:00:00', 'KVBP', 'AJK Surau'),
(271, 167, '2025-12-30', '2025-12-30', 'OTHERS', '10:00:00', 'KVBP', 'Servis Peralatan'),
(272, 169, '2026-01-21', '2026-01-21', 'KURSUS/BENGKEL', '12:00:00', 'Kedai Tayar', 'Baiki Tayar'),
(273, 101, '2026-01-22', '2026-01-22', 'MESYUARAT', '08:00:00', 'Bilik Mesyuarat', 'Mesyuarat pagi'),
(274, 102, '2026-01-22', '2026-01-22', 'PROGRAM', '08:20:00', 'Dewan', 'Program pelajar'),
(275, 103, '2026-01-22', '2026-01-22', 'OTHERS', '08:40:00', 'Pejabat', 'Urusan rasmi'),
(276, 104, '2026-01-22', '2026-01-22', 'KURSUS/BENGKEL', '09:00:00', 'Makmal Komputer', 'Latihan sistem'),
(277, 105, '2026-01-22', '2026-01-22', 'MESYUARAT', '09:20:00', 'KVBP', 'Mesyuarat pengurusan'),
(278, 106, '2026-01-22', '2026-01-22', 'PROGRAM', '09:40:00', 'Dewan', 'Taklimat pelajar'),
(279, 107, '2026-01-22', '2026-01-22', 'OTHERS', '10:00:00', 'Pejabat', 'Semak dokumen'),
(280, 108, '2026-01-22', '2026-01-22', 'CUTI(MC)', '10:20:00', 'Klinik', 'Rawatan ringan'),
(281, 109, '2026-01-22', '2026-01-22', 'MESYUARAT', '10:40:00', 'Bilik Mesyuarat', 'Mesyuarat unit'),
(282, 110, '2026-01-22', '2026-01-22', 'PROGRAM', '11:00:00', 'Makmal', 'Aktiviti pelajar'),
(283, 111, '2026-01-22', '2026-01-22', 'OTHERS', '11:20:00', 'Pejabat', 'Kemaskini fail'),
(317, 116, '2026-01-29', '2026-01-29', 'MESYUARAT', '08:00:00', 'Bilik Gerakan', 'Mesyuarat Kurikulum Bil 1'),
(285, 113, '2026-01-22', '2026-01-22', 'MESYUARAT', '12:00:00', 'KVBP', 'Mesyuarat khas'),
(287, 115, '2026-01-22', '2026-01-22', 'OTHERS', '12:40:00', 'Pejabat', 'Urusan pentadbiran'),
(318, 120, '2026-01-29', '2026-01-29', 'PROGRAM', '08:30:00', 'Dewan Besar', 'Taklimat Pelajar Baharu'),
(319, 125, '2026-01-29', '2026-01-29', 'OTHERS', '09:00:00', 'Perpustakaan', 'Sesi Mentor Mentee'),
(320, 130, '2026-01-29', '2026-01-29', 'MESYUARAT', '09:15:00', 'Bilik Mesyuarat A', 'Perbincangan Projek Tahun Akhir'),
(321, 132, '2026-01-29', '2026-01-29', 'PROGRAM', '09:30:00', 'Makmal Komputer 1', 'Bengkel Laravel Dasar'),
(294, 122, '2026-01-22', '2026-01-22', 'OTHERS', '15:00:00', 'Pejabat', 'Sediakan laporan'),
(295, 123, '2026-01-22', '2026-01-22', 'MESYUARAT', '15:20:00', 'KVBP', 'Mesyuarat jawatankuasa'),
(296, 124, '2026-01-22', '2026-01-22', 'PROGRAM', '15:40:00', 'Makmal', 'Latihan amali'),
(297, 125, '2026-01-22', '2026-01-22', 'OTHERS', '16:00:00', 'Pejabat', 'Kemas kini data'),
(298, 126, '2026-01-22', '2026-01-22', 'KURSUS/BENGKEL', '08:10:00', 'Online', 'Kursus keselamatan'),
(299, 127, '2026-01-22', '2026-01-22', 'MESYUARAT', '08:30:00', 'KVBP', 'Mesyuarat staf'),
(300, 128, '2026-01-22', '2026-01-22', 'PROGRAM', '08:50:00', 'Dewan', 'Taklimat khas'),
(301, 129, '2026-01-22', '2026-01-22', 'OTHERS', '09:10:00', 'Pejabat', 'Urusan pelajar'),
(302, 130, '2026-01-22', '2026-01-22', 'MESYUARAT', '09:30:00', 'KVBP', 'Mesyuarat pengurusan'),
(303, 131, '2026-01-22', '2026-01-22', 'PROGRAM', '09:50:00', 'Makmal', 'Bengkel pelajar'),
(304, 132, '2026-01-22', '2026-01-22', 'OTHERS', '10:10:00', 'Pejabat', 'Kemaskini sistem'),
(305, 133, '2026-01-22', '2026-01-22', 'MESYUARAT', '10:30:00', 'KVBP', 'Mesyuarat penutup'),
(306, 134, '2026-01-22', '2026-01-22', 'PROGRAM', '10:50:00', 'Dewan', 'Aktiviti petang'),
(2, 116, '2026-01-30', '2026-02-01', 'MESYUARAT', '17:18:21', 'Pantai Merdeka', 'aa'),
(307, 116, '2026-01-28', '2026-01-29', 'MESYUARAT', '04:21:00', 'wwe', 'Jalan ii'),
(308, 116, '2026-01-28', '2026-01-30', 'MESYUARAT', '06:31:00', 'Hutan Amazon', 'anaconda hunting'),
(309, 116, '2026-01-28', '2026-02-01', 'KURSUS/BENGKEL', '06:41:00', 'Temasik', 'sakit'),
(310, 116, '2026-01-09', '2026-01-30', 'OTHERS', '04:46:00', 'Sg Ara', 'sakit'),
(311, 116, '2026-01-29', '2026-01-31', 'CUTI(MC)', '07:50:00', 'Georgtown m', 'makan ii'),
(312, 116, '2026-02-28', '2026-02-28', 'CUTI(MC)', '01:54:00', 'Chow Kit', 'Saja'),
(313, 112, '2026-01-28', '2026-01-30', 'CUTI(MC)', '00:03:00', 'Sg Ara', 'Sakit'),
(314, 112, '2026-01-29', '2026-01-31', 'KURSUS/BENGKEL', '01:11:00', 'Kuala Lumpur', 'meeting'),
(315, 112, '2026-01-28', '2026-01-29', 'CUTI(MC)', '00:07:00', 'hospital', 'sakit'),
(316, 171, '2026-01-28', '2026-01-29', 'MESYUARAT', '21:41:00', 'Dewan kv', 'Meeting'),
(322, 133, '2026-01-29', '2026-01-29', 'MESYUARAT', '10:00:00', 'Pejabat Pentadbiran', 'Semakan Fail Audit'),
(323, 134, '2026-01-29', '2026-01-29', 'OTHERS', '10:30:00', 'Kantin', 'Aktiviti Kebajikan Staf'),
(324, 116, '2026-01-29', '2026-01-29', 'PROGRAM', '11:00:00', 'Pusat Islam', 'Ceramah Perdana'),
(325, 120, '2026-01-29', '2026-01-29', 'MESYUARAT', '11:30:00', 'Bilik Kuliah 4', 'Meeting Jabatan Teknologi'),
(326, 125, '2026-01-29', '2026-01-29', 'PROGRAM', '12:00:00', 'Padang KV', 'Latihan Sukan Tahunan'),
(327, 130, '2026-01-29', '2026-01-29', 'OTHERS', '14:00:00', 'Bengkel Mekanik', 'Pemantauan Projek Inovasi'),
(328, 132, '2026-01-29', '2026-01-29', 'MESYUARAT', '14:30:00', 'Bilik Seminar', 'Vetting Soalan Peperiksaan'),
(329, 133, '2026-01-29', '2026-01-29', 'PROGRAM', '15:00:00', 'Dewan Kuliah', 'Kursus Integriti Penjawat Awam'),
(330, 134, '2026-01-29', '2026-01-29', 'OTHERS', '15:30:00', 'Bilik Rehat', 'Penyediaan Laporan Mingguan'),
(331, 116, '2026-01-29', '2026-01-29', 'MESYUARAT', '08:00:00', 'Online (Google Meet)', 'Mesyuarat Penyelarasan Pusat'),
(332, 120, '2026-01-29', '2026-01-29', 'PROGRAM', '09:00:00', 'Auditorium', 'Simposium Pendidikan Teknikal'),
(333, 125, '2026-01-29', '2026-01-29', 'MESYUARAT', '10:00:00', 'Bilik VVIP', 'Kunjungan Hormat Industri'),
(334, 130, '2026-01-29', '2026-01-29', 'OTHERS', '11:00:00', 'Makmal Sains', 'Persediaan Amali Pelajar'),
(335, 132, '2026-01-29', '2026-01-29', 'PROGRAM', '14:00:00', 'Pusat Sukan', 'Kejohanan Badminton Staf'),
(336, 133, '2026-01-29', '2026-01-29', 'MESYUARAT', '15:00:00', 'Bilik Mesyuarat B', 'Post-Mortem Program Sukan'),
(337, 134, '2026-01-29', '2026-01-29', 'OTHERS', '16:00:00', 'Stor Sukan', 'Inventori Peralatan'),
(338, 116, '2026-01-29', '2026-01-29', 'PROGRAM', '08:45:00', 'Dewan Perdana', 'Majlis Anugerah Cemerlang'),
(339, 120, '2026-01-29', '2026-01-29', 'MESYUARAT', '10:15:00', 'Bilik Utama', 'Mesyuarat Kewangan Jabatan'),
(340, 125, '2026-01-29', '2026-01-29', 'OTHERS', '13:45:00', 'Kafe', 'Perbincangan Santai Akademik'),
(341, 130, '2026-01-29', '2026-01-29', 'PROGRAM', '15:15:00', 'Dewan Seri', 'Latihan Koir Guru'),
(342, 116, '2026-01-29', '2026-01-29', 'CUTI(MC)', '15:57:00', 'Pahang', 'sakit'),
(343, 112, '2026-01-29', '2026-01-30', 'CUTI(MC)', '00:22:00', 'Georgtown', 'makan ii'),
(344, 112, '2026-01-29', '2026-01-29', 'MESYUARAT', '00:24:00', 'Georgtown', 'meeting'),
(345, 172, '2026-01-29', '2026-01-31', 'KURSUS/BENGKEL', '00:13:00', 'Kuala Lumpur', 'meeting'),
(346, 112, '2026-01-29', '2026-01-30', 'OTHERS', '02:43:00', 'Sg Ara', 'sakit'),
(347, 173, '2026-01-29', '2026-01-31', 'KURSUS/BENGKEL', '13:19:00', 'Kuala Lumpur', 'Bengkel AI'),
(348, 173, '2026-01-29', '2026-01-31', 'KURSUS/BENGKEL', '02:26:00', 'Kuala Lumpur', 'meeting'),
(349, 112, '2026-01-29', '2026-01-31', 'CUTI(MC)', '04:48:00', 'Hospital Balik Pulau', 'Sakit Mata'),
(350, 175, '2026-02-06', '2026-02-07', 'KURSUS/BENGKEL', '14:43:00', 'Kuala Lumpur', 'meeting'),
(351, 112, '2026-02-09', '2026-02-10', 'CUTI (Cuti Rehat Khas (CRK))', NULL, 'Pahang', 'makan ii'),
(352, 278, '2026-02-09', '2026-02-10', 'CUTI (Cuti Tanpa Rekod (CTR))', NULL, 'KV mas', 'meeting'),
(353, 278, '2026-02-14', '2026-02-17', 'CUTI (Cuti Sakit (MC))', NULL, 'KVBP', 'makan ii'),
(354, 279, '2026-02-09', '2026-02-10', 'CUTI (Cuti Tanpa Rekod (CTR))', NULL, 'Rumah', 'Jga adik'),
(355, 279, '2026-02-09', '2026-02-10', 'CUTI (Cuti Rehat Khas (CRK))', NULL, 'Rumah', 'Holiday'),
(357, 279, '2026-02-09', '2026-02-11', 'CUTI (Cuti Sakit (MC))', NULL, 'Hosp', 'Demam'),
(360, 278, '2026-02-10', '2026-02-12', 'CUTI (Cuti Sakit (MC))', NULL, 'Hospital Balik Pulau', 'sakit'),
(361, 278, '2026-02-10', '2026-02-10', 'MESYUARAT', '04:52', 'KVBP', 'sakit'),
(362, 279, '2026-02-09', '2026-02-09', 'MESYUARAT', '01:53', 'Dewan kv', 'Meeting'),
(363, 112, '2026-02-09', '2026-02-10', 'MESYUARAT', '15:46', 'KV mas', 'meeting');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `nama`, `department`, `identity`, `phone`, `email`, `image`, `password`) VALUES
(112, 'Amsyarr', 'Computing Technology', NULL, '0198765744', 'shamseramsyar@gmail.com', '1770212811_cortis.jpeg', 'amsyar99'),
(220, 'Nurul Izzaty binti Abd Aziz', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(218, 'Nur Hafizah binti Razali', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(219, 'Nurhidayah binti Zamat', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(217, 'Nur Fatirah binti Roslee', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(215, 'Nik Nor Amirah binti Rozik', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(216, 'Nor Famiza binti Mohamad Sakhmah', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(213, 'Muhamad Rafli Zikri Bin Rahmat', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(214, 'Najwa Hannan binti Mohd Subri', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(211, 'Mohd Ridzwan bin Osman', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(212, 'Muhammad Hambali bin Ismail', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(210, 'Ashiratul Husna binti Muhammad Yazid', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(209, 'Adlina binti Zainol', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(208, 'Ts. Nur Raihana binti Samsudin', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(207, 'Ts. Muhamad Muzammil bin Md Salleh', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(206, 'Harith Aslah bin Misnan', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(204, 'Jamil bin Salleh', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(205, 'Mohd Shahidi bin Mohd Sokri', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(203, 'Mohammad Azib bin Khairudin', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(202, 'Nur Fatin Nabihah binti Mohd Zaidi', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(201, 'Nur Hatin binti Abdul Halim', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(200, 'M. Sharol Nasirudin bin Muhamad Nor', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(199, 'Mohd Naqiuddin bin Ismail', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(198, 'Aizatul Husna binti Mohd Sabri', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(197, 'Syazrul Azneeha binti Mohd Zakaria', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(196, 'Siti Zaharah binti Mahmad Zaini', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(195, 'Shahidin bin Shaik Osman', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(194, 'Saidi Khairul Alimi bin Othmman', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(193, 'Nurul Izzah binti Muhamad Zahir', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(192, 'Muhammad Shahir bin Sharifudin', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(191, 'Muhammad Amin bin Norhisham', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(190, 'Mohd Zaki bin Mahmud', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(189, 'Mohd Nazri bin Ahmad Sofi', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(188, 'Mohd Khir Hafifi bin Muid', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(187, 'Mohamad Fadzli bin Mohd Zin', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(186, 'Ileyati binti Mohd Yusoff', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(185, 'Hamsaril bin Ahmad', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(184, 'Adriana Farisha binti Saiful', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(182, 'Nadzirul Naim bin Hayadin', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(183, 'Ts. Zulfiqar Azhim bin Zamri', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(181, 'Rashidah binti Omar', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(180, 'Muhammad Hizami bin Mohd Jafri', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(179, 'Nurain binti Jury', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(178, 'Muhammad Hazman bin Shafii', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(177, 'Muhammad Syaaban bin Sahidin', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(176, 'Nur Hafizah binti A.Majid', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(175, 'Muhammad Fauwaz bin Mohd Nasir', 'Teknologi Elektrik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(174, 'Ts. Nooraseken binti Mohamed Noor', 'Jabatan Teknologi Elektrik dan Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(221, 'Salina binti Irwan Shah', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(222, 'Yogeshwari a/p Vinayagam', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(223, 'Zurina binti Abdul Khair', 'Teknologi Elektronik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(224, 'Ts. Noorhashimah binti Mohammad', 'Jabatan Teknologi Maklumat', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(225, 'Zulhaikal bin Jaini', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(226, 'Raja Rosmaliani binti Raja Manis', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(227, 'Nasrun Naim bin Tajudin', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(228, 'Siti Aminah binti Musa', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(229, 'Noor Amirah binti Ghazalli', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(230, 'Ashikah Mariam binti Mohamed Sharifudeen', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(231, 'Zulkifli bin Yaacob', 'Teknologi Komputeran', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(232, 'Muhammad Faiz Asraf bin Baharom', 'Jabatan Seni Reka', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(233, 'Hafizah binti Nazir', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(234, 'Suriafiza binti Abu Shah', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(235, 'Mohd Taufiq bin Md Sollhi', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(236, 'Siti Hajar Aishah binti Zainuddin', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(237, 'Dr. Mohd Syarull Azlan bin Yaakub', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(238, 'Nur Hazlina binti Abu Hassan', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(239, 'Muhammad Faris Fitri bin Sadri', 'Teknologi Reka Bentuk Grafik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(240, 'Fazli binti Mustafa Latiff', 'Jabatan Pendidikan Umum', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(241, 'Suriati binti Abdul Rani', 'Jabatan Pendidikan Umum', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(242, 'Nor Mastura binti Mansor', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(243, 'Nor Nadia Hanim binti Saufi', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(244, 'Noratika binti Isa', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(245, 'Thibbah a/p Gatanagayan', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(246, 'Muhammad Ilyas bin Talib', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(247, 'Noorhazlina binti Awaludin', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(248, 'Mohd Sholahuddin bin Sulong', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(249, 'Salina binti Sahid', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(250, 'Nor Aznina binti Md Noor', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(251, 'Siti Nur Bahirah binti Khalid', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(252, 'Rawaidah binti Saiful Islam', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(253, 'Syazana Fatin binti Isahak', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(254, 'Nur Farah binti Mazlan', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(255, 'Noor Izzati binti Mohd Yusoff', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(256, 'Muhammad Adli bin Hud', 'Unit Bahasa', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(257, 'Mohd Nurul Amri bin Rodzi', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(258, 'Norhafiza binti Haron', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(259, 'Noor Nadia Hanum binti Mustaffa', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(260, 'Nor Nabilah binti Ahmad Hazari', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(261, 'Mohammad Harith Hazaril bin Mohd Noor', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(262, 'Nurhartini binti Abd Mutalit', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(263, 'Nur Salwa binti Mohammad Azizan', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(264, 'Suhaida binti Abdul Ghani', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(265, 'Muhammad Fiqri Bin Mustaffa', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(266, 'Fauziah binti Othman', 'Unit Sains dan Matematik', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(267, 'Norliza binti Nordin', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(268, 'Nor Abizan binti Md Zain', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(269, 'Jananee a/p Subramaniam', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(270, 'Siti Zuraidah binti Abu Bakar', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(271, 'Nurharishah binti Haron', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(272, 'Nur Syafihani binti Mohd Yusof', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(273, 'Muhammad Hasnan bin Ahmad Lutfi', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(274, 'Ahmad Zaim bin Ahmad Mustaffa', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(275, 'Muhamad bin Nordin', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(276, 'Mohamad Solehin bin Idris', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(277, 'Mohamad Syauti bin Mohammad Nazir', 'Unit Kemanusiaan', NULL, NULL, NULL, NULL, 'pha3001@kvbp'),
(278, 'Ariana', 'kpd', NULL, NULL, 'ariana@gmail.com', NULL, 'ariana123'),
(279, 'Reza', 'Kpd', NULL, NULL, 'undergrow11@gmail.com', NULL, 'kpd123');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_29_162212_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shamseramsyar@gmail.com', 'og3OhgM3hUaYHDAfZcAMMIMqDwsikKea5HetWF6E4iFEwgU2XouclloxS5Km', '2025-12-03 18:39:30'),
('mscohoc@gmail.com', 'MDRXsN6sHzRniIg21HbQSDc3yr3tbB8Dvsvhpj8lZXoxZs6ePEUoV3Xw5eSQ', '2025-11-30 08:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_notifications`
--

DROP TABLE IF EXISTS `site_notifications`;
CREATE TABLE IF NOT EXISTS `site_notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
CREATE TABLE IF NOT EXISTS `user_notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `notification_id` bigint UNSIGNED NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
