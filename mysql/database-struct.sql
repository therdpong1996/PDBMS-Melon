-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2018 at 02:05 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_pdbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `pdbms_data`
--

CREATE TABLE `pdbms_data` (
  `data_id` int(11) NOT NULL,
  `identity` varchar(10) NOT NULL,
  `temp` decimal(10,2) NOT NULL,
  `humi` decimal(10,2) NOT NULL,
  `mosi` decimal(10,2) NOT NULL,
  `light` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pdbms_picture`
--

CREATE TABLE `pdbms_picture` (
  `identity` varchar(10) NOT NULL,
  `base64pic` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pdbms_data`
--
ALTER TABLE `pdbms_data`
  ADD PRIMARY KEY (`data_id`),
  ADD UNIQUE KEY `identity` (`identity`);

--
-- Indexes for table `pdbms_picture`
--
ALTER TABLE `pdbms_picture`
  ADD UNIQUE KEY `identity` (`identity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pdbms_data`
--
ALTER TABLE `pdbms_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pdbms_picture`
--
ALTER TABLE `pdbms_picture`
  ADD CONSTRAINT `pdbms_picture_ibfk_1` FOREIGN KEY (`identity`) REFERENCES `pdbms_data` (`identity`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
