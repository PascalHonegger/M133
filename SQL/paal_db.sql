-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Jan 2016 um 21:05
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `paal_db`
--
CREATE DATABASE IF NOT EXISTS `paal_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `paal_db`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `acc_ID` int(11) NOT NULL,
  `balance` decimal(13,2) NOT NULL,
  `payment_limit` decimal(13,2) NOT NULL DEFAULT '2000.00',
  `type` enum('Sparkonto','Privatkonto','Jugendkonto','Säule 3','') NOT NULL,
  `user_ID` int(11) NOT NULL,
  `acc_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `account`
--

INSERT INTO `account` (`acc_ID`, `balance`, `payment_limit`, `type`, `user_ID`, `acc_name`) VALUES
(1, '9999999401.00', '2000000000.00', 'Jugendkonto', 3, 'NoSteuernInDaHuud'),
(2, '599.10', '250.00', 'Privatkonto', 3, 'MoneyOutOfffffDaHuud');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `trans_ID` int(11) NOT NULL,
  `trans_amount` decimal(13,2) NOT NULL,
  `trans_sender` int(11) NOT NULL,
  `trans_reciever` int(11) NOT NULL,
  `trans_type` enum('Miete','Haushalt','Freizeit','Online','Einkaufen','Reisen','Gesundheit','Steuern & Versicherungen','Ferien','Diverses') NOT NULL,
  `execution_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `transaction`
--

INSERT INTO `transaction` (`trans_ID`, `trans_amount`, `trans_sender`, `trans_reciever`, `trans_type`, `execution_time`) VALUES
(1, '50.00', 1, 2, 'Haushalt', '2016-01-19 19:57:18'),
(2, '1000.00', 1, 2, 'Diverses', '2016-01-19 19:57:51'),
(3, '249.00', 2, 1, 'Miete', '2016-01-19 19:58:00'),
(4, '1.00', 2, 1, 'Miete', '2016-01-19 19:58:05'),
(5, '1.00', 2, 1, 'Miete', '2016-01-19 19:58:08'),
(6, '100.00', 2, 1, 'Miete', '2016-01-19 19:59:43'),
(7, '200.00', 2, 1, 'Miete', '2016-01-19 20:00:02'),
(8, '233.00', 1, 1, 'Miete', '2016-01-19 20:00:26'),
(9, '1.00', 1, 1, 'Miete', '2016-01-19 20:00:54');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `secret` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_ID`, `username`, `firstname`, `lastname`, `password`, `secret`) VALUES
(1, 'Pudcul', 'Pudcil', 'Qwer!1234', '$2y$11$UVFLUUJDWkVGREpNS1lWQu9LQSGV3lAN2NeqPgVj3ZAgx2QY62d5q', 'QQKQBCZEFDJMKYVC'),
(2, 'TooMuchMoneyForYourLife', 'Seraphin', 'Rihm', '$2y$11$NkRDWU00M0NZNEZFQ0xMMelUnqYSQePN5ZblHWlFz4V9p2xOq4uES', '6DCYM43CY4FECLL2'),
(3, 'Seraphun', 'seraphun', 'rheim', '$2y$11$RlA3WElIU0xVSFZZNFlQNePE0wiiSkzkyeSN4.jUTz9RQVqKNQ.Ly', 'FP7XIHSLUHVY4YP6');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_ID`), ADD KEY `user_ID` (`user_ID`);

--
-- Indizes für die Tabelle `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_ID`), ADD KEY `trans_sender` (`trans_sender`), ADD KEY `trans_reciever` (`trans_reciever`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `account`
--
ALTER TABLE `account`
  MODIFY `acc_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `account`
--
ALTER TABLE `account`
ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints der Tabelle `transaction`
--
ALTER TABLE `transaction`
ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`trans_sender`) REFERENCES `account` (`acc_ID`),
ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`trans_reciever`) REFERENCES `account` (`acc_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
