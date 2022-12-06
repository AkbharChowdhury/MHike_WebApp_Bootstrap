-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2022 at 12:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MHike`
--

-- --------------------------------------------------------

--
-- Table structure for table `Difficulty`
--

CREATE TABLE `Difficulty` (
  `difficulty_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Difficulty`
--

INSERT INTO `Difficulty` (`difficulty_id`, `type`) VALUES
(1, 'Easy'),
(4, 'Expert'),
(3, 'Hard'),
(2, 'Moderate');

-- --------------------------------------------------------

--
-- Table structure for table `Hike`
--

CREATE TABLE `Hike` (
  `hike_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hike_date` date NOT NULL,
  `hike_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `distance` double(5,2) NOT NULL,
  `duration` double NOT NULL,
  `parking_id` int(11) NOT NULL,
  `elevation_gain` double NOT NULL,
  `high` double(10,2) NOT NULL,
  `difficulty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Hike`
--

INSERT INTO `Hike` (`hike_id`, `user_id`, `hike_date`, `hike_name`, `description`, `location`, `distance`, `duration`, `parking_id`, `elevation_gain`, `high`, `difficulty_id`) VALUES
(2, 1, '2022-12-05', 'Test', 'dsds', 'ssdds', 34.00, 32, 2, 89, 199.00, 3),
(8, 3, '2022-12-06', 'Fitz Roy Trek', 'One of Patagonia’s best-known landmarks, this rugged trek offers some of the most dramatic views in the world. Flora and fauna fill the park while striking rock formations create an amazing landscape.\r\n\r\n', 'Patagonia, Argentina', 6.00, 70, 2, 900, 1200.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `HikePhoto`
--

CREATE TABLE `HikePhoto` (
  `photo_id` int(11) NOT NULL,
  `hike_id` int(11) NOT NULL,
  `photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Observation`
--

CREATE TABLE `Observation` (
  `observation_id` int(11) NOT NULL,
  `hike_id` int(11) NOT NULL,
  `observation_title` varchar(100) NOT NULL,
  `comments` text DEFAULT NULL,
  `observation_date` date NOT NULL,
  `observation_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Parking`
--

CREATE TABLE `Parking` (
  `parking_id` int(11) NOT NULL,
  `type` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Parking`
--

INSERT INTO `Parking` (`parking_id`, `type`) VALUES
(2, 'No'),
(1, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `firstname`, `lastname`, `email`, `password`, `registered_date`) VALUES
(1, 'Tom', 'Smith', 'tom@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2022-12-05 19:58:46'),
(2, 'larr', 'diosodi', 'ss@aa.com', 'a7d62a8996c32d3c0e84c9729d9e7070a6a7b193', '2022-12-05 19:45:56'),
(3, 'Whitney', 'Ivy', 'WhitneyCIvy@jourrapide.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2022-12-06 11:11:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Difficulty`
--
ALTER TABLE `Difficulty`
  ADD PRIMARY KEY (`difficulty_id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `Hike`
--
ALTER TABLE `Hike`
  ADD PRIMARY KEY (`hike_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parking_id` (`parking_id`,`difficulty_id`),
  ADD KEY `difficulty_id` (`difficulty_id`);

--
-- Indexes for table `HikePhoto`
--
ALTER TABLE `HikePhoto`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `hike_id` (`hike_id`);

--
-- Indexes for table `Observation`
--
ALTER TABLE `Observation`
  ADD PRIMARY KEY (`observation_id`),
  ADD KEY `hike_id` (`hike_id`);

--
-- Indexes for table `Parking`
--
ALTER TABLE `Parking`
  ADD PRIMARY KEY (`parking_id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Difficulty`
--
ALTER TABLE `Difficulty`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Hike`
--
ALTER TABLE `Hike`
  MODIFY `hike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `HikePhoto`
--
ALTER TABLE `HikePhoto`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Observation`
--
ALTER TABLE `Observation`
  MODIFY `observation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Parking`
--
ALTER TABLE `Parking`
  MODIFY `parking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Hike`
--
ALTER TABLE `Hike`
  ADD CONSTRAINT `hike_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hike_ibfk_2` FOREIGN KEY (`difficulty_id`) REFERENCES `Difficulty` (`difficulty_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hike_ibfk_3` FOREIGN KEY (`parking_id`) REFERENCES `Parking` (`parking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `HikePhoto`
--
ALTER TABLE `HikePhoto`
  ADD CONSTRAINT `hikephoto_ibfk_1` FOREIGN KEY (`hike_id`) REFERENCES `Hike` (`hike_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Observation`
--
ALTER TABLE `Observation`
  ADD CONSTRAINT `observation_ibfk_1` FOREIGN KEY (`hike_id`) REFERENCES `Hike` (`hike_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
