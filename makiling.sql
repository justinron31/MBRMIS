-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 02:49 PM
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
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `tracking_number` varchar(255) DEFAULT NULL,
  `file_status` enum('Processing','Ready for Pickup','Disapproved') DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_request`
--

INSERT INTO `file_request` (`id`, `type`, `firstname`, `lastname`, `contact_number`, `pickup_datetime`, `purpose_description`, `voters_id_image`, `voters_id_number`, `datetime_created`, `viewed`, `tracking_number`, `file_status`) VALUES
(361, 'Certificate of Indigency', '123', '123132', '12312312321', '2024-02-23 12:31:00', '12312312312312', '../Uploaded File/VotersID_123132_123.png', '1231312', '2024-02-21 13:37:50', 1, '65d5fcae1c2dd', 'Disapproved'),
(362, 'Certificate of Indigency', 'mcvincew', 'delacruz', '09874564564', '2024-02-26 12:31:00', 'none', '../Uploaded File/VotersID_delacruz_mcvincew.png', '4532215', '2024-02-24 06:20:04', 1, '65d98a9418a2f', 'Processing');

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
  `account_status` enum('Activated','Deactivated') DEFAULT 'Activated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `idnumber`, `email`, `gender`, `age`, `pass`, `staff_role`, `dateCreated`, `last_login_timestamp`, `is_logged_in`, `account_status`) VALUES
(57, 'Ron', 'Galang', '123', 'ron@gmail.com', 'Male', 21, '$2y$10$rMHNxgDnPoAwQFS4PzX7r.xOaU.Ct./M1pCYxN8jOiNFPZTFTOAUC', 'Admin', '2024-02-17 05:15:24', '2024-02-24 06:19:27', 1, 'Activated'),
(59, 'Mc', 'Vince', 'qwe', 'mc@gmail.com', 'Male', 31, '$2y$10$xGD/g.TBuBqDI83OMbcaSOa3fKoJa1MGAGQNtSqeMqZMR8RRudiB2', 'Admin', '2024-02-17 05:20:03', '2024-02-18 14:32:27', 0, 'Activated'),
(61, 'Jc', 'Cj', '123123', 'jc@gmail.com', 'Female', 11, '$2y$10$SPi1jlazT0Vt2psNsno.Nejw51A/0Wf5s/.ZEejv6MI6NwB9NFSDO', 'Staff', '2024-02-17 05:20:38', '2024-02-17 06:42:39', 0, 'Deactivated'),
(64, 'Queen catherine', 'Gajes .center', 'hs123', 'queenhrewherherh@gmail.com', 'Female', 23, '$2y$10$dPMGPDn4sQlCoPiyk.e6GeNwTLJHLD9iK7ij9qyu80OSV9guCKvh6', 'Staff', '2024-02-18 15:11:18', '2024-02-18 15:25:06', 0, 'Deactivated'),
(65, 'Jeah', 'Arcillas', 'jeah123', 'jeah@gmail.com', 'Female', 45, '$2y$10$ri62D8IFiGowWY9XGv13.ukTxA7AO/Y5Ted2bv8rAPKWaEG8g//Da', 'Staff', '2024-02-18 15:45:05', '2024-02-24 06:04:47', 0, 'Activated');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tblfilehistory`
--
ALTER TABLE `tblfilehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
