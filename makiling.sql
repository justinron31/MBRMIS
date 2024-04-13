-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 07:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


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
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `familymember`
--

INSERT INTO `familymember` (`id`, `resident_id`, `mLastName`, `mFirstName`, `mMothersMaidenName`, `mRelationship`, `mSex`, `mAge`, `mClassificationByAgeHealthRisk`, `mQuarter`, `datecreated`, `dateUpdated`) VALUES
(66, 62, 'Santos', 'Natalie', 'Garcia', '', 'Female', 18, '', 'Second', '2024-04-03 00:10:03', '2024-04-13 22:13:19'),
(67, 63, 'Hernandez', 'Maria', 'Mendoza', 'Spouse', 'Female', 50, 'Female', 'Third', '2024-04-03 00:15:19', NULL),
(68, 63, 'Perez', ' Elena', ' Elena', 'Caregiver', 'Female', 25, 'Male', 'First', '2024-04-02 16:15:19', NULL),
(69, 64, 'Dela Cruz', 'Joseph', 'Martinez', 'Spouse', 'Male', 32, 'Male', 'First', '2024-04-03 00:18:39', NULL),
(70, 64, 'Reyes', 'Samantha', 'Samantha', 'Adopter', 'Female', 5, 'Female', 'First', '2024-04-02 16:18:39', NULL),
(71, 65, 'Reyes', 'Catherine', 'Bautista', 'Daughter', 'Female', 22, 'Female', 'Fourth', '2024-04-03 00:30:18', NULL),
(72, 65, 'Khan', 'Ali', 'Hassan', 'Boarder', 'Male', 30, 'Male', 'Second', '2024-04-02 16:30:18', NULL),
(73, 66, 'Mendoza', 'Beatrice', 'Beatrice', 'Head', 'Female', 27, '', 'First', '2024-04-03 00:32:13', '2024-04-13 16:08:30'),
(74, 67, 'Lopez', 'Jennifer', ' Santos', 'Daughter', 'Female', 40, 'Male', 'Second', '2024-04-03 00:34:22', NULL),
(75, 68, 'Aquino', 'Beatrice', 'Fernandez', 'Spouse', 'Female', 36, 'Male', 'Second', '2024-04-03 00:37:28', NULL),
(76, 68, 'Aquino', 'Michael', 'Fernandez', 'Son', 'Male', 10, 'Male', 'Second', '2024-04-02 16:37:28', NULL),
(77, 69, 'null', 'null', 'null', '', '', 0, '', '', '2024-04-03 00:39:25', '2024-04-05 17:28:56'),
(90, 82, 'Guia', 'Luisa', 'Chavez', '', 'Female', 35, 'Adolescent-Pregnant', 'Second', '2024-04-06 15:06:14', '2024-04-13 22:52:42'),
(102, 94, 'Galang', 'Justin Ron', 'bubbles', 'Spouse', 'Male', 21, 'Newborn', 'First', '2024-04-13 14:36:26', '2024-04-13 23:04:38');

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
  `purok` varchar(255) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `purpose_description` text NOT NULL,
  `voters_id_image` varchar(255) NOT NULL,
  `voters_id_number` varchar(20) NOT NULL,
  `datetime_created` timestamp NULL DEFAULT current_timestamp(),
  `tracking_number` varchar(255) DEFAULT NULL,
  `file_status` enum('Processing','Ready for Pickup','Reviewing','Declined') DEFAULT 'Processing',
  `remarks` varchar(255) NOT NULL,
  `notification_played` tinyint(1) NOT NULL DEFAULT 0,
  `file_data_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_request`
--

INSERT INTO `file_request` (`id`, `type`, `firstname`, `lastname`, `contact_number`, `purok`, `pickup_datetime`, `purpose_description`, `voters_id_image`, `voters_id_number`, `datetime_created`, `tracking_number`, `file_status`, `remarks`, `notification_played`, `file_data_updated`) VALUES
(444, 'Certificate of Indigency', 'Jeah Raizza', 'Arcillas', '63936318316', '', '2024-04-04 10:12:00', 'Scholarship', '../Uploaded File/VotersID_Arcillas_Jeah Raizza_2024-04-01.png', '12345', '2024-04-01 14:12:54', '660ac0e6da2c4', 'Declined', 'dawd', 1, '2024-04-13 18:18:15'),
(464, 'Certificate of Indigency', 'Juanito', 'Cruz', '63911122233', '', '2024-04-03 10:37:00', 'Medical Assistance', '../Uploaded File/VotersID_Cruz_Juanito_2024-04-02.jpg', '1234567890123456', '2024-04-02 14:38:57', '660c1881581dc', 'Declined', 'h', 1, '2024-04-13 18:50:55'),
(465, 'Certificate of Indigency', 'Maria', 'Santos', '63944455566', '', '2024-04-04 11:39:00', 'Educational Support', '../Uploaded File/VotersID_Santos_Maria_2024-04-02.jpg', '9876543210987654', '2024-04-02 14:40:20', '660c18d4e2bef', 'Declined', 's', 1, '2024-04-13 21:54:48'),
(466, 'Certificate of Indigency', 'Eduardo', 'Reyes', '63977788899', '', '2024-04-05 01:41:00', 'Housing Assistance', '../Uploaded File/VotersID_Reyes_Eduardo_2024-04-02.jpg', '5555555555555555', '2024-04-02 14:41:23', '660c1913bc763', 'Declined', 'saff afs', 1, '2024-04-13 22:24:50'),
(467, 'Certificate of Indigency', 'Rosita', 'Gonzales', '63912345678', '', '2024-04-08 02:41:00', 'Livelihood Program', '../Uploaded File/VotersID_Gonzales_Rosita_2024-04-02.jpg', '8765432109876543', '2024-04-02 14:42:21', '660c194d06745', 'Declined', 'awf a fw', 1, '2024-04-13 23:57:22'),
(468, 'Certificate of Indigency', 'Antonio', 'Aquino', '63998765432', '', '2024-04-09 09:43:00', 'Food Assistance', '../Uploaded File/VotersID_Aquino_Antonio_2024-04-02.jpg', '4444444444444444', '2024-04-02 14:43:37', '660c19993ab25', 'Declined', 'f qeqfe ', 1, '2024-04-14 00:18:53'),
(469, 'Certificate of Indigency', 'Carmela', 'Ramos', '63933344455', '', '2024-04-04 08:44:00', 'Senior Citizen Benefits', '../Uploaded File/VotersID_Ramos_Carmela_2024-04-02.jpg', '3333333333333333', '2024-04-02 14:44:40', '660c19d8b1ca3', 'Declined', 'feq fqe ', 1, '2024-04-14 00:23:16'),
(470, 'Certificate of Indigency', 'Miguel', 'Dela Rosa', '63966677788', '', '2024-04-03 10:45:00', 'Disability Support', '../Uploaded File/VotersID_Dela Rosa_Miguel_2024-04-02.jpg', '2222222222222222', '2024-04-02 14:45:51', '660c1a1f37224', 'Declined', 'ge  g', 1, '2024-04-14 00:28:41'),
(471, 'Certificate of Indigency', 'Lorna', ' Santos', '63999900011', '', '2024-04-05 10:00:00', 'Legal Aid', '../Uploaded File/VotersID_ Santos_Lorna_2024-04-02.jpg', '3232435445634', '2024-04-02 14:47:08', '660c1a6cbf0bd', 'Declined', 'eq fq e', 1, '2024-04-14 00:34:17'),
(472, 'Certificate of Residency', 'Maria', 'Cruz', '63987654321', '', '2024-04-05 08:55:00', 'Enrollment in School', '../Uploaded File/VotersID_Cruz_Maria_2024-04-02.jpg', '1234567890123456', '2024-04-02 14:53:52', '660c1c00ac832', 'Declined', 'qfe q ef', 1, '2024-04-13 23:46:12'),
(473, 'Certificate of Residency', 'Juan', 'Dela Rosa', '63981234567', '', '2024-04-08 01:00:00', 'Employment Verification', '../Uploaded File/VotersID_Dela Rosa_Juan_2024-04-02.jpg', '9876543210987654', '2024-04-02 14:54:49', '660c1c3925896', 'Processing', '', 1, NULL),
(474, 'Certificate of Residency', 'Jose', 'Santos', '63992345678', '', '2024-04-04 08:00:00', 'Applying for Government Assistance', '../Uploaded File/VotersID_Santos_Jose_2024-04-02.jpg', '639812345678', '2024-04-02 14:55:51', '660c1c779b762', 'Declined', 'rwg wr g', 1, '2024-04-13 23:19:08'),
(475, 'Certificate of Residency', 'Anna', 'Lim', '63971234567', '', '2024-04-03 02:00:00', 'Proof of Address for Bank Account', '../Uploaded File/VotersID_Lim_Anna_2024-04-02.jpg', '8765432109876543', '2024-04-02 14:56:48', '660c1cb0a4a3c', 'Declined', 'fe qfe q', 1, '2024-04-13 23:55:35'),
(476, 'Certificate of Residency', 'Pedro', 'Gonzales', '63963456789', '', '2024-04-09 09:00:00', 'Applying for Driver\'s License', '../Uploaded File/VotersID_Gonzales_Pedro_2024-04-02.jpg', '639712345678', '2024-04-02 14:57:41', '660c1ce5f0031', 'Declined', 'fq qwf ', 1, '2024-04-13 23:56:04'),
(477, 'Certificate of Residency', 'Sofia', 'Hernandez', '63974567890', '', '2024-04-08 03:00:00', 'Utility Connection', '../Uploaded File/VotersID_Hernandez_Sofia_2024-04-02.jpg', '639634567890', '2024-04-02 14:58:58', '660c1d3278932', 'Reviewing', '', 1, '2024-04-14 00:34:45'),
(478, 'Certificate of Residency', 'Miguel', 'Reyes', '63985678901', '', '2024-04-08 04:00:00', 'Applying for Loan', '../Uploaded File/VotersID_Reyes_Miguel_2024-04-02.jpg', '639745678901', '2024-04-02 15:01:20', '660c1dc0b8dae', 'Reviewing', '', 1, '2024-04-14 00:08:04'),
(479, 'Certificate of Residency', 'Fatima', 'Ahmed', '63956789012', '', '2024-04-06 11:00:00', 'Applying for Scholarship', '../Uploaded File/VotersID_Ahmed_Fatima_2024-04-02.jpg', '639856789012', '2024-04-02 15:02:34', '660c1e0aca54b', 'Reviewing', '', 1, NULL),
(491, 'Certificate of Indigency', 'Mikha', 'Bini', '09122323231', 'Purok 1', '2024-04-08 04:20:00', 'Scholarship', '../Uploaded File/ValidID_Bini_Mikha_2024-04-06.jpg', '123432', '2024-04-06 08:23:42', '6611068e079fd', 'Declined', 'eqf fqe ', 1, '2024-04-14 00:57:26'),
(492, 'Certificate of Residency', 'Mikha', 'Bini', '09122323231', 'Purok 1', '2024-04-08 04:25:00', 'Scholarship', '../Uploaded File/ValidID_Bini_Mikha_2024-04-06.jpg', '123432', '2024-04-06 16:25:33', '661106fd07187', 'Reviewing', '', 1, '2024-04-13 23:51:55'),
(496, 'Certificate of Indigency', 'Justin Ron', 'Galang', '7457457457', '134134', '2024-04-19 02:33:00', 'eqweqw', '../Uploaded File/ValidID_Galang_Justin Ron_2024-04-10.png', '341343', '2024-04-10 09:33:54', '6616b1620f666', 'Reviewing', '', 1, '2024-04-12 07:31:04'),
(497, 'Certificate of Indigency', '13213123', '123123', '123123', '12313', '2024-04-20 04:51:00', '13213213', '../Uploaded File/ValidID_123123_13213123_2024-04-13.png', '12313123', '2024-04-13 08:52:07', '661a47b7a7cc9', 'Reviewing', '', 1, '2024-04-13 18:40:12'),
(498, 'Certificate of Indigency', '13213123', '123123', '123123', '12313', '2024-04-20 04:00:00', '2425545', '../Uploaded File/ValidID_123123_13213123_2024-04-13.png', '123131231', '2024-04-13 09:00:35', '661a49b371a89', 'Reviewing', '', 1, '2024-04-13 23:56:47'),
(499, 'Certificate of Indigency', '123123', '123', '123123', '213123', '2024-04-20 03:04:00', '123123123', '../Uploaded File/ValidID_123_123123_2024-04-13.png', '1235135135', '2024-04-13 09:04:27', '661a4a9b56480', 'Declined', 'efq q fe', 1, '2024-04-14 00:54:23'),
(500, 'Certificate of Indigency', 'Justin Ron', 'Galang', '7457457457', '23123', '2024-04-18 01:05:00', '123123123123', '../Uploaded File/ValidID_Galang_Justin Ron_2024-04-13.png', '2y4 qheargerg', '2024-04-13 09:05:50', '661a4aee37601', 'Declined', 'f qeqfe', 1, '2024-04-14 00:52:02');

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
  `notification_played` tinyint(1) NOT NULL DEFAULT 0,
  `file_data_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_time_job`
--

INSERT INTO `first_time_job` (`id`, `type`, `firstname`, `lastname`, `birthdate`, `age`, `gender`, `contact_number`, `civil_status`, `address`, `residency`, `education`, `course`, `job_start_beneficiary`, `pickup_datetime`, `datetime_created`, `id_number`, `avatar`, `tracking_number`, `purpose_description`, `file_status`, `remarks`, `notification_played`, `file_data_updated`) VALUES
(20, 'First Time Job Seeker', 'Juan', 'Dela Cruz', '1998-02-12', 26, 'Male', '63987654321', 'Single', 'Barangay Makiling, Calamba, Laguna', 'More than a Year', 'Bachelor\'s Degree', 'NA', 'no', '2024-04-03 01:00:00', '2024-04-02 15:11:17', '1234567890', '../Uploaded File/VotersID_Dela Cruz_Juan_2024-04-02.jpg', '660c2015643db', 'Applying for first job after graduation.', 'Declined', 'dw a wad', 1, '2024-04-13 23:44:50'),
(21, 'First Time Job Seeker', 'Maria', 'Santos', '2000-02-07', 22, 'Female', '63998765432', 'Single', 'Barangay Makiling, Calamba, Laguna', 'More than a Year', 'Bachelor\'s Degree', 'NA', 'yes', '2024-04-05 09:00:00', '2024-04-02 15:15:22', '0987654321', '../Uploaded File/VotersID_Santos_Maria_2024-04-02.jpg', '660c210aa9928', 'Seeking employment opportunities in the local area.', 'Declined', 'deym', 1, '2024-04-12 07:33:45'),
(22, 'First Time Job Seeker', 'Pedro', 'Gonzales', '1999-11-11', 23, 'Male', '63987654321', 'Single', 'Barangay Makiling, Calamba, Laguna', 'More than a Year', 'High School Diploma', 'NA', 'no', '2024-04-05 02:00:00', '2024-04-02 15:17:50', '323434', '../Uploaded File/VotersID_Gonzales_Pedro_2024-04-02.jpg', '660c219ebd9df', 'Seeking part-time employment while studying.', 'Declined', 'w dqqw d', 1, '2024-04-14 00:23:24'),
(23, 'First Time Job Seeker', 'Sofia', 'Hernandez', '2002-05-05', 21, 'Female', '63987654321', 'Single', ' Barangay Makiling, Calamba, Laguna', 'More than a Year', 'Bachelor\'s Degree', 'NA', 'yes', '2024-04-04 01:20:00', '2024-04-02 15:20:49', '23231', '../Uploaded File/VotersID_Hernandez_Sofia_2024-04-02.jpg', '660c2251a885a', ' Applying for internship opportunities in the area.', 'Declined', 'wdw ', 1, '2024-04-14 00:37:41'),
(24, 'First Time Job Seeker', 'Carlos', 'Rodriguez', '1997-02-12', 27, 'Male', '0987654321', 'Married', ' Barangay Makiling, Calamba, Laguna', 'More than a Year', 'Bachelor\'s Degree', 'NA', 'no', '2024-04-05 02:25:00', '2024-04-02 15:24:40', '7654321', '../Uploaded File/VotersID_Rodriguez_Carlos_2024-04-02.jpg', '660c233854c99', 'Seeking entry-level position in the IT industry.', 'Declined', 'f qf e', 1, '2024-04-14 00:56:16'),
(25, 'First Time Job Seeker', 'Fatima', 'Ahmed', '2001-03-21', 21, 'Female', '0987654321', 'Single', ' Barangay Makiling, Calamba, Laguna', 'Less than a Year', 'Bachelor\'s Degree', 'NA', 'no', '2024-04-03 02:30:00', '2024-04-02 15:29:05', '4321', '../Uploaded File/VotersID_Ahmed_Fatima_2024-04-02.jpg', '660c2441113e0', 'Applying for a position in customer service.', 'Declined', 'qfe ', 1, '2024-04-14 00:55:38'),
(26, 'First Time Job Seeker', 'Lorna', 'Tan', '2000-03-12', 22, 'Male', '63922222342', 'Married', ' Barangay Makiling, Calamba, Laguna', 'Less than a Year', 'Vocational/Technical Certificate', 'NA', 'no', '2024-04-04 02:30:00', '2024-04-02 15:31:11', '432123', '../Uploaded File/VotersID_Tan_Lorna_2024-04-02.jpg', '660c24bf2c970', 'Seeking employment in the hospitality industry.', 'Declined', 'ef qqfe ', 1, '2024-04-14 00:54:29'),
(27, 'First Time Job Seeker', 'Mikha', 'Bini', '2024-04-08', 32, 'Female', '09122323231', 'Single', 'Blk 7 Lot 6 LBEH', 'More than a Year', 'Bachelor\'s Degree', 'NA', 'no', '2024-04-08 04:20:00', '2024-04-06 08:18:56', '12332', '../Uploaded File/ValidID_Bini_Mikha_2024-04-06.jpg', '661105700981f', 'Applying job', 'Reviewing', '', 1, '2024-04-14 00:57:33');

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
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residentrecord`
--

INSERT INTO `residentrecord` (`id`, `rVotersID`, `rvoterstatus`, `rBHS`, `rPurokSitioSubdivision`, `rHouseholdNumber`, `rLastName`, `rFirstName`, `rAge`, `rGender`, `rMothersMaidenName`, `rNHTSHousehold`, `rIP`, `rCategory`, `rHHHeadPhilHealthMember`, `voters_id_image`, `datecreated`, `dateUpdated`) VALUES
(62, '1597-5632-8012', 'Voter', 'Makiling', 'Purok 4', 333, ' Bautista', 'Sofia', 69, 'Female', 'Reyes', 'NHTS-Non-4Ps', 'Non-IP', 'FORMAL ECONOMY', '2345678901', '../ResidentsID/RVotersID_ Bautista_Sofia_2024-04-03.jpg', '2024-04-03 00:10:03', '2024-04-13 22:13:19'),
(63, '3210-9876-4567', 'Voter', 'Makiling', 'Purok 2', 247, 'Hernandez', 'Carlos', 52, 'Male', 'Mendoza', 'NHTS-Non-4Ps', 'IP', 'SPONSORED', ' 5678901234', '../ResidentsID/RVotersID_Hernandez_Carlos_2024-04-03.jpg', '2024-04-03 00:15:19', NULL),
(64, '3210-9876-4567', 'Voter', 'Makiling', 'Purok 1', 678, 'Dela Cruz', 'Anna', 30, 'Female', 'Martinez', 'Non-NHTS', 'Non-IP', 'FORMAL ECONOMY', '4321-8765-0912 ', '../ResidentsID/RVotersID_Dela Cruz_Anna_2024-04-03.jpg', '2024-04-03 00:18:39', NULL),
(65, '6543-2109-8765', 'Voter', 'Makiling', ' Bloomingdale', 741, 'Reyes', 'David ', 48, 'Male', 'Bautista ', 'NHTS-4Ps', 'IP', 'INDIGENT', '1234567890', '../ResidentsID/RVotersID_Reyes_David _2024-04-03.jpg', '2024-04-03 00:30:18', NULL),
(66, '9870-4321-5678', 'Voter', 'Makiling', 'Happyville', 890, 'Mendoza', 'Sarah Mae', 27, 'Female', 'Perez', 'NHTS-Non-4Ps', 'IP', 'INDIGENT', '2345678901', '../ResidentsID/RVotersID_Mendoza_Sarah_2024-04-03.jpg', '2024-04-03 00:32:13', '2024-04-13 16:08:30'),
(67, '2109-8765-4321', 'Voter', 'Makiling', 'Purok 3', 954, 'Lopez', ' Mark', 65, 'Male', 'Santos', 'NHTS-Non-4Ps', 'Non-IP', 'None', 'No', '../ResidentsID/RVotersID_Lopez_ Mark_2024-04-03.jpg', '2024-04-03 00:34:22', NULL),
(68, '8520-1973-6425', 'Voter', 'Makiling', 'Purok 4', 27, 'Aquino ', 'Benjamin', 38, 'Male', 'Fernandez', 'NHTS-4Ps', 'IP', 'None', 'No', '../ResidentsID/RVotersID_Aquino _Benjamin_2024-04-03.jpg', '2024-04-03 00:37:28', NULL),
(69, '3215363426w', 'Voter', 'Makiling', 'Purok 4', 147, 'Martinez', ' Elena', 55, 'Female', ' Elena', 'NHTS-Non-4Ps', 'IP', 'None', '96896986-908089', '../ResidentsID/RVotersID_Martinez_ Elena_2024-04-03.jpg', '2024-04-03 00:39:25', '2024-04-05 17:28:56'),
(82, '523445252454', 'Voter', 'Makiling', 'Purok 1', 235, 'Guiass', 'Benhur', 45, 'Male', 'Chavez', 'NHTS-Non-4Ps', 'Non-IP', 'None', 'No', NULL, '2024-04-06 15:06:14', '2024-04-13 22:52:42'),
(94, 'None', 'Non-voter', 'flow g', 'flow g', 2345234, 'Galang', 'Justin Rons', 34, 'Male', 'flow gg', 'NHTS-4Ps', 'IP', 'None', 'No', NULL, '2024-04-13 14:36:26', '2024-04-13 23:04:38');

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
(144, 'Justin Ron', 'Galang', '125', 'ronronnn31@gmail.com', 'Male', 21, '$2y$10$9otmzI/4xdJXinPmu0WcO.bV20pXW5rNPcEehm6TBASvub2hrOHL6', 'Admin', '2024-04-13 10:52:05', '2024-04-13 14:59:49', 1, 'Activated', NULL, 1, '2024-04-13 18:52:15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_information`
--

CREATE TABLE `staff_information` (
  `id` int(11) NOT NULL,
  `idnumber` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_information`
--

INSERT INTO `staff_information` (`id`, `idnumber`, `first_name`, `last_name`, `dateCreated`, `date_updated`) VALUES
(3, '125', 'Justine Ron', 'Galang', '2024-04-10 13:52:31', '2024-04-13 17:01:15'),
(4, '126', 'Koji', 'Ijok', '2024-04-10 13:52:31', NULL),
(5, '127', 'JC', 'Boi Boi', '2024-04-10 13:52:31', '2024-04-13 07:44:13'),
(29, 'HS123wrgrg', 'bubbles', 'bubblesdeym bro', '2024-04-13 08:05:21', NULL),
(50, '1431423ew', 'flow', 'G', '2024-04-13 17:29:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `useractivity`
--

CREATE TABLE `useractivity` (
  `ActivityID` int(11) NOT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Role` varchar(255) DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `ActionDate` datetime DEFAULT NULL,
  `request_tracking_number` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `ResidentFirstName` varchar(255) DEFAULT NULL,
  `ResidentLastName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useractivity`
--

INSERT INTO `useractivity` (`ActivityID`, `StaffID`, `FirstName`, `LastName`, `Role`, `Action`, `ActionDate`, `request_tracking_number`, `type`, `ResidentFirstName`, `ResidentLastName`) VALUES
(247, 125, 'Justin Ron', 'Galang', 'admin', 'Deleted staff information with ID: 1431423', '2024-04-14 01:20:33', '1431423', 'Staff Information', NULL, NULL),
(248, 125, 'Justin Ron', 'Galang', 'admin', 'Deleted staff information ', '2024-04-14 01:21:28', '1431423', 'Staff Information', NULL, NULL),
(249, 125, 'Justin Ron', 'Galang', 'admin', 'Insert staff information', '2024-04-14 01:29:53', NULL, 'Added Staff Information', NULL, NULL);

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
-- Indexes for table `useractivity`
--
ALTER TABLE `useractivity`
  ADD PRIMARY KEY (`ActivityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `familymember`
--
ALTER TABLE `familymember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `file_request`
--
ALTER TABLE `file_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `first_time_job`
--
ALTER TABLE `first_time_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `residentrecord`
--
ALTER TABLE `residentrecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `staff_information`
--
ALTER TABLE `staff_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `useractivity`
--
ALTER TABLE `useractivity`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

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
