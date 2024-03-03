-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 03, 2024 at 05:37 PM
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
(1, 'HARDWELL', 'DANCE / HOUSE', 'Robbert van de Corput, known professionally as Hardwell, is a Dutch DJ and music producer from Breda. He was voted the world\'s number-one DJ by DJ Mag in 2013 and again in 2014. In 2020. He was also ranked at number 43 in the top 100 DJs poll by DJ Mag.', 'artists/hardwell.png'),
(2, 'ARMIN VAN BUUREN', 'TRANCE / TECHNO', 'Armin van Buuren is a Dutch DJ and record producer from Leiden, South Holland. Since 2001, he has hosted A State of Trance (ASOT), a weekly radio show, which is broadcast to nearly 40 million listeners in 84 countries on over 100 FM radio stations. He has been ranked the number one DJ by DJ Mag a record of five times, four years in a row. ', 'artists/armin_van_buuren.png'),
(3, 'MARTIN GARRIX', 'DANCE / ELECTRONIC', 'Martin Garrix, also known as Ytram and GRX, is a Dutch DJ and record producer, who was ranked number one on DJ Mag\'s Top 100 DJs list for three consecutive years—2016, 2017, and 2018. He is best known for his singles \'Animals\', \'In the Name of Love\', and \'Scared to Be Lonely\'.', 'artists/martin_garrix.png'),
(4, 'TIESTO', 'TRANCE/ TECHNO/HOUSE/ELECTRO', 'Tijs Michiel Verwest born 17 January 1969, known professionally as Tiësto, is a Dutch DJ and record producer. He was voted \'The Greatest DJ of All Time\' by Mix magazine in a 2010/2011 poll amongst fans. In 2013, he was voted by DJ Mag readers as the \'best DJ of the last 20 years\'. He is also regarded by many as the \'Godfather of EDM\'.', 'artists/tiesto.png'),
(5, 'NICKY ROMERO', 'ELECTROHOUSE / PROGRESSIVE HOUSE', 'Nick Rotteveel born January 6 1989, professionally known as Nicky Romero or Monocule, is a Dutch DJ, record producer and remixer from Amerongen, Utrecht Province. He has worked with, and received support from DJs, such as Tiësto, Fedde le Grand, Sander van Doorn, David Guetta, Calvin Harris, Armand van Helden, Avicii and Hardwell. He currently ranks at number 20 on DJ Mag\'s annual Top 100 DJs poll. He is known for his viral hit song \'Toulouse\'.', 'artists/nicky_romero.png'),
(6, 'AFROJACK', 'HOUSE', 'Nick Leonardus van de Wall born 9 September 1987, better known as Afrojack, is a Dutch DJ, music producer and remixer. In 2007, he founded the record label Wall Recordings; his debut album Forget the World was released in 2014. Afrojack regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag.', 'artists/afrojack.png'),
(28, 'ODIN', 'EPIC VIKING', 'KILL KILL KILL ÉM ALL', 'artists/odin.png'),
(29, 'ZEUS', 'ELECTRONIC', 'THUNDER THUNDER THUNDER', 'artists/zeus.png'),
(30, 'ATHENA', 'POP / HOUSE', 'GO GO GO', 'artists/athena.png');

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
  `price` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_events`
--

INSERT INTO `dance_events` (`id`, `venue_id`, `date`, `start_time`, `end_time`, `session`, `tickets_available`, `price`, `type`) VALUES
(1, 1, 'FRIDAY 27 JULY', '20:00', '02:00', 'BACK2BACK', 1500, 75, 'SINGLE-CONCERT'),
(2, 3, 'FRIDAY 27 JULY', '22:00', '23:30', 'CLUB', 200, 60, 'SINGLE-CONCERT'),
(3, 4, 'FRIDAY 27 JULY', '23:00', '00:30', 'CLUB', 300, 60, 'SINGLE-CONCERT'),
(4, 5, 'FRIDAY 27 JULY', '22:00', '23:30', 'CLUB', 200, 60, 'SINGLE-CONCERT'),
(5, 6, 'FRIDAY 27 JULY', '22:00', '23:30', 'CLUB', 200, 60, 'SINGLE-CONCERT'),
(6, 2, 'SATURDAY 28 JULY', '14:00', '23:00', 'BACK2BACK', 2000, 110, 'SINGLE-CONCERT'),
(7, 4, 'SATURDAY 28 JULY', '22:00', '23:30', 'CLUB', 300, 60, 'SINGLE-CONCERT'),
(8, 1, 'SATURDAY 28 JULY', '21:00', '01:00', 'TIESTOWORLD', 1500, 75, 'SINGLE-CONCERT'),
(9, 3, 'SATURDAY 28 JULY', '23:00', '00:30', 'CLUB', 200, 60, 'SINGLE-CONCERT'),
(10, 2, 'SUNDAY 29 JULY', '14:00', '23:00', 'BACK2BACK', 2000, 110, 'SINGLE-CONCERT'),
(11, 4, 'SUNDAY 29 JULY', '19:00', '20:30', 'CLUB', 300, 60, 'SINGLE-CONCERT'),
(12, 5, 'SUNDAY 29 JULY', '21:00', '22:30', 'CLUB', 1500, 90, 'SINGLE-CONCERT'),
(13, 3, 'SUNDAY 29 JULY', '18:00', '19:30', 'CLUB', 200, 60, 'SINGLE-CONCERT'),
(14, 1, 'FRIDAY 27 JULY', '20:00', '02:00', 'BACK2BACK', 150, 125, '1-DAY-PASS'),
(15, 2, 'SATURDAY 28 JULY', '14:00', '01:00', 'BACK2BACK', 150, 150, '1-DAY-PASS'),
(16, 2, 'SUNDAY 29 JULY', '14:00', '23:00', 'BACK2BACK', 150, 150, '1-DAY-PASS'),
(17, 1, 'FRIDAY 27 JULY', '20:00', '23:00', 'BACK2BACK', 150, 250, '3-DAY-PASS'),
(36, 2, 'MONDAY 30 JULY', '13:00', '18:00', 'BACK2BACK', 2000, 500, 'SINGLE-CONCERT'),
(37, 4, 'MONDAY 30 JULY', '20:00', '22:30', 'CLUB', 200, 250, 'SINGLE-CONCERT');

-- --------------------------------------------------------

--
-- Table structure for table `dance_tickets`
--

CREATE TABLE `dance_tickets` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_tickets`
--

INSERT INTO `dance_tickets` (`id`, `amount`, `event_id`, `user_id`) VALUES
(33, 3, 1, 2),
(46, 2, 1, 2),
(47, 2, 2, 2),
(48, 3, 3, 2),
(49, 4, 4, 2),
(50, 4, 6, 2),
(51, 4, 9, 2),
(52, 2, 17, 2),
(53, 1, 14, 4),
(55, 1, 5, 3),
(56, 3, 10, 3),
(57, 1, 1, 2),
(58, 2, 6, 2);

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
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_artists`
--

INSERT INTO `event_artists` (`id`, `event_id`, `artist_id`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 2, 4),
(4, 3, 1),
(5, 4, 2),
(6, 5, 3),
(7, 6, 1),
(8, 6, 2),
(9, 6, 3),
(11, 7, 6),
(12, 8, 4),
(13, 9, 5),
(14, 10, 4),
(15, 10, 5),
(16, 10, 6),
(17, 11, 2),
(18, 12, 1),
(19, 13, 3),
(43, 36, 28),
(44, 36, 29),
(46, 37, 30);

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
  `user_id` int(11) NOT NULL
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
(2, 'Achil', 'Ballanos', 'ahilleasballanos@gmail.com', '$2y$10$ZSIYLLcEL.tgMorcLdTzcO84RRvfPPZHyNntErm3IK5TdYCKAG73K', 'admin', '11-02-2024'),
(3, 'Thor', 'Odinson', 'thor@email.com', '$2y$10$MJglj4Tb6TbC3Y9VLhd0x.zMyeUQGvqBSFZa2kLuRivBP46YfYplC', 'customer', '27-02-2024'),
(4, 'Tony', 'Stark', 'stark@email.com', '$2y$10$iFLnmaPFjBjFRBH021OpYu38HrI0DzHhSD1g0qb8hcHtMu0QQzq4S', 'customer', '27-02-2024');

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
(1, 'LICHTFABRIEK', 'MINCKERSWEG 2', 'venues/lichtfabriek.png'),
(2, 'CAPRERA OPENLUCHTTHEATER', 'HOGE DUIN EN DAALSWEG 2', 'venues/caprera_openluchttheater.png'),
(3, 'CLUB STALKER', 'KROMME ELLEBOOGSTEEG 2', 'venues/club_stalker.png'),
(4, 'JOPENKERK', 'GEDEMTE VOLDERGRACHT 2', 'venues/jopenkerk.png'),
(5, 'XO THE CLUB', 'GROTE MARKT 8', 'venues/xo_club.png'),
(6, 'CLUB RUIS', 'SMEDESTRAAT 32', 'venues/club_ruis.png');

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
  ADD KEY `dance_events_ibfk_1` (`venue_id`);

--
-- Indexes for table `dance_tickets`
--
ALTER TABLE `dance_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dance_tickets_ibfk_1` (`event_id`),
  ADD KEY `dance_tickets_ibfk_2` (`user_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event_artists_event` (`event_id`),
  ADD KEY `fk_event_artists_artist` (`artist_id`);

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
  ADD KEY `order_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `dance_events`
--
ALTER TABLE `dance_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `dance_tickets`
--
ALTER TABLE `dance_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_artists`
--
ALTER TABLE `event_artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dance_events`
--
ALTER TABLE `dance_events`
  ADD CONSTRAINT `dance_events_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dance_tickets`
--
ALTER TABLE `dance_tickets`
  ADD CONSTRAINT `dance_tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `dance_events` (`id`),
  ADD CONSTRAINT `dance_tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `fk_event_artists_artist` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_artists_event` FOREIGN KEY (`event_id`) REFERENCES `dance_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
