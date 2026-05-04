-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2026 at 03:15 PM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `posted_by` varchar(100) NOT NULL DEFAULT 'CCS Admin',
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `posted_by`, `content`, `created_at`) VALUES
(1, 'CCS Admin', 'Hello USers', '2026-04-24 11:22:21'),
(2, 'CCS Admin', 'Hello Good Noon Users', '2026-04-24 11:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `sit_ins`
--

CREATE TABLE `sit_ins` (
  `sit_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `lab` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'ACTIVE',
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sit_ins`
--

INSERT INTO `sit_ins` (`sit_id`, `student_id`, `purpose`, `lab`, `status`, `time_in`, `time_out`) VALUES
(1, 23798606, 'C Programming', '525', 'COMPLETED', '2026-05-04 20:23:20', '2026-05-04 20:54:29'),
(2, 23798606, 'C Programming', '525', 'COMPLETED', '2026-05-04 20:23:20', '2026-05-04 20:44:33'),
(3, 23798606, 'Java Programming', '526', 'COMPLETED', '2026-05-04 20:28:57', '2026-05-04 20:39:22'),
(4, 23798606, 'Java Programming', '526', 'COMPLETED', '2026-05-04 20:55:21', '2026-05-04 20:55:31');

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
  `profile_image` varchar(100) DEFAULT 'IMG_Default.jpg',
  `session` int(11) DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `last_name`, `first_name`, `middle_name`, `student_password`, `course`, `course_level`, `email`, `address`, `profile_image`, `session`) VALUES
(23798606, 'Ocarol', 'Dwen', 'Cabalda', '$2y$10$hPMpSW2uG8xLSR/D60ALFOo0dE3Uv2UXr4dWb6PrneeTdzHdq2zSy', 'BSCS', 4, 'ocaroleandro@gmail.com', 'Pasil, Cebu City', 'IMG_23798606.jpg', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sit_ins`
--
ALTER TABLE `sit_ins`
  ADD PRIMARY KEY (`sit_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sit_ins`
--
ALTER TABLE `sit_ins`
  MODIFY `sit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sit_ins`
--
ALTER TABLE `sit_ins`
  ADD CONSTRAINT `sit_ins_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
