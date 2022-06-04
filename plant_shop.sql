-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Cze 2022, 21:16
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `plant_shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `images`
--

INSERT INTO `images` (`id`, `name`) VALUES
(1, '1.png'),
(2, '2.png'),
(3, '3.png'),
(4, '4.png'),
(5, '5.png'),
(6, '6.png'),
(7, '7.png'),
(8, '8.png'),
(9, '9.png'),
(10, '10.png'),
(11, '11.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `perms`
--

CREATE TABLE `perms` (
  `id` int(11) NOT NULL,
  `perm` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `perms`
--

INSERT INTO `perms` (`id`, `perm`) VALUES
(1, 'admin'),
(2, 'mod'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `plant_name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `plants`
--

INSERT INTO `plants` (`id`, `plant_name`, `price`, `quantity`, `image`) VALUES
(1, 'Plumeria', '61.41', 38, 4),
(2, 'Bachmanniomyces Lichen', '88.62', 72, 6),
(3, 'Cryptothele Lichen', '65.86', 89, 7),
(4, 'Egg-leaf Amazonvine', '83.22', 58, 8),
(5, 'Immersaria Lichen', '44.95', 17, 8),
(6, 'Perovskia', '19.23', 34, 5),
(7, 'Smallflower Lovegrass', '42.43', 47, 9),
(8, 'Ogotoruk Creek Ragwort', '37.98', 9, 1),
(9, 'Purple Crowberry', '33.58', 5, 7),
(10, 'Lecidea Lichen', '43.91', 12, 8),
(11, 'Purple-spot Parrot-lily', '37.20', 9, 11),
(12, 'Fries\' Pussytoes', '77.85', 99, 10),
(13, 'Zollinger\'s Parmotrema Lichen', '77.35', 88, 8),
(14, 'California Tortula Moss', '80.52', 64, 3),
(15, 'Bellshape Gilia', '50.90', 35, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `perm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `perm`) VALUES
(1, 'moderator', '79f52b5b92498b00cb18284f1dcb466bd40ad559', 2),
(2, 'user', '12dea96fec20593566ab75692c9949596833adc9', 3),
(3, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_orders` (`user_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indeksy dla tabeli `perms`
--
ALTER TABLE `perms`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image` (`image`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_perm` (`perm`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT dla tabeli `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `plants` (`id`),
  ADD CONSTRAINT `fk_user_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`image`) REFERENCES `images` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_perm` FOREIGN KEY (`perm`) REFERENCES `perms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
