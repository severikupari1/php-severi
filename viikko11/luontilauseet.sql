-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Palvelin: localhost
-- Luontiaika: 02.12.2011 klo 08:59
-- Palvelimen versio: 5.5.8
-- PHP:n versio: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Tietokanta: `asiakas`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `asiakas`
--

CREATE TABLE IF NOT EXISTS `asiakas` (
  `AVAIN` int(11) NOT NULL AUTO_INCREMENT,
  `NIMI` varchar(50) NOT NULL,
  `OSOITE` varchar(50) NOT NULL,
  `POSTINRO` varchar(5) NOT NULL,
  `POSTITMP` varchar(50) NOT NULL,
  `LUONTIPVM` date NOT NULL,
  `ASTY_AVAIN` int(11) NOT NULL,
  PRIMARY KEY (`AVAIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Vedos taulusta `asiakas`
--

INSERT INTO `asiakas` (`AVAIN`, `NIMI`, `OSOITE`, `POSTINRO`, `POSTITMP`, `LUONTIPVM`, `ASTY_AVAIN`) VALUES
(1, 'KALLE TAPPINEN', 'OPISTOTIE 2', '70100', 'KUOPIO', '2011-12-01', 1),
(2, 'VILLE VALLATON', 'MICROKATU 2', '70100', 'KUOPIO', '2011-12-03', 2);

-- --------------------------------------------------------

--
-- Rakenne taululle `asiakastyyppi`
--

CREATE TABLE IF NOT EXISTS `asiakastyyppi` (
  `AVAIN` int(11) NOT NULL AUTO_INCREMENT,
  `LYHENNE` varchar(10) NOT NULL,
  `SELITE` varchar(50) NOT NULL,
  PRIMARY KEY (`AVAIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Vedos taulusta `asiakastyyppi`
--

INSERT INTO `asiakastyyppi` (`AVAIN`, `LYHENNE`, `SELITE`) VALUES
(1, 'YA', 'YRITYSASIAKAS'),
(2, 'KA', 'KULUTTAJA ASIAKAS');
