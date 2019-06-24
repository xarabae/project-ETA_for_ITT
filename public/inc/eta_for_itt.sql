-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jun 2019 um 16:31
-- Server-Version: 10.3.16-MariaDB
-- PHP-Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `eta_for_itt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabe`
--

CREATE TABLE `aufgabe` (
  `ID` int(11) NOT NULL,
  `Nummer` varchar(10) NOT NULL,
  `Prüfungs_ID` int(11) NOT NULL,
  `Prüfungsteil_ID` int(11) NOT NULL,
  `Aufgabenart_ID` int(11) NOT NULL,
  `Thema_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `aufgabe`
--

INSERT INTO `aufgabe` (`ID`, `Nummer`, `Prüfungs_ID`, `Prüfungsteil_ID`, `Aufgabenart_ID`, `Thema_ID`) VALUES
(1, '1. a)', 1, 1, 6, 1),
(2, '2. b)', 1, 3, 2, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabenart`
--

CREATE TABLE `aufgabenart` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `aufgabenart`
--

INSERT INTO `aufgabenart` (`ID`, `Bezeichnung`) VALUES
(1, 'Frage-Antwort'),
(2, 'Multiple Choice'),
(3, 'Zuordnung'),
(4, 'Rechnen'),
(5, 'Vervollständigung'),
(6, 'Erläuterung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fach`
--

CREATE TABLE `fach` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `fach`
--

INSERT INTO `fach` (`ID`, `Bezeichnung`) VALUES
(1, 'Anwendungsentwicklung'),
(2, 'IT-Systeme'),
(3, 'Organisation und Geschäftsprozesse'),
(4, 'Wirtschaft und Gesellschaft');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pruefung`
--

CREATE TABLE `pruefung` (
  `ID` int(11) NOT NULL,
  `Jahr` varchar(4) NOT NULL,
  `Halbjahr` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pruefung`
--

INSERT INTO `pruefung` (`ID`, `Jahr`, `Halbjahr`) VALUES
(1, '2017', 'Sommer'),
(2, '2016', 'Winter'),
(3, '2016', 'Sommer'),
(4, '2017', 'Sommer'),
(5, '2016', 'Winter'),
(6, '2016', 'Sommer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pruefungsteil`
--

CREATE TABLE `pruefungsteil` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pruefungsteil`
--

INSERT INTO `pruefungsteil` (`ID`, `Bezeichnung`) VALUES
(1, 'GA1'),
(2, 'GA2'),
(3, 'WISO');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thema`
--

CREATE TABLE `thema` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(50) NOT NULL,
  `Fach_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `thema`
--

INSERT INTO `thema` (`ID`, `Bezeichnung`, `Fach_ID`) VALUES
(1, 'Datenbanken', 1),
(2, 'Rechtsformen', 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `aufgabe`
--
ALTER TABLE `aufgabe`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Prüfungs_ID` (`Prüfungs_ID`,`Prüfungsteil_ID`,`Aufgabenart_ID`,`Thema_ID`),
  ADD KEY `aufgabe_ibfk_1` (`Aufgabenart_ID`),
  ADD KEY `aufgabe_ibfk_2` (`Prüfungsteil_ID`),
  ADD KEY `aufgabe_ibfk_4` (`Thema_ID`);

--
-- Indizes für die Tabelle `aufgabenart`
--
ALTER TABLE `aufgabenart`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `fach`
--
ALTER TABLE `fach`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `pruefung`
--
ALTER TABLE `pruefung`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `pruefungsteil`
--
ALTER TABLE `pruefungsteil`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `thema`
--
ALTER TABLE `thema`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Fach_ID` (`Fach_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `aufgabe`
--
ALTER TABLE `aufgabe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `aufgabenart`
--
ALTER TABLE `aufgabenart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `fach`
--
ALTER TABLE `fach`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `pruefung`
--
ALTER TABLE `pruefung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `pruefungsteil`
--
ALTER TABLE `pruefungsteil`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `thema`
--
ALTER TABLE `thema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `aufgabe`
--
ALTER TABLE `aufgabe`
  ADD CONSTRAINT `aufgabe_ibfk_1` FOREIGN KEY (`Aufgabenart_ID`) REFERENCES `aufgabenart` (`ID`),
  ADD CONSTRAINT `aufgabe_ibfk_2` FOREIGN KEY (`Prüfungsteil_ID`) REFERENCES `pruefungsteil` (`ID`),
  ADD CONSTRAINT `aufgabe_ibfk_3` FOREIGN KEY (`Prüfungs_ID`) REFERENCES `pruefung` (`ID`),
  ADD CONSTRAINT `aufgabe_ibfk_4` FOREIGN KEY (`Thema_ID`) REFERENCES `thema` (`ID`);

--
-- Constraints der Tabelle `thema`
--
ALTER TABLE `thema`
  ADD CONSTRAINT `thema_ibfk_1` FOREIGN KEY (`Fach_ID`) REFERENCES `fach` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
