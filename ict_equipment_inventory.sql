-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2024 at 05:43 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ict_equipment_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`userID`, `firstname`, `surname`, `username`, `password`) VALUES
(1, 'JOHN', 'MARANDU', 'marandu', '$2y$10$8Fm7ZsX4Uw6uAYj6JwvSbOVhOVHtqrTlnlLOELf9tcoJKHiDP.X3i');

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

DROP TABLE IF EXISTS `allocation`;
CREATE TABLE IF NOT EXISTS `allocation` (
  `allocation_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `allocation_date` date DEFAULT NULL,
  `employee_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `equipment_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `COMMENT` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`allocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`allocation_id`, `allocation_date`, `employee_id`, `equipment_id`, `COMMENT`) VALUES
('1', '2024-09-19', '11234', '1234', 'issued');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `department_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
('1015', 'ICT UNIT');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `designation_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `designation_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`) VALUES
('1', 'ICT OFFICER');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `f_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `s_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `designation_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `f_name`, `s_name`, `department_id`, `designation_id`) VALUES
('11234', 'Baraka', 'Emmanuel', '1015', '1');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

DROP TABLE IF EXISTS `equipments`;
CREATE TABLE IF NOT EXISTS `equipments` (
  `equipment_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serialnumber` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `STATUS` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `specification` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `GOV_code` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`equipment_id`, `equipment_name`, `model`, `serialnumber`, `STATUS`, `specification`, `GOV_code`, `category_id`) VALUES
('1234', 'HP PROBOOK', 'HP x360', 'G56566', 'active', 'core i7 RAM 8GB', 'RAS*84*566', '1');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE IF NOT EXISTS `equipment_category` (
  `category_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_category`
--

INSERT INTO `equipment_category` (`category_id`, `category`) VALUES
('1', 'laptop');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
