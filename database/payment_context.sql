-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2017 at 11:14 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hunter_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_context`
--

CREATE TABLE IF NOT EXISTS `payment_context` (
`id` int(11) NOT NULL,
  `payment_method` enum('paypal','offline') NOT NULL DEFAULT 'paypal',
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `Payment_date` date NOT NULL,
  `payment_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=unpaid,1=paid',
  `gateway_responce` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_context`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_context`
--
ALTER TABLE `payment_context`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_context`
--
ALTER TABLE `payment_context`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_context`
--
ALTER TABLE `payment_context`
ADD CONSTRAINT `payment_context_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
