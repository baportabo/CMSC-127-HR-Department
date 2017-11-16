-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 05:02 AM
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
  `organizer_id` longtext NOT NULL,
  `staff_id` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Activity Calendar table';

--
-- Dumping data for table `activity_list`
--

INSERT INTO `activity_list` (`id`, `activity`, `date`, `location`, `organizer_id`, `staff_id`) VALUES
(52, '123123', '2017-11-16 00:32:00', 'GGGG', 'None', 'B C A,\n\rasdas sadas 1312,\n\rasdas sadas adsa,\n\rasdas sadas adsa,\n\rAllen Rosal Aledo'),
(53, 'Christmas Day', '2017-11-12 12:00:00', 'None', 'wqewqeqewq,\n\rwqeqqw231321313212,\n\rwqeqeeqe,\n\rtest,\n\rqewqewqwwqewqewqwqewqwqeqeq,\n\rqeewq,\n\rTatatatatattatatatataata,\n\rTatabells = petmalu na lodi talaga,\n\rSagip mata Org,\n\rSagip ilong ORG,\n\rSagip ggf Org,\n\rSagip gge Org,\n\rSagip ggd Org,\n\rSagip ggc Org,\n\rSagip ggbb Org,\n\rSagip gga Org,\n\rSagip gg Org,\n\rSagip bibig Org,\n\rSagip Ngipin Org,\n\rREM NOT BEST GURL,\n\rQQQQ,\n\rGGEZ GGEZ,\n\rFelix Best Girl - daw,\n\rEmilia Best Gurl,\n\rElmo&#39;s World,\n\r1232131313213213', 'asdas sadas xcxvv,\n\rasdas sadas wqeq,\n\rasdas sadas utyuty,\n\rasdas sadas tratata,\n\rasdas sadas qweeee,\n\rasdas sadas qw,\n\rasdas sadas qqq,\n\rasdas sadas jhgj,\n\rasdas sadas bbnb,\n\rasdas sadas asd,\n\rasdas sadas adsa,\n\rasdas sadas adsa,\n\rasdas sadas 1312,\n\rManuel Manzo Balbuena,\n\rH H H,\n\rG G G,\n\rB C A,\n\rAllen Rosal Aledo');

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
  `sick_leave_ctr` int(11) NOT NULL,
  `undertime` int(11) DEFAULT NULL,
  `offset` int(11) DEFAULT NULL,
  `leave_start` date NOT NULL,
  `leave_end` date NOT NULL,
  `leave_type` varchar(255) NOT NULL
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

--
-- Dumping data for table `attendance_record`
--

INSERT INTO `attendance_record` (`id`, `staff_id`, `year`, `remarks`, `approved_by`, `start`, `end`) VALUES
(3, 1, 2017, 'adssadsada', 'ME', '2017-11-13', '2018-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `rep_position` varchar(255) NOT NULL,
  `rep_contact` varchar(255) DEFAULT NULL,
  `rep_name` varchar(255) DEFAULT NULL,
  `rep_email` varchar(255) DEFAULT NULL,
  `rep_address` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Organizer table';

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`org_id`, `org_name`, `rep_position`, `rep_contact`, `rep_name`, `rep_email`, `rep_address`) VALUES
(2, 'Sagip mata Org', 'Ring Leader', '09099730701', 'SMO', 'smo@gmail.com', 'Cab Hill, BC'),
(3, 'Sagip bibig Org', 'Ring Leader', '09099730701', 'SBO', 'sbo@gmail.com', 'Eng Hill, BC'),
(4, 'Sagip ilong ORG', 'Ring Leader', '09099730701', 'SIO', 'sio@gmail.com', 'Baguio City'),
(5, 'Sagip Ngipin Org', 'Ring Leader', '09099730701', 'SNO', 'test@gmail.com', 'Baguio City'),
(36, 'GGEZ GGEZ', 'Ring Leader', 'None', 'None', 'None', 'None'),
(7, 'Sagip gg Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(8, 'Sagip gga Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(9, 'Sagip ggbb Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(10, 'Sagip ggc Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(11, 'Sagip ggd Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(12, 'Sagip gge Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(13, 'Sagip ggf Org', 'Ring Leader', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
(37, 'wqewqeqewq', 'Ring Leader', 'None', 'None', 'None', 'None'),
(19, 'Felix Best Girl - daw', 'Ring Leader', '09099730701', 'qwewqqeeqewqewqe', 'asdsa@gmail.com', 'Cab Hill, BC'),
(20, 'Emilia Best Gurl', 'Ring Leader', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(21, 'REM NOT BEST GURL', 'Ring Leader', '09099730701', 'qwewq', 'asdsa@gmail.com', 'Cab Hill, BC'),
(27, 'Elmo&#39;s World', 'Ring Leader', 'None', 'None', 'None', 'None'),
(34, 'test', 'Ring Leader', 'None', 'None', 'None', 'None'),
(35, 'Tatabells = petmalu na lodi talaga', 'Ring Leader', 'None', 'Francis Bernardino', 'sjw@worldpress.com', 'NOPE'),
(38, 'QQQQ', 'None', '09099730701', 'AAAAA', 'None', 'None'),
(39, 'qewqewqwwqewqewqwqewqwqeqeq', 'None', '09099730701', 'GGGGGGGGGGGGGGGGGGGG', 'None', 'None'),
(40, 'wqeqeeqe', 'None', 'None', 'wwwwwwwwwwwwwwwwwwww', 'None', 'wwwwwwwwwwwwwwwww'),
(41, 'wqeqqw231321313212', '2132132132131', '09099730701', '21323131', 'a@a.a', '21321321321'),
(42, 'GGGGG', 'wqewqewqe', 'None', 'EZEZ', 'wqeewq@adas.saddas', 'wqewqewq'),
(43, '1232131313213213', '21321321', '(047)811-1365', '123213', 'None', 'None'),
(44, 'Tatatatatattatatatataata', 'wqewqe', '09099730701', 'qwewqe', 'qwewq@adasd.dasad', 'dqeqwewqewq');

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
(1, 'Aledo', 'Allen', 'Rosal', 'Universe', '09099730701', 'a@a.a', 'Official Staff'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `attendance_counter`
--
ALTER TABLE `attendance_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_record`
--
ALTER TABLE `attendance_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
