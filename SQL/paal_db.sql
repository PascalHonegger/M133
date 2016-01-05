-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Dez 2015 um 15:15
-- Server-Version: 5.6.26
-- PHP-Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `paal_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `konto`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `acc_ID` int(11) NOT NULL,
  `balance` decimal(13,2) NOT NULL,
  `payment_limit` decimal(13,2) NOT NULL DEFAULT '2000.00',
  `type` enum('Sparkonto','Privatkonto','Jugendkonto','Säule 3','') NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_ID` int(11) NOT NULL,
  `trans_ammount` decimal(13,2) NOT NULL,
  `trans_sender` int(11) NOT NULL,
  `trans_reciever` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID`        int(11)      NOT NULL,
  `username`  varchar(40)  NOT NULL,
  `firstname` varchar(40)  NOT NULL,
  `lastname`  varchar(40)  NOT NULL,
  `password`  varchar(128) NOT NULL,
  `salt`      VARCHAR(64)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `konto`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indizes für die Tabelle `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_ID`),
  ADD KEY `trans_sender` (`trans_sender`),
  ADD KEY `trans_reciever` (`trans_reciever`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `konto`
--
ALTER TABLE `accounts`
  MODIFY `acc_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `konto`
--
ALTER TABLE `accounts`
  ADD FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`);

--
-- Constraints der Tabelle `transactions`
--
ALTER TABLE `transactions`
  ADD FOREIGN KEY (`trans_sender`) REFERENCES `accounts` (`acc_ID`),
  ADD FOREIGN KEY (`trans_reciever`) REFERENCES `accounts` (`acc_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
