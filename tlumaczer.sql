-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Sty 2017, 12:24
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tlumaczer`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jezyk`
--

CREATE TABLE `jezyk` (
  `id` int(11) NOT NULL,
  `jezyk_ory` varchar(64) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `jezyk`
--

INSERT INTO `jezyk` (`id`, `jezyk_ory`) VALUES
(1, 'Polski'),
(7, 'Angielski'),
(8, 'Niemiecki'),
(9, 'Francuski'),
(10, 'Hiszpanski'),
(11, 'Wloski'),
(12, 'Rosyjski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teksty`
--

CREATE TABLE `teksty` (
  `id_teksty` int(11) NOT NULL,
  `id_jez_doc` int(11) NOT NULL,
  `id_jez_ory` int(11) NOT NULL,
  `id_uzy` int(11) NOT NULL,
  `temat` varchar(64) CHARACTER SET utf8 NOT NULL,
  `tekst` text CHARACTER SET utf8 NOT NULL,
  `tlumaczenie` text CHARACTER SET utf8 NOT NULL,
  `id_uzy_tlu` varchar(64) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `teksty`
--

INSERT INTO `teksty` (`id_teksty`, `id_jez_doc`, `id_jez_ory`, `id_uzy`, `temat`, `tekst`, `tlumaczenie`, `id_uzy_tlu`) VALUES
(18, 7, 1, 16, 'Testowanie', 'Testujemy dziaÅ‚anie strony', 'We testing website', 'admin'),
(22, 8, 1, 16, 'tetetettetete', 'tersccefefefef', 'efegergerghrthrthyjyj', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `kraj` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `plec` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `dataur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `haslo`, `email`, `kraj`, `plec`, `dataur`) VALUES
(16, 'admin', '$2y$10$KX5Xb2/H4Q5NchyvoIgbreO5b2k/IFHKa1QPv5s6VzY3gjCWKjpU2', 'prze.m.alcatras@gmail.com', 'Polska', 'mezczyzna', '1992-11-01'),
(17, 'przemek', '$2y$10$dgmdlNwKnKqPPFu9gkDlZuvy8ICE.4BbSHBxExgUGbBgwoVoDuXdG', 'prze.m@interia.pl', 'Polska', 'mezczyzna', '1992-01-11'),
(18, 'Kowalski', '$2y$10$7./Bhx8AztfhQq6nchrSC.g2Q/jHdYquj8bpI3/FWkWKoY8/IVRPi', 'kowalski@gmail.com', 'Niemcy', 'mezczyzna', '1982-05-22'),
(19, 'Nowak', '$2y$10$6sZr13UScjVpPlYNsHNhyObzTV1x9CjpOHMbXY22VFOT4oDChkpre', 'nowak@gmail.com', 'Anglia', 'kobieta', '1995-10-22');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `jezyk`
--
ALTER TABLE `jezyk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teksty`
--
ALTER TABLE `teksty`
  ADD PRIMARY KEY (`id_teksty`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `jezyk`
--
ALTER TABLE `jezyk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `teksty`
--
ALTER TABLE `teksty`
  MODIFY `id_teksty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
