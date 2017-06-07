-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Datenbank Struktur für tekassensystem
CREATE DATABASE IF NOT EXISTS `tekassensystem` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tekassensystem`;


-- Exportiere Struktur von Tabelle tekassensystem.angestellte
DROP TABLE IF EXISTS `angestellte`;
CREATE TABLE IF NOT EXISTS `angestellte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fi_person` int(11) NOT NULL,
  `gehalt` decimal(9,2) DEFAULT '0.00',
  `rechte` int(11) DEFAULT '0',
  `passwort` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_angestellte_fk` (`fi_person`),
  CONSTRAINT `person_angestellte_fk` FOREIGN KEY (`fi_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.angestellte: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `angestellte` DISABLE KEYS */;
INSERT INTO `angestellte` (`id`, `fi_person`, `gehalt`, `rechte`, `passwort`) VALUES
  (1, 1, 0.00, 2, '7288edd0fc3ffcbe93a0cf06e3568e28521687bc');
/*!40000 ALTER TABLE `angestellte` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle tekassensystem.artikel
DROP TABLE IF EXISTS `artikel`;
CREATE TABLE IF NOT EXISTS `artikel` (
  `artikelnr` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `bestand` int(11) DEFAULT '0',
  `preis` decimal(9,2) NOT NULL,
  PRIMARY KEY (`artikelnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.artikel: ~8 rows (ungefähr)
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
INSERT INTO `artikel` (`artikelnr`, `name`, `bestand`, `preis`) VALUES
  ('0000000000010', '1,5 l Saskia Quellwasser', 997, 0.19),
  ('0123456789131', 'Mildes Weizenmischbrot', 100, 1.50),
  ('0221510739120', '500g Packung Onkel Bens', 49, 3.50),
  ('1001320013442', 'Gouda Jung 500g', 698, 1.30),
  ('1212121212121', 'Taschenrechner', 5, 29.99),
  ('1911199212121', 'Putzschwamm 6er Pack', 300, 4.99),
  ('5000112546415', '1,25 l Coca Cola', 499, 1.79),
  ('5555556675661', 'Scheuermittel Chemiekeule', 200, 9.00);
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle tekassensystem.bestellpositionen
DROP TABLE IF EXISTS `bestellpositionen`;
CREATE TABLE IF NOT EXISTS `bestellpositionen` (
  `id_fi_bestellung` int(11) NOT NULL,
  `id_fi_artikel` varchar(16) NOT NULL,
  `menge` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fi_bestellung`,`id_fi_artikel`),
  KEY `bp_art_fk` (`id_fi_artikel`),
  KEY `bp_bestell_fk` (`id_fi_bestellung`),
  CONSTRAINT `bp_artikel_fk` FOREIGN KEY (`id_fi_artikel`) REFERENCES `artikel` (`artikelnr`) ON UPDATE CASCADE,
  CONSTRAINT `bp_bestellung_fk` FOREIGN KEY (`id_fi_bestellung`) REFERENCES `bestellung` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.bestellpositionen: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `bestellpositionen` DISABLE KEYS */;
INSERT INTO `bestellpositionen` (`id_fi_bestellung`, `id_fi_artikel`, `menge`) VALUES
  (7, '0000000000010', 2),
  (8, '0221510739120', 1),
  (8, '1001320013442', 2),
  (8, '5000112546415', 1);
/*!40000 ALTER TABLE `bestellpositionen` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle tekassensystem.bestellung
DROP TABLE IF EXISTS `bestellung`;
CREATE TABLE IF NOT EXISTS `bestellung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fi_kunde` int(11) NOT NULL,
  `fi_angestellter` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `best_kunde_fk` (`fi_kunde`),
  KEY `best_ang_fk` (`fi_angestellter`),
  CONSTRAINT `best_ang_fk` FOREIGN KEY (`fi_angestellter`) REFERENCES `angestellte` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `best_kunde_fk` FOREIGN KEY (`fi_kunde`) REFERENCES `kunde` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.bestellung: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `bestellung` DISABLE KEYS */;
INSERT INTO `bestellung` (`id`, `fi_kunde`, `fi_angestellter`, `datum`) VALUES
  (7, 1, 1, '2017-06-07 17:26:42'),
  (8, 1, 1, '2017-06-07 17:28:05');
/*!40000 ALTER TABLE `bestellung` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle tekassensystem.kunde
DROP TABLE IF EXISTS `kunde`;
CREATE TABLE IF NOT EXISTS `kunde` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fi_person` int(11) NOT NULL,
  `umsatz` decimal(9,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `person_kunde_fk` (`fi_person`),
  CONSTRAINT `person_kunde_fk` FOREIGN KEY (`fi_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.kunde: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `kunde` DISABLE KEYS */;
INSERT INTO `kunde` (`id`, `fi_person`, `umsatz`) VALUES
  (1, 2, 0.00),
  (2, 3, 0.00);
/*!40000 ALTER TABLE `kunde` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle tekassensystem.person
DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `vname` varchar(40) NOT NULL,
  `strasse` varchar(40) NOT NULL,
  `hausnr` int(11) NOT NULL,
  `plz` int(11) NOT NULL,
  `ort` varchar(40) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.person: ~3 rows (ungefähr)
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` (`id`, `name`, `vname`, `strasse`, `hausnr`, `plz`, `ort`, `tel`, `email`) VALUES
  (1, 'Testadmin', '', '', 0, 0, '', '0', ''),
  (2, 'Schmitz', 'Hans', 'Venloer Straße', 142, 50823, 'Koeln', '0', ''),
  (3, 'Henriks', 'Harald', 'Schwedik Weg', 12, 27732, '', '', '');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
