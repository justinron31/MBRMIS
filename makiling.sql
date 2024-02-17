-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 09:45 AM
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
-- Table structure for table `resident_indigency`
--

CREATE TABLE `resident_indigency` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `purpose_description` text NOT NULL,
  `voters_id_image` blob NOT NULL,
  `voters_id_number` varchar(20) NOT NULL,
  `datetime_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_indigency`
--

INSERT INTO `resident_indigency` (`id`, `firstname`, `lastname`, `contact_number`, `pickup_datetime`, `purpose_description`, `voters_id_image`, `voters_id_number`, `datetime_created`) VALUES
(32, '123', '123', '123', '2024-03-01 12:31:00', '123123', 0x2f78616d70702f6874646f63732f4d42524d49532f436572744f66496e646967656e63792f766f7465727349445f53637265656e73686f745f323032342d30312d31375f3232333833392e706e67, '123', '2024-02-17 08:29:25');

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
  `account_status` enum('Activated','Deactivated') DEFAULT 'Activated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `idnumber`, `email`, `gender`, `age`, `pass`, `staff_role`, `dateCreated`, `last_login_timestamp`, `account_status`) VALUES
(57, 'Ron', 'Galang', '123', 'ron@gmail.com', 'Male', 21, '$2y$10$rMHNxgDnPoAwQFS4PzX7r.xOaU.Ct./M1pCYxN8jOiNFPZTFTOAUC', 'Admin', '2024-02-17 05:15:24', '2024-02-17 07:03:03', 'Activated'),
(59, 'Mc', 'Vince', 'qwe', 'mc@gmail.com', 'Male', 31, '$2y$10$xGD/g.TBuBqDI83OMbcaSOa3fKoJa1MGAGQNtSqeMqZMR8RRudiB2', 'Admin', '2024-02-17 05:20:03', '2024-02-17 06:42:19', 'Activated'),
(61, 'Jc', 'Cj', '123123', 'jc@gmail.com', 'Female', 11, '$2y$10$SPi1jlazT0Vt2psNsno.Nejw51A/0Wf5s/.ZEejv6MI6NwB9NFSDO', 'Staff', '2024-02-17 05:20:38', '2024-02-17 06:42:39', 'Activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resident_indigency`
--
ALTER TABLE `resident_indigency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resident_indigency`
--
ALTER TABLE `resident_indigency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
