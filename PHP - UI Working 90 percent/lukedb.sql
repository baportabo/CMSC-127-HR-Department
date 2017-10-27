-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 05:09 AM
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
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `organizer_id` varchar(255) NOT NULL,
  `staff_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Activity Calendar table';

--
-- Dumping data for table `activity_list`
--

INSERT INTO `activity_list` (`id`, `activity`, `date`, `location`, `organizer_id`, `staff_id`) VALUES
(3, 'qweqwqwwqqewq', '2017-10-26', 'e123213212121', 'test', 'asdas sadas adsa'),
(4, '123213132131', '2017-10-26', '23212454sadfsad dd asds awd qawd qwd', '2015620', 'G G G'),
(5, 'qweqewqwqe', '2017-10-26', 'qewqewqewqe', 'None', 'None'),
(6, 'tata', '2017-10-26', 'adasdsaa', 'None', 'None'),
(7, 'tatabellass', '2017-10-26', 'qweqeq', 'None', 'None');

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
(5, 'Sagip Ngipin Org', '09099730701', 'SNO', 'test@gmail.com', 'Baguio City'),
(36, 'GGEZ GGEZ', 'None', 'None', 'None', 'None'),
(7, 'Sagip gg Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(8, 'Sagip gga Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(9, 'Sagip ggbb Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(10, 'Sagip ggc Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(11, 'Sagip ggd Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(12, 'Sagip gge Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(13, 'Sagip ggf Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(17, 'GG EZ ORgs', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(37, 'wqewqeqewq', 'None', 'None', 'None', 'None'),
(19, 'Felix Best Girl', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(20, 'Emilia Best Gurl', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(21, 'REM NOT BEST GURL', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(27, 'Elmo&#39;s World', 'None', 'None', 'None', 'None'),
(34, 'test', 'None', 'None', 'None', 'None'),
(35, 'Tatabells = petmalu na lodi talaga', 'None', 'Francis Bernardino', 'sjw@worldpress.com', 'NOPE');

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
(7, 'Balbuena', 'Manuel', 'Manzo', '21321321', '21313213', '123adsd@.asdasd', 'dev'),
(8, 'adsa', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(9, 'adsa', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(10, 'qw', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(11, 'wqeq', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(12, 'asd', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(13, '1312', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(14, 'qweeee', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(15, 'tratata', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(16, 'qqq', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(17, 'jhgj', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(18, 'xcxvv', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(19, 'bbnb', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff'),
(20, 'utyuty', 'asdas', 'sadas', 'asdsa', '09099730701', 'adas@asdas.adsdsa', 'Staff');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
