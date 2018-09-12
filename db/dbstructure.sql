-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: wp454.webpack.hosteurope.de
-- Erstellungszeit: 13. Sep 2018 um 13:15
-- Server Version: 5.6.37
-- PHP-Version: 5.4.45-0+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 1;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db12892893-eigenentwicklung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wwbt_coaches`
--

CREATE TABLE IF NOT EXISTS `wwbt_coaches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `wwbt_coaches`
--

INSERT INTO `wwbt_coaches` (`id`, `name`) VALUES
(1, 'Johann Wolfgang von Goethe'),
(2, 'Alexander der Große');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wwbt_groups`
--

CREATE TABLE IF NOT EXISTS `wwbt_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `wwbt_groups`
--

INSERT INTO `wwbt_groups` (`id`, `name`) VALUES
(3, 'Müggelsee-Piraten'),
(4, 'Blutige Anfänger');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wwbt_participantcounts`
--

CREATE TABLE IF NOT EXISTS `wwbt_participantcounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `trainingdate` date NOT NULL,
  `coach_id` int(11) NOT NULL,
  `male_under_18` int(11) NOT NULL,
  `female_under_18` int(11) NOT NULL,
  `female_over_18` int(11) NOT NULL,
  `male_over_18` int(11) NOT NULL,
  `submitted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (group_id) REFERENCES wwbt_groups(id),
  FOREIGN KEY (coach_id) REFERENCES wwbt_coaches(id),
  UNIQUE KEY `idx_unique_group_trainingdate` (`group_id`,`trainingdate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `wwbt_participantcounts`
--

INSERT INTO `wwbt_participantcounts` (`id`, `group_id`, `trainingdate`, `coach_id`, `male_under_18`, `female_under_18`, `female_over_18`, `male_over_18`, `submitted_at`) VALUES
(1, 3, '2018-09-13', 1, 12, 11, 3, 0, '2018-09-20 14:13:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wwbt_useragentstats`
--

CREATE TABLE IF NOT EXISTS `wwbt_useragentstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yearmonth` int(11) NOT NULL,
  `useragent` text NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `wwbt_useragentstats`
--

INSERT INTO `wwbt_useragentstats` (`id`, `yearmonth`, `useragent`, `count`) VALUES
(1, 201001, 'Test-Useragent', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
