-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2015 at 10:29 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tracklabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `myplaces`
--

CREATE TABLE IF NOT EXISTS `myplaces` (
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `myplaces`
--

INSERT INTO `myplaces` (`name`, `address`, `lat`, `lng`, `user_email`) VALUES
('Kochi', 'Kochi, Kerala, India', 9.931233, 76.267303, 'metallicmay@gmail.com'),
('Bengaluru', 'Bengaluru, Karnataka, India', 12.971599, 77.594566, 'metallicmay@gmail.com'),
('Chennai', 'Chennai, Tamil Nadu, India', 13.082680, 80.270721, 'metallicmay@gmail.com'),
('San Francisco', 'San Francisco, CA, USA', 37.774929, -122.419418, 'gayugovind@gmail.com'),
('Chicago', 'Chicago, IL, USA', 41.878113, -87.629799, 'gayugovind@gmail.com'),
('Ithaca', 'Ithaca, NY, USA', 42.443962, -76.501884, 'metallicmay@gmail.com'),
('Delhi', 'Delhi, ON, Canada', 42.852695, -80.499191, 'gayugovind@gmail.com'),
('Seattle', 'Seattle, WA, USA', 47.606209, -122.332069, 'gayugovind@gmail.com'),
('Edinburgh', 'Edinburgh, City of Edinburgh, UK', 55.953251, -3.188267, 'metallicmay@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_dob` date NOT NULL,
  `user_num` bigint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_dob`, `user_num`) VALUES
(1, 'Maya', 'nitt100', 'metallicmay@gmail.com', '1995-02-28', 9840852548),
(2, 'Gayu', 'tswift', 'gayugovind@gmail.com', '1995-08-27', 8220296198);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myplaces`
--
ALTER TABLE `myplaces`
  ADD UNIQUE KEY `lat` (`lat`), ADD UNIQUE KEY `lng` (`lng`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
