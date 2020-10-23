-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.1.36-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win32
-- HeidiSQL Versione:            9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database tecweb
CREATE DATABASE IF NOT EXISTS `tecweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tecweb`;

-- Dump della struttura di tabella tecweb.articoli
CREATE TABLE IF NOT EXISTS `articoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testo` text NOT NULL,
  `titolo` varchar(40) NOT NULL DEFAULT '0',
  `descrizione` varchar(60) NOT NULL DEFAULT '0',
  `tipo` varchar(2) NOT NULL DEFAULT '0',
  `dataPubblicazione` date DEFAULT NULL,
  `dataScadenza` date DEFAULT NULL,
  `prezzo` varchar(25) NOT NULL DEFAULT '0',
  `immagine` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella tecweb.utenti
CREATE TABLE IF NOT EXISTS `utenti` (
  `idUtente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT '0',
  `cognome` varchar(50) DEFAULT '0',
  `telefono` varchar(50) DEFAULT '0',
  `password` varchar(50) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  PRIMARY KEY (`idUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- L’esportazione dei dati non era selezionata.
INSERT INTO `utenti` (`idUtente`, `nome`, `cognome`, `telefono`, `password`, `email`) VALUES
(1, 'admin', 'admin', '', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com');
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
