-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 28, 2024 at 09:04 PM
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
  `artist_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `genre`, `artist_image`) VALUES
(1, 'HARDWELL', 'DANCE / HOUSE', 'artists/hardwell.png'),
(2, 'ARMIN VAN BUUREN', 'TRANCE / TECHNO', 'artists/armin_van_buuren.png'),
(3, 'MARTIN GARRIX', 'DANCE / ELECTRONIC', 'artists/martin_garrix.png'),
(4, 'TIESTO', 'TRANCE/ TECHNO/HOUSE/ELECTRO', 'artists/tiesto.png'),
(5, 'NICKY ROMERO', 'ELECTROHOUSE / PROGRESSIVE HOUSE', 'artists/nicky_romero.png'),
(6, 'AFROJACK', 'HOUSE', 'artists/afrojack.png'),
(28, 'ODIN', 'EPIC VIKING', 'artists/odin.png'),
(29, 'ZEUS', 'ELECTRONIC', 'artists/zeus.png'),
(30, 'ATHENA', 'POP / HOUSE', 'artists/athena.png');

-- --------------------------------------------------------

--
-- Table structure for table `artists_info`
--

CREATE TABLE `artists_info` (
  `artist_id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `page_img` varchar(50) NOT NULL,
  `career_highlight_title` varchar(50) NOT NULL,
  `career_highlight_img` varchar(50) NOT NULL,
  `career_highlight_text` varchar(1000) NOT NULL,
  `latest_releases` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists_info`
--

INSERT INTO `artists_info` (`artist_id`, `description`, `page_img`, `career_highlight_title`, `career_highlight_img`, `career_highlight_text`, `latest_releases`) VALUES
(1, '<p>Robbert van de Corput, known professionally as Hardwell, is a Dutch DJ and music producer from Breda. He was voted the world\'s number-one DJ by DJ Mag in 2013 and again in 2014. In 2020, he was ranked at number 43 in the top 100 DJs poll by DJ Mag.</p>', 'artists/hardwell_page.png', '<h1>THE BEGINNINGS</h1>', 'artists/hardwell_highlight.png', '<p>HARDWELL started by producing remixes and uploading them to the Internet. At the age of 14, he was offered a record deal with the Digidance record label. Three weeks later, he made a first official release with the two-disc-record \"Bubbling Beats 1\" which he followed with a Netherlands tour.</p>', '<div class=\"spotify-song\">\r\n<iframe style=\"border-radius:12px\"            src=\"https://open.spotify.com/embed/track/2meQ2wSIBU8OQDKlJcJk5j?utm_source=generator \" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\"\r\n allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe>\r\n<iframe style=\"border radius:12px\" src=\"https://open.spotify.com/embed/track/6L5xbckRDXIf5K1pwTaGkD?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\nloading=\"lazy\"></iframe>\r\n<iframe style=\"border-radius:12px\"\r\nsrc=\"https://open.spotify.com/embed/track/2Q5l502BJ5lvjZFGmnRQ5B?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\nloading=\"lazy\"></iframe>\r\n</div>'),
(2, '<p>Armin van Buuren is a Dutch DJ and record producer from Leiden, South Holland. Since 2001, he has hosted A State of Trance (ASOT), a weekly radio show, which is broadcast to nearly 40 million listeners in 84 countries on over 100 FM radio stations. He has been ranked the number one DJ by DJ Mag a record of five times, four years in a row.</p>', 'artists/armin_van_buuren_page.png', '<h1>THE PERFECTIONIST</h1>', 'artists/armin_van_buuren_highlight.png', '<p>DJ and producer Armin van Buuren is a born perfectionist. His five-time number-one position in the critically acclaimed DJ Mag Top 100 DJs Poll has been the result of his loyalty to fans and his creativity in the studio.</p>', '<div class=\"spotify-song\">\r\n                        <iframe style=\"border-radius:12px\"\r\n                            src=\"https://open.spotify.com/embed/track/57nKL06bKwjaM5Y0aMtY9v?utm_source=generator\"\r\n                            width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\"\r\n                            allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\n                            loading=\"lazy\"></iframe>\r\n                    </div>\r\n                    <div class=\"spotify-song\">\r\n                        <iframe style=\"border-radius:12px\"\r\n                            src=\"https://open.spotify.com/embed/track/1q3qh7hEJrPmPH7uOteYSr?utm_source=generator\"\r\n                            width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\"\r\n                            allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\n                            loading=\"lazy\"></iframe>\r\n                    </div>\r\n                    <div class=\"spotify-song\">\r\n                        <iframe style=\"border-radius:12px\"\r\n                            src=\"https://open.spotify.com/embed/track/08yyvtQ8CNRH6Ogpj60p0n?utm_source=generator\"\r\n                            width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\"\r\n                            allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\n                            loading=\"lazy\"></iframe>\r\n                    </div>'),
(3, '<p>\r\nMartin Garrix, also known as Ytram and GRX, is a Dutch DJ and record producer, who was <strong>ranked number one on DJ Mag\'s Top 100 DJs</strong> list <strong>for three consecutive years—2016, 2017, and 2018.</strong> He is best known for his singles <strong>\'Animals\'</strong>, <strong>\'In the Name of Love\'</strong>, and <strong>\'Scared to Be Lonely\'</strong>.\r\n  </p>', 'artists/martin_garrix_page.png', '<h1>THE BREAKTHROUGH</h1>', 'artists/martin_garrix_highlight.png', '<p>\r\nGarrix gained fame through his solo release, <strong>\"Animals\"</strong>, which was released on 16 June 2013. <strong>The single became a hit in several countries in Europe.</strong> This allowed Garrix to become the <strong>youngest person to reach number one on Beatport.</strong>\r\n</p>', '<div class=\"spotify-song\">\r\n        <iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/4Wu62DoQg1ECGlDKDfo30R?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe>\r\n    </div>\r\n    <div class=\"spotify-song\">\r\n        <iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/6LHXb1sGs72iTmpSr0603b?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe>\r\n    </div>\r\n    <div class=\"spotify-song\">\r\n        <iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/0lqgo6rIBS0nVsvppZC3Ay?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe>\r\n    </div>'),
(4, '<p>Tijs Michiel Verwest born 17 January 1969, known professionally as Tiesto, is a Dutch DJ and record producer. <strong>He was voted \'The Greatest DJ of All Time\'</strong> by Mix magazine in a 2010/2011 poll amongst fans. In 2013, he was voted by DJ Mag readers as the \'best DJ of the last 20 years\'. <strong>He is also regarded by many as the \'Godfather of EDM\'.</strong></p>', 'artists/tiesto_page.png', '<h1>THE GODFATHER<h1>', 'artists/tiesto_highlight.png', '<p>In 2001, Tiesto released his first solo album  \'In My Memory\' which gave him several major hits that launched his career. As his popularity rose in the early 2000s <strong>he became the first DJ to perform to a large crowd without any other DJs or opening acts. He was crowned the “World’s No.1 DJ” 3 consecutive times by DJ Magazine</strong> from 2002 through 2004.</p>', '<div class=\"spotify-song\"><iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/4EmH2iRucAgCOnhuJRotUi?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe></div>\r\n<div class=\"spotify-song\"><iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/4UkUxO2WlKLc0Q1iEutGGh?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe></div><div class=\"spotify-song\"><iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/1SBfaO3swtjh8dV07MExuP?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe></div>'),
(5, '<p>Nick Rotteveel born January 6 1989, professionally known as Nicky Romero or Monocule, is a Dutch DJ, record producer and remixer from Amerongen, Utrecht Province. He has worked with, and received support from DJs, such as Tiesto, Fedde le Grand, Sander van Doorn, David Guetta, Calvin Harris, Armand van Helden, Avicii and Hardwell. He currently ranks at number 20 on DJ Mag\'s annual Top 100 DJs poll. He is known for his viral hit song \'Toulouse\'.</p>', 'artists/nicky_romero_page.png', '<h1>THE MONOCULE</h1>', 'artists/nicky_romero_highlight.png', '<p>In 2009, Nicky remixed tracks that increased his profile and the Ministry of Sound contacted him to do some remixes on their label. In 2010 Nicky Romero came up with a new track called \"My Friend\". The track has been played by DJs and record producers such as Tiesto, Axwell, Fedde Le Grand, Sander van Doorn and many more.</p>', '<div class=\"spotify-song\">\r\n                        <iframe style=\"border-radius:12px\"\r\n                            src=\"https://open.spotify.com/embed/track/5yPEJ4UF90Km4KmLl2h4EE?utm_source=generator\"\r\n                            width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\"\r\n                       allow=\"autoplay;     clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\n                            loading=\"lazy\"></iframe>\r\n                    </div>\r\n                    <div class=\"spotify-song\">\r\n                        <iframe style=\"border-radius:12px\"\r\n                            src=\"https://open.spotify.com/embed/track/6Wq9mMoP3u5DUoTF45Ov7u?utm_source=generator\"\r\n                            width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"true\"\r\n                       allow=\"autoplay;     clipboard-write; encrypted-media; fullscreen; picture-in-picture\"\r\n                            loading=\"lazy\"></iframe>\r\n                    </div>\r\n                    <div class=\"spotify-song\">\r\n                        <iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/2UMDjpShbeQoON9Dn7ONMK?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe>\r\n                    </div>'),
(6, '<p>Nick Leonardus van de Wall born 9 September 1987, better known as Afrojack, is a Dutch DJ, music producer and remixer. In 2007, he founded the record label Wall Recordings; his debut album Forget the World was released in 2014. Afrojack regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag.</p>', 'artists/afrojack_page.png', '<h1>THE ENTREPRENEUR</h1>', 'artists/afrojack_highlight.png', '<p>At the age of 14, Van de Wall started DJing at local pubs and clubs and earning additional income by designing websites for fellow musicians. In 2007, he released \"In Your Face\", the first recording under the Afrojack name. He received international success with the song \"Take Over Control\" featuring Eva Simons, which charted in 10 countries.</p>', '<div class=\"spotify-song\">\r\n     <iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/4YMebDlcRphWajZhJAWPg0?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"false\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\">\r\n       </iframe>\r\n</div>\r\n<div class=\"spotify-song\">\r\n    <iframe style=\"border-radius:12px\"                            src=\"https://open.spotify.com/embed/track/7b5FO1uKhuJE0ZUJPKLWtI?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"false\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\">\r\n    </iframe>\r\n</div>\r\n<div class=\"spotify-song\">\r\n   <iframe style=\"border-radius:12px\"                            src=\"https://open.spotify.com/embed/track/5j1XuqSJqLDRceRqMjcUhT?utm_source=generator\" width=\"100%\" height=\"252\" frameBorder=\"0\" allowfullscreen=\"false\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\">\r\n    </iframe>\r\n</div>'),
(28, '<p>Odin is a widely revered god in Germanic paganism. Norse mythology, the source of most surviving information about him, associates him with wisdom, healing, death, royalty, the gallows, knowledge, war, battle, victory, sorcery, poetry, frenzy, and the runic alphabet, and depicts him as the husband of the goddess Frigg.</p>', 'artists/odin_page.png', '<h1>THE NORSE GOD</h1>', 'artists/odin_highlight.png', '<p>The god Odin has been a source of inspiration for artists working in fine art, literature, and music.</p>', '<div><iframe style=\"border-radius: 12px;\" src=\"https://open.spotify.com/embed/track/6Z5rBmAtaA29iD0H0LGKn7?utm_source=generator\" width=\"100%\" height=\"252\" frameborder=\"0\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>\r\n<div><iframe style=\"border-radius: 12px;\" src=\"https://open.spotify.com/embed/track/587nP9FS8o0p70Z3JS9Uem?utm_source=generator\" width=\"100%\" height=\"252\" frameborder=\"0\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>'),
(29, '<p><strong>Zeus</strong> is the sky and thunder god in ancient Greek religion and mythology, who <strong>rules as king of the gods on Mount Olympus</strong>. His name is cognate with the first syllable of his Roman equivalent Jupiter.</p>', 'artists/zeus_page.png', '<h1>SKY FATHER</h1>', 'artists/zeus_highlight.png', '<p><strong>Zeus was also infamous for his erotic escapades</strong>. These resulted in many divine and heroic offspring, including Apollo, Artemis, Hermes, Persephone, Dionysus, Perseus, Heracles, Helen of Troy, Minos, and the Muses.</p>', '<div><iframe style=\"border-radius:12px\" src=\"https://open.spotify.com/embed/track/24NClHvlj1c93I80wKRQFe?utm_source=generator\" width=\"100%\" height=\"352\" frameBorder=\"0\" allowfullscreen=\"\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" loading=\"lazy\"></iframe><iframe style=\"border-radius: 12px;\" src=\"https://open.spotify.com/embed/track/57bgtoPSgt236HzfBOd8kj?utm_source=generator\" width=\"100%\" height=\"252\" frameborder=\"\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>'),
(30, '<p><strong>Athena</strong> is an ancient Greek goddess associated with wisdom, warfare, and handicraft. <strong>Athena was regarded as the patron and protectress of various cities across Greece</strong>, particularly the city of Athens, from which she most likely received her name.</p>', 'artists/athena_page.png', '<h1>THE OWL</h1>', 'artists/athena_highlight.png', '<p><strong>Athena </strong>was believed to have been born from the forehead of her father Zeus.</p>', '<div><iframe style=\"border-radius: 12px;\" src=\"https://open.spotify.com/embed/track/4ZyE9TB38tLADzmv1OImVU?utm_source=generator\" width=\"100%\" height=\"252\" frameborder=\"0\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe> <iframe style=\"border-radius: 12px;\" src=\"https://open.spotify.com/embed/track/7gwo88n3Asm5Kg7UTdWeF5?utm_source=generator\" width=\"100%\" height=\"252\" frameborder=\"0\" allow=\"autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>');

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`id`, `name`) VALUES
(1, 'Dutch'),
(2, 'French'),
(3, 'European'),
(4, 'International'),
(5, 'Fish and Seafood'),
(6, 'Modern'),
(7, 'Asian');

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
  `price` decimal(10,2) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_events`
--

INSERT INTO `dance_events` (`id`, `venue_id`, `date`, `start_time`, `end_time`, `session`, `tickets_available`, `price`, `type`) VALUES
(1, 1, 'FRIDAY 27 JULY', '20:00', '02:00', 'BACK2BACK', 1350, 75.00, 'SINGLE-CONCERT'),
(2, 3, 'FRIDAY 27 JULY', '22:00', '23:30', 'CLUB', 196, 60.00, 'SINGLE-CONCERT'),
(3, 4, 'FRIDAY 27 JULY', '23:00', '00:30', 'CLUB', 300, 60.00, 'SINGLE-CONCERT'),
(4, 5, 'FRIDAY 27 JULY', '22:00', '23:30', 'CLUB', 200, 60.00, 'SINGLE-CONCERT'),
(5, 6, 'FRIDAY 27 JULY', '22:00', '23:30', 'CLUB', 200, 60.00, 'SINGLE-CONCERT'),
(6, 2, 'SATURDAY 28 JULY', '14:00', '23:00', 'BACK2BACK', 1798, 110.00, 'SINGLE-CONCERT'),
(7, 4, 'SATURDAY 28 JULY', '22:00', '23:30', 'CLUB', 300, 60.00, 'SINGLE-CONCERT'),
(8, 1, 'SATURDAY 28 JULY', '21:00', '01:00', 'TIESTOWORLD', 1499, 75.00, 'SINGLE-CONCERT'),
(9, 3, 'SATURDAY 28 JULY', '23:00', '00:30', 'CLUB', 200, 60.00, 'SINGLE-CONCERT'),
(10, 2, 'SUNDAY 29 JULY', '14:00', '23:00', 'BACK2BACK', 1799, 110.00, 'SINGLE-CONCERT'),
(11, 4, 'SUNDAY 29 JULY', '19:00', '20:30', 'CLUB', 300, 60.00, 'SINGLE-CONCERT'),
(12, 5, 'SUNDAY 29 JULY', '21:00', '22:30', 'CLUB', 1500, 90.00, 'SINGLE-CONCERT'),
(13, 3, 'SUNDAY 29 JULY', '18:00', '19:30', 'CLUB', 200, 60.00, 'SINGLE-CONCERT'),
(14, 1, 'FRIDAY 27 JULY', '20:00', '02:00', 'BACK2BACK', 150, 125.00, '1-DAY-PASS'),
(15, 2, 'SATURDAY 28 JULY', '14:00', '01:00', 'BACK2BACK', 200, 150.00, '1-DAY-PASS'),
(16, 2, 'SUNDAY 29 JULY', '14:00', '23:00', 'BACK2BACK', 200, 150.00, '1-DAY-PASS'),
(17, 1, 'FRIDAY 27 JULY', '20:00', '23:00', 'BACK2BACK', 148, 250.00, '3-DAY-PASS'),
(36, 2, 'MONDAY 30 JULY', '13:00', '18:00', 'BACK2BACK', 1798, 500.00, 'SINGLE-CONCERT'),
(37, 4, 'MONDAY 30 JULY', '20:00', '22:30', 'CLUB', 150, 250.00, 'SINGLE-CONCERT');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` int(11) NOT NULL,
  `price_bottle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `price_bottle`) VALUES
(11, 120),
(12, 150),
(13, 100),
(14, 180),
(15, 90);

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
(13, 3),
(36, 28),
(36, 29),
(37, 30);

-- --------------------------------------------------------

--
-- Table structure for table `history_tours`
--

CREATE TABLE `history_tours` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time(5) NOT NULL,
  `guide` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_tours`
--

INSERT INTO `history_tours` (`id`, `date`, `time`, `guide`) VALUES
(1, '2023-07-26', '10:00:00.00000', 1),
(2, '2023-07-26', '10:00:00.00000', 4),
(3, '2023-07-26', '13:00:00.00000', 1),
(4, '2023-07-26', '13:00:00.00000', 4),
(5, '2023-07-26', '16:00:00.00000', 1),
(6, '2023-07-26', '16:00:00.00000', 4),
(7, '2023-07-27', '10:00:00.00000', 5),
(8, '2023-07-27', '10:00:00.00000', 2),
(9, '2023-07-27', '13:00:00.00000', 5),
(10, '2023-07-27', '13:00:00.00000', 2),
(11, '2023-07-27', '13:00:00.00000', 7),
(12, '2023-07-27', '16:00:00.00000', 5),
(13, '2023-07-27', '16:00:00.00000', 2),
(14, '2023-07-28', '10:00:00.00000', 1),
(15, '2023-07-28', '10:00:00.00000', 2),
(16, '2023-07-28', '10:00:00.00000', 5),
(17, '2023-07-28', '10:00:00.00000', 4),
(18, '2023-07-28', '13:00:00.00000', 1),
(19, '2023-07-28', '13:00:00.00000', 2),
(20, '2023-07-28', '13:00:00.00000', 5),
(21, '2023-07-28', '13:00:00.00000', 4),
(22, '2023-07-28', '13:00:00.00000', 7),
(23, '2023-07-28', '16:00:00.00000', 1),
(24, '2023-07-28', '16:00:00.00000', 4),
(25, '2023-07-28', '16:00:00.00000', 7),
(26, '2023-07-29', '10:00:00.00000', 1),
(27, '2023-07-29', '10:00:00.00000', 3),
(28, '2023-07-29', '10:00:00.00000', 5),
(29, '2023-07-29', '10:00:00.00000', 6),
(30, '2023-07-29', '10:00:00.00000', 8),
(31, '2023-07-29', '13:00:00.00000', 1),
(32, '2023-07-29', '13:00:00.00000', 2),
(33, '2023-07-29', '13:00:00.00000', 3),
(34, '2023-07-29', '13:00:00.00000', 4),
(35, '2023-07-29', '13:00:00.00000', 5),
(36, '2023-07-29', '13:00:00.00000', 6),
(37, '2023-07-29', '13:00:00.00000', 7),
(38, '2023-07-29', '13:00:00.00000', 8),
(39, '2023-07-29', '16:00:00.00000', 2),
(40, '2023-07-29', '16:00:00.00000', 4);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`) VALUES
(1, 'stbavo.png'),
(2, 'grotemarkt.png'),
(3, 'dehallen.png'),
(4, 'proveniershof.png'),
(5, 'jopenkerk.png'),
(6, 'waalsekerk.png'),
(7, 'molenadreiaan.png'),
(8, 'amsterdamsepoort.png'),
(9, 'hofvanbakenes.png'),
(10, 'ratatouille-banner.png'),
(11, 'restaurant-ml-banner.png'),
(12, 'restaurant-fris-banner.png'),
(13, 'specktakel-banner.png'),
(14, 'grand-cafe-brinkman-banner.png'),
(15, 'urban-frenchy-bistro-toujours-banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `location_type` varchar(100) NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `links` varchar(1000) DEFAULT NULL,
  `images` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `address`, `location_type`, `description`, `links`, `images`) VALUES
(1, 'Church of St. Bavo', 'Grote Markt 22, 2011 RD Haarlem', 'Landmark', 'The St Bavo church was built in 1895-1930 and dedicated in 1948, named for the city&#039;s patron saint.', 'https://en.wikipedia.org/wiki/Grote_Kerk,_Haarlem', 1),
(2, 'Grote Markt', 'Grote Markt 1, 2011 RD Haarlem', 'Landmark', 'This is the city centre of Haarlem. Located in this centre, are some of the most historical buildings of Haarlem, the most obvious St Bavo church.', 'https://nl.wikipedia.org/wiki/Grote_Markt_(Haarlem)', 2),
(3, 'De Hallen', 'Groot Heiligland 62, 2011 ES Haarlem', 'Landmark', 'In this museum, you can view contemporary, modern art and more!', 'https://nl.wikipedia.org/wiki/Hal_(Frans_Hals_Museum)', 3),
(4, 'Proveniershof', 'Grote Houtstraat 142D, 2011 SV Haarlem', 'Landmark', 'The Proveniershof was founded in 1704 and has a lot of history that leads to its creation. Find out more by visiting!', 'https://nl.wikipedia.org/wiki/Proveniershof', 4),
(5, 'Jopenkerk', 'Gedempte Voldersgracht 2, 2011 WD Haarlem', 'Landmark', 'Beer enjoyers are definitely going to love this place. It is a brewery that is focused on creating traditional Haarlem beers and to bring them to the commercial market!', 'https://nl.wikipedia.org/wiki/Brouwerij_Jopen', 5),
(6, 'Waalse Kerk', 'Begijnhof 28, 2011 HE Haarlem', 'Landmark', 'This is the oldest church in Haarlem. It was built in the year 1348 and since then, has been a very important part of Haarlem’s history.', 'https://nl.wikipedia.org/wiki/De_Adriaan_(Haarlem)', 6),
(7, 'Molen Adriaan', 'Papentorenvest 1A, 2011 AV Haarlem', 'Landmark', 'This is one of the most distinctive part of Haarlem’s skyline. It is one of the monuments you see when you enter Haarlem.', 'https://nl.wikipedia.org/wiki/De_Adriaan_(Haarlem)', 7),
(8, 'Amsterdamse Poort', 'Zijlvest 39, 2011 VB Haarlem', 'Landmark', 'Previously called the Spaarnwouderpoort, it was built in 1486 and is located at the end of the old route from Amsterdam to Haarlem. Its also the only gate left from the 12 original city gates.', 'https://nl.wikipedia.org/wiki/Amsterdamse_Poort_(Haarlem)', 8),
(9, 'Hof van Bakenes', 'Wijde Appelaarsteeg 11F, 2011 HB Haarlem', 'Landmark', 'This is the oldest hofje in the Netherlands, found by Dirck van Bakenes in the year 1395.', 'https://nl.wikipedia.org/wiki/Hofje_van_Bakenes', 9);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `price_per_portion` decimal(10,2) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price_per_portion`, `restaurant_id`) VALUES
(1, 'Grilled Salmon', 'Fresh salmon with a lemon herb seasoning', 25.00, 1),
(2, 'Caesar Salad', 'Classic Caesar salad with homemade dressing', 12.00, 1),
(3, 'Beef Burger', 'Juicy beef burger with cheese and special sauce', 15.00, 1),
(4, 'Margherita Pizza', 'Classic pizza with tomatoes, mozzarella, and basil', 18.00, 1),
(5, 'Chocolate Lava Cake', 'Warm cake with a gooey chocolate center', 10.00, 1),
(6, 'Sushi Platter', 'Assorted nigiri and rolls, serves two', 30.00, 2),
(7, 'Ramen Bowl', 'Rich broth with noodles, pork, and vegetables', 20.00, 2),
(8, 'Vegetarian Pasta', 'Pasta with seasonal vegetables in tomato sauce', 16.00, 2),
(9, 'Tiramisu', 'Classic Italian dessert with coffee and mascarpone', 11.00, 2),
(10, 'Mediterranean Salad', 'Mixed greens with feta, olives, and vinaigrette', 14.00, 2),
(11, 'Chardonnay', 'Elegant white wine with notes of apple and oak', 5.00, 1),
(12, 'Pinot Noir', 'Medium-bodied red wine with flavors of cherry and raspberry', NULL, 1),
(13, 'Sauvignon Blanc', 'Crisp and refreshing white wine with citrus notes', 8.50, 1),
(14, 'Cabernet Sauvignon', 'Robust red wine with hints of blackberry and vanilla', 7.00, 2),
(15, 'Merlot', 'Smooth red wine with soft tannins and plum flavors', 22.20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date_time`, `payment_status`, `total_price`) VALUES
(1, '2024-03-27 21:05:18', 'paid', 120.00);

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
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `number_of_seats` int(11) NOT NULL DEFAULT 50,
  `number_of_stars` enum('1','2','3','4','5') NOT NULL,
  `banner` int(11) NOT NULL,
  `is_recommended` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `location`, `description`, `number_of_seats`, `number_of_stars`, `banner`, `is_recommended`) VALUES
(1, 'Ratatouille', 'Spaarne 96, 2011 CL Haarlem, Nederland', 'With Jozua Jaring, not everything is as it seems. He pays great attention to detail in the meticulous presentation of his dishes and likes to surprise diners with contrasting colours and forms. This is a restaurant with a real wow factor chef Jaring who puts his own exciting spin on classical flavours, taking your taste buds on a culinary adventure.', 52, '4', 10, 1),
(2, 'Restaurant ML', 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 'Still at a top level but also with a more lower price, Toujours wins the top for the the best restaurant in terms of price-quality. For an intimate, cozy and beautiful dinner with friends or family, take a seat in our beautiful restaurant area. With radiant daylight thanks to the domes on our roof. Which provide a magical beautiful light in the evening, when dining under the starry sky comes very close.', 60, '4', 11, 0),
(3, 'Restaurant Fris', 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 'With Jozua Jaring, not everything is as it seems. He pays great attention to detail in the meticulous presentation of his dishes and likes to surprise diners with contrasting colours and forms. This is a restaurant with a real wow factor chef Jaring who puts his own exciting spin on classical flavours, taking your taste buds on a culinary adventure.', 45, '4', 12, 0),
(4, 'Specktakel', 'Spekstraat 4, 2011 HM Haarlem, Nederland', 'With Jozua Jaring, not everything is as it seems. He pays great attention to detail in the meticulous presentation of his dishes and likes to surprise diners with contrasting colours and forms. This is a restaurant with a real wow factor chef Jaring who puts his own exciting spin on classical flavours, taking your taste buds on a culinary adventure.', 36, '3', 13, 0),
(5, 'Grand Cafe Brinkman', 'Grote Markt 13, 2011 RC Haarlem, Nederland', 'With Jozua Jaring, not everything is as it seems. He pays great attention to detail in the meticulous presentation of his dishes and likes to surprise diners with contrasting colours and forms. This is a restaurant with a real wow factor chef Jaring who puts his own exciting spin on classical flavours, taking your taste buds on a culinary adventure.', 100, '3', 14, 0),
(6, 'Urban Frenchy Bistro Toujours', 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 48, '3', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_cuisines`
--

CREATE TABLE `restaurants_cuisines` (
  `restaurant_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants_cuisines`
--

INSERT INTO `restaurants_cuisines` (`restaurant_id`, `cuisine_id`) VALUES
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(1, 2),
(3, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(4, 4),
(1, 5),
(2, 5),
(6, 5),
(5, 6),
(4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_sessions`
--

CREATE TABLE `restaurants_sessions` (
  `restaurant_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants_sessions`
--

INSERT INTO `restaurants_sessions` (`restaurant_id`, `session_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `start_date`, `end_date`) VALUES
(1, '2024-03-05 18:00:00', '2024-03-05 19:30:00'),
(2, '2024-03-05 19:30:00', '2024-03-05 21:00:00'),
(3, '2024-03-05 21:00:00', '2024-03-05 22:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` uuid NOT NULL,
  `calc_price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `dance_event_id` int(11) DEFAULT NULL,
  `history_tour_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `calc_price`, `amount`, `dance_event_id`, `history_tour_id`, `reservation_id`, `user_id`, `order_id`) VALUES
('254d8f2d-02ba-496b-ba5c-58456deb355e', 1000.00, 2, 36, NULL, NULL, 2, NULL),
('0b9b65c9-2c73-4470-8efe-7e64b566d2b5', 220.00, 2, 6, NULL, NULL, 2, NULL),
('b4eb0068-963f-4ca2-8839-82bdd0357003', 110.00, 1, 10, NULL, NULL, 2, NULL),
('d029ec15-1352-439d-ba1c-907ab9e60a02', 60.00, 1, 2, NULL, NULL, 2, NULL),
('9b9c83ff-4c37-490c-9636-d12e5a06b6bc', 75.00, 1, 8, NULL, NULL, 6, NULL),
('426c623e-8963-4f04-8410-f82e017d1009', 500.00, 2, 17, NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour_guides`
--

CREATE TABLE `tour_guides` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_guides`
--

INSERT INTO `tour_guides` (`id`, `name`, `language`) VALUES
(1, 'Frederic', 'English'),
(2, 'Williams', 'English'),
(3, 'Deirdre', 'English'),
(4, 'Jan Willem', 'Dutch'),
(5, 'Annet', 'Dutch'),
(6, 'Lisa', 'Dutch'),
(7, 'Kim', 'Chinese'),
(8, 'Susan', 'Chinese');

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
(2, 'Achil', 'Ballanos', 'ahilleasballanos@gmail.com', '$2y$10$ZSIYLLcEL.tgMorcLdTzcO84RRvfPPZHyNntErm3IK5TdYCKAG73K', 'Admin', '11-02-2024'),
(5, 'Hulk', 'Banner', 'achilleasballanos@outlook.com', '$2y$10$ncp7mP0hjtXyKua87OGQUuFxBmEL9r9PzuLIKAQMj0GhJ//ML.vuC', 'Employee', '25-02-2024'),
(6, 'Thor', 'Odinson', 'thor@email.com', '$2y$10$FKn5WvU4.YDLV3IjmuATqugZtA1dMBOnqaK/LGXpXKSCsGfFE.CD6', 'Employee', '23-02-2024'),
(7, 'Tony', 'Stark', 'stark@email.com', '$2y$10$cv1rrTS179h1RsWHGXo4J.ho0UH3C49dpEQdvo2srjwa1zSjU9cP.', 'Customer', '12-02-2024'),
(8, 'John', 'Doe', 'johndoe@mail.com', '$2y$10$EPBD8eQqFU5H/2IVapkpa.umoHV3f1XwvUKWIWVqN7Bn2VTlGcubG', 'Admin', '04-03-2024');

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
-- Indexes for table `artists_info`
--
ALTER TABLE `artists_info`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dance_events`
--
ALTER TABLE `dance_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dance_events_ibfk_1` (`venue_id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_artists`
--
ALTER TABLE `event_artists`
  ADD PRIMARY KEY (`event_id`,`artist_id`),
  ADD KEY `fk_event_artists_event` (`event_id`),
  ADD KEY `fk_event_artists_artist` (`artist_id`);

--
-- Indexes for table `history_tours`
--
ALTER TABLE `history_tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guide` (`guide`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`images`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_token` (`user_id`,`token`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banner` (`banner`);

--
-- Indexes for table `restaurants_cuisines`
--
ALTER TABLE `restaurants_cuisines`
  ADD PRIMARY KEY (`restaurant_id`,`cuisine_id`),
  ADD KEY `cuisine_id` (`cuisine_id`);

--
-- Indexes for table `restaurants_sessions`
--
ALTER TABLE `restaurants_sessions`
  ADD PRIMARY KEY (`restaurant_id`,`session_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`dance_event_id`),
  ADD KEY `order_id` (`user_id`),
  ADD KEY `tickets_ibfk_2` (`history_tour_id`),
  ADD KEY `order_id_2` (`order_id`);

--
-- Indexes for table `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dance_events`
--
ALTER TABLE `dance_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `history_tours`
--
ALTER TABLE `history_tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tour_guides`
--
ALTER TABLE `tour_guides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artists_info`
--
ALTER TABLE `artists_info`
  ADD CONSTRAINT `artists_info_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dance_events`
--
ALTER TABLE `dance_events`
  ADD CONSTRAINT `dance_events_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `drinks_ibfk_1` FOREIGN KEY (`id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_artists`
--
ALTER TABLE `event_artists`
  ADD CONSTRAINT `fk_event_artists_artist` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_artists_event` FOREIGN KEY (`event_id`) REFERENCES `dance_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_tours`
--
ALTER TABLE `history_tours`
  ADD CONSTRAINT `guide` FOREIGN KEY (`guide`) REFERENCES `tour_guides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `image` FOREIGN KEY (`images`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`banner`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurants_cuisines`
--
ALTER TABLE `restaurants_cuisines`
  ADD CONSTRAINT `restaurants_cuisines_ibfk_1` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurants_cuisines_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurants_sessions`
--
ALTER TABLE `restaurants_sessions`
  ADD CONSTRAINT `restaurants_sessions_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurants_sessions_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`dance_event_id`) REFERENCES `dance_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`history_tour_id`) REFERENCES `history_tours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_4` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
