-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2015 at 07:30 PM
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
  `url` varchar(200) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `myplaces`
--

INSERT INTO `myplaces` (`name`, `address`, `lat`, `lng`, `url`, `user_email`) VALUES
('Tirunelveli', 'Tirunelveli, Tamil Nadu, India', 8.730000, 77.699997, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D8.73%2C77.7', 'gayugovind@gmail.com'),
('Kochi', 'Kochi, Kerala, India', 9.931233, 76.267303, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D9.931233%2C76.267304', 'uaravindshenoy@gmail.com'),
('Trichy', 'Trichy, Tiruchirappalli, Tamil Nadu, India', 10.808379, 78.646965, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D10.808379%2C78.646966', 'uaravindshenoy@gmail.com'),
('Bengaluru', 'Bengaluru, Karnataka, India', 12.971599, 77.594566, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D12.971599%2C77.594563', 'metallicmay@gmail.com'),
('Bengaluru', 'Bengaluru, Karnataka, India', 12.971599, 77.594566, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D12.971599%2C77.594563', 'uaravindshenoy@gmail.com'),
('Dubai', 'Dubai - Dubai - United Arab Emirates', 25.204849, 55.270782, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D25.204849%2C55.270783', 'uaravindshenoy@gmail.com'),
('Georgia', 'Georgia, USA', 32.165623, -82.900078, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D32.165622%2C-82.900075', 'gayugovind@gmail.com'),
('San Jose', 'San Jose, CA, USA', 37.338207, -121.886330, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D37.338208%2C-121.886329', 'gayugovind@gmail.com'),
('Colorado Springs', 'Colorado Springs, CO, USA', 38.833881, -104.821365, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D38.833882%2C-104.821363', 'metallicmay@gmail.com'),
('Edinburgh', 'Edinburgh, City of Edinburgh, UK', 55.953251, -3.188267, 'https%3A%2F%2Fmaps.google.com%2Fmaps%3Fll%3D55.953252%2C-3.188267', 'metallicmay@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_dob`, `user_num`) VALUES
(1, 'Maya', 'nitt100', 'metallicmay@gmail.com', '1995-02-28', 9840852548),
(2, 'Gayu', 'tswift', 'gayugovind@gmail.com', '1995-08-27', 8220296198),
(4, 'Shenoy', 'lotr25', 'uaravindshenoy@gmail.com', '1994-11-24', 8148224360);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myplaces`
--
ALTER TABLE `myplaces`
  ADD UNIQUE KEY `dupli` (`lat`,`lng`,`user_email`);

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
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
