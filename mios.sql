-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Sie 2017, 13:55
-- Wersja serwera: 10.1.25-MariaDB
-- Wersja PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mios`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `classes`
--

CREATE TABLE `classes` (
  `class_id` int(8) NOT NULL,
  `class_number` int(2) NOT NULL,
  `class_symbol` varchar(8) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `class_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `class_educator` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `classes`
--

INSERT INTO `classes` (`class_id`, `class_number`, `class_symbol`, `class_name`, `class_educator`) VALUES
(1, 1, 'I', 'technik informatyk', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(32) NOT NULL,
  `club_type` int(11) NOT NULL,
  `club_name` varchar(256) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `club_desc` varchar(1024) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `club_creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_type`, `club_name`, `club_desc`, `club_creationDate`) VALUES
(10, 3, 'GameDev Club', 'Kółko stworzone przez uczniów dla uczniów.', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(32) NOT NULL,
  `notification_type` int(8) NOT NULL,
  `notification_user_id` int(32) NOT NULL,
  `notification_subject0` int(32) DEFAULT NULL,
  `notification_subject1` int(32) DEFAULT NULL,
  `notification_extra` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(32) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_first` varchar(256) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_last` varchar(256) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_email` varchar(256) DEFAULT NULL,
  `user_role` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `class_id` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_uid`, `user_pwd`, `user_first`, `user_last`, `user_email`, `user_role`, `class_id`) VALUES
(3, 'iwoplaza', '$2y$10$s4PogIjdChSm19s4Scz49e0P45MxsGMJ9Uw9Q1VRGsn9GWU7cs8.u', 'Iwo', 'Plaza', 'iwoplaza@gmail.com', 1, 1),
(6, 'teacher', '$2y$10$xy4Q1xaYrwmysUWRNtoP3OFNJttg8ahUz5AQj5NAdC7tEAFbzRvt6', 'Toriel', 'Jones', 'teacher@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_club_relations`
--

CREATE TABLE `user_club_relations` (
  `relation_id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `club_id` int(32) NOT NULL,
  `relation` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `user_club_relations`
--

INSERT INTO `user_club_relations` (`relation_id`, `user_id`, `club_id`, `relation`) VALUES
(15, 3, 2, 0),
(21, 3, 9, 0),
(22, 6, 10, 3),
(23, 3, 10, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_club_relations`
--
ALTER TABLE `user_club_relations`
  ADD PRIMARY KEY (`relation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `user_club_relations`
--
ALTER TABLE `user_club_relations`
  MODIFY `relation_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
