-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2017 at 03:07 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--
CREATE DATABASE IF NOT EXISTS `hr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hr`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_list`
--

DROP TABLE IF EXISTS `activity_list`;
CREATE TABLE `activity_list` (
  `id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `organizer_id` varchar(255) NOT NULL,
  `staff_id` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Activity Calendar table';

-- --------------------------------------------------------

--
-- Table structure for table `attendance_counter`
--

DROP TABLE IF EXISTS `attendance_counter`;
CREATE TABLE `attendance_counter` (
  `id` int(11) NOT NULL,
  `staff_id` tinyint(4) NOT NULL,
  `year` year(4) NOT NULL,
  `sick_leave_balance` int(11) NOT NULL,
  `vac_leave_balance` int(11) NOT NULL,
  `vac_leave_ctr` int(11) NOT NULL,
  `maternity_leave` tinyint(1) NOT NULL,
  `sick_leave_ctr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_record`
--

DROP TABLE IF EXISTS `attendance_record`;
CREATE TABLE `attendance_record` (
  `id` int(11) NOT NULL,
  `staff_id` tinyint(4) NOT NULL,
  `year` year(4) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approved_by` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Attendance records';

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

DROP TABLE IF EXISTS `organizer`;
CREATE TABLE `organizer` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `rep_contact` int(11) DEFAULT NULL,
  `rep_name` varchar(255) DEFAULT NULL,
  `rep_email` varchar(255) DEFAULT NULL,
  `rep_address` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Organizer table';

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `staff_id` tinyint(4) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `staff_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Staff table';

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE `user_accounts` (
  `staff_id` tinyint(4) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `attendance_recorder` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Users';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_list`
--
ALTER TABLE `activity_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_counter`
--
ALTER TABLE `attendance_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_record`
--
ALTER TABLE `attendance_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_list`
--
ALTER TABLE `activity_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_counter`
--
ALTER TABLE `attendance_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_record`
--
ALTER TABLE `attendance_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` tinyint(4) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
