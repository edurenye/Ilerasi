-- phpMyAdmin SQL Dump
-- version 3.4.10.2deb1.maverick~ppa.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 25-05-2012 a les 02:12:26
-- Versió del servidor: 5.1.61
-- Versió de PHP : 5.3.3-1ubuntu9.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `ilerasi`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nom` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cognoms` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefon` int(11) DEFAULT NULL,
  `pais` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciutat` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `client`
--

INSERT INTO `client` (`dni`, `nom`, `cognoms`, `user`, `password`, `email`, `telefon`, `pais`, `ciutat`) VALUES
('12345678S', 'Pepito', 'Pepito Perez', 'pepito', 'pepito', 'pepito@hotmail.com', 649782168, 'Espanya', 'Barcelona'),
('45687946C', 'Maria', 'Sole Sans', 'maria', 'maria', 'maria@hotmail.com', 816798428, 'FranÃ§a', 'Perpinya'),
('45689512C', 'Maria', 'Antonia Percebe', 'maria', 'maria', 'maria@gmail.com', 152689456, 'Catalunya', 'Tarragona'),
('48625975A', 'Josep', 'Pepet Menguanet', 'josep', 'josep', 'josep@gmail.com', 842851856, 'Catalunya', 'Barcelona'),
('58486575D', 'Marta', 'Marteta Marteta', 'marta', 'marta', 'marta@gmail.com', 795163713, 'Catalunya', 'Lleida'),
('Jordi', 'Jordi', 'Jordi', 'jordi', 'jordi', 'jordi@gmail.com', 845632546, 'Catalunya', 'Girona');

-- --------------------------------------------------------

--
-- Estructura de la taula `conferencia`
--

CREATE TABLE IF NOT EXISTS `conferencia` (
  `id_conferencia` int(11) NOT NULL AUTO_INCREMENT,
  `ponent` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `data` datetime DEFAULT NULL,
  `durada` time DEFAULT NULL,
  `tema` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `responsable` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_conferencia`),
  KEY `responsable` (`responsable`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `conferencia`
--

INSERT INTO `conferencia` (`id_conferencia`, `ponent`, `data`, `durada`, `tema`, `responsable`) VALUES
(1, 'Eduard', '2012-05-31 00:00:00', '00:00:00', 'Software lliure', '12345678S'),
(2, 'Miquel', '2012-06-22 00:00:00', '00:00:30', 'PHP', '12345678S'),
(3, 'Carles', '2012-06-22 00:00:00', '00:01:20', 'El canvi climatic', '12345678S'),
(4, 'Judith', '2012-05-30 00:00:00', '00:00:00', 'Andorra', '12345678S');

-- --------------------------------------------------------

--
-- Estructura de la taula `consumeix`
--

CREATE TABLE IF NOT EXISTS `consumeix` (
  `id_consumeix` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_consumeix`),
  KEY `id_menu` (`id_menu`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Bolcant dades de la taula `consumeix`
--

INSERT INTO `consumeix` (`id_consumeix`, `data`, `id_menu`, `id_factura`) VALUES
(2, '2012-05-24 16:52:26', 1, 3),
(3, '2012-05-24 17:02:59', 3, 3),
(4, '2012-05-24 17:03:09', 2, 3),
(5, '2012-05-24 17:03:19', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `contracte`
--

CREATE TABLE IF NOT EXISTS `contracte` (
  `id_contracte` int(11) NOT NULL AUTO_INCREMENT,
  `indefinit` tinyint(1) DEFAULT NULL,
  `data_inici` datetime DEFAULT NULL,
  `data_fi` datetime DEFAULT NULL,
  `complement` int(11) DEFAULT NULL,
  `antiguitat` int(11) DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_contracte`),
  KEY `dni` (`dni`),
  KEY `id_tipus` (`id_tipus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `contracte`
--

INSERT INTO `contracte` (`id_contracte`, `indefinit`, `data_inici`, `data_fi`, `complement`, `antiguitat`, `dni`, `id_tipus`) VALUES
(1, 1, '2010-08-01 00:00:00', NULL, 1000, 500, '12345678A', 1),
(2, 1, '2010-09-01 00:00:00', NULL, 500, 200, '51648597D', 3),
(3, 1, '2008-09-01 00:00:00', NULL, 100, 200, '84658459N', 4),
(4, NULL, '2011-05-01 00:00:00', '2012-09-30 00:00:00', 0, 0, '84695746K', 2);

-- --------------------------------------------------------

--
-- Estructura de la taula `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `id_reserva` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_reserva` (`id_reserva`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Bolcant dades de la taula `factura`
--

INSERT INTO `factura` (`id_factura`, `total`, `id_reserva`) VALUES
(3, 1060, 10),
(4, NULL, 11),
(5, NULL, 12),
(6, NULL, 13);

-- --------------------------------------------------------

--
-- Estructura de la taula `habitacio`
--

CREATE TABLE IF NOT EXISTS `habitacio` (
  `id_reserva` int(11) NOT NULL DEFAULT '0',
  `numero` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_reserva`,`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `habitacio`
--

INSERT INTO `habitacio` (`id_reserva`, `numero`) VALUES
(10, 19),
(11, 2),
(11, 4),
(12, 7),
(13, 3),
(13, 8),
(13, 23),
(13, 26);

-- --------------------------------------------------------

--
-- Estructura de la taula `massatge`
--

CREATE TABLE IF NOT EXISTS `massatge` (
  `id_massatge` int(11) NOT NULL AUTO_INCREMENT,
  `tipus` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sala` int(11) DEFAULT NULL,
  `responsable` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `preu` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_massatge`),
  KEY `responsable` (`responsable`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `massatge`
--

INSERT INTO `massatge` (`id_massatge`, `tipus`, `sala`, `responsable`, `preu`, `data`, `id_factura`) VALUES
(1, 'coll', 2, '84658459N', 60, '2012-05-24 17:12:05', 3),
(2, 'lumbar', 4, '84658459N', 80, '2012-05-24 17:12:48', 3),
(3, 'cames', 1, '84658459N', 60, '2012-05-24 17:13:12', 3),
(4, 'esquena', 5, '84658459N', 90, '2012-05-24 17:13:38', 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `aliment` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `preu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `menu`
--

INSERT INTO `menu` (`id_menu`, `aliment`, `preu`) VALUES
(1, 'carn', 20),
(2, 'pizza', 10),
(3, 'mariscada', 50),
(4, 'espagetis', 15);

-- --------------------------------------------------------

--
-- Estructura de la taula `productes`
--

CREATE TABLE IF NOT EXISTS `productes` (
  `id_producte` int(11) NOT NULL AUTO_INCREMENT,
  `aliment` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `preu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producte`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Bolcant dades de la taula `productes`
--

INSERT INTO `productes` (`id_producte`, `aliment`, `preu`) VALUES
(5, 'cola', 1),
(6, 'pepsi', 1),
(7, 'cacauets', 2),
(8, 'aigua', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `num_adults` int(11) DEFAULT NULL,
  `num_nens` int(11) DEFAULT NULL,
  `data_entrada` datetime DEFAULT NULL,
  `data_sortida` datetime DEFAULT NULL,
  `num_habitacions` int(11) DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `preu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Bolcant dades de la taula `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `num_adults`, `num_nens`, `data_entrada`, `data_sortida`, `num_habitacions`, `dni`, `preu`) VALUES
(10, 2, 1, '2012-05-23 00:00:00', '2012-05-31 00:00:00', 1, '12345678S', 560),
(11, 4, 2, '2012-06-14 00:00:00', '2012-06-28 00:00:00', 2, '12345678S', 2080),
(12, 2, 1, '2012-08-10 00:00:00', '2012-08-17 00:00:00', 1, '12345678S', 480),
(13, 8, 4, '2012-09-01 00:00:00', '2012-09-06 00:00:00', 4, '12345678S', 1280);

-- --------------------------------------------------------

--
-- Estructura de la taula `spa`
--

CREATE TABLE IF NOT EXISTS `spa` (
  `id_spa` int(11) NOT NULL AUTO_INCREMENT,
  `durada` time DEFAULT NULL,
  `preu` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_spa`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `spa`
--

INSERT INTO `spa` (`id_spa`, `durada`, `preu`, `data`, `id_factura`) VALUES
(1, '00:00:30', 26, '2012-05-24 16:26:58', 3),
(2, '00:00:45', 39, '2012-05-24 17:02:27', 3),
(3, '00:00:20', 17, '2012-05-24 17:02:38', 3),
(4, '00:00:30', 26, '2012-05-24 17:02:48', 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `tipus`
--

CREATE TABLE IF NOT EXISTS `tipus` (
  `id_tipus` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `salari` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `tipus`
--

INSERT INTO `tipus` (`id_tipus`, `descripcio`, `salari`) VALUES
(1, 'director general', 5000),
(2, 'netejador', 1000),
(3, 'recepcionista', 2000),
(4, 'massatgista', 2000);

-- --------------------------------------------------------

--
-- Estructura de la taula `treballador`
--

CREATE TABLE IF NOT EXISTS `treballador` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `user` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nom` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cognoms` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_ss` int(12) DEFAULT NULL,
  `telefon` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciutat` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `edat` int(2) DEFAULT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `treballador`
--

INSERT INTO `treballador` (`dni`, `user`, `password`, `nom`, `cognoms`, `num_ss`, `telefon`, `email`, `ciutat`, `edat`) VALUES
('12345678A', 'eduard', 'eduard', 'Eduard', 'Renye Claramunt', 2147483647, 654856659, 'edurenye@localhost.com', 'Arbeca', 20),
('51648597D', 'julia', 'julia', 'Julia', 'Julia Julia', 2147483647, 465987258, 'julia@gmail.com', 'Lleida', 26),
('84658459N', 'worker', 'worker', 'Worker', 'Worker', 2147483647, 2147483647, 'worker@gmail.com', 'Andorra', 30),
('84695746K', 'jordi', 'jordi', 'Jordi', 'Jordi Jordi', 2147483647, 456852673, 'jordi@gmail.com', 'Girona', 35);

-- --------------------------------------------------------

--
-- Estructura de la taula `usa`
--

CREATE TABLE IF NOT EXISTS `usa` (
  `id_usa` int(11) NOT NULL AUTO_INCREMENT,
  `quantitat` int(11) DEFAULT NULL,
  `id_producte` int(11) DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usa`),
  KEY `id_producte` (`id_producte`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `usa`
--

INSERT INTO `usa` (`id_usa`, `quantitat`, `id_producte`, `id_factura`) VALUES
(1, 2, 5, 3),
(2, 1, 6, 3),
(3, 1, 7, 3),
(4, 2, 8, 3);

--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `conferencia`
--
ALTER TABLE `conferencia`
  ADD CONSTRAINT `conferencia_ibfk_1` FOREIGN KEY (`responsable`) REFERENCES `client` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `consumeix`
--
ALTER TABLE `consumeix`
  ADD CONSTRAINT `consumeix_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consumeix_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `contracte`
--
ALTER TABLE `contracte`
  ADD CONSTRAINT `contracte_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `treballador` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contracte_ibfk_2` FOREIGN KEY (`id_tipus`) REFERENCES `tipus` (`id_tipus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `habitacio`
--
ALTER TABLE `habitacio`
  ADD CONSTRAINT `habitacio_ibfk_2` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `massatge`
--
ALTER TABLE `massatge`
  ADD CONSTRAINT `massatge_ibfk_1` FOREIGN KEY (`responsable`) REFERENCES `treballador` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `massatge_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `client` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `spa`
--
ALTER TABLE `spa`
  ADD CONSTRAINT `spa_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `usa`
--
ALTER TABLE `usa`
  ADD CONSTRAINT `usa_ibfk_1` FOREIGN KEY (`id_producte`) REFERENCES `productes` (`id_producte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usa_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
