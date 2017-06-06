-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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

-- Exportiere Daten aus Tabelle tekassensystem.angestellte: ~1 rows (ungef�hr)
DELETE FROM `angestellte`;
/*!40000 ALTER TABLE `angestellte` DISABLE KEYS */;
INSERT INTO `angestellte` (`id`, `fi_person`, `gehalt`, `rechte`, `passwort`) VALUES
	(1, 1, 0.00, 2, '7288edd0fc3ffcbe93a0cf06e3568e28521687bc');
/*!40000 ALTER TABLE `angestellte` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle tekassensystem.artikel
DROP TABLE IF EXISTS `artikel`;
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

-- Exportiere Daten aus Tabelle tekassensystem.artikel: ~8 rows (ungef�hr)
DELETE FROM `artikel`;
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
INSERT INTO `artikel` (`artikelnr`, `name`, `fi_kategorie`, `bestand`, `preis`) VALUES
	('0000000000010', '1,5 l Saskia Quellwasser', 'Getraenk', 1000, 0.19),
	('0123456789131', 'Mildes Weizenmischbrot', 'Nahrung', 100, 1.50),
	('0221510739120', '500g Packung Onkel Bens', 'Nahrung', 50, 3.50),
	('1001320013442', 'Gouda Jung 500g', 'Nahrung', 700, 1.30),
	('1212121212121', 'Taschenrechner', 'Elektronik', 5, 29.99),
	('1911199212121', 'Putzschwamm 6er Pack', 'Haushaltsware', 300, 4.99),
	('5000112546415', '1,25 l Coca Cola', 'Getraenk', 500, 1.79),
	('5555556675661', 'Scheuermittel Chemiekeule', 'Haushaltsware', 200, 9.00);
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle tekassensystem.art_kategorie
DROP TABLE IF EXISTS `art_kategorie`;
CREATE TABLE IF NOT EXISTS `art_kategorie` (
  `bezeichnung` varchar(40) NOT NULL,
  PRIMARY KEY (`bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.art_kategorie: ~4 rows (ungef�hr)
DELETE FROM `art_kategorie`;
/*!40000 ALTER TABLE `art_kategorie` DISABLE KEYS */;
INSERT INTO `art_kategorie` (`bezeichnung`) VALUES
	('Elektronik'),
	('Getraenk'),
	('Haushaltsware'),
	('Nahrung');
/*!40000 ALTER TABLE `art_kategorie` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle tekassensystem.bestellpositionen
DROP TABLE IF EXISTS `bestellpositionen`;
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

-- Exportiere Daten aus Tabelle tekassensystem.bestellpositionen: ~0 rows (ungef�hr)
DELETE FROM `bestellpositionen`;
/*!40000 ALTER TABLE `bestellpositionen` DISABLE KEYS */;
/*!40000 ALTER TABLE `bestellpositionen` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle tekassensystem.bestellung
DROP TABLE IF EXISTS `bestellung`;
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

-- Exportiere Daten aus Tabelle tekassensystem.bestellung: ~0 rows (ungef�hr)
DELETE FROM `bestellung`;
/*!40000 ALTER TABLE `bestellung` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.kunde: ~0 rows (ungef�hr)
DELETE FROM `kunde`;
/*!40000 ALTER TABLE `kunde` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle tekassensystem.person: ~2 rows (ungef�hr)
DELETE FROM `person`;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` (`id`, `name`, `vname`, `strasse`, `hausnr`, `plz`, `ort`, `tel`, `email`) VALUES
	(1, 'Testadmin', '', '', 0, 0, '', '0', ''),
	(2, 'Schmitz', 'Hans', 'Venloer Stra�e', 142, 50823, 'Koeln', '0', '');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
