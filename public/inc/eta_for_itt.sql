-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 02:12 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eta_for_itt`
--

-- --------------------------------------------------------

--
-- Table structure for table `aufgabe`
--

CREATE TABLE `aufgabe` (
  `ID` int(11) NOT NULL,
  `Nummer` varchar(10) NOT NULL,
  `Pruefungs_ID` int(11) NOT NULL,
  `Pruefungsteil_ID` int(11) NOT NULL,
  `Aufgabenart_ID` int(11) NOT NULL,
  `Thema_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aufgabe`
--

INSERT INTO `aufgabe` (`ID`, `Nummer`, `Pruefungs_ID`, `Pruefungsteil_ID`, `Aufgabenart_ID`, `Thema_ID`) VALUES
(1, '1. a)', 1, 1, 6, 3),
(2, '1. b)', 1, 1, 1, 3),
(4, '1.', 1, 2, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `aufgabenart`
--

CREATE TABLE `aufgabenart` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aufgabenart`
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
-- Table structure for table `fach`
--

CREATE TABLE `fach` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fach`
--

INSERT INTO `fach` (`ID`, `Bezeichnung`) VALUES
(1, 'Anwendungsentwicklung'),
(2, 'IT-Systeme'),
(3, 'Organisation und Geschäftsprozesse'),
(4, 'Wirtschaft und Gesellschaft');

-- --------------------------------------------------------

--
-- Table structure for table `pruefung`
--

CREATE TABLE `pruefung` (
  `ID` int(11) NOT NULL,
  `Jahr` varchar(4) NOT NULL,
  `Halbjahr` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pruefung`
--

INSERT INTO `pruefung` (`ID`, `Jahr`, `Halbjahr`) VALUES
(1, '2017', 'Sommer'),
(2, '2016', 'Winter'),
(3, '2016', 'Sommer');

-- --------------------------------------------------------

--
-- Table structure for table `pruefungsteil`
--

CREATE TABLE `pruefungsteil` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pruefungsteil`
--

INSERT INTO `pruefungsteil` (`ID`, `Bezeichnung`) VALUES
(1, 'GA1'),
(2, 'GA2'),
(3, 'WISO');

-- --------------------------------------------------------

--
-- Table structure for table `thema`
--

CREATE TABLE `thema` (
  `ID` int(11) NOT NULL,
  `Bezeichnung` varchar(50) NOT NULL,
  `Fach_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thema`
--

INSERT INTO `thema` (`ID`, `Bezeichnung`, `Fach_ID`) VALUES
(1, 'Datenbanken', 1),
(2, 'Rechtsformen', 3),
(3, 'UML', 1),
(4, 'Arbeitsprozesse', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aufgabe`
--
ALTER TABLE `aufgabe`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Prüfungs_ID` (`Pruefungs_ID`,`Pruefungsteil_ID`,`Aufgabenart_ID`,`Thema_ID`),
  ADD KEY `aufgabe_ibfk_1` (`Aufgabenart_ID`),
  ADD KEY `aufgabe_ibfk_2` (`Pruefungsteil_ID`),
  ADD KEY `aufgabe_ibfk_4` (`Thema_ID`);

--
-- Indexes for table `aufgabenart`
--
ALTER TABLE `aufgabenart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `fach`
--
ALTER TABLE `fach`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pruefung`
--
ALTER TABLE `pruefung`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pruefungsteil`
--
ALTER TABLE `pruefungsteil`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `thema`
--
ALTER TABLE `thema`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Fach_ID` (`Fach_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aufgabe`
--
ALTER TABLE `aufgabe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aufgabenart`
--
ALTER TABLE `aufgabenart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fach`
--
ALTER TABLE `fach`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pruefung`
--
ALTER TABLE `pruefung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pruefungsteil`
--
ALTER TABLE `pruefungsteil`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thema`
--
ALTER TABLE `thema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aufgabe`
--
ALTER TABLE `aufgabe`
  ADD CONSTRAINT `aufgabe_ibfk_1` FOREIGN KEY (`Aufgabenart_ID`) REFERENCES `aufgabenart` (`ID`),
  ADD CONSTRAINT `aufgabe_ibfk_2` FOREIGN KEY (`Pruefungsteil_ID`) REFERENCES `pruefungsteil` (`ID`),
  ADD CONSTRAINT `aufgabe_ibfk_3` FOREIGN KEY (`Pruefungs_ID`) REFERENCES `pruefung` (`ID`),
  ADD CONSTRAINT `aufgabe_ibfk_4` FOREIGN KEY (`Thema_ID`) REFERENCES `thema` (`ID`);

--
-- Constraints for table `thema`
--
ALTER TABLE `thema`
  ADD CONSTRAINT `thema_ibfk_1` FOREIGN KEY (`Fach_ID`) REFERENCES `fach` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
