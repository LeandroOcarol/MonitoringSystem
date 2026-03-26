-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2026 at 04:43 AM
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
-- Database: `monitoring_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `student_password` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `course_level` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `profile_image` varchar(100) DEFAULT 'IMG_Default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `last_name`, `first_name`, `middle_name`, `student_password`, `course`, `course_level`, `email`, `address`, `profile_image`) VALUES
(1234, 'oracxol', 'leandro', 's', '$2y$10$.juy2dAS3cAriI2y6YBLDu04WhD89OJJZhNQOsGVbTNWeeUKgodea', 'BEED', 3, 'orakol@gmail.com', 'ormoc', 'IMG_1234.jpg'),
(12345, 'Sermonia', 'John Carlo ', 'Dominguez', '$2y$10$0W6a/c6UxghdaNhSF7P0F.d16Qdqtz5c4TzWFSsLhfgFkcCpWhVK6', 'BSIT', 3, 'carlosermonia14@gmail.com', 'Lapu Lapu', 'IMG_Default.jpg'),
(23792344, 'Aranez', 'AxelJake', '', '$2y$10$Qvs.CxpVDe4QyN8vcas/FuUl56KALBLLmBfDuHdl1b0WBzuVGjcq2', 'BSIT', 3, 'axeljake@gmail.com', 'lahug', 'IMG_Default.jpg'),
(23798606, 'Ocarol', 'Leandro', 'Cabalda', '$2y$10$hPMpSW2uG8xLSR/D60ALFOo0dE3Uv2UXr4dWb6PrneeTdzHdq2zSy', 'BSIT', 3, 'ocaroleandro@gmail.com', 'Pasil, Cebu City', 'IMG_23798606.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
