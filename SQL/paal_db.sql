-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Jan 2016 um 19:33
-- Server-Version: 10.0.17-MariaDB
-- PHP-Version: 5.6.14

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
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `acc_ID` int(11) NOT NULL,
  `balance` decimal(13,2) NOT NULL,
  `payment_limit` decimal(13,2) NOT NULL DEFAULT '2000.00',
  `type` enum('Sparkonto','Privatkonto','Jugendkonto','Säule 3','') NOT NULL,
  `user_ID` int(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transactions`
--

CREATE TABLE `transactions` (
  `trans_ID`       INT(11)                                                                                                                                NOT NULL,
  `trans_ammount`  DECIMAL(13, 2)                                                                                                                         NOT NULL,
  `trans_sender`   INT(11)                                                                                                                                NOT NULL,
  `trans_reciever` INT(11)                                                                                                                                NOT NULL,
  `trans_type`     ENUM('Miete', 'Haushalt', 'Freizeit', 'Online', 'Einkaufen', 'Reisen', 'Gesundheit', 'Steuern & Versicherungen', 'Ferien', 'Diverses') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID`        INT(11)      NOT NULL,
  `username`  VARCHAR(40)  NOT NULL,
  `firstname` VARCHAR(40)  NOT NULL,
  `lastname`  VARCHAR(40)  NOT NULL,
  `password`  VARCHAR(128) NOT NULL,
  `secret`    VARCHAR(16)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
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
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
MODIFY `acc_ID` INT(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints der Tabelle `accounts`
--
ALTER TABLE `accounts`
ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`);

--
-- Constraints der Tabelle `transactions`
--
ALTER TABLE `transactions`
ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`trans_sender`) REFERENCES `accounts` (`acc_ID`),
ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`trans_reciever`) REFERENCES `accounts` (`acc_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
