-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 10:27 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `password`) VALUES
(1, '123', 'Ron', 'qwe'),
(2, '123123', 'Mcvince', 'qweqwe');

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
  `pass` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_status` enum('Activated','Deactivated') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `idnumber`, `email`, `gender`, `pass`, `dateCreated`, `account_status`) VALUES
(9, 'Jeah', 'Arcillas', '123jeah', 'jeah@gmail.com', 'Female', '$2y$10$W6yGugw3CZKHbVNvvZLng.TLq2aNY1RPwCxL6w1yhXH4XpKyGRht6', '2024-01-24 06:48:23', 'Activated'),
(10, 'Koji', 'Ignacious', 'ijok', 'ijok@gmail.com', 'Male', '$2y$10$jRiuOa3i2P4UVAZlXZ4NUuUw74Fz5us5GC2r7JE7LCfFWXiUXpvHO', '2024-01-24 06:51:04', 'Deactivated'),
(11, 'Johnny', 'Barayray', 'jc123', 'jc@gmail.com', 'Male', '$2y$10$S.mtLamDwHjmJL1UCyoZ7.vHqaiSjyaLw/boq6dMfeIJw.mnQPDf2', '2024-01-25 05:04:22', 'Deactivated'),
(12, 'Maple', 'Marquez', 'maplejr', 'jr@gmail.com', 'Male', '$2y$10$e5nNfNn0/ZsWZbFYLU05neRM/7jJf/LuLd.R4s7r/ynAjVthqdzBa', '2024-01-25 10:44:33', 'Activated'),
(13, 'Ronron', 'Ron', '123123', 'ron@gmail.com', 'Male', '$2y$10$DiuqgrLYBI4X8f9U2QA8E.Zs.Qq.aQcKi5He3aLi2TUri4lB/ohdS', '2024-01-27 08:56:25', 'Activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
