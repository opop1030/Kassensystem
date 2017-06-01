-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------
-- Ich habe mal das Script was aufpoliert, da ich kleine Fehler entdeckt hatte.
-- Liebe Grüße gez. Andy

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

use tekassensystem;

-- Exportiere Struktur von Tabelle tekassensystem.angestellte
CREATE TABLE IF NOT EXISTS `angestellte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fi_person` int(11) NOT NULL,
  `gehalt` decimal(9,2) DEFAULT '0.00',
  `rechte` int(11) DEFAULT '0',
  `passwort` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_angestellte_fk` (`fi_person`),
  CONSTRAINT `person_angestellte_fk` FOREIGN KEY (`fi_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle tekassensystem.artikel
CREATE TABLE IF NOT EXISTS `artikel` (
  `artikelnr` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `fi_kategorie` varchar(40) NOT NULL,
  `bestand` int(11) DEFAULT '0',
  `preis` decimal(9,2) NOT NULL,
  PRIMARY KEY (`artikelnr`),
  KEY `art_kat_fk` (`fi_kategorie`),
  CONSTRAINT `art_kat_fk` FOREIGN KEY (`fi_kategorie`) REFERENCES `art_kategorie` (`bezeichnung`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle tekassensystem.art_kategorie
CREATE TABLE IF NOT EXISTS `art_kategorie` (
  `bezeichnung` varchar(40) NOT NULL,
  PRIMARY KEY (`bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle tekassensystem.bestellpositionen
CREATE TABLE IF NOT EXISTS `bestellpositionen` (
  `id_fi_bestellung` int(11) NOT NULL,
  `id_fi_artikel` varchar(16) NOT NULL,
  `menge` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fi_bestellung`,`id_fi_artikel`),
  KEY `bp_art_fk` (`id_fi_artikel`),
  KEY `bp_bestell_fk` (`id_fi_bestellung`),
  CONSTRAINT `bp_art_fk` FOREIGN KEY (`id_fi_artikel`) REFERENCES `artikel` (`artikelnr`) ON UPDATE CASCADE,
  CONSTRAINT `bp_bestellung_fk` FOREIGN KEY (`id_fi_bestellung`) REFERENCES `bestellung` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle tekassensystem.bestellung
CREATE TABLE IF NOT EXISTS `bestellung` (
  `id` int(11) NOT NULL,
  `fi_kunde` int(11) NOT NULL,
  `fi_angestellter` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `best_kunde_fk` (`fi_kunde`),
  KEY `best_ang_fk` (`fi_angestellter`),
  CONSTRAINT `best_ang_fk` FOREIGN KEY (`fi_angestellter`) REFERENCES `angestellte` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `best_kunde_fk` FOREIGN KEY (`fi_kunde`) REFERENCES `kunde` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle tekassensystem.kunde
CREATE TABLE IF NOT EXISTS `kunde` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fi_person` int(11) NOT NULL,
  `umsatz` decimal(9,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `person_kunde_fk` (`fi_person`),
  CONSTRAINT `person_kunde_fk` FOREIGN KEY (`fi_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle tekassensystem.person
CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `vname` varchar(40) NOT NULL,
  `strasse` varchar(40) NOT NULL,
  `hausnr` decimal(38,0) NOT NULL,
  `plz` decimal(38,0) NOT NULL,
  `ort` varchar(40) NOT NULL,
  `tel` decimal(38,0) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
