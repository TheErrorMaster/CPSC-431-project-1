-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 01, 2020 at 04:36 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `add_id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`add_id`, `street`, `city`, `state`, `zip`, `username`) VALUES
(9, 'sandal', 'anaheim', 'CA', '92806', 'maui123456'),
(10, 'sandal', 'anaheim', 'CA', '92806', 'mauricio.macias'),
(11, 'sandal', 'anaheim', 'CA', '92806', 'maui123');

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

DROP TABLE IF EXISTS `credit`;
CREATE TABLE IF NOT EXISTS `credit` (
  `credit_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `credit_number` int(15) NOT NULL,
  `security` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`credit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`credit_id`, `name`, `credit_number`, `security`, `username`) VALUES
(17, 'mauricio', 123, 123, 'maui123456'),
(18, 'mauricio', 123, 123, 'mauricio.macias'),
(19, 'mauricio', 123, 123, 'maui123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `email`, `password`, `phone`) VALUES
('maui123456', 'mauricio.macias@csu.fullerton.edu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7144699'),
('mauricio.macias', 'mauricio.macias@csu.fullerton.edu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7144699'),
('maui123', 'mauricio.macias@csu.fullerton.edu', '02e83b29b8887f23db707ecfda420279ac7eed29', '7144699');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `name`, `price`, `picture`, `description`) VALUES
(1, '30 year old boomer', 15, '30_yr_old_boomer.PNG', 'movie'),
(2, 'corona virus', 10, 'corona_virus.PNG', 'food'),
(3, 'corgi theft auto', 50, 'cta.PNG', 'game'),
(4, 'grand theft auto philiy', 50, 'gta_philly.PNG', 'food'),
(7, 'Heinz Ketchup Soda', 3, 'heinz_ketchup_soda.PNG', 'food');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
