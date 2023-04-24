-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 05:02 PM
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
-- Database: `vezeetadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `payment_id` int(8) NOT NULL,
  `cash_fee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `rate` decimal(10,0) NOT NULL,
  `appointments` datetime NOT NULL,
  `doctor_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `payment_id` int(8) NOT NULL,
  `credit_id` int(11) NOT NULL,
  `valid_date` date NOT NULL,
  `cvc` varchar(3) NOT NULL,
  `password` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `works_for` int(8) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `salary` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_qualifications`
--

CREATE TABLE `doctor_qualifications` (
  `doctor_id` int(8) NOT NULL,
  `qualifications` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_insurance`
--

CREATE TABLE `health_insurance` (
  `id` varchar(8) NOT NULL,
  `type` varchar(64) NOT NULL,
  `valid_date` date NOT NULL,
  `patient_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(8) NOT NULL COMMENT '5',
  `name` varchar(64) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `name`, `gender`, `date_of_birth`, `phone`, `email`, `password`) VALUES
(38, 'Ziad', 'Male', '2017-11-11', '01987649555', 'ziadamr309@gmail.com', '$2y$10$5m16G034fjxuC72blDj7f.bqKd.kQt7t8ksxp3nFSG.AcO/HDyWL6'),
(40, 'Ahmed', 'Male', '2009-09-09', '010987645', 'ahmed@gmail.com', '$2y$10$gKWGdKXrff6oi0YnZheCMOnQY1yxvqWFGe6.IUZApr/m8S3gNR3EC'),
(41, 'Mohamed Galal', 'Male', '2002-11-11', '0149876534', 'galal@gmail.com', '$2y$10$xuu0nsRhQt16wEb9nTvj8.1gye7B4sM0gS9.dbaERCtXmn.oke3A.');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(8) NOT NULL,
  `payment_method` enum('Cash','Credit') NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(12,0) DEFAULT NULL,
  `credit_id` varchar(16) DEFAULT NULL,
  `cvc` varchar(3) DEFAULT NULL,
  `valid_date` date DEFAULT NULL,
  `password` int(6) DEFAULT NULL,
  `fee` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_method`, `date`, `amount`, `credit_id`, `cvc`, `valid_date`, `password`, `fee`) VALUES
(35, 'Credit', '2023-04-23 03:48:32', NULL, '1111111111111111', '197', '2020-02-22', 0, NULL),
(36, 'Credit', '2023-04-23 04:00:23', NULL, '1458 3267 1579 1', 'CVC', '2024-11-11', 0, NULL),
(37, 'Cash', '2023-04-23 04:04:53', 0, NULL, NULL, NULL, NULL, 50),
(38, 'Credit', '2023-04-23 04:06:55', NULL, '198364921649', '934', '2024-02-22', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(8) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `rating` float NOT NULL,
  `clinic_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `parity` varchar(255) NOT NULL,
  `payment_id` int(8) NOT NULL,
  `clinic_id` int(8) NOT NULL,
  `patient_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD UNIQUE KEY `credit_id` (`credit_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `works_for` (`works_for`);

--
-- Indexes for table `doctor_qualifications`
--
ALTER TABLE `doctor_qualifications`
  ADD KEY `doctor_qualifications_ibfk_1` (`doctor_id`);

--
-- Indexes for table `health_insurance`
--
ALTER TABLE `health_insurance`
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `reservation_ibfk_2` (`clinic_id`),
  ADD KEY `reservation_ibfk_3` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(8) NOT NULL AUTO_INCREMENT COMMENT '5', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clinic`
--
ALTER TABLE `clinic`
  ADD CONSTRAINT `clinic_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit`
--
ALTER TABLE `credit`
  ADD CONSTRAINT `credit_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`works_for`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_qualifications`
--
ALTER TABLE `doctor_qualifications`
  ADD CONSTRAINT `doctor_qualifications_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_insurance`
--
ALTER TABLE `health_insurance`
  ADD CONSTRAINT `health_insurance_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
