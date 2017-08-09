-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sie 2017, 13:03
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
-- Struktura tabeli dla tabeli `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(32) NOT NULL,
  `club_type` int(11) NOT NULL,
  `club_name` varchar(256) NOT NULL,
  `club_desc` varchar(1024) DEFAULT NULL,
  `club_creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(32) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_uid`, `user_pwd`, `user_first`, `user_last`, `user_email`) VALUES
(3, 'iwoplaza', '$2y$10$s4PogIjdChSm19s4Scz49e0P45MxsGMJ9Uw9Q1VRGsn9GWU7cs8.u', 'Iwo', 'Plaza', 'iwoplaza@gmail.com'),
(4, 'krzysiu', '$2y$10$WOCAx4XiUzkBDpatulOaceBn.eTYmhXvwCY2hMT2M/GS/k6mDCcjC', 'Krzysiu', 'PrzybyÅ‚', 'krzysiu@krzysiu.krzysiu'),
(5, 'Maro919', '$2y$10$tq2MHcHFj9iH0vqF97.ZjeREfhAiELRFqhPmQfLMU2XuhpSXDLr5C', 'Marek', 'WaluÅ›kiewicz', 'marek999-1999@o2.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_club_relations`
--

CREATE TABLE `user_club_relations` (
  `user_id` int(32) NOT NULL,
  `club_id` int(32) NOT NULL,
  `relation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
