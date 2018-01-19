-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2017 at 07:07 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harjoitustyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `billing_address` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `apartment_type` varchar(200) NOT NULL,
  `apartment_area` varchar(200) NOT NULL,
  `property` varchar(200) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `order_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `acception_date` date DEFAULT NULL,
  `rejection_date` date DEFAULT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `workhours` int(50) DEFAULT NULL,
  `supplement` varchar(300) DEFAULT NULL,
  `cost` int(50) DEFAULT NULL,
  `finished_time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `requestorder`
--

DROP TABLE IF EXISTS `requestorder`;
CREATE TABLE IF NOT EXISTS `requestorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `order_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `acception_date` date DEFAULT NULL,
  `rejection_date` date DEFAULT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `workhours` int(50) DEFAULT NULL,
  `supplement` varchar(300) DEFAULT NULL,
  `cost` int(50) DEFAULT NULL,
  `finished_time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestorder`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
