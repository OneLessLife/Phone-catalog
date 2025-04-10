-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 11:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pg6`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` int(15) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `admin` int(10) NOT NULL,
  `id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `city`, `phone`, `pic`, `admin`, `id`) VALUES
('giorgos', 'giorgiou', 'Larisa', 69854584, 'user2.jpg', 0, 1),
('nikos', 'koudounas3', 'Thessalonikh', 69584578, 'user3.jpg', 1, 2),
('kwstas', 'nikolaou2', 'Athens', 69584524, 'user4.jpg', 0, 3),
('giorgos', 'μιχαηλιδης', 'ΑΘΗΝΑ', 2147483647, 'user7.jpg', 0, 4),
('iasonas', 'koudounas', 'ΑΘΗΝΑ', 2147483647, './pics/62ab9db93be4a.jpg', 0, 5),
('eirhnh', 'mag', 'ΑΘΗΝΑ', 69584521, 'user5.jpg', 1, 6),
('giorgosa', 'μιχαηλιδης', 'larisa', 2147483647, './pics/62aba181cde0f.jpg', 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
