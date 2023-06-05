-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 10:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dictionary`
--

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `en` text DEFAULT NULL,
  `rus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `en`, `rus`) VALUES
(2, 'whatever ', 'что бы ни'),
(3, 'however', 'однако'),
(4, 'circle back', 'вернуться назад'),
(6, 'assuming ', 'предпологая'),
(16, 'Consider ', 'рассматривать'),
(17, 'whether ', 'ли'),
(28, 'enhancement ', 'улучшение'),
(29, 'highlights ', 'основные моменты'),
(30, 'Unlike', 'В отличие от'),
(32, 'rest assured', 'Будьте уверены'),
(33, 'tackled ', 'занялся'),
(34, 'Indeed', 'Действительно'),
(35, 'treate', 'трактовать'),
(36, 'relate', 'иметь отношение к'),
(37, 'Accomplished', 'Удавшийся'),
(38, 'expand ', 'расширять'),
(39, 'forewarned', 'предупрежден'),
(40, 'beyond ', 'вне'),
(41, 'from scratch', 'с нуля'),
(42, 'snapshots ', 'снимки'),
(43, 'plow ', 'плуг'),
(44, 'headlong ', 'стремительный'),
(45, 'honing ', 'оттачивание'),
(46, 'undoubtedly', 'несомненно'),
(47, 'distinguish ', 'различать'),
(48, 'unpolluted ', 'незагрязненный'),
(49, 'whatsoever', 'что угодно'),
(50, 'otherwise ', 'в противном случае'),
(51, 'redundant', 'избыточный'),
(52, 'Thus', 'Таким образом');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
