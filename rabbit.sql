-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 02:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rabbit`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(6, 'Others', 'this is for other breedtype '),
(7, 'Angora', 'Angora rabbits are among the oldest breeds of domestic rabbit that originated in Angora (formerly known as Ankara), Turkey.'),
(8, 'American', 'American Rabbits made it to the American Rabbit Breeders Association (ARBA) list in 1917. '),
(9, 'Argente', 'Argente rabbits are among the oldest French breeds. '),
(10, 'Armenian Marder', 'The Armenian Marder rabbit has been coveted for its exquisitely delicious meat. '),
(11, 'Beige', 'Beige rabbits are believed to have originated in England or in The Netherlands. '),
(12, 'Belgian Hare', 'Belgian Hare is a domestic breed that was called as such because of its resemblance to the wild hare. '),
(13, 'Dwarf', 'N/A'),
(14, 'English', 'Originated in England in the 19th century. '),
(15, 'Lop', 'none'),
(16, 'Doe', 'none'),
(17, 'Buck', 'none'),
(18, 'Cinnamon ', 'Cinnamon rabbits are domestic breeds developed in the US in 1962. They are best known for their russet-coloured fur, which earned them their name. Their average weight ranges from 8.5 to 11 pounds. Their coat also has a smoky grey colouring on their sides and a dark underbelly. They also have rust-coloured spots on their feet and face. Cinnamon rabbits are calm, laid-back, and love the attention of their owners.'),
(19, 'Dutch', 'Dutch Rabbits used to be the most popular rabbit breed, but were replaced by the popularity of dwarf rabbits. Despite their name, they were actually first bred in England. They have delicate bodies that should be handled with extra care, which is why pet owners need proper training, to prevent injuries. These rabbits have very small, erect ears, powerful back legs that are bigger than their front feet, and a generally white coat with some base colours. Dutch Rabbits are gentle with a good disposition.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date_posted` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `date_posted`, `post_id`, `user_id`) VALUES
(1, 'hey', '2023-11-08 14:41:56', 70, 70),
(2, 'good', '2023-11-08 14:42:30', 70, 70),
(3, 'hey\r\n', '2023-11-08 14:53:25', 69, 70),
(4, 'So cute.', '2023-11-08 23:30:28', 57, 1),
(5, 'nice', '2023-11-10 14:22:10', 68, 70);

-- --------------------------------------------------------

--
-- Table structure for table `location_tab`
--

CREATE TABLE `location_tab` (
  `locationLatitude` varchar(50) NOT NULL,
  `locationLongitude` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_tab`
--

INSERT INTO `location_tab` (`locationLatitude`, `locationLongitude`, `ID`) VALUES
('13.696756233796542', '123.47965369316721', 1),
('13.710859654843919', '123.49784517086889', 4),
('13.710859654843919', '123.49784517086889', 5),
('13.723524862813548', '123.50282257942463', 6),
('13.735835747283858', '123.52101131741205', 7),
('13.6973', '123.4886', 8),
('13.735835747283858', '123.4886', 9);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(50, 456784, 33, 'asda'),
(51, 456784, 33, 'gfg'),
(52, 793725, 1, 'hhf'),
(53, 793725, 1, 'ghjmghj'),
(54, 456784, 33, 'gdfgdf'),
(91, 123456, 47, 'hello'),
(92, 123456, 335454, 'as'),
(93, 335454, 123456, 'heyy'),
(94, 335454, 123456, 'hello pooo'),
(95, 123456, 335454, 'shesssh'),
(96, 335454, 123456, 'gotta work now'),
(97, 335454, 123456, 'pleaseee'),
(98, 335454, 123456, 'hello'),
(99, 123456, 335454, 'yeahhh'),
(100, 335454, 123456, 'TEST MESSAGE'),
(101, 335454, 123456, 'YEAH'),
(102, 123456, 335454, 'IS IT WORKING NOWWW?'),
(103, 123456, 335454, 'CAN YOU HEAR ME'),
(104, 335454, 123456, 'YES'),
(105, 123456, 335454, 'NAISEEEEE'),
(106, 123456, 335454, 'heyy'),
(107, 335454, 123456, 'what'),
(108, 123456, 335454, 'heyyyyy'),
(109, 2147483647, 456784, 'hello'),
(110, 234567, 456784, 'gghhgj'),
(111, 234567, 123456, 'hello'),
(112, 123456, 234567, 'hi'),
(113, 98765, 123456, 'hello'),
(114, 123456, 12345, 'hello'),
(115, 678901, 123456, 'hey'),
(116, 123456, 1452427359, 'yow'),
(117, 98765, 123456, 'heyy'),
(118, 234567, 123456, 'shesh');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `age` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `population` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `is_featured`, `age`, `color`, `gender`, `population`) VALUES
(55, 'Lionhead', 'None', '1698026687rabbit1.jpg', '2023-10-23 02:04:47', 6, 67, 0, '6 Months', 'black and white', 'Buck', '6'),
(56, 'fuzzy', 'Lionhead x Fuzzy Lionhead (Pet type)', '1698028862rabbit2.jpg', '2023-10-23 02:41:02', 6, 1, 0, '2 Months', 'White And Brown', 'Doe', '5'),
(57, 'Doe', 'Mix Lionhead x New Zealand (Pet type)', '1698059143rabbit3.jpg', '2023-10-23 11:05:43', 6, 58, 1, '2 Months', 'Broken Color (White Brown)', 'Both', '4'),
(58, 'Buck', 'New Zealand (Pet type)', '1698125865rabbit4.jpg', '2023-10-24 05:37:45', 6, 59, 0, '2 Months', 'Broken Color (White &#38; Gray)', 'Both', '5'),
(59, 'Buck', 'Mix Lionhead x New Zealand (Pet type)', '1698125994rabbit5.jpg', '2023-10-24 05:39:54', 6, 59, 0, '2 Months', 'White', 'Both', '4'),
(60, 'Buck', 'Mix Lionhead x New Zealand (Pet type)', '1698126220rabbit6.jpg', '2023-10-24 05:43:40', 6, 60, 0, '3 Months', 'White', 'Both', '4'),
(61, 'Doe', 'New Zealand (Pet type)', '1698126330rabbit7.jpg', '2023-10-24 05:45:30', 6, 60, 0, '2Â½ months old', 'Broken Color (White Brown)', 'Both', '4'),
(64, 'Doe', 'New Zealand - Red eye ( Meat type)', '1698126777rabbit8.jpg', '2023-10-24 05:52:57', 6, 61, 0, '4 months old', 'White', 'Both', '5'),
(65, 'Buck', 'Mix Lionhead x New Zealand - Red eye (Pet type)', '1698126866rabbit9.jpg', '2023-10-24 05:54:26', 6, 61, 0, '2 Months', 'White', 'Both', '6'),
(66, 'Doe', 'Mix Lionhead x Fuzzy Lionhead (Pet type)', '16981270271.jpg', '2023-10-24 05:57:07', 6, 62, 0, '1 month', 'Broken Color (White Brown)', 'Both', '5'),
(67, 'Doe', 'New Zealand (Pet type)', '16981271032.jpg', '2023-10-24 05:58:23', 6, 62, 0, '1 month', 'Broken Color (White Gray)', 'Both', '3'),
(68, 'Doe', 'Mix Lionhead (Pet type)', '16981273493.jpg', '2023-10-24 06:02:29', 6, 63, 0, '21 days', 'Broken Color (White DarkBrown)', 'Both', '3'),
(69, 'Buck', 'New Zealand - Red eye (Meat type)', '16981274164.jpg', '2023-10-24 06:03:36', 6, 63, 0, '9 Months', 'White', 'Both', '4'),
(70, 'Buck', 'Mix Lionhead x New Zealand (Pet type)', '16981276866.jpg', '2023-10-24 06:08:06', 17, 65, 0, '2 Months', 'Black', 'Both', '3'),
(71, 'Buck', 'New Zealand (Pet type)', '16981277325.jpg', '2023-10-24 06:08:52', 17, 65, 0, '2 Months', 'Dutch', 'Both', '4'),
(72, 'Dutch', 'Dutch Rabbits used to be the most popular rabbit breed, but were replaced by the popularity of dwarf rabbits. Despite their name, they were actually first bred in England. They have delicate bodies that should be handled with extra care, which is why pet owners need proper training, to prevent injuries. These rabbits have very small, erect ears, powerful back legs that are bigger than their front feet, and a generally white coat with some base colours. Dutch Rabbits are gentle with a good disposition.', '16981287687.jpg', '2023-10-24 06:26:08', 19, 1, 0, '3 Months', 'black and white', 'Both', '3'),
(73, 'Buck', 'Lionhead x Fuzzy Lionhead (Pet type)', '16981912288.jpg', '2023-10-24 23:47:08', 17, 58, 0, '2 Months', 'Mix Color (Dark brown &#38; Black)', 'both', '3'),
(74, 'Buck', 'Lionhead x Fuzzy Lionhead (Pet type)', '169819152101.jpg', '2023-10-24 23:52:01', 17, 58, 0, '1 Â½ month old', 'Broken Color (White &#38; Brown)', 'both', '6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `status` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`, `status`, `address`, `contact`, `location`) VALUES
(1, '123456', 'mark joshua', 'echimane', 'echimane', 'jitzkieechimane@gmail.com', '$2y$10$L9STPSpEW9YjJG0hU4.vCO.U8X4YlAx.LN6iN.BU0ivx78ePz/dke', '16914077711.png', 0, 'Active now', 'Zone 5, Sitio Talisay, Dolo, San Jose, Cam. Sur', '09485766763', 8),
(58, '234567', 'Dissa  Z.', 'Briguel', 'dissa', 'dissabriguel1004@gmail.com', '$2y$10$KNqIcQNmm9EoNiCZXYSDo.CaY8muMPyD2LXeiHVCa29WMxVEelhCW', '1698020236avatar5.jpg', 2, 'Active now', 'Zone 4 Abo, Tigaon, Camarines Sur', '09481817507', NULL),
(59, '345678', 'Mae Ronquillio ', 'Huerte', 'huerte', 'huerte@gmail.com', '$2y$10$VV0b1/poAOUeLPLafJawOOLrj1FLFugtT7ecAYMB3APR7S/nNhdva', '1698020453avatar6.jpg', 2, 'Active now', '', '', NULL),
(60, '456789', 'Lorezenel P. ', 'Remiter', 'remiter', 'pelimianolorenel@gmail.com', '$2y$10$L9VV4kw.K/kP72Kv5tVpDuVwnyB.60.Iv1avlWTPQfBOSjPeMilm2', '1698021108avatar8.jpg', 2, 'Active now', '', '', NULL),
(61, '567890', 'Bernardette', ' Anata', 'bernardette', 'bernardettegonzaga@gmail.com', '$2y$10$m0d0kOC.wu8SySOP5qQIMu3QeZdcmTPwatqrOCkfCxusB7.1s8TOa', '1698021217avatar9.jpg', 2, 'Active now', '', '', NULL),
(62, '678901', 'Michael Allan ', 'Nabales', 'allan', 'allan@gmail.com', '$2y$10$6IPjwGFqQjpZ2f9FKpWmietJbyAvmgFVSixXcBvT/5B/IcZiN1BhS', '1698021281avatar3.jpg', 2, 'Active now', '', '', NULL),
(63, '789012', 'Victor ', 'Mendoza', 'victor', 'victor@gmail.com', '$2y$10$fFuRphuldPwm7JJPJD89PeYFlSTEC8Mg0eYhx5eG.rYK4bsiHEMwm', '1698021353avatar15.jpg', 2, 'Active now', '', '', NULL),
(64, '890123', 'Julie ', 'Relloso', 'julie ', 'Julie.relloso@gmail.com', '$2y$10$tZKqFsDkGKjDo9Ig13TSLumYsjBbgY3TmL.9yhRRxRpMuNBU6./cO', '1698021988avatar4.jpg', 2, '', '', '', NULL),
(65, '901234', 'jessa ', 'ouabe', 'jessa ', 'jessa@gmail.com', '$2y$10$FsfXa5HRokWYqIxn0kdYtes2KT/Z.GzEGTvutODrFi1/74sdn9XpO', '1698022104avatar16.jpg', 2, 'Active now', '', '', NULL),
(66, '12345', 'Marco', 'Joshua', 'marco', 'marco@gmail.com', '$2y$10$OGsm8phh06WcXxCgE6twN.zDttJYIJE83KOT1JVWkPKKJn5Y9KK/G', '1698022196blog100.jpg', 3, 'Active now', 'Salogon, San Jose, Camarines Sur', '09222555100', 6),
(67, '98765', 'shiena', 'dizon', 'dizon', 'dizon@gmail.com', '$2y$10$bzlGhTRJgKNC23iugI1qjeFBuufsy.86A06UqbEgwC6ADIpYqtEdi', '1698022272avatar17.jpg', 0, 'Active now', '', '', 5),
(70, '1452427359', 'Ej ', 'Sinfuego', 'ejsinfuego100', 'ej@mail.com', '$2y$10$bQpeRL.lcQ24Oia4iNsn8eF07LC6RRV5CP3tJcMsWJ5cq5LbOi/Cu', '1699330176Screenshot 2023-04-21 215654.png', 3, 'Active now', 'sample address', '', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `location_tab`
--
ALTER TABLE `location_tab`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `incoming_msg_index` (`incoming_msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_author` (`author_id`),
  ADD KEY `FK_blog_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id_index` (`location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location_tab`
--
ALTER TABLE `location_tab`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_breeder_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_breeder_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_rabbit_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_rabbit_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
