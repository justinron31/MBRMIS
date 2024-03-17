-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 03:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `tracking_number` varchar(255) DEFAULT NULL,
  `file_status` enum('Processing','Ready for Pickup','Disapproved') DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_request`
--

INSERT INTO `file_request` (`id`, `type`, `firstname`, `lastname`, `contact_number`, `pickup_datetime`, `purpose_description`, `voters_id_image`, `voters_id_number`, `datetime_created`, `viewed`, `tracking_number`, `file_status`) VALUES
(362, 'Certificate of Indigency', 'mcvincew', 'delacruz', '09874564564', '2024-02-26 12:31:00', 'none', '../Uploaded File/VotersID_delacruz_mcvincew.png', '4532215', '2024-02-24 06:20:04', 1, '65d98a9418a2f', 'Ready for Pickup'),
(363, 'Certificate of Indigency', 'Jeah', 'Arcillas', '09122323231', '2024-03-11 08:35:00', 'sasa', '../Uploaded File/VotersID_Arcillas_Jeah.jpg', '1212', '2024-03-02 07:36:24', 1, '65e2d6f8e63d7', 'Processing');

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
  `verification_code` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `idnumber`, `email`, `gender`, `age`, `pass`, `staff_role`, `dateCreated`, `last_login_timestamp`, `is_logged_in`, `account_status`, `verification_code`, `email_verified_at`) VALUES
(57, 'Ron', 'Galang', '123', 'ron@gmail.com', 'Male', 21, '$2y$10$rMHNxgDnPoAwQFS4PzX7r.xOaU.Ct./M1pCYxN8jOiNFPZTFTOAUC', 'Admin', '2024-02-17 05:15:24', '2024-03-05 13:52:58', 0, 'Activated', '', NULL),
(59, 'Mc', 'Vince', 'qwe', 'mc@gmail.com', 'Male', 31, '$2y$10$xGD/g.TBuBqDI83OMbcaSOa3fKoJa1MGAGQNtSqeMqZMR8RRudiB2', 'Admin', '2024-02-17 05:20:03', '2024-03-05 13:58:31', 0, 'Activated', '', NULL),
(61, 'Jc', 'Cj', '123123', 'jc@gmail.com', 'Female', 11, '$2y$10$SPi1jlazT0Vt2psNsno.Nejw51A/0Wf5s/.ZEejv6MI6NwB9NFSDO', 'Staff', '2024-02-17 05:20:38', '2024-02-17 06:42:39', 0, 'Activated', '', NULL),
(64, 'Queen catherine', 'Gajes .center', 'hs123', 'queenhrewherherh@gmail.com', 'Female', 23, '$2y$10$dPMGPDn4sQlCoPiyk.e6GeNwTLJHLD9iK7ij9qyu80OSV9guCKvh6', 'Staff', '2024-02-18 15:11:18', '2024-02-18 15:25:06', 0, 'Deactivated', '', NULL),
(70, 'Jeah', 'Jeah', 'jeah1234', 'jeah@gmail.com', 'Female', 32, '$2y$10$uZ3ZrX.zkPwkMbZpwlQJ.uK/c89phRdr5ANWdqtL81re/RIRZdX6a', 'Staff', '2024-03-06 12:49:59', '2024-03-06 12:50:34', 0, 'Activated', '', NULL),
(79, '', '', '', 'arcillasjeahraizza@gmail.com', '', 0, '$2y$10$iECPbEOnsK86tZXLh8ruWOqdmXFF.jnnaBBRCgBEojwZ.9XtKH5.2', 'Staff', '2024-03-17 14:15:23', '0000-00-00 00:00:00', 0, 'Activated', '114506', '2024-03-17 22:15:42');

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
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_request`
--
ALTER TABLE `file_request`
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
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_request`
--
ALTER TABLE `file_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tblfilehistory`
--
ALTER TABLE `tblfilehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
