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
  `agency_contact` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table lugia.passenger: ~2 rows (approximately)
DELETE FROM `passenger`;
INSERT INTO `passenger` (`id`, `name`, `first_name`, `last_name`, `prefix`, `contact`, `email`, `agency_contact`) VALUES
	(1, 'John Doe', 'John', 'Doe', 'MR', '09374859303', '', '09898780987'),
	(2, 'Jane Doe', 'Jane', 'Doe', 'MS', '09374859303', '', '09898780987'),
	(3, 'Nath Ramos', 'Nath', 'Ramos', 'MR', '987654321', '', '123456789');

-- Dumping structure for table lugia.tblaircraft
CREATE TABLE IF NOT EXISTS `tblaircraft` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icao` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_class` smallint unsigned DEFAULT NULL,
  `business_class` smallint unsigned DEFAULT NULL,
  `economy_class` smallint unsigned DEFAULT NULL,
  `row_nums` smallint unsigned DEFAULT '30',
  `col_nums` tinyint unsigned DEFAULT '2',
  `col_sizes` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '3-3-3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblaircraft: ~18 rows (approximately)
DELETE FROM `tblaircraft`;
INSERT INTO `tblaircraft` (`id`, `iata`, `icao`, `model`, `first_class`, `business_class`, `economy_class`, `row_nums`, `col_nums`, `col_sizes`) VALUES
	(1, 'DH8D', 'DH8D', 'De Havilland Dash 8-Q400', 36, 54, 180, 30, 3, '3-3-3'),
	(2, 'AT76', 'AT76', 'ATR 72-600', 36, 54, 180, 30, 3, '3-3-3'),
	(3, 'AT42', 'AT42', 'ATR 42-600', 36, 54, 180, 30, 3, '2-4-2'),
	(4, '320', 'A321', 'Airbus A320-200', 36, 54, 180, 30, 3, '3-3-3'),
	(5, '32N', 'A20N', 'Airbus A320neo', 36, 54, 180, 30, 3, '3-3-3'),
	(6, '321', 'A321', 'Airbus A321-200', 36, 54, 180, 30, 3, '1-5-1'),
	(7, '32Q', 'A21N', 'Airbus A321neo', 16, 32, 112, 20, 2, '4-4'),
	(8, '333', 'A333', 'Airbus A330-300', 40, 60, 100, 20, 3, '3-4-3'),
	(9, '339', 'A339', 'Airbus A330-900neo', 36, 54, 180, 30, 3, '3-3-3'),
	(10, '359', 'A359', 'Airbus A350-900', 36, 54, 180, 30, 3, '3-3-3'),
	(11, '35K', 'A35K', 'Airbus A350-1000', 36, 54, 180, 30, 3, '3-3-3'),
	(12, '77W', 'B77W', 'Boeing 777-300ER', 36, 54, 180, 30, 3, '3-3-3'),
	(13, '738', 'B738', 'Boeing 737-800', 36, 54, 180, 30, 3, '3-3-3'),
	(14, '7M8', 'B38M', 'Boeing 737 MAX 8', 36, 54, 180, 30, 3, '3-3-3'),
	(15, '788', 'B788', 'Boeing 787-8', 36, 54, 180, 30, 3, '3-3-3'),
	(16, '789', 'B789', 'Boeing 787-9', 36, 54, 180, 30, 3, '3-3-3'),
	(17, '78X', 'B78X', 'Boeing 787-10', 36, 54, 180, 30, 3, '3-3-3'),
	(18, '388', 'A388', 'Airbus A380-800', 36, 54, 180, 30, 3, '3-3-3');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
	(12, 'ST', 'SEA', 'Sunlight AirA', 'BLUE HUMAN', 'Philippines', 'Founded 2020; boutique regional airline.');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
	(27, 'AMS', 'EHAM', 'Amsterdam Schiphols', 'Amsterdam, Netherlands', 'UTC+1', 'Y'),
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblflightroute: ~12 rows (approximately)
DELETE FROM `tblflightroute`;
INSERT INTO `tblflightroute` (`id`, `aid`, `oapid`, `dapid`, `round_trip`, `acid`) VALUES
	(1, 1, 1, 2, 0, 4),
	(2, 1, 2, 3, 1, 4),
	(3, 2, 1, 5, 1, 8),
	(4, 2, 1, 6, 1, 10),
	(5, 2, 1, 8, 1, 12),
	(6, 2, 1, 9, 1, 10),
	(7, 2, 1, 10, 1, 12),
	(8, 3, 1, 6, 1, 4),
	(9, 3, 1, 7, 1, 5),
	(10, 4, 2, 14, 1, 2),
	(11, 5, 1, 2, 1, 1),
	(16, 1, 4, 5, 1, 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblflightschedule: ~0 rows (approximately)
DELETE FROM `tblflightschedule`;
INSERT INTO `tblflightschedule` (`id`, `auid`, `frid`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `status`, `first_price`, `business_price`, `economy_price`) VALUES
	(27, 1, 1, '2025-11-18', '03:57:00', '2025-11-20', '01:00:00', 'scheduled', 1000.00, 500.00, 100.00);

-- Dumping structure for table lugia.tblseats
CREATE TABLE IF NOT EXISTS `tblseats` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fid` int DEFAULT NULL,
  `ticket_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seat_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `class` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passenger_id` int DEFAULT NULL,
  `seat_price` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`),
  CONSTRAINT `tblseats_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `tblflightschedule` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table lugia.tblseats: ~270 rows (approximately)
DELETE FROM `tblseats`;
INSERT INTO `tblseats` (`id`, `fid`, `ticket_no`, `seat_name`, `class`, `status`, `passenger_id`, `seat_price`) VALUES
	(1, 27, '0001-A1-F', 'A1', 'first', 'available', NULL, 1400),
	(2, 27, '0002-B1-F', 'B1', 'first', 'available', NULL, 1000),
	(3, 27, '0003-C1-F', 'C1', 'first', 'available', NULL, 1000),
	(4, 27, '0004-D1-F', 'D1', 'first', 'available', NULL, 1000),
	(5, 27, '0005-E1-F', 'E1', 'first', 'available', NULL, 1000),
	(6, 27, '0006-F1-F', 'F1', 'first', 'available', NULL, 1000),
	(7, 27, '0007-G1-F', 'G1', 'first', 'available', NULL, 1000),
	(8, 27, '0008-H1-F', 'H1', 'first', 'available', NULL, 1000),
	(9, 27, '0009-I1-F', 'I1', 'first', 'available', NULL, 1400),
	(10, 27, '0010-A2-F', 'A2', 'first', 'available', NULL, 1400),
	(11, 27, '0011-B2-F', 'B2', 'first', 'available', NULL, 1000),
	(12, 27, '0012-C2-F', 'C2', 'first', 'available', NULL, 1000),
	(13, 27, '0013-D2-F', 'D2', 'first', 'available', NULL, 1000),
	(14, 27, '0014-E2-F', 'E2', 'first', 'available', NULL, 1000),
	(15, 27, '0015-F2-F', 'F2', 'first', 'available', NULL, 1000),
	(16, 27, '0016-G2-F', 'G2', 'first', 'available', NULL, 1000),
	(17, 27, '0017-H2-F', 'H2', 'first', 'available', NULL, 1000),
	(18, 27, '0018-I2-F', 'I2', 'first', 'available', NULL, 1400),
	(19, 27, '0019-A3-F', 'A3', 'first', 'available', NULL, 1400),
	(20, 27, '0020-B3-F', 'B3', 'first', 'available', NULL, 1000),
	(21, 27, '0021-C3-F', 'C3', 'first', 'available', NULL, 1000),
	(22, 27, '0022-D3-F', 'D3', 'first', 'available', NULL, 1000),
	(23, 27, '0023-E3-F', 'E3', 'first', 'available', NULL, 1000),
	(24, 27, '0024-F3-F', 'F3', 'first', 'available', NULL, 1000),
	(25, 27, '0025-G3-F', 'G3', 'first', 'available', NULL, 1000),
	(26, 27, '0026-H3-F', 'H3', 'first', 'available', NULL, 1000),
	(27, 27, '0027-I3-F', 'I3', 'first', 'available', NULL, 1400),
	(28, 27, '0028-A4-F', 'A4', 'first', 'available', NULL, 1400),
	(29, 27, '0029-B4-F', 'B4', 'first', 'available', NULL, 1000),
	(30, 27, '0030-C4-F', 'C4', 'first', 'available', NULL, 1000),
	(31, 27, '0031-D4-F', 'D4', 'first', 'available', NULL, 1000),
	(32, 27, '0032-E4-F', 'E4', 'first', 'available', NULL, 1000),
	(33, 27, '0033-F4-F', 'F4', 'first', 'available', NULL, 1000),
	(34, 27, '0034-G4-F', 'G4', 'first', 'available', NULL, 1000),
	(35, 27, '0035-H4-F', 'H4', 'first', 'available', NULL, 1000),
	(36, 27, '0036-I4-F', 'I4', 'first', 'available', NULL, 1400),
	(37, 27, '0037-A5-B', 'A5', 'business', 'available', NULL, 700),
	(38, 27, '0038-B5-B', 'B5', 'business', 'available', NULL, 500),
	(39, 27, '0039-C5-B', 'C5', 'business', 'available', NULL, 500),
	(40, 27, '0040-D5-B', 'D5', 'business', 'available', NULL, 500),
	(41, 27, '0041-E5-B', 'E5', 'business', 'available', NULL, 500),
	(42, 27, '0042-F5-B', 'F5', 'business', 'available', NULL, 500),
	(43, 27, '0043-G5-B', 'G5', 'business', 'available', NULL, 500),
	(44, 27, '0044-H5-B', 'H5', 'business', 'available', NULL, 500),
	(45, 27, '0045-I5-B', 'I5', 'business', 'available', NULL, 700),
	(46, 27, '0046-A6-B', 'A6', 'business', 'available', NULL, 700),
	(47, 27, '0047-B6-B', 'B6', 'business', 'available', NULL, 500),
	(48, 27, '0048-C6-B', 'C6', 'business', 'available', NULL, 500),
	(49, 27, '0049-D6-B', 'D6', 'business', 'available', NULL, 500),
	(50, 27, '0050-E6-B', 'E6', 'business', 'available', NULL, 500),
	(51, 27, '0051-F6-B', 'F6', 'business', 'available', NULL, 500),
	(52, 27, '0052-G6-B', 'G6', 'business', 'available', NULL, 500),
	(53, 27, '0053-H6-B', 'H6', 'business', 'available', NULL, 500),
	(54, 27, '0054-I6-B', 'I6', 'business', 'available', NULL, 700),
	(55, 27, '0055-A7-B', 'A7', 'business', 'available', NULL, 700),
	(56, 27, '0056-B7-B', 'B7', 'business', 'available', NULL, 500),
	(57, 27, '0057-C7-B', 'C7', 'business', 'available', NULL, 500),
	(58, 27, '0058-D7-B', 'D7', 'business', 'available', NULL, 500),
	(59, 27, '0059-E7-B', 'E7', 'business', 'available', NULL, 500),
	(60, 27, '0060-F7-B', 'F7', 'business', 'available', NULL, 500),
	(61, 27, '0061-G7-B', 'G7', 'business', 'available', NULL, 500),
	(62, 27, '0062-H7-B', 'H7', 'business', 'available', NULL, 500),
	(63, 27, '0063-I7-B', 'I7', 'business', 'available', NULL, 700),
	(64, 27, '0064-A8-B', 'A8', 'business', 'available', NULL, 700),
	(65, 27, '0065-B8-B', 'B8', 'business', 'available', NULL, 500),
	(66, 27, '0066-C8-B', 'C8', 'business', 'available', NULL, 500),
	(67, 27, '0067-D8-B', 'D8', 'business', 'available', NULL, 500),
	(68, 27, '0068-E8-B', 'E8', 'business', 'available', NULL, 500),
	(69, 27, '0069-F8-B', 'F8', 'business', 'available', NULL, 500),
	(70, 27, '0070-G8-B', 'G8', 'business', 'available', NULL, 500),
	(71, 27, '0071-H8-B', 'H8', 'business', 'available', NULL, 500),
	(72, 27, '0072-I8-B', 'I8', 'business', 'available', NULL, 700),
	(73, 27, '0073-A9-B', 'A9', 'business', 'available', NULL, 700),
	(74, 27, '0074-B9-B', 'B9', 'business', 'available', NULL, 500),
	(75, 27, '0075-C9-B', 'C9', 'business', 'available', NULL, 500),
	(76, 27, '0076-D9-B', 'D9', 'business', 'available', NULL, 500),
	(77, 27, '0077-E9-B', 'E9', 'business', 'available', NULL, 500),
	(78, 27, '0078-F9-B', 'F9', 'business', 'available', NULL, 500),
	(79, 27, '0079-G9-B', 'G9', 'business', 'available', NULL, 500),
	(80, 27, '0080-H9-B', 'H9', 'business', 'available', NULL, 500),
	(81, 27, '0081-I9-B', 'I9', 'business', 'available', NULL, 700),
	(82, 27, '0082-A10-B', 'A10', 'business', 'available', NULL, 700),
	(83, 27, '0083-B10-B', 'B10', 'business', 'available', NULL, 500),
	(84, 27, '0084-C10-B', 'C10', 'business', 'available', NULL, 500),
	(85, 27, '0085-D10-B', 'D10', 'business', 'available', NULL, 500),
	(86, 27, '0086-E10-B', 'E10', 'business', 'available', NULL, 500),
	(87, 27, '0087-F10-B', 'F10', 'business', 'available', NULL, 500),
	(88, 27, '0088-G10-B', 'G10', 'business', 'available', NULL, 500),
	(89, 27, '0089-H10-B', 'H10', 'business', 'available', NULL, 500),
	(90, 27, '0090-I10-B', 'I10', 'business', 'available', NULL, 700),
	(91, 27, '0091-A11-E', 'A11', 'economy', 'available', NULL, 140),
	(92, 27, '0092-B11-E', 'B11', 'economy', 'available', NULL, 100),
	(93, 27, '0093-C11-E', 'C11', 'economy', 'available', NULL, 100),
	(94, 27, '0094-D11-E', 'D11', 'economy', 'available', NULL, 100),
	(95, 27, '0095-E11-E', 'E11', 'economy', 'available', NULL, 100),
	(96, 27, '0096-F11-E', 'F11', 'economy', 'available', NULL, 100),
	(97, 27, '0097-G11-E', 'G11', 'economy', 'available', NULL, 100),
	(98, 27, '0098-H11-E', 'H11', 'economy', 'available', NULL, 100),
	(99, 27, '0099-I11-E', 'I11', 'economy', 'available', NULL, 140),
	(100, 27, '0100-A12-E', 'A12', 'economy', 'available', NULL, 140),
	(101, 27, '0101-B12-E', 'B12', 'economy', 'available', NULL, 100),
	(102, 27, '0102-C12-E', 'C12', 'economy', 'available', NULL, 100),
	(103, 27, '0103-D12-E', 'D12', 'economy', 'available', NULL, 100),
	(104, 27, '0104-E12-E', 'E12', 'economy', 'available', NULL, 100),
	(105, 27, '0105-F12-E', 'F12', 'economy', 'available', NULL, 100),
	(106, 27, '0106-G12-E', 'G12', 'economy', 'available', NULL, 100),
	(107, 27, '0107-H12-E', 'H12', 'economy', 'available', NULL, 100),
	(108, 27, '0108-I12-E', 'I12', 'economy', 'available', NULL, 140),
	(109, 27, '0109-A13-E', 'A13', 'economy', 'available', NULL, 140),
	(110, 27, '0110-B13-E', 'B13', 'economy', 'available', NULL, 100),
	(111, 27, '0111-C13-E', 'C13', 'economy', 'available', NULL, 100),
	(112, 27, '0112-D13-E', 'D13', 'economy', 'available', NULL, 100),
	(113, 27, '0113-E13-E', 'E13', 'economy', 'available', NULL, 100),
	(114, 27, '0114-F13-E', 'F13', 'economy', 'available', NULL, 100),
	(115, 27, '0115-G13-E', 'G13', 'economy', 'available', NULL, 100),
	(116, 27, '0116-H13-E', 'H13', 'economy', 'available', NULL, 100),
	(117, 27, '0117-I13-E', 'I13', 'economy', 'available', NULL, 140),
	(118, 27, '0118-A14-E', 'A14', 'economy', 'available', NULL, 140),
	(119, 27, '0119-B14-E', 'B14', 'economy', 'available', NULL, 100),
	(120, 27, '0120-C14-E', 'C14', 'economy', 'available', NULL, 100),
	(121, 27, '0121-D14-E', 'D14', 'economy', 'available', NULL, 100),
	(122, 27, '0122-E14-E', 'E14', 'economy', 'available', NULL, 100),
	(123, 27, '0123-F14-E', 'F14', 'economy', 'available', NULL, 100),
	(124, 27, '0124-G14-E', 'G14', 'economy', 'available', NULL, 100),
	(125, 27, '0125-H14-E', 'H14', 'economy', 'available', NULL, 100),
	(126, 27, '0126-I14-E', 'I14', 'economy', 'available', NULL, 140),
	(127, 27, '0127-A15-E', 'A15', 'economy', 'available', NULL, 140),
	(128, 27, '0128-B15-E', 'B15', 'economy', 'available', NULL, 100),
	(129, 27, '0129-C15-E', 'C15', 'economy', 'available', NULL, 100),
	(130, 27, '0130-D15-E', 'D15', 'economy', 'available', NULL, 100),
	(131, 27, '0131-E15-E', 'E15', 'economy', 'available', NULL, 100),
	(132, 27, '0132-F15-E', 'F15', 'economy', 'available', NULL, 100),
	(133, 27, '0133-G15-E', 'G15', 'economy', 'available', NULL, 100),
	(134, 27, '0134-H15-E', 'H15', 'economy', 'available', NULL, 100),
	(135, 27, '0135-I15-E', 'I15', 'economy', 'available', NULL, 140),
	(136, 27, '0136-A16-E', 'A16', 'economy', 'available', NULL, 140),
	(137, 27, '0137-B16-E', 'B16', 'economy', 'available', NULL, 100),
	(138, 27, '0138-C16-E', 'C16', 'economy', 'available', NULL, 100),
	(139, 27, '0139-D16-E', 'D16', 'economy', 'available', NULL, 100),
	(140, 27, '0140-E16-E', 'E16', 'economy', 'available', NULL, 100),
	(141, 27, '0141-F16-E', 'F16', 'economy', 'available', NULL, 100),
	(142, 27, '0142-G16-E', 'G16', 'economy', 'available', NULL, 100),
	(143, 27, '0143-H16-E', 'H16', 'economy', 'available', NULL, 100),
	(144, 27, '0144-I16-E', 'I16', 'economy', 'available', NULL, 140),
	(145, 27, '0145-A17-E', 'A17', 'economy', 'available', NULL, 140),
	(146, 27, '0146-B17-E', 'B17', 'economy', 'available', NULL, 100),
	(147, 27, '0147-C17-E', 'C17', 'economy', 'available', NULL, 100),
	(148, 27, '0148-D17-E', 'D17', 'economy', 'available', NULL, 100),
	(149, 27, '0149-E17-E', 'E17', 'economy', 'available', NULL, 100),
	(150, 27, '0150-F17-E', 'F17', 'economy', 'available', NULL, 100),
	(151, 27, '0151-G17-E', 'G17', 'economy', 'available', NULL, 100),
	(152, 27, '0152-H17-E', 'H17', 'economy', 'available', NULL, 100),
	(153, 27, '0153-I17-E', 'I17', 'economy', 'available', NULL, 140),
	(154, 27, '0154-A18-E', 'A18', 'economy', 'available', NULL, 140),
	(155, 27, '0155-B18-E', 'B18', 'economy', 'available', NULL, 100),
	(156, 27, '0156-C18-E', 'C18', 'economy', 'available', NULL, 100),
	(157, 27, '0157-D18-E', 'D18', 'economy', 'available', NULL, 100),
	(158, 27, '0158-E18-E', 'E18', 'economy', 'available', NULL, 100),
	(159, 27, '0159-F18-E', 'F18', 'economy', 'available', NULL, 100),
	(160, 27, '0160-G18-E', 'G18', 'economy', 'available', NULL, 100),
	(161, 27, '0161-H18-E', 'H18', 'economy', 'available', NULL, 100),
	(162, 27, '0162-I18-E', 'I18', 'economy', 'available', NULL, 140),
	(163, 27, '0163-A19-E', 'A19', 'economy', 'available', NULL, 140),
	(164, 27, '0164-B19-E', 'B19', 'economy', 'available', NULL, 100),
	(165, 27, '0165-C19-E', 'C19', 'economy', 'available', NULL, 100),
	(166, 27, '0166-D19-E', 'D19', 'economy', 'available', NULL, 100),
	(167, 27, '0167-E19-E', 'E19', 'economy', 'available', NULL, 100),
	(168, 27, '0168-F19-E', 'F19', 'economy', 'available', NULL, 100),
	(169, 27, '0169-G19-E', 'G19', 'economy', 'available', NULL, 100),
	(170, 27, '0170-H19-E', 'H19', 'economy', 'available', NULL, 100),
	(171, 27, '0171-I19-E', 'I19', 'economy', 'available', NULL, 140),
	(172, 27, '0172-A20-E', 'A20', 'economy', 'available', NULL, 140),
	(173, 27, '0173-B20-E', 'B20', 'economy', 'available', NULL, 100),
	(174, 27, '0174-C20-E', 'C20', 'economy', 'available', NULL, 100),
	(175, 27, '0175-D20-E', 'D20', 'economy', 'available', NULL, 100),
	(176, 27, '0176-E20-E', 'E20', 'economy', 'available', NULL, 100),
	(177, 27, '0177-F20-E', 'F20', 'economy', 'available', NULL, 100),
	(178, 27, '0178-G20-E', 'G20', 'economy', 'available', NULL, 100),
	(179, 27, '0179-H20-E', 'H20', 'economy', 'available', NULL, 100),
	(180, 27, '0180-I20-E', 'I20', 'economy', 'available', NULL, 140),
	(181, 27, '0181-A21-E', 'A21', 'economy', 'available', NULL, 140),
	(182, 27, '0182-B21-E', 'B21', 'economy', 'available', NULL, 100),
	(183, 27, '0183-C21-E', 'C21', 'economy', 'available', NULL, 100),
	(184, 27, '0184-D21-E', 'D21', 'economy', 'available', NULL, 100),
	(185, 27, '0185-E21-E', 'E21', 'economy', 'available', NULL, 100),
	(186, 27, '0186-F21-E', 'F21', 'economy', 'available', NULL, 100),
	(187, 27, '0187-G21-E', 'G21', 'economy', 'available', NULL, 100),
	(188, 27, '0188-H21-E', 'H21', 'economy', 'available', NULL, 100),
	(189, 27, '0189-I21-E', 'I21', 'economy', 'available', NULL, 140),
	(190, 27, '0190-A22-E', 'A22', 'economy', 'available', NULL, 140),
	(191, 27, '0191-B22-E', 'B22', 'economy', 'available', NULL, 100),
	(192, 27, '0192-C22-E', 'C22', 'economy', 'available', NULL, 100),
	(193, 27, '0193-D22-E', 'D22', 'economy', 'available', NULL, 100),
	(194, 27, '0194-E22-E', 'E22', 'economy', 'available', NULL, 100),
	(195, 27, '0195-F22-E', 'F22', 'economy', 'available', NULL, 100),
	(196, 27, '0196-G22-E', 'G22', 'economy', 'available', NULL, 100),
	(197, 27, '0197-H22-E', 'H22', 'economy', 'available', NULL, 100),
	(198, 27, '0198-I22-E', 'I22', 'economy', 'available', NULL, 140),
	(199, 27, '0199-A23-E', 'A23', 'economy', 'available', NULL, 140),
	(200, 27, '0200-B23-E', 'B23', 'economy', 'available', NULL, 100),
	(201, 27, '0201-C23-E', 'C23', 'economy', 'available', NULL, 100),
	(202, 27, '0202-D23-E', 'D23', 'economy', 'available', NULL, 100),
	(203, 27, '0203-E23-E', 'E23', 'economy', 'available', NULL, 100),
	(204, 27, '0204-F23-E', 'F23', 'economy', 'available', NULL, 100),
	(205, 27, '0205-G23-E', 'G23', 'economy', 'available', NULL, 100),
	(206, 27, '0206-H23-E', 'H23', 'economy', 'available', NULL, 100),
	(207, 27, '0207-I23-E', 'I23', 'economy', 'available', NULL, 140),
	(208, 27, '0208-A24-E', 'A24', 'economy', 'available', NULL, 140),
	(209, 27, '0209-B24-E', 'B24', 'economy', 'available', NULL, 100),
	(210, 27, '0210-C24-E', 'C24', 'economy', 'available', NULL, 100),
	(211, 27, '0211-D24-E', 'D24', 'economy', 'available', NULL, 100),
	(212, 27, '0212-E24-E', 'E24', 'economy', 'available', NULL, 100),
	(213, 27, '0213-F24-E', 'F24', 'economy', 'available', NULL, 100),
	(214, 27, '0214-G24-E', 'G24', 'economy', 'available', NULL, 100),
	(215, 27, '0215-H24-E', 'H24', 'economy', 'available', NULL, 100),
	(216, 27, '0216-I24-E', 'I24', 'economy', 'available', NULL, 140),
	(217, 27, '0217-A25-E', 'A25', 'economy', 'available', NULL, 140),
	(218, 27, '0218-B25-E', 'B25', 'economy', 'available', NULL, 100),
	(219, 27, '0219-C25-E', 'C25', 'economy', 'available', NULL, 100),
	(220, 27, '0220-D25-E', 'D25', 'economy', 'available', NULL, 100),
	(221, 27, '0221-E25-E', 'E25', 'economy', 'available', NULL, 100),
	(222, 27, '0222-F25-E', 'F25', 'economy', 'available', NULL, 100),
	(223, 27, '0223-G25-E', 'G25', 'economy', 'available', NULL, 100),
	(224, 27, '0224-H25-E', 'H25', 'economy', 'available', NULL, 100),
	(225, 27, '0225-I25-E', 'I25', 'economy', 'available', NULL, 140),
	(226, 27, '0226-A26-E', 'A26', 'economy', 'available', NULL, 140),
	(227, 27, '0227-B26-E', 'B26', 'economy', 'available', NULL, 100),
	(228, 27, '0228-C26-E', 'C26', 'economy', 'available', NULL, 100),
	(229, 27, '0229-D26-E', 'D26', 'economy', 'available', NULL, 100),
	(230, 27, '0230-E26-E', 'E26', 'economy', 'available', NULL, 100),
	(231, 27, '0231-F26-E', 'F26', 'economy', 'available', NULL, 100),
	(232, 27, '0232-G26-E', 'G26', 'economy', 'available', NULL, 100),
	(233, 27, '0233-H26-E', 'H26', 'economy', 'available', NULL, 100),
	(234, 27, '0234-I26-E', 'I26', 'economy', 'available', NULL, 140),
	(235, 27, '0235-A27-E', 'A27', 'economy', 'available', NULL, 140),
	(236, 27, '0236-B27-E', 'B27', 'economy', 'available', NULL, 100),
	(237, 27, '0237-C27-E', 'C27', 'economy', 'available', NULL, 100),
	(238, 27, '0238-D27-E', 'D27', 'economy', 'available', NULL, 100),
	(239, 27, '0239-E27-E', 'E27', 'economy', 'available', NULL, 100),
	(240, 27, '0240-F27-E', 'F27', 'economy', 'available', NULL, 100),
	(241, 27, '0241-G27-E', 'G27', 'economy', 'available', NULL, 100),
	(242, 27, '0242-H27-E', 'H27', 'economy', 'available', NULL, 100),
	(243, 27, '0243-I27-E', 'I27', 'economy', 'available', NULL, 140),
	(244, 27, '0244-A28-E', 'A28', 'economy', 'available', NULL, 140),
	(245, 27, '0245-B28-E', 'B28', 'economy', 'available', NULL, 100),
	(246, 27, '0246-C28-E', 'C28', 'economy', 'available', NULL, 100),
	(247, 27, '0247-D28-E', 'D28', 'economy', 'available', NULL, 100),
	(248, 27, '0248-E28-E', 'E28', 'economy', 'available', NULL, 100),
	(249, 27, '0249-F28-E', 'F28', 'economy', 'available', NULL, 100),
	(250, 27, '0250-G28-E', 'G28', 'economy', 'available', NULL, 100),
	(251, 27, '0251-H28-E', 'H28', 'economy', 'available', NULL, 100),
	(252, 27, '0252-I28-E', 'I28', 'economy', 'available', NULL, 140),
	(253, 27, '0253-A29-E', 'A29', 'economy', 'available', NULL, 140),
	(254, 27, '0254-B29-E', 'B29', 'economy', 'available', NULL, 100),
	(255, 27, '0255-C29-E', 'C29', 'economy', 'available', NULL, 100),
	(256, 27, '0256-D29-E', 'D29', 'economy', 'available', NULL, 100),
	(257, 27, '0257-E29-E', 'E29', 'economy', 'available', NULL, 100),
	(258, 27, '0258-F29-E', 'F29', 'economy', 'available', NULL, 100),
	(259, 27, '0259-G29-E', 'G29', 'economy', 'available', NULL, 100),
	(260, 27, '0260-H29-E', 'H29', 'economy', 'available', NULL, 100),
	(261, 27, '0261-I29-E', 'I29', 'economy', 'available', NULL, 140),
	(262, 27, '0262-A30-E', 'A30', 'economy', 'available', NULL, 140),
	(263, 27, '0263-B30-E', 'B30', 'economy', 'available', NULL, 100),
	(264, 27, '0264-C30-E', 'C30', 'economy', 'available', NULL, 100),
	(265, 27, '0265-D30-E', 'D30', 'economy', 'available', NULL, 100),
	(266, 27, '0266-E30-E', 'E30', 'economy', 'available', NULL, 100),
	(267, 27, '0267-F30-E', 'F30', 'economy', 'available', NULL, 100),
	(268, 27, '0268-G30-E', 'G30', 'economy', 'available', NULL, 100),
	(269, 27, '0269-H30-E', 'H30', 'economy', 'available', NULL, 100),
	(270, 27, '0270-I30-E', 'I30', 'economy', 'available', NULL, 140);

-- Dumping structure for table lugia.tbluser
CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
