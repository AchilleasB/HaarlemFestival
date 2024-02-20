-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 20, 2024 at 10:12 PM
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
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `artist_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `genre`, `description`, `artist_image`) VALUES
(1, 'Harwell', 'dance and house', 'Robbert van de Corput , known professionally as Hardwell, is a Dutch DJ and music producer from Breda. He was voted the world\'s number one DJ by DJ Mag in 2013 and again in 2014. In 202. he was also ranked at number 43 in the top 100 DJs poll by DJ Mag.', '/../images/artists/hardwell.png'),
(2, 'Armin van Buuren', 'trance and techno', 'ARMIN VAN BUUREN a Dutch DJ and record producer from Leiden, South Holland. Since 2001, he has hosted A State of Trance (ASOT), a weekly radio show, which is broadcast to nearly 40 million listeners in 84 countries on over 100 FM radio stations. He has been ranked the number one DJ by DJ Mag a record of five times, four years in a row. ', '/../images/artists/armin_van_buuren.png'),
(3, 'Martin Garrix', 'dance and electronic', 'Martin Garrix, also known as Ytram and GRX, is a Dutch DJ and record producer, who was ranked number one on DJ Mag\'s Top 100 DJs list for three consecutive years—2016, 2017, and 2018. He is best known for his singles \'Animals\', \'In the Name of Love\', and \'Scared to Be Lonely\'.', '/../images/artists/martin_garrix.png'),
(4, 'Tiesto', 'trance,  techno, minimal, house and electro', 'Tijs Michiel Verwest born 17 January 1969, known professionally as Tiësto, is a Dutch DJ and record producer. He was voted \'The Greatest DJ of All Time\' by Mix magazine in a 2010/2011 poll amongst fans. In 2013, he was voted by DJ Mag readers as the \'best DJ of the last 20 years\'. He is also regarded by many as the \'Godfather of EDM\'.', '/../images/artists/tiesto.png'),
(5, 'Nicky Romero', 'electrohouse and progressive house', 'Nick Rotteveel born January 6 1989, professionally known as Nicky Romero or Monocule, is a Dutch DJ, record producer and remixer from Amerongen, Utrecht Province. He has worked with, and received support from DJs, such as Tiësto, Fedde le Grand, Sander van Doorn, David Guetta, Calvin Harris, Armand van Helden, Avicii and Hardwell. He currently ranks at number 20 on DJ Mag\'s annual Top 100 DJs poll. He is known for his viral hit song \'Toulouse\'.', '/../images/artists/nicky_romero.png'),
(6, 'Afrojack', 'house', 'Nick Leonardus van de Wall born 9 September 1987, better known as Afrojack, is a Dutch DJ, music producer and remixer. In 2007, he founded the record label Wall Recordings; his debut album Forget the World was released in 2014. Afrojack regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag.', '/../images/artists/afrojack.png');

-- --------------------------------------------------------

--
-- Table structure for table `dance_events`
--

CREATE TABLE `dance_events` (
  `id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `tickets_available` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_events`
--

INSERT INTO `dance_events` (`id`, `venue_id`, `date`, `start_time`, `end_time`, `session`, `tickets_available`, `price`) VALUES
(1, 1, 'Friday 27 July', '20:00', '02:00', 'Back2Back', 1500, 75),
(2, 3, 'Friday 27 July', '22:00', '23:30', 'Club', 200, 60),
(3, 4, 'Friday 27 July', '23:00', '00:30', 'Club', 300, 60),
(4, 5, 'Friday 27 July', '22:00', '23:30', 'Club', 200, 60),
(5, 6, 'Friday 27 July', '22:00', '23:30', 'Club', 200, 60),
(6, 2, 'Saturday 28 July', '14:00', '23:00', 'Back2Back', 2000, 110),
(7, 4, 'Saturday 28 July', '22:00', '23:30', 'Club', 300, 60),
(8, 1, 'Saturday 28 July', '21:00', '01:00', 'TiestoWorld', 1500, 75),
(9, 3, 'Saturday 28 July', '23:00', '00:30', 'Club', 200, 60),
(10, 2, 'Sunday 29 July', '14:00', '23:00', 'Back2Back', 2000, 110),
(11, 4, 'Sunday 29 July', '19:00', '20:30', 'Club', 300, 60),
(12, 5, 'Sunday 29 July', '21:00', '22:30', 'Club', 1500, 90),
(13, 3, 'Sunday 29 July', '18:00', '19:30', 'Club', 200, 60);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `location_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `tickets_available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_artists`
--

CREATE TABLE `event_artists` (
  `event_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_artists`
--

INSERT INTO `event_artists` (`event_id`, `artist_id`) VALUES
(1, 5),
(1, 6),
(2, 4),
(3, 1),
(4, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 6),
(8, 4),
(9, 5),
(10, 4),
(10, 5),
(10, 6),
(11, 2),
(12, 1),
(13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `location_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `ticket_type` varchar(50) NOT NULL,
  `ticket_amount` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'Achil', 'Ballanos', 'ahilleasballanos@gmail.com', '$2y$10$FL2ULD6vLiLcWytbszeV.OdHFujzs4lLv2P9A4siQHtKp5EBeu/HO', 'admin', '11-02-2024');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `venue_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `address`, `venue_image`) VALUES
(1, 'Lichtfabriek', 'Minckelersweg 2', '/../images/venues/lichtfabriek.png'),
(2, 'Caprera Openluchttheater', 'Hoge Duin en Daalseweg 2', '/../images/venues/caprera_openluchttheater.png'),
(3, 'Club Stalker', 'Kromme Elleboogsteeg 2', '/../images/venues/club_stalker.png'),
(4, 'Jopenkerk', 'Gedemte Voldergracht 2', '/../images/venues/jopenkerk.png'),
(5, 'XO the club', 'Grote Markt 8', '/../images/venues/xo_club.png'),
(6, 'Club Ruis', 'Smedestraat 32', '/../images/venues/club_ruis.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dance_events`
--
ALTER TABLE `dance_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `event_artists`
--
ALTER TABLE `event_artists`
  ADD PRIMARY KEY (`event_id`,`artist_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_token` (`user_id`,`token`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dance_events`
--
ALTER TABLE `dance_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dance_events`
--
ALTER TABLE `dance_events`
  ADD CONSTRAINT `dance_events_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `event_artists`
--
ALTER TABLE `event_artists`
  ADD CONSTRAINT `event_artists_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `dance_events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_artists_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
