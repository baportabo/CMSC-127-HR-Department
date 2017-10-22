-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2017 at 03:06 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lukedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_list`
--

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

CREATE TABLE `organizer` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `rep_contact` varchar(11) DEFAULT NULL,
  `rep_name` varchar(255) DEFAULT NULL,
  `rep_email` varchar(255) DEFAULT NULL,
  `rep_address` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Organizer table';

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`org_id`, `org_name`, `rep_contact`, `rep_name`, `rep_email`, `rep_address`) VALUES
(2, 'Sagip mata Org', '09099730701', 'SMO', 'smo@gmail.com', 'Cab Hill, BC'),
(3, 'Sagip bibig Org', '09099730701', 'SBO', 'sbo@gmail.com', 'Eng Hill, BC'),
(4, 'Sagip ilong ORG', '09099730701', 'SIO', 'sio@gmail.com', 'Baguio City'),
(5, 'Sagip Ngipin Org', '09099730701', 'SNO', 'sno@gmail.com', 'Baguio City'),
(6, 'Sagip g ORG', '09099730701', 'SIO', 'adda@gmial.com', 'Baguio City'),
(7, 'Sagip gg Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(8, 'Sagip gga Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(9, 'Sagip ggbb Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(10, 'Sagip ggc Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(11, 'Sagip ggd Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(12, 'Sagip gge Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(13, 'Sagip ggf Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(14, 'Sagip ggg Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(15, 'Sagip ggghhe Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(16, '1113', '1321', '1312', 'addd@ada.asda', '12321'),
(17, 'GG EZ ORgs', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(18, 'qeqweqwe', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(19, 'Felix Best Girl', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(20, 'Emilia Best Gurl', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(21, 'REM NOT BEST GURL', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(27, 'Elmo&#39;s World', 'None', 'None', 'None', 'None'),
(25, 'Toxxic si Tata', 'None', 'Tatabells', 'du30@gmali.com', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` tinyint(4) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `staff_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Staff table';

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `last_name`, `first_name`, `middle_name`, `address`, `contact_number`, `email_address`, `staff_type`) VALUES
(1, 'Aledo', 'Allen', 'Rosal', 'CH BC', '09099730701', 'a@a.a', 'dev'),
(2, 'G', 'G', 'G', 'G', 'G', 'g@g.g', 'G'),
(3, 'H', 'H', 'H', 'H', 'H', 'H', 'H'),
(4, 'A', 'B', 'C', 'N/A', 'N/A', 'N/A', 'test'),
(7, 'Balbuena', 'Manuel', 'Manzo', '21321321', '21313213', '123adsd@.asdasd', 'dev');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `staff_id` tinyint(4) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `attendance_recorder` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Users';

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`staff_id`, `uname`, `pword`, `attendance_recorder`) VALUES
(1, 'admin', 'admin', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
