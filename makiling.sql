-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 05:10 PM
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
-- Table structure for table `familymember`
--

CREATE TABLE `familymember` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `mLastName` varchar(255) DEFAULT NULL,
  `mFirstName` varchar(255) DEFAULT NULL,
  `mMothersMaidenName` varchar(255) DEFAULT NULL,
  `mRelationship` varchar(255) DEFAULT NULL,
  `mSex` enum('Male','Female') DEFAULT NULL,
  `mAge` int(11) DEFAULT NULL,
  `mClassificationByAgeHealthRisk` varchar(255) DEFAULT NULL,
  `mQuarter` varchar(255) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `familymember`
--

INSERT INTO `familymember` (`id`, `resident_id`, `mLastName`, `mFirstName`, `mMothersMaidenName`, `mRelationship`, `mSex`, `mAge`, `mClassificationByAgeHealthRisk`, `mQuarter`, `datecreated`) VALUES
(46, 47, 'Galang', 'Joanne Mae', 'Jayco', 'Sister', 'Female', 23, 'Female', 'First', '2024-03-29 08:53:51'),
(47, 47, 'Galang', 'Ronald', 'Cagaral', 'Head', 'Male', 50, 'Female', 'Second', '2024-03-29 15:53:51'),
(48, 47, 'Galang', 'Rhisa', 'Pangilinan', 'Mother', 'Female', 51, 'Female', 'Third', '2024-03-29 15:53:51'),
(56, 54, 'hev ', 'hev', 'alam mo', 'Son', 'Male', 12, 'Female', 'Third', '2024-03-30 08:19:04'),
(57, 54, 'eh paano', 'nakakulong ', 'pading', 'Daughter', 'Female', 23, 'Female', 'Fourth', '2024-03-30 08:19:04'),
(63, 59, 'bubbles', 'bubbles', 'bubbles', 'dog', 'Male', 12, 'Female', 'First', '2024-03-30 15:30:42'),
(64, 60, 'butter', 'butter', 'butter', 'Dog', 'Female', 1, 'Male', 'Third', '2024-03-30 15:35:54');

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
(432, 'Certificate of Indigency', 'Ron', 'Galang', '09762911692', '2024-03-29 06:29:00', 'for work', '../Uploaded File/VotersID_Galang_Ron_2024-03-28.png', '29387456', '2024-03-28 07:29:56', '66051c74caeb6', 'Processing', '', 1),
(433, 'Certificate of Residency', '123', '123', '123', '2024-04-01 06:55:00', '123', '../Uploaded File/VotersID_123_123_2024-03-30.png', '123123', '2024-03-30 08:55:23', '6607d37bcfd26', 'Processing', '', 1);

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
(16, 'First Time Job Seeker', '213', '123', '2024-04-01', 12, 'Male', '123', 'Single', '1231312', 'Less than a Year', 'No Formal Education', '123123', 'no', '2024-04-02 07:57:00', '2024-03-30 16:56:16', '123123', '../Uploaded File/VotersID_123_213_2024-03-30.png', '6607d3b03f33c', '123213', 'Processing', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `residentrecord`
--

CREATE TABLE `residentrecord` (
  `id` int(11) NOT NULL,
  `rVotersID` varchar(255) DEFAULT NULL,
  `rvoterstatus` enum('Voter','Non-voter') DEFAULT NULL,
  `rBHS` varchar(255) DEFAULT NULL,
  `rPurokSitioSubdivision` varchar(255) DEFAULT NULL,
  `rHouseholdNumber` int(11) DEFAULT NULL,
  `rLastName` varchar(255) DEFAULT NULL,
  `rFirstName` varchar(255) DEFAULT NULL,
  `rAge` int(11) DEFAULT NULL,
  `rGender` enum('Male','Female') DEFAULT NULL,
  `rMothersMaidenName` varchar(255) DEFAULT NULL,
  `rNHTSHousehold` varchar(255) DEFAULT NULL,
  `rIP` varchar(255) NOT NULL,
  `rCategory` varchar(255) DEFAULT NULL,
  `rHHHeadPhilHealthMember` varchar(255) DEFAULT NULL,
  `voters_id_image` varchar(255) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residentrecord`
--

INSERT INTO `residentrecord` (`id`, `rVotersID`, `rvoterstatus`, `rBHS`, `rPurokSitioSubdivision`, `rHouseholdNumber`, `rLastName`, `rFirstName`, `rAge`, `rGender`, `rMothersMaidenName`, `rNHTSHousehold`, `rIP`, `rCategory`, `rHHHeadPhilHealthMember`, `voters_id_image`, `datecreated`) VALUES
(47, '54345235', 'Voter', 'BHS', 'Makiling', 42144, 'Galang', 'Justin Ron', 22, 'Male', 'Jayco', 'NHTS-4Ps', 'Non-IP', 'LIFETIME MEMBER', '65365343524', '../ResidentsID/RVotersID_Galang_Justin Ron_2024-03-29.png', '2024-03-29 08:53:51'),
(54, '75436546', 'Voter', 'SHB', 'CALAMBA', 75434325, 'ABI', 'HEV', 26, 'Male', 'Alam mo ba Girl', 'NHTS-4Ps', 'IP', 'SPONSORED', '564363456365', '../ResidentsID/RVotersID_ABI_HEV_2024-03-30.png', '2024-03-30 08:19:04'),
(59, 'bubbles', 'Voter', 'bubbles', 'bubbles', 0, 'bubbles', 'bubbles', 12, 'Male', 'bubbles', 'NHTS-4Ps', 'IP', 'SPONSORED', 'bubbles', '../ResidentsID/RVotersID_bubbles_bubbles_2024-03-30.png', '2024-03-30 15:30:42'),
(60, 'butter', 'Voter', 'butter', 'butter', 123312, 'butter', 'butter', 12, 'Male', 'butter', 'NHTS-4Ps', 'IP', 'FORMAL ECONOMY', 'butter', '../ResidentsID/RVotersID_butter_butter_2024-03-30.png', '2024-03-30 15:35:54');

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
  `passreset_timestamp` datetime DEFAULT NULL,
  `token_expiry` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `idnumber`, `email`, `gender`, `age`, `pass`, `staff_role`, `dateCreated`, `last_login_timestamp`, `is_logged_in`, `account_status`, `verification_code`, `email_verify`, `email_verified_at`, `reset_token`, `passreset_timestamp`, `token_expiry`) VALUES
(65, 'Jeah', 'Arcillas', 'jeah123', 'jeah@gmail.com', 'Female', 45, '$2y$10$ri62D8IFiGowWY9XGv13.ukTxA7AO/Y5Ted2bv8rAPKWaEG8g//Da', 'Admin', '2024-02-18 15:45:05', '2024-02-24 06:04:47', 0, 'Activated', NULL, 1, NULL, NULL, NULL, NULL),
(69, 'Mcvince', 'Paul', '321', 'mcvince@gmail.com', 'Male', 23, '$2y$10$5PL8EuRYrDwmssoHJiB5ye80.sAUG3DzrEotnkW0fII8LeD6cCqGO', 'Admin', '2024-03-18 08:39:56', '2024-03-18 08:40:01', 0, 'Deactivated', NULL, 1, NULL, NULL, NULL, NULL),
(109, 'Ron', 'Galang', '123', 'ronronnn31@gmail.com', 'Male', 21, '$2y$10$7kIdaf760j5TZqfPBuFYCu6OdZ90DjB8ECa.mh/lEah/33A0zABNK', 'Admin', '2024-03-29 05:47:10', '2024-03-30 16:11:57', 0, 'Activated', NULL, 1, '2024-03-29 13:47:48', '23e2caba7ce4dc1ad3fd39c375b6d13205fba65aff81f5b96e17caa9984af412d90ce0a9ca37a60b2bfa8173822ef710764a', NULL, '2024-03-31 14:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `staff_information`
--

CREATE TABLE `staff_information` (
  `id` int(11) NOT NULL,
  `idnumber` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_information`
--

INSERT INTO `staff_information` (`id`, `idnumber`, `first_name`, `last_name`, `gender`) VALUES
(1, 'HS123', 'Justin Ron', 'Galang', 'Male'),
(2, '123123', 'Jeah', 'Arcillas', 'Female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `familymember`
--
ALTER TABLE `familymember`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`);

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
-- Indexes for table `residentrecord`
--
ALTER TABLE `residentrecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_information`
--
ALTER TABLE `staff_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `familymember`
--
ALTER TABLE `familymember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `file_request`
--
ALTER TABLE `file_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT for table `first_time_job`
--
ALTER TABLE `first_time_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `residentrecord`
--
ALTER TABLE `residentrecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `staff_information`
--
ALTER TABLE `staff_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `familymember`
--
ALTER TABLE `familymember`
  ADD CONSTRAINT `familymember_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residentrecord` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
