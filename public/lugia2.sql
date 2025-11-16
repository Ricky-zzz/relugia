-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lugia
CREATE DATABASE IF NOT EXISTS `lugia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lugia`;

-- Dumping structure for table lugia.passenger
CREATE TABLE IF NOT EXISTS `passenger` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prefix` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `contact` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table lugia.passenger: ~0 rows (approximately)
DELETE FROM `passenger`;

-- Dumping structure for table lugia.tblaircraft
CREATE TABLE IF NOT EXISTS `tblaircraft` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icao` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_class` smallint unsigned DEFAULT NULL,
  `business_class` smallint unsigned DEFAULT NULL,
  `economy_class` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblaircraft: ~18 rows (approximately)
DELETE FROM `tblaircraft`;
INSERT INTO `tblaircraft` (`id`, `iata`, `icao`, `model`, `first_class`, `business_class`, `economy_class`) VALUES
	(1, 'DH8D', 'DH8D', 'De Havilland Dash 8-Q400', 10, 20, 80),
	(2, 'AT76', 'AT76', 'ATR 72-600', 10, 20, 80),
	(3, 'AT42', 'AT42', 'ATR 42-600', 10, 20, 80),
	(4, '320', 'A320', 'Airbus A320-200', 10, 20, 80),
	(5, '32N', 'A20N', 'Airbus A320neo', 10, 20, 80),
	(6, '321', 'A321', 'Airbus A321-200', 10, 20, 80),
	(7, '32Q', 'A21N', 'Airbus A321neo', 10, 20, 80),
	(8, '333', 'A333', 'Airbus A330-300', 10, 20, 80),
	(9, '339', 'A339', 'Airbus A330-900neo', 10, 20, 80),
	(10, '359', 'A359', 'Airbus A350-900', 10, 20, 80),
	(11, '35K', 'A35K', 'Airbus A350-1000', 10, 20, 80),
	(12, '77W', 'B77W', 'Boeing 777-300ER', 10, 20, 80),
	(13, '738', 'B738', 'Boeing 737-800', 10, 20, 80),
	(14, '7M8', 'B38M', 'Boeing 737 MAX 8', 10, 20, 80),
	(15, '788', 'B788', 'Boeing 787-8', 10, 20, 80),
	(16, '789', 'B789', 'Boeing 787-9', 10, 20, 80),
	(17, '78X', 'B78X', 'Boeing 787-10', 10, 20, 80),
	(18, '388', 'A388', 'Airbus A380-800', 10, 20, 80);

-- Dumping structure for table lugia.tblairline
CREATE TABLE IF NOT EXISTS `tblairline` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icao` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `airline_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `callsign` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comments` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblairline: ~12 rows (approximately)
DELETE FROM `tblairline`;
INSERT INTO `tblairline` (`id`, `iata`, `icao`, `airline_name`, `callsign`, `region`, `comments`) VALUES
	(1, '5J', 'CEB', 'Cebu Pacific', 'CEBU', 'Philippines', 'Founded as Cebu Air (1988); began operations in 1996 as Cebu Pacific.'),
	(2, 'PR', 'PAL', 'Philippine Airlines', 'PHILIPPINE', 'Philippines', 'Founded 1930 as Philippine Aerial Taxi Co.; renamed Philippine Airlines in 1970.'),
	(3, 'Z2', 'APG', 'Philippines AirAsia', 'COOL RED', 'Philippines', 'Founded as AirAsia Philippines (2010); renamed Philippines AirAsia in 2015.'),
	(4, 'RW', 'RYL', 'Royal Air Philippines', 'DOUBLE GOLD', 'Philippines', 'Founded 2002 as Royal Air Charter Service; relaunched as Royal Air Philippines in 2017.'),
	(5, 'AO', 'AJO', 'Air Juan', 'AIR JUAN', 'Philippines', 'First ever seaplane airline in the Philippines (founded 2012).'),
	(6, 'T6', 'ATX', 'AirSWIFT', 'AIRSWIFT', 'Philippines', 'Founded 2002 as Island Transvoyager.'),
	(7, '0A', 'BIC', 'Alphaland Aviation', 'BALESIN', 'Philippines', 'Founded 2015; operates flights to Balesin Island.'),
	(8, 'DG', 'SRQ', 'Cebgo', 'BLUE JAY', 'Philippines', 'Founded 1995 as South East Asian Airlines; operates as Cebu Pacific.'),
	(9, '2P', 'GAP', 'PAL Express', 'AIRPHIL', 'Philippines', 'Founded 1995 as Air Philippines; operates as Philippine Airlines.'),
	(10, 'M8', 'MSJ', 'SkyJet Airlines', 'MAGNUM AIR', 'Philippines', 'Founded 2005; began operations in 2012.'),
	(11, 'SP', 'WCC', 'Sky Pasada', 'SKY PASADA', 'Philippines', 'Founded 2010; regional services from Manila.'),
	(12, 'ST', 'SEA', 'Sunlight Air', 'BLUE HUMAN', 'Philippines', 'Founded 2020; boutique regional airline.');

-- Dumping structure for table lugia.tblairlineuser
CREATE TABLE IF NOT EXISTS `tblairlineuser` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aid` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  CONSTRAINT `tblairlineuser_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `tblairline` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblairlineuser: ~19 rows (approximately)
DELETE FROM `tblairlineuser`;
INSERT INTO `tblairlineuser` (`id`, `user`, `pass`, `type`, `aid`) VALUES
	(1, 'ceb_admin', 'ceb12345', 'admin', 1),
	(2, 'ceb_ops1', 'opsceb01', 'staff', 1),
	(3, 'pal_admin', 'paladmin22', 'admin', 2),
	(4, 'pal_agent1', 'palagent88', 'agent', 2),
	(5, 'pal_pilot1', 'flypal330', 'pilot', 2),
	(6, 'airasia_admin', 'aa2025', 'admin', 3),
	(7, 'airasia_ops', 'ops888', 'staff', 3),
	(8, 'royair_admin', 'roy123', 'admin', 4),
	(9, 'royair_agent1', 'royagent55', 'agent', 4),
	(10, 'airswift_admin', 'swiftHR22', 'admin', 5),
	(11, 'skyjet_admin', 'skyjet01', 'admin', 6),
	(12, 'skyjet_staff1', 'skyops44', 'staff', 6),
	(13, 'sunlight_admin', 'sun2024', 'admin', 7),
	(14, 'palexp_ops1', 'palexp11', 'staff', 8),
	(15, 'cebu2_agent', 'ceb2fly22', 'agent', 9),
	(16, 'philcharter_mgr', 'pcmgr33', 'admin', 10),
	(17, 'seair_admin', 'seair007', 'admin', 11),
	(18, 'zestair_admin', 'zest888', 'admin', 12),
	(19, 'zestair_ops1', 'zestops12', 'staff', 12),
	(20, 'philairlines', '12345', 'admin', 2);

-- Dumping structure for table lugia.tblairport
CREATE TABLE IF NOT EXISTS `tblairport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icao` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `airport_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location_serve` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dst` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblairport: ~30 rows (approximately)
DELETE FROM `tblairport`;
INSERT INTO `tblairport` (`id`, `iata`, `icao`, `airport_name`, `location_serve`, `time`, `dst`) VALUES
	(1, 'MNL', 'RPLL', 'Ninoy Aquino International', 'Manila, Philippines', 'UTC+8', 'N'),
	(2, 'CEB', 'RPVM', 'Mactan?Cebu International', 'Cebu, Philippines', 'UTC+8', 'N'),
	(3, 'DVO', 'RPMD', 'Francisco Bangoy International', 'Davao, Philippines', 'UTC+8', 'N'),
	(4, 'CRK', 'RPLC', 'Clark International', 'Angeles, Philippines', 'UTC+8', 'N'),
	(5, 'ILO', 'RPVI', 'Iloilo International', 'Iloilo, Philippines', 'UTC+8', 'N'),
	(6, 'PPS', 'RPVP', 'Puerto Princesa International', 'Palawan, Philippines', 'UTC+8', 'N'),
	(7, 'TAG', 'RPVT', 'Bohol?Panglao International', 'Bohol, Philippines', 'UTC+8', 'N'),
	(8, 'ZAM', 'RPMZ', 'Zamboanga International', 'Zamboanga, Philippines', 'UTC+8', 'N'),
	(9, 'KLO', 'RPVK', 'Kalibo International', 'Kalibo, Philippines', 'UTC+8', 'N'),
	(10, 'LGP', 'RPVP', 'Legazpi (Bicol) International', 'Albay, Philippines', 'UTC+8', 'N'),
	(11, 'CGY', 'RPMY', 'Laguindingan Airport', 'Cagayan de Oro, PH', 'UTC+8', 'N'),
	(12, 'NRT', 'RJAA', 'Narita International', 'Tokyo, Japan', 'UTC+9', 'N'),
	(13, 'HND', 'RJTT', 'Haneda International', 'Tokyo, Japan', 'UTC+9', 'N'),
	(14, 'HKG', 'VHHH', 'Hong Kong International', 'Hong Kong', 'UTC+8', 'N'),
	(15, 'SIN', 'WSSS', 'Singapore Changi', 'Singapore', 'UTC+8', 'N'),
	(16, 'KUL', 'WMKK', 'Kuala Lumpur International', 'Kuala Lumpur, Malaysia', 'UTC+8', 'N'),
	(17, 'BKK', 'VTBS', 'Suvarnabhumi Airport', 'Bangkok, Thailand', 'UTC+7', 'N'),
	(18, 'DXB', 'OMDB', 'Dubai International', 'Dubai, UAE', 'UTC+4', 'N'),
	(19, 'DOH', 'OTHH', 'Hamad International', 'Doha, Qatar', 'UTC+3', 'N'),
	(20, 'LAX', 'KLAX', 'Los Angeles International', 'Los Angeles, USA', 'UTC-8', 'Y'),
	(21, 'SFO', 'KSFO', 'San Francisco International', 'San Francisco, USA', 'UTC-8', 'Y'),
	(22, 'JFK', 'KJFK', 'John F. Kennedy International', 'New York, USA', 'UTC-5', 'Y'),
	(23, 'LHR', 'EGLL', 'London Heathrow', 'London, UK', 'UTC+0', 'Y'),
	(24, 'LGW', 'EGKK', 'London Gatwick', 'London, UK', 'UTC+0', 'Y'),
	(25, 'CDG', 'LFPG', 'Paris Charles de Gaulle', 'Paris, France', 'UTC+1', 'Y'),
	(26, 'FRA', 'EDDF', 'Frankfurt International', 'Frankfurt, Germany', 'UTC+1', 'Y'),
	(27, 'AMS', 'EHAM', 'Amsterdam Schiphol', 'Amsterdam, Netherlands', 'UTC+1', 'Y'),
	(28, 'SYD', 'YSSY', 'Sydney Kingsford Smith', 'Sydney, Australia', 'UTC+10', 'Y'),
	(29, 'MEL', 'YMML', 'Melbourne Tullamarine', 'Melbourne, Australia', 'UTC+10', 'Y'),
	(30, 'ICN', 'RKSI', 'Incheon International', 'Seoul, South Korea', 'UTC+9', 'N');

-- Dumping structure for table lugia.tblflightroute
CREATE TABLE IF NOT EXISTS `tblflightroute` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aid` int DEFAULT NULL,
  `oapid` int DEFAULT NULL,
  `dapid` int DEFAULT NULL,
  `round_trip` tinyint(1) DEFAULT NULL,
  `acid` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `oapid` (`oapid`),
  KEY `dapid` (`dapid`),
  KEY `acid` (`acid`),
  CONSTRAINT `tblflightroute_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `tblairline` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tblflightroute_ibfk_2` FOREIGN KEY (`oapid`) REFERENCES `tblairport` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tblflightroute_ibfk_3` FOREIGN KEY (`dapid`) REFERENCES `tblairport` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tblflightroute_ibfk_4` FOREIGN KEY (`acid`) REFERENCES `tblaircraft` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblflightroute: ~11 rows (approximately)
DELETE FROM `tblflightroute`;
INSERT INTO `tblflightroute` (`id`, `aid`, `oapid`, `dapid`, `round_trip`, `acid`) VALUES
	(1, 1, 1, 2, 1, 4),
	(2, 1, 2, 3, 1, 4),
	(3, 2, 1, 5, 1, 8),
	(4, 2, 1, 6, 1, 10),
	(5, 2, 1, 8, 1, 12),
	(6, 2, 1, 9, 1, 10),
	(7, 2, 1, 10, 1, 12),
	(8, 3, 1, 6, 1, 4),
	(9, 3, 1, 7, 1, 5),
	(10, 4, 2, 14, 1, 2),
	(11, 5, 1, 2, 1, 1);

-- Dumping structure for table lugia.tblflightschedule
CREATE TABLE IF NOT EXISTS `tblflightschedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auid` int DEFAULT NULL,
  `frid` int DEFAULT NULL,
  `date_departure` date DEFAULT NULL,
  `time_departure` time DEFAULT NULL,
  `date_arrival` date DEFAULT NULL,
  `time_arrival` time DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_price` decimal(10,2) DEFAULT NULL,
  `business_price` decimal(10,2) DEFAULT NULL,
  `economy_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auid` (`auid`),
  KEY `frid` (`frid`),
  CONSTRAINT `tblflightschedule_ibfk_1` FOREIGN KEY (`auid`) REFERENCES `tblairlineuser` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tblflightschedule_ibfk_2` FOREIGN KEY (`frid`) REFERENCES `tblflightroute` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblflightschedule: ~2 rows (approximately)
DELETE FROM `tblflightschedule`;
INSERT INTO `tblflightschedule` (`id`, `auid`, `frid`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `status`, `first_price`, `business_price`, `economy_price`) VALUES
	(18, 20, 3, '2025-09-11', '14:37:00', '2025-09-12', '14:37:00', 'scheduled', 11111.00, 1111.00, 1111.00),
	(19, 20, 4, '2025-09-10', '15:02:00', '2025-09-11', '18:00:00', 'scheduled', 100000.00, 5000.00, 600.00);

-- Dumping structure for table lugia.tblseats
CREATE TABLE IF NOT EXISTS `tblseats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fid` int DEFAULT NULL,
  `ticket_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seat_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `class` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`),
  CONSTRAINT `tblseats_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `tblflightschedule` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblseats: ~220 rows (approximately)
DELETE FROM `tblseats`;
INSERT INTO `tblseats` (`id`, `fid`, `ticket_no`, `seat_name`, `class`, `status`) VALUES
	(113, 18, '000001', 'A1', 'First', 'available'),
	(114, 18, '000002', 'B1', 'First', 'available'),
	(115, 18, '000003', 'C1', 'First', 'available'),
	(116, 18, '000004', 'A2', 'First', 'available'),
	(117, 18, '000005', 'B2', 'First', 'available'),
	(118, 18, '000006', 'C2', 'First', 'available'),
	(119, 18, '000007', 'A3', 'First', 'available'),
	(120, 18, '000008', 'B3', 'First', 'available'),
	(121, 18, '000009', 'C3', 'First', 'available'),
	(122, 18, '000010', 'A4', 'First', 'available'),
	(123, 18, '000011', 'A1', 'Business', 'available'),
	(124, 18, '000012', 'B1', 'Business', 'available'),
	(125, 18, '000013', 'C1', 'Business', 'available'),
	(126, 18, '000014', 'D1', 'Business', 'available'),
	(127, 18, '000015', 'A2', 'Business', 'available'),
	(128, 18, '000016', 'B2', 'Business', 'available'),
	(129, 18, '000017', 'C2', 'Business', 'available'),
	(130, 18, '000018', 'D2', 'Business', 'available'),
	(131, 18, '000019', 'A3', 'Business', 'available'),
	(132, 18, '000020', 'B3', 'Business', 'available'),
	(133, 18, '000021', 'C3', 'Business', 'available'),
	(134, 18, '000022', 'D3', 'Business', 'available'),
	(135, 18, '000023', 'A4', 'Business', 'available'),
	(136, 18, '000024', 'B4', 'Business', 'available'),
	(137, 18, '000025', 'C4', 'Business', 'available'),
	(138, 18, '000026', 'D4', 'Business', 'available'),
	(139, 18, '000027', 'A5', 'Business', 'available'),
	(140, 18, '000028', 'B5', 'Business', 'available'),
	(141, 18, '000029', 'C5', 'Business', 'available'),
	(142, 18, '000030', 'D5', 'Business', 'available'),
	(143, 18, '000031', 'A1', 'Economy', 'available'),
	(144, 18, '000032', 'B1', 'Economy', 'available'),
	(145, 18, '000033', 'C1', 'Economy', 'available'),
	(146, 18, '000034', 'D1', 'Economy', 'available'),
	(147, 18, '000035', 'E1', 'Economy', 'available'),
	(148, 18, '000036', 'F1', 'Economy', 'available'),
	(149, 18, '000037', 'A2', 'Economy', 'available'),
	(150, 18, '000038', 'B2', 'Economy', 'available'),
	(151, 18, '000039', 'C2', 'Economy', 'available'),
	(152, 18, '000040', 'D2', 'Economy', 'available'),
	(153, 18, '000041', 'E2', 'Economy', 'available'),
	(154, 18, '000042', 'F2', 'Economy', 'available'),
	(155, 18, '000043', 'A3', 'Economy', 'available'),
	(156, 18, '000044', 'B3', 'Economy', 'available'),
	(157, 18, '000045', 'C3', 'Economy', 'available'),
	(158, 18, '000046', 'D3', 'Economy', 'available'),
	(159, 18, '000047', 'E3', 'Economy', 'available'),
	(160, 18, '000048', 'F3', 'Economy', 'available'),
	(161, 18, '000049', 'A4', 'Economy', 'available'),
	(162, 18, '000050', 'B4', 'Economy', 'available'),
	(163, 18, '000051', 'C4', 'Economy', 'available'),
	(164, 18, '000052', 'D4', 'Economy', 'available'),
	(165, 18, '000053', 'E4', 'Economy', 'available'),
	(166, 18, '000054', 'F4', 'Economy', 'available'),
	(167, 18, '000055', 'A5', 'Economy', 'available'),
	(168, 18, '000056', 'B5', 'Economy', 'available'),
	(169, 18, '000057', 'C5', 'Economy', 'available'),
	(170, 18, '000058', 'D5', 'Economy', 'available'),
	(171, 18, '000059', 'E5', 'Economy', 'available'),
	(172, 18, '000060', 'F5', 'Economy', 'available'),
	(173, 18, '000061', 'A6', 'Economy', 'available'),
	(174, 18, '000062', 'B6', 'Economy', 'available'),
	(175, 18, '000063', 'C6', 'Economy', 'available'),
	(176, 18, '000064', 'D6', 'Economy', 'available'),
	(177, 18, '000065', 'E6', 'Economy', 'available'),
	(178, 18, '000066', 'F6', 'Economy', 'available'),
	(179, 18, '000067', 'A7', 'Economy', 'available'),
	(180, 18, '000068', 'B7', 'Economy', 'available'),
	(181, 18, '000069', 'C7', 'Economy', 'available'),
	(182, 18, '000070', 'D7', 'Economy', 'available'),
	(183, 18, '000071', 'E7', 'Economy', 'available'),
	(184, 18, '000072', 'F7', 'Economy', 'available'),
	(185, 18, '000073', 'A8', 'Economy', 'available'),
	(186, 18, '000074', 'B8', 'Economy', 'available'),
	(187, 18, '000075', 'C8', 'Economy', 'available'),
	(188, 18, '000076', 'D8', 'Economy', 'available'),
	(189, 18, '000077', 'E8', 'Economy', 'available'),
	(190, 18, '000078', 'F8', 'Economy', 'available'),
	(191, 18, '000079', 'A9', 'Economy', 'available'),
	(192, 18, '000080', 'B9', 'Economy', 'available'),
	(193, 18, '000081', 'C9', 'Economy', 'available'),
	(194, 18, '000082', 'D9', 'Economy', 'available'),
	(195, 18, '000083', 'E9', 'Economy', 'available'),
	(196, 18, '000084', 'F9', 'Economy', 'available'),
	(197, 18, '000085', 'A10', 'Economy', 'available'),
	(198, 18, '000086', 'B10', 'Economy', 'available'),
	(199, 18, '000087', 'C10', 'Economy', 'available'),
	(200, 18, '000088', 'D10', 'Economy', 'available'),
	(201, 18, '000089', 'E10', 'Economy', 'available'),
	(202, 18, '000090', 'F10', 'Economy', 'available'),
	(203, 18, '000091', 'A11', 'Economy', 'available'),
	(204, 18, '000092', 'B11', 'Economy', 'available'),
	(205, 18, '000093', 'C11', 'Economy', 'available'),
	(206, 18, '000094', 'D11', 'Economy', 'available'),
	(207, 18, '000095', 'E11', 'Economy', 'available'),
	(208, 18, '000096', 'F11', 'Economy', 'available'),
	(209, 18, '000097', 'A12', 'Economy', 'available'),
	(210, 18, '000098', 'B12', 'Economy', 'available'),
	(211, 18, '000099', 'C12', 'Economy', 'available'),
	(212, 18, '000100', 'D12', 'Economy', 'available'),
	(213, 18, '000101', 'E12', 'Economy', 'available'),
	(214, 18, '000102', 'F12', 'Economy', 'available'),
	(215, 18, '000103', 'A13', 'Economy', 'available'),
	(216, 18, '000104', 'B13', 'Economy', 'available'),
	(217, 18, '000105', 'C13', 'Economy', 'available'),
	(218, 18, '000106', 'D13', 'Economy', 'available'),
	(219, 18, '000107', 'E13', 'Economy', 'available'),
	(220, 18, '000108', 'F13', 'Economy', 'available'),
	(221, 18, '000109', 'A14', 'Economy', 'available'),
	(222, 18, '000110', 'B14', 'Economy', 'available'),
	(223, 19, '000001', 'A1', 'First', 'available'),
	(224, 19, '000002', 'B1', 'First', 'available'),
	(225, 19, '000003', 'C1', 'First', 'available'),
	(226, 19, '000004', 'A2', 'First', 'available'),
	(227, 19, '000005', 'B2', 'First', 'available'),
	(228, 19, '000006', 'C2', 'First', 'available'),
	(229, 19, '000007', 'A3', 'First', 'available'),
	(230, 19, '000008', 'B3', 'First', 'available'),
	(231, 19, '000009', 'C3', 'First', 'available'),
	(232, 19, '000010', 'A4', 'First', 'available'),
	(233, 19, '000011', 'A1', 'Business', 'available'),
	(234, 19, '000012', 'B1', 'Business', 'available'),
	(235, 19, '000013', 'C1', 'Business', 'available'),
	(236, 19, '000014', 'D1', 'Business', 'available'),
	(237, 19, '000015', 'A2', 'Business', 'available'),
	(238, 19, '000016', 'B2', 'Business', 'available'),
	(239, 19, '000017', 'C2', 'Business', 'available'),
	(240, 19, '000018', 'D2', 'Business', 'available'),
	(241, 19, '000019', 'A3', 'Business', 'available'),
	(242, 19, '000020', 'B3', 'Business', 'available'),
	(243, 19, '000021', 'C3', 'Business', 'available'),
	(244, 19, '000022', 'D3', 'Business', 'available'),
	(245, 19, '000023', 'A4', 'Business', 'available'),
	(246, 19, '000024', 'B4', 'Business', 'available'),
	(247, 19, '000025', 'C4', 'Business', 'available'),
	(248, 19, '000026', 'D4', 'Business', 'available'),
	(249, 19, '000027', 'A5', 'Business', 'available'),
	(250, 19, '000028', 'B5', 'Business', 'available'),
	(251, 19, '000029', 'C5', 'Business', 'available'),
	(252, 19, '000030', 'D5', 'Business', 'available'),
	(253, 19, '000031', 'A1', 'Economy', 'available'),
	(254, 19, '000032', 'B1', 'Economy', 'available'),
	(255, 19, '000033', 'C1', 'Economy', 'available'),
	(256, 19, '000034', 'D1', 'Economy', 'available'),
	(257, 19, '000035', 'E1', 'Economy', 'available'),
	(258, 19, '000036', 'F1', 'Economy', 'available'),
	(259, 19, '000037', 'A2', 'Economy', 'available'),
	(260, 19, '000038', 'B2', 'Economy', 'available'),
	(261, 19, '000039', 'C2', 'Economy', 'available'),
	(262, 19, '000040', 'D2', 'Economy', 'available'),
	(263, 19, '000041', 'E2', 'Economy', 'available'),
	(264, 19, '000042', 'F2', 'Economy', 'available'),
	(265, 19, '000043', 'A3', 'Economy', 'available'),
	(266, 19, '000044', 'B3', 'Economy', 'available'),
	(267, 19, '000045', 'C3', 'Economy', 'available'),
	(268, 19, '000046', 'D3', 'Economy', 'available'),
	(269, 19, '000047', 'E3', 'Economy', 'available'),
	(270, 19, '000048', 'F3', 'Economy', 'available'),
	(271, 19, '000049', 'A4', 'Economy', 'available'),
	(272, 19, '000050', 'B4', 'Economy', 'available'),
	(273, 19, '000051', 'C4', 'Economy', 'available'),
	(274, 19, '000052', 'D4', 'Economy', 'available'),
	(275, 19, '000053', 'E4', 'Economy', 'available'),
	(276, 19, '000054', 'F4', 'Economy', 'available'),
	(277, 19, '000055', 'A5', 'Economy', 'available'),
	(278, 19, '000056', 'B5', 'Economy', 'available'),
	(279, 19, '000057', 'C5', 'Economy', 'available'),
	(280, 19, '000058', 'D5', 'Economy', 'available'),
	(281, 19, '000059', 'E5', 'Economy', 'available'),
	(282, 19, '000060', 'F5', 'Economy', 'available'),
	(283, 19, '000061', 'A6', 'Economy', 'available'),
	(284, 19, '000062', 'B6', 'Economy', 'available'),
	(285, 19, '000063', 'C6', 'Economy', 'available'),
	(286, 19, '000064', 'D6', 'Economy', 'available'),
	(287, 19, '000065', 'E6', 'Economy', 'available'),
	(288, 19, '000066', 'F6', 'Economy', 'available'),
	(289, 19, '000067', 'A7', 'Economy', 'available'),
	(290, 19, '000068', 'B7', 'Economy', 'available'),
	(291, 19, '000069', 'C7', 'Economy', 'available'),
	(292, 19, '000070', 'D7', 'Economy', 'available'),
	(293, 19, '000071', 'E7', 'Economy', 'available'),
	(294, 19, '000072', 'F7', 'Economy', 'available'),
	(295, 19, '000073', 'A8', 'Economy', 'available'),
	(296, 19, '000074', 'B8', 'Economy', 'available'),
	(297, 19, '000075', 'C8', 'Economy', 'available'),
	(298, 19, '000076', 'D8', 'Economy', 'available'),
	(299, 19, '000077', 'E8', 'Economy', 'available'),
	(300, 19, '000078', 'F8', 'Economy', 'available'),
	(301, 19, '000079', 'A9', 'Economy', 'available'),
	(302, 19, '000080', 'B9', 'Economy', 'available'),
	(303, 19, '000081', 'C9', 'Economy', 'available'),
	(304, 19, '000082', 'D9', 'Economy', 'available'),
	(305, 19, '000083', 'E9', 'Economy', 'available'),
	(306, 19, '000084', 'F9', 'Economy', 'available'),
	(307, 19, '000085', 'A10', 'Economy', 'available'),
	(308, 19, '000086', 'B10', 'Economy', 'available'),
	(309, 19, '000087', 'C10', 'Economy', 'available'),
	(310, 19, '000088', 'D10', 'Economy', 'available'),
	(311, 19, '000089', 'E10', 'Economy', 'available'),
	(312, 19, '000090', 'F10', 'Economy', 'available'),
	(313, 19, '000091', 'A11', 'Economy', 'available'),
	(314, 19, '000092', 'B11', 'Economy', 'available'),
	(315, 19, '000093', 'C11', 'Economy', 'available'),
	(316, 19, '000094', 'D11', 'Economy', 'available'),
	(317, 19, '000095', 'E11', 'Economy', 'available'),
	(318, 19, '000096', 'F11', 'Economy', 'available'),
	(319, 19, '000097', 'A12', 'Economy', 'available'),
	(320, 19, '000098', 'B12', 'Economy', 'available'),
	(321, 19, '000099', 'C12', 'Economy', 'available'),
	(322, 19, '000100', 'D12', 'Economy', 'available'),
	(323, 19, '000101', 'E12', 'Economy', 'available'),
	(324, 19, '000102', 'F12', 'Economy', 'available'),
	(325, 19, '000103', 'A13', 'Economy', 'available'),
	(326, 19, '000104', 'B13', 'Economy', 'available'),
	(327, 19, '000105', 'C13', 'Economy', 'available'),
	(328, 19, '000106', 'D13', 'Economy', 'available'),
	(329, 19, '000107', 'E13', 'Economy', 'available'),
	(330, 19, '000108', 'F13', 'Economy', 'available'),
	(331, 19, '000109', 'A14', 'Economy', 'available'),
	(332, 19, '000110', 'B14', 'Economy', 'available');

-- Dumping structure for table lugia.tbluser
CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tbluser: ~10 rows (approximately)
DELETE FROM `tbluser`;
INSERT INTO `tbluser` (`id`, `user`, `pass`, `role`) VALUES
	(11, 'mark_admin', 'admin123', 'admin'),
	(12, 'anna_user', 'password1', 'user'),
	(13, 'juan_pilot', 'flyhigh', 'user'),
	(14, 'cebu_manager', 'cebupass', 'user'),
	(15, 'peter_staff', 'staff123', 'user'),
	(16, 'lucy_ops', 'opspass', 'user'),
	(17, 'maria_agent', 'agent2025', 'user'),
	(18, 'john_dev', 'devpass', 'user'),
	(19, 'karen_checkin', 'checkin123', 'user'),
	(20, 'samir_support', 'supportpass', 'user'),
	(21, 'super_admin', '12345', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
