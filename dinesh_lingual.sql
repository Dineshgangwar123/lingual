-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2022 at 09:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinesh_lingual`
--

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE `cast` (
  `id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `castname` varchar(200) NOT NULL,
  `castgender` char(1) NOT NULL,
  `cast_char_name` varchar(200) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cast`
--

INSERT INTO `cast` (`id`, `movieid`, `castname`, `castgender`, `cast_char_name`, `created`, `updated`) VALUES
(6, 6, 'Yash', 'M', 'Rocky', '2022-06-17 16:37:00', '2022-06-17 21:17:33'),
(7, 6, 'Shrinidhi', 'F', 'Reena', '2022-06-17 16:37:00', '2022-06-17 16:37:00'),
(8, 7, 'Allu Arjun', 'M', 'Pushpa Raj', '2022-06-17 16:45:37', '2022-06-17 16:45:37'),
(9, 7, 'Rashmika Mandanna', 'F', 'Shrivalli', '2022-06-17 16:45:37', '2022-06-17 16:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `dialogue`
--

CREATE TABLE `dialogue` (
  `id` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `starttime` time(3) NOT NULL,
  `endtime` time(3) NOT NULL,
  `char_name` varchar(200) NOT NULL,
  `dialogue` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dialogue`
--

INSERT INTO `dialogue` (`id`, `movieid`, `starttime`, `endtime`, `char_name`, `dialogue`, `created`, `updated`) VALUES
(3, 6, '01:30:59.179', '01:32:19.224', 'Rocky', 'Violence, Violence, Violence! I don\'t like it. I avoid. But, violence likes me! I can\'t avoid', '2022-06-17 16:37:00', '2022-06-17 21:17:59'),
(4, 6, '01:37:14.227', '00:00:00.000', 'Reena', 'Parti kisne band ki', '2022-06-17 16:37:00', '2022-06-17 16:37:00'),
(5, 7, '01:01:01.100', '01:02:02.200', 'Pushpa Raj', 'Main Jhukega nahi sala', '2022-06-17 16:45:37', '2022-06-17 21:14:24'),
(6, 7, '01:37:14.227', '00:00:00.000', 'Shrivalli', 'Mujhe dekh kar kawla wabra ho raha tha na', '2022-06-17 16:45:37', '2022-06-17 16:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `moviename` varchar(255) NOT NULL,
  `movieduration` time(3) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `moviename`, `movieduration`, `created`, `updated`) VALUES
(6, 'KGF2', '03:28:55.752', '2022-06-17 16:37:00', '2022-06-17 21:54:01'),
(7, 'Pushpa', '02:29:56.900', '2022-06-17 16:45:36', '2022-06-17 16:45:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cast`
--
ALTER TABLE `cast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dialogue`
--
ALTER TABLE `dialogue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cast`
--
ALTER TABLE `cast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dialogue`
--
ALTER TABLE `dialogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
