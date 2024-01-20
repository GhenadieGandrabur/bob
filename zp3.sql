-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 08:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zp`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`) VALUES
(1, 'Kevin Yank', 'thatguy@kevinyank.com', ''),
(2, 'Tom Butler', 'tom@r.je', ''),
(3, 'Ghena', 'info@tahograf.md', '$2y$10$CgWpeoW53zOhmicU2w.kqutIhZQpgGZ5DXipWUP.4OrsY27Ze0RBK');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`) VALUES
(2, 'EURO'),
(1, 'MDL'),
(31, 'RON'),
(30, 'UAH'),
(3, 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `created`) VALUES
(1, '2024-01-20 16:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `income_facevalues`
--

CREATE TABLE `income_facevalues` (
  `id` int(10) NOT NULL,
  `income_id` int(11) NOT NULL,
  `currency_id` int(10) NOT NULL,
  `facevalue` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `rate` decimal(6,2) NOT NULL,
  `summ` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income_facevalues`
--

INSERT INTO `income_facevalues` (`id`, `income_id`, `currency_id`, `facevalue`, `quantity`, `amount`, `rate`, `summ`) VALUES
(14, 1, 1, 100, 100, 55, '20.00', '1000.00'),
(31, 1, 2, 100, 1, 100, '19.00', '1900.00'),
(32, 1, 2, 100, 1, 100, '19.00', '1900.00'),
(33, 1, 2, 100, 1, 100, '19.00', '1900.00'),
(34, 1, 30, 100, 100, 10000, '0.48', '4800.00');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `currency_id` int(10) NOT NULL,
  `rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `date`, `currency_id`, `rate`) VALUES
(1, '2023-07-31', 3, '18.00'),
(13, '2023-07-31', 2, '20.00'),
(14, '2023-08-04', 3, '1.00'),
(15, '2023-08-01', 2, '19.54'),
(16, '2023-08-03', 3, '17.78'),
(17, '2023-08-05', 2, '22.00'),
(19, '2023-08-19', 2, '19.00'),
(20, '2023-08-26', 30, '60.00'),
(22, '2023-08-28', 31, '3.90'),
(23, '2023-08-28', 30, '0.48'),
(27, '2023-08-30', 3, '18.01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_facevalues`
--
ALTER TABLE `income_facevalues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_ibfk_1` (`currency_id`),
  ADD KEY `income_id` (`income_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_id` (`currency_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income_facevalues`
--
ALTER TABLE `income_facevalues`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `income_facevalues`
--
ALTER TABLE `income_facevalues`
  ADD CONSTRAINT `income_facevalues_ibfk_1` FOREIGN KEY (`income_id`) REFERENCES `income` (`id`);

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
