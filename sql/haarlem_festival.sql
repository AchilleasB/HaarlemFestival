-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 10, 2024 at 10:18 AM
-- Server version: 11.0.3-MariaDB-1:11.0.3+maria~ubu2204
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haarlem_festival`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `registration_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `registration_date`) VALUES
(1, 'Achilleas', 'Ballanos', 'achil@email.com', '$2y$10$mjD.jC/87HN3E9q1ZxwXHeY6Yvh3WNLpLMrWlTny9iRGaoDXBde0a', 'customer', '07-02-2024'),
(2, 'Odin', 'Odinson', 'odin@email.com', '$2y$10$9nQENvOLLdlj.RnMpB6ZpOnfTIyanK3msL/q/8Yu/NvtldzrIdXRe', 'customer', '08-02-2024'),
(3, 'Tony', 'Stark', '686446@student.inholland.nl', '$2y$10$gikeOLWBalPi/..Wm8j.8.R1yRjtBplqytL9777xiXMflP5hBApb2', 'admin', '08-02-2024'),
(4, 'Hulk', 'Banner', 'hulk@email.com', '$2y$10$6mVTfKfk.AdHFY4o2CRN0OvP2KDG..2RNWOWb2S0iiEC28lfwum/2', 'employee', '08-02-2024');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
