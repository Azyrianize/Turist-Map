-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 16, 2023 at 01:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turistmap`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`, `email`, `type`) VALUES
(1, 'Kacper', '123', 'kacper@gmail.com', 'admin'),
(2, 'Kacper', '1234', 'kacperuser@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `marker_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `xcoord` double NOT NULL,
  `ycoord` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`marker_id`, `user_id`, `name`, `type`, `xcoord`, `ycoord`) VALUES
(1, 1, 'Paris Eiffel Tower', 'Building', 48.8583, 2.2945),
(2, 1, 'Great Pyramid of Giza', 'Building', 31.1339477975, 29.97416777),
(3, 1, 'Sphinx', 'Building', 31.13583279, 29.971829446),
(4, 1, 'Notre-Dame', 'Building', 48.852966, 2.349902),
(5, 1, 'Rocinha Favela', 'Area', -22.986496054, -43.241332368),
(6, 1, 'Ganges Canal', 'River', 29.7666636, 78.1999992),
(7, 1, 'The Colosseum of Rome', 'Building', 41.890251, 12.492373),
(8, 1, 'Buckingham Palace', 'Building', 51.501476, -0.140634),
(9, 1, 'ALEXANDRA FIORD', 'Area', 78.8999964, -75.993162694),
(10, 1, 'Alhambra', 'Building', -118.1270146, 34.095287),
(11, 2, 'Cathedral Basilica of St. John', 'Building', 32.073333, -81.091389),
(12, 2, 'Siena Cathedral', 'Building', 43.3177, 11.329),
(14, 2, 'eyyy', 'Building', 37.383889, -5.991389),
(15, 2, 'Shwedagon Pagoda', 'Building', 16.798354, 96.149705),
(16, 2, 'eyyy', 'Statue', -22.951944, -43.210556),
(17, 1, 'Golden Gate Bridge', 'Building', 37.819722, -122.478611),
(18, 2, 'Central Park', 'Park', 40.782222, -73.965278),
(19, 1, 'lalala', 'Statue', 40.689194, -74.0445);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`marker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `marker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
