-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 04:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makiling`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_request`
--

CREATE TABLE `file_request` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `purpose_description` text NOT NULL,
  `voters_id_image` varchar(255) NOT NULL,
  `voters_id_number` varchar(20) NOT NULL,
  `datetime_created` timestamp NULL DEFAULT current_timestamp(),
  `tracking_number` varchar(255) DEFAULT NULL,
  `file_status` enum('Processing','Ready for Pickup','Reviewing','Declined') DEFAULT 'Processing',
  `remarks` varchar(255) NOT NULL,
  `notification_played` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_request`
--

INSERT INTO `file_request` (`id`, `type`, `firstname`, `lastname`, `contact_number`, `pickup_datetime`, `purpose_description`, `voters_id_image`, `voters_id_number`, `datetime_created`, `tracking_number`, `file_status`, `remarks`, `notification_played`) VALUES
(403, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Declined', 'theth', 1),
(404, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Ready for Pickup', '', 1),
(405, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(406, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(407, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(408, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(409, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(410, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(411, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(412, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(413, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(414, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(415, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(416, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(417, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(418, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Ready for Pickup', '', 1),
(419, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(420, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(421, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(422, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Ready for Pickup', '', 1),
(423, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(424, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(425, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(426, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(427, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(428, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(429, 'Certificate of Residency', 'Queen', 'Gajes', '978696789', '2024-03-23 03:45:00', 'none', '../Uploaded File/VotersID_Gajes_Queen.png', '567456754754', '2024-03-17 16:23:59', '65f7191fead05', 'Ready for Pickup', '', 1),
(430, 'Certificate of Indigency', '12312', '3123123', '123123', '2024-03-23 12:52:00', '123123123', '../Uploaded File/VotersID_3123123_12312.png', '123123', '2024-03-17 16:50:34', '65f71f5a91b8f', 'Declined', 'bahala ka bro', 1),
(431, 'Certificate of Indigency', 'test', 'test', '09769678978', '2024-03-25 07:51:00', 'test', '../Uploaded File/VotersID_test_test.png', 'htrdhrt5643w', '2024-03-23 09:51:25', '65fea61d2b4da', 'Declined', 'nauh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `first_time_job`
--

CREATE TABLE `first_time_job` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `civil_status` enum('Married','Single','Divorced','Widowed') NOT NULL,
  `address` varchar(255) NOT NULL,
  `residency` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `job_start_beneficiary` enum('yes','no') NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `datetime_created` datetime DEFAULT current_timestamp(),
  `id_number` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `purpose_description` text NOT NULL,
  `file_status` enum('Processing','Ready for Pickup','Reviewing','Declined') DEFAULT 'Processing',
  `remarks` varchar(255) NOT NULL,
  `notification_played` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_time_job`
--

INSERT INTO `first_time_job` (`id`, `type`, `firstname`, `lastname`, `birthdate`, `age`, `gender`, `contact_number`, `civil_status`, `address`, `residency`, `education`, `course`, `job_start_beneficiary`, `pickup_datetime`, `datetime_created`, `id_number`, `avatar`, `tracking_number`, `purpose_description`, `file_status`, `remarks`, `notification_played`) VALUES
(13, 'First Time Job Seeker', 'Ron', 'Galang', '2002-01-31', 23, 'Male', '09762911692', 'Single', 'Calamba, Laguna', 'Less than a Year', 'Bachelor\'s Degree', 'BSIT', 'yes', '2024-03-20 03:46:00', '2024-03-18 00:47:42', 'HS10489', '../Uploaded File/ID_Galang_Ron.png', '65f71eae8d91f', '', 'Declined', 'gerg', 1),
(14, 'First Time Job Seeker', '234234', '234234', '2024-02-27', 23, 'Male', '234234', 'Single', '234234234', 'Less than a Year', 'Associate\'s Degree', 'NA', 'yes', '2024-03-23 01:24:00', '2024-03-18 01:23:01', '123123', '../Uploaded File/ID_234234_234234.png', '65f726f510cde', '', 'Declined', 'bro what is that ID?', 1),
(15, 'First Time Job Seeker', 'ROnRON', 'GLANAG', '2024-03-14', 23, 'Male', '09796578576', 'Single', 'Calamaba Lagunana', 'More than a Year', 'Bachelor\'s Degree', 'BSIT', 'yes', '2024-03-25 06:24:00', '2024-03-23 16:26:27', '0946784064', '../Uploaded File/ID_GLANAG_ROnRON.png', '65fe92331f7cc', 'Fof my work bro bro', 'Reviewing', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `firstname` varchar(35) NOT NULL,
  `lastname` varchar(35) NOT NULL,
  `idnumber` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `staff_role` enum('Admin','Staff') DEFAULT 'Staff',
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_timestamp` timestamp NULL DEFAULT NULL,
  `is_logged_in` tinyint(4) NOT NULL,
  `account_status` enum('Activated','Deactivated') DEFAULT 'Activated',
  `verification_code` varchar(255) DEFAULT NULL,
  `email_verify` tinyint(4) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `passreset_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `idnumber`, `email`, `gender`, `age`, `pass`, `staff_role`, `dateCreated`, `last_login_timestamp`, `is_logged_in`, `account_status`, `verification_code`, `email_verify`, `email_verified_at`, `reset_token`, `passreset_timestamp`) VALUES
(65, 'Jeah', 'Arcillas', 'jeah123', 'jeah@gmail.com', 'Female', 45, '$2y$10$ri62D8IFiGowWY9XGv13.ukTxA7AO/Y5Ted2bv8rAPKWaEG8g//Da', 'Admin', '2024-02-18 15:45:05', '2024-02-24 06:04:47', 0, 'Activated', NULL, 1, NULL, NULL, NULL),
(67, 'Ron', 'Galang', '123', 'ron@gmail.com', 'Male', 22, '$2y$10$NXwhY1FgxvYq7pZqkzE5TOlp4EewRU4ZUhitfR1eZ8hwJ4jDgAsIm', 'Admin', '2024-03-16 05:07:18', '2024-03-24 05:58:57', 0, 'Activated', NULL, 1, NULL, NULL, NULL),
(69, 'Mcvince', 'Paul', '321', 'mcvince@gmail.com', 'Male', 23, '$2y$10$5PL8EuRYrDwmssoHJiB5ye80.sAUG3DzrEotnkW0fII8LeD6cCqGO', 'Admin', '2024-03-18 08:39:56', '2024-03-18 08:40:01', 0, 'Deactivated', NULL, 1, NULL, NULL, NULL),
(93, 'Ron', 'Galang', '123123', 'ronronnn31@gmail.com', 'Male', 21, '$2y$10$51kkOuL/Dvzpg0cM87q7Fupev72PhUxZOoz1g0bIQsrHWtmG/CQ0O', 'Staff', '2024-03-24 09:32:15', '2024-03-24 02:32:12', 0, 'Activated', '216113', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfilehistory`
--

CREATE TABLE `tblfilehistory` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `purpose_description` text NOT NULL,
  `voters_id_image` varchar(255) NOT NULL,
  `voters_id_number` varchar(20) NOT NULL,
  `datetime_created` timestamp NULL DEFAULT current_timestamp(),
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `tracking_number` varchar(255) DEFAULT NULL,
  `file_status` enum('Processing','Ready for Pickup','Disapproved') DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_request`
--
ALTER TABLE `file_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_time_job`
--
ALTER TABLE `first_time_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfilehistory`
--
ALTER TABLE `tblfilehistory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_request`
--
ALTER TABLE `file_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT for table `first_time_job`
--
ALTER TABLE `first_time_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tblfilehistory`
--
ALTER TABLE `tblfilehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
