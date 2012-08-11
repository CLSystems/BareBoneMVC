-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: node1.silverjet.nl
-- Generation Time: May 01, 2012 at 12:42 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `SIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_cabin`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_cabin` (
  `cabin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ship_id` mediumint(9) NOT NULL,
  `cabin_type_id` smallint(6) NOT NULL,
  `cabin_category_id` smallint(6) NOT NULL,
  PRIMARY KEY (`cabin_id`),
  KEY `ship_id` (`ship_id`),
  KEY `cabin_type_id` (`cabin_type_id`),
  KEY `cabin_category_id` (`cabin_category_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `framework__cruise_cabin`
--

INSERT INTO `framework__cruise_cabin` (`cabin_id`, `ship_id`, `cabin_type_id`, `cabin_category_id`) VALUES
(15, 1, 3, 10),
(12, 1, 1, 1),
(13, 1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_cabin_category`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_cabin_category` (
  `cabin_category_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cabin_category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`cabin_category_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `framework__cruise_cabin_category`
--

INSERT INTO `framework__cruise_cabin_category` (`cabin_category_id`, `cabin_category_name`) VALUES
(7, 'Cat. 7'),
(3, 'Cat. 3'),
(9, 'Cat. 9'),
(10, 'Cat. 10'),
(15, 'V2'),
(6, 'Cat. 6'),
(17, 'OW'),
(16, 'WG'),
(12, 'PH'),
(5, 'Cat. 5'),
(14, 'A1'),
(11, 'BC'),
(1, 'Cat. 1'),
(2, 'Cat. 2'),
(4, 'Cat. 4'),
(8, 'Cat. 8');

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_cabin_description`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_cabin_description` (
  `description_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cabin_id` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `active_from` date NOT NULL,
  `active_untill` date NOT NULL,
  PRIMARY KEY (`description_id`),
  KEY `active_from` (`active_from`),
  KEY `active_untill` (`active_untill`),
  KEY `cabin_id` (`cabin_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `framework__cruise_cabin_description`
--

INSERT INTO `framework__cruise_cabin_description` (`description_id`, `cabin_id`, `description`, `active_from`, `active_untill`) VALUES
(3, 13, '&lt;p&gt;\r\n	Veranda Suite (cat. 4-7) ca. 27 m2 + balkon 5 m2: gelijk&lt;br /&gt;\r\n	aan Suite maar met een balkon met zitje.&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31'),
(6, 15, '&lt;p&gt;\r\n	&lt;strong&gt;Spa Suite (cat. 10)&lt;/strong&gt; ca. 27 m&lt;sup&gt;2&lt;/sup&gt; + balkon 5 m&lt;sup&gt;2&lt;/sup&gt;: deze suites met een warme uitstraling zijn in Aziatische sfeer ingericht. Kosteloos heeft u de keuze uit diverse wellnessdrankjes van het speciale spa-menu, een ruim aanbod van&amp;nbsp; behandelingen in de Ocean Spa of comfortabel in uw eigen suite.&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31'),
(2, 12, '&lt;p&gt;\r\n	Suite (cat. 1-3) ca. 27 m2: luxe en ruime suite met groot&lt;br /&gt;\r\n	panoramaraam, zithoek, bureau, televisiesysteem,&lt;br /&gt;\r\n	minibar, walk-in closet en badkamer met bad en douche.&lt;br /&gt;\r\n	In alle hutten en suites is wifi beschikbaar.&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_cabin_type`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_cabin_type` (
  `cabin_type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cabin_type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`cabin_type_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `framework__cruise_cabin_type`
--

INSERT INTO `framework__cruise_cabin_type` (`cabin_type_id`, `cabin_type_name`) VALUES
(3, 'Spa Suite'),
(9, 'Verandah Suite'),
(10, 'Wintergarden Suite'),
(6, 'Buitenhut'),
(5, 'Penthouse Suite'),
(11, 'Owner Suite'),
(1, 'Suite'),
(2, 'Veranda Suite'),
(4, 'Buitenhut met balkon'),
(8, 'Seabourn Suite');

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_cruise`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_cruise` (
  `cruise_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `route_id` mediumint(9) NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` time NOT NULL,
  `date_arrival` date NOT NULL,
  `time_arrival` time NOT NULL,
  `flight` float(8,2) NOT NULL DEFAULT '0.00',
  `taxes` float(8,2) NOT NULL DEFAULT '0.00',
  `hotel` float(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`cruise_id`),
  KEY `route_id` (`route_id`),
  KEY `date_departure` (`date_departure`),
  KEY `date_arrival` (`date_arrival`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `framework__cruise_cruise`
--

INSERT INTO `framework__cruise_cruise` (`cruise_id`, `route_id`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `flight`, `taxes`, `hotel`) VALUES
(15, 16, '2012-08-05', '00:00:00', '2013-08-04', '10:00:00', 31.00, 422.71, 350.00),
(14, 17, '2012-03-21', '12:00:00', '2012-03-28', '10:00:00', 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_cruise_description`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_cruise_description` (
  `description_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cruise_id` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `active_from` date NOT NULL,
  `active_untill` date NOT NULL,
  PRIMARY KEY (`description_id`),
  KEY `active_from` (`active_from`),
  KEY `active_untill` (`active_untill`),
  KEY `cruise_id` (`cruise_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `framework__cruise_cruise_description`
--

INSERT INTO `framework__cruise_cruise_description` (`description_id`, `cruise_id`, `description`, `active_from`, `active_untill`) VALUES
(6, 15, '&lt;p&gt;\r\n	&lt;strong&gt;MS EUROPA&lt;/strong&gt;&lt;br /&gt;\r\n	Dubai - Dubai&lt;/p&gt;\r\n&lt;p&gt;\r\n	Een cruise met grote verschillen. Moderne&lt;br /&gt;\r\n	steden met een bijzondere architectuur&lt;br /&gt;\r\n	afgewisseld met de traditionele soek en nauwe&lt;br /&gt;\r\n	straatjes in de oude centra. In alle steden zijn er&lt;br /&gt;\r\n	uitgebreide winkelmogelijkheden. In Khasab&lt;br /&gt;\r\n	kunt u genieten van het spectaculaire&lt;br /&gt;\r\n	landschap, ruig gebergte met indrukwekkende&lt;br /&gt;\r\n	fjorden.&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;Wat is in-/exclusief:&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		Vliegreis van Amsterdam naar Dubai v.v. per KLM&lt;/li&gt;\r\n	&lt;li&gt;\r\n		2 overnachtingen in het 5* The Address Burj Dubai&lt;/li&gt;\r\n	&lt;li&gt;\r\n		o.b.v. 2 pers. incl. ontbijt&lt;/li&gt;\r\n	&lt;li&gt;\r\n		8-daagse cruise in een hut/suite van uw keuze&lt;/li&gt;\r\n	&lt;li&gt;\r\n		o.b.v. 2 pers. incl. volpension&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Luchthavenbelasting en havengelden&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Executive Lounge op Schiphol&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Priv&amp;eacute;transfers ter plaatse&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Fooien en excursies zijn niet inbegrepen&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;Hotel: The Address Burj Dubai *****&lt;/strong&gt;&lt;br /&gt;\r\n	The Address is een trendy designhotel, zeer fraai ingericht&lt;br /&gt;\r\n	in een modern eigentijdse stijl. Tegenover het&lt;br /&gt;\r\n	hotel staat de hoogste toren ter wereld, Burj Dubai en&lt;br /&gt;\r\n	naast het hotel ligt de indrukwekkende Dubai Mall.&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31'),
(2, 14, '&lt;p&gt;\r\n	Lekker bootje varen...&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_price`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_price` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cruise_id` mediumint(9) NOT NULL,
  `cabin_id` mediumint(9) NOT NULL,
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `own_commission` float(5,2) NOT NULL DEFAULT '15.00',
  `agent_commission` float(5,2) NOT NULL DEFAULT '11.00',
  PRIMARY KEY (`price_id`),
  KEY `cruise_id` (`cruise_id`),
  KEY `cabin_id` (`cabin_id`),
  KEY `price` (`price`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `framework__cruise_price`
--

INSERT INTO `framework__cruise_price` (`price_id`, `cruise_id`, `cabin_id`, `price`, `own_commission`, `agent_commission`) VALUES
(18, 14, 13, 12345, 15.00, 11.00),
(20, 15, 15, 0, 15.00, 11.00),
(21, 15, 12, 12345, 15.00, 11.00),
(22, 15, 13, 1253, 15.00, 11.00);

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_route`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_route` (
  `route_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ship_id` mediumint(9) NOT NULL,
  `route_title` varchar(200) NOT NULL,
  `port_departure` varchar(3) NOT NULL,
  `port_arrival` varchar(3) NOT NULL,
  `transfers` smallint(6) NOT NULL DEFAULT '0',
  `handling` smallint(6) NOT NULL DEFAULT '0',
  `harbours` tinyint(4) NOT NULL DEFAULT '0',
  `tax_harbours` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`route_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `framework__cruise_route`
--

INSERT INTO `framework__cruise_route` (`route_id`, `ship_id`, `route_title`, `port_departure`, `port_arrival`, `transfers`, `handling`, `harbours`, `tax_harbours`) VALUES
(17, 1, 'Istanbul - Nice', 'IST', 'NCE', 1234, 30, 10, 5),
(16, 1, 'Dubai - Dubai', 'DXB', 'DXB', 150, 30, 16, 8);

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_ship`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_ship` (
  `ship_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ship_number` mediumint(9) NOT NULL,
  `ship_name` varchar(200) NOT NULL,
  `shipping_company_id` smallint(6) NOT NULL,
  PRIMARY KEY (`ship_id`),
  KEY `shipping_company` (`shipping_company_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `framework__cruise_ship`
--

INSERT INTO `framework__cruise_ship` (`ship_id`, `ship_number`, `ship_name`, `shipping_company_id`) VALUES
(7, 1234, 'Seabourn Pride', 2),
(3, 1234, 'MS Bremen', 1),
(9, 1234, 'Seabourn Legend', 2),
(28, 890, 'MS Prinsendam', 8),
(43, 4444, 'River Cloud II', 16),
(10, 4321, 'Silver Spirit', 3),
(41, 333, 'Norwegian Jade', 15),
(18, 789, 'Queen Mary 2', 6),
(20, 789, 'Queen Elizabeth', 6),
(15, 456, 'Seadream II', 4),
(31, 111, 'Island Princess', 9),
(34, 111, 'Ruby Princess', 9),
(36, 111, 'Diamond Princess', 9),
(6, 1234, 'Seabourn Quest', 2),
(23, 567, 'Silhouette', 7),
(50, 555, 'Stella', 13),
(26, 890, 'MS Eurodam', 8),
(47, 555, 'Brava', 13),
(17, 987, 'Sea Cloud II', 5),
(29, 890, 'MS Amsterdam', 8),
(16, 987, 'Sea Cloud', 5),
(37, 222, 'Oasis of the Seas', 10),
(24, 567, 'Equinox', 7),
(35, 111, 'Sapphire Princess', 9),
(19, 789, 'Queen Victoria', 6),
(12, 4321, 'Silver Shadow', 3),
(5, 1234, 'Seabourn Sojourn', 2),
(27, 890, 'MS Nieuw Amsterdam', 8),
(32, 111, 'Caribbean Princess', 9),
(21, 567, 'Solstice', 7),
(22, 567, 'Eclipse', 7),
(39, 222, 'Adventure of the Seas', 10),
(14, 456, 'Seadream I', 4),
(11, 4321, 'Silver Whisper', 3),
(44, 555, 'Silva', 13),
(48, 555, 'Mia', 13),
(42, 333, 'Norwegian Jewel', 15),
(1, 1234, 'MS Europa', 1),
(13, 4321, 'Silver Wind', 3),
(25, 567, 'Xpedition', 7),
(40, 333, 'Norwegian Epic', 15),
(46, 555, 'Viva', 13),
(2, 1234, 'MS Hanseatic', 1),
(45, 555, 'Aqua', 13),
(38, 222, 'Navigator of the Seas', 10),
(30, 111, 'Coral Princess', 9),
(33, 111, 'Emerald Princess', 9),
(4, 1234, 'Seabourn Odyssey', 2),
(49, 555, 'Bella', 13),
(8, 1234, 'Seabourn Spirit', 2);

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_shipping_company`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_shipping_company` (
  `shipping_company_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_company_name` varchar(100) NOT NULL,
  `shipping_company_phone` varchar(30) NOT NULL,
  `shipping_company_address` varchar(200) NOT NULL,
  PRIMARY KEY (`shipping_company_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `framework__cruise_shipping_company`
--

INSERT INTO `framework__cruise_shipping_company` (`shipping_company_id`, `shipping_company_name`, `shipping_company_phone`, `shipping_company_address`) VALUES
(7, 'Celebrity Cruises', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(3, 'Silversea', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(9, 'Princess Cruises', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(10, 'Royal Caribbean International', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(15, 'Norwegian Cruise Line', '0123-456789', 'Straat 123\r\n1234 AA Stadje'),
(6, 'Cunard', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(16, 'River Cloud', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(5, 'Sea Cloud', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(1, 'Hapag-Lloyd Cruises', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(13, 'A-Rosa', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(2, 'Seabourn', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(4, 'Seadream', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje'),
(8, 'Holland America Line', '0123-456789', 'Straat 123\r\n1234 AA\r\nStadje');

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_shipping_company_description`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_shipping_company_description` (
  `description_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_company_id` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `active_from` date NOT NULL,
  `active_untill` date NOT NULL,
  PRIMARY KEY (`description_id`),
  KEY `shipping_company_id` (`shipping_company_id`),
  KEY `active_from` (`active_from`),
  KEY `active_untill` (`active_untill`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `framework__cruise_shipping_company_description`
--

INSERT INTO `framework__cruise_shipping_company_description` (`description_id`, `shipping_company_id`, `description`, `active_from`, `active_untill`) VALUES
(7, 16, '', '1970-01-01', '2099-12-31'),
(3, 9, '', '1970-01-01', '2099-12-31'),
(9, 1, '&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Hapag Lloyd Cruises is geboren uit de passie voor het cruisen en dat &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;merkt u! Ze laten uw dagelijkse zorgen met gemak even verdwijnen &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;zodat u volledig kunt genieten van wat de cruise u te bieden heeft.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;De rederij telt 4 unieke schepen met elk een eigen karakter. Het maakt &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;niet uit welk schip u kiest, ze hebben allemaal &amp;eacute;&amp;eacute;n ding gemeen en dat &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;is dat ze de beste in hun klasse zijn!&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Flexibiliteit en een enorme verscheidenheid zijn uitstekende eigenschappen &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;van Hapag-Lloyd Cruises. Deze Duitse rederij wordt ook wel &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;de ontdekker van de oceaan genoemd. Zij zoekt fascinerende vaargebieden &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;op zoals Antarctica, Zanzibar, West-Afrika en Zuid-Amerika. De &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;kwaliteit en service aan boord is uitmuntend.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Onder de vlag van &amp;lsquo;Expeditie kennis&amp;rsquo; zijn er cruises van deze rederij &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;naar klassieke bestemmingen zoals de Oostzee, de Atlantische kust, de &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Middellandse Zee of het Caribisch gebied aan boord van de Hanseatic &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;en Bremen, waarbij ook deze reizen omgezet worden in avonturen. &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Haal diep adem en duik in deze expedities op zoek naar verloren &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;beschavingen, zeldzame natuurlijke verschijnselen of exotische culinaire &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;ervaringen.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Tijdens deze &amp;lsquo;studiereizen&amp;rsquo; op zee stopt het niet bij de theorie, maar &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;zult u grotendeels in de praktijk ervaren en meer begrip krijgen voor &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;dat wat al zo bekend leek. U wordt begeleid door docenten en experts &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;die spannende lezingen aan boord van de Hanseatic en Bremen geven &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;en u voorbereiden op elke excursie aan land met uitgebreide achtergrond &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;informatie en alle tijd voor het beantwoorden van uw afzonderlijke &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;vragen. Aan land vergezellen bevoegde gidsen u trots door &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;kerken, paleizen en musea alsook naar afgelegen eilanden en nationale &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;parken.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Een klassieke cruise of expeditie, maatpak of recreatieve kleding - &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Hapag-Lloyd Cruises zijn altijd de reis waard!&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Niet voor niets zijn de expeditieschepen van Hapag Lloyd Cruises dan &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;ook geclassificeerd met 4*+ en 5*. De EUROPA, het mooiste jacht in &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;de wereld was weer het enige cruiseschip wereldwijd waaraan meer &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;dan 5* worden toegekend, een 5*+ schip! Het schip belooft unieke &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;cruises voor reizigers met hoge verwachtingen.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;Hapag Lloyd Cruises biedt d&amp;eacute; perfecte combinatie van individuele service, &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;exclusieve programma&amp;rsquo;s en een uitstekende keuken. Elk schip &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;binnen de vloot geeft een unieke sfeer aan de reizen en dat maakt een &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;cruise met Hapag Lloyd Cruises een niet meer uit te wissen levenservaring.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;3&quot;&gt;Waarom Hapag-Lloyd Cruises:&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; De MS EUROPA al 12 jaar het best geclassificeerde schip ter &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;wereld&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; De MS HANSEATIC het enige 5* expeditieschip met de zwaarste &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;ijsclasificatie (E4) voor passagiesschepen &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; Voortreffelijke maaltijden en service &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; Uitsluitend luxe hutten en suites&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; Unieke routes en havens&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; De MS HANSEATIC beschikt over 14 zodiacs om nog dichter &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;bij de natuur te komen.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&amp;bull; Expeditiereizen worden begeleid door de beste geleerden en &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;3&quot;&gt;wetenschappers&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31'),
(18, 13, '&lt;p&gt;\r\n	Test 1&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31'),
(6, 6, '', '1970-01-01', '2099-12-31'),
(12, 4, '', '1970-01-01', '2099-12-31'),
(5, 15, '', '1970-01-01', '2099-12-31'),
(11, 2, '', '1970-01-01', '2099-12-31'),
(1, 7, '', '1970-01-01', '2099-12-31'),
(13, 8, '', '1970-01-01', '2099-12-31'),
(2, 3, '', '1970-01-01', '2099-12-31'),
(4, 10, '', '1970-01-01', '2099-12-31'),
(8, 5, '', '1970-01-01', '2099-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `framework__cruise_ship_description`
--

CREATE TABLE IF NOT EXISTS `framework__cruise_ship_description` (
  `description_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ship_id` smallint(6) NOT NULL,
  `impression` text NOT NULL,
  `facilities` text NOT NULL,
  `boatdata` text NOT NULL,
  `active_from` date NOT NULL,
  `active_untill` date NOT NULL,
  PRIMARY KEY (`description_id`),
  KEY `active_from` (`active_from`),
  KEY `active_untill` (`active_untill`),
  KEY `ship_id` (`ship_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `framework__cruise_ship_description`
--

INSERT INTO `framework__cruise_ship_description` (`description_id`, `ship_id`, `impression`, `facilities`, `boatdata`, `active_from`, `active_untill`) VALUES
(7, 41, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(3, 9, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(9, 20, '&lt;p&gt;\r\n	Zeer mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(28, 27, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(43, 2, '&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Impressie&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Een cruise maken op de luxe MS HANSEATIC is &amp;lsquo;Once in a lifetime&amp;rsquo;. De eersteklas &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;service en de persoonlijke sfeer bieden de perfecte setting voor uw ervaringen. U &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;reist in het gezelschap van een ervaren bemanning en gerenommeerde docenten &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;met verbazingwekkende expertise. De MS HANSEATIC is &amp;eacute;&amp;eacute;n van de twee schepen &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;van Hapag Lloyd Cruises die de hoogste ijsklasse heeft. Dit wil zeggen dat het &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;schip ook in dicht ijs kan varen. Door de afmeting van het schip kunnen er bijzondere &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;bestemmingen aangedaan worden. Het kleine schip biedt ruimte aan 184 &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;passagiers en 122 bemanningsleden. Uw hut of suite is ruim en smaakvol ingericht.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Faciliteiten&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;De informele sfeer vindt u terug op het gehele schip. Voor ontbijt, lunch en diner &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;kunt naar het Marco Polo Restaurant. Hier worden verfijnde gerechten geserveerd. &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&amp;lsquo;s Avonds kunt u in de Poolbar of in de Observation Lounge genieten van een &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;drankje. Daarnaast heeft het schip een verwarmd zwembad, whirlpool en sauna. &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Tevens is er een fitnessruimte aan boord. In de Darwin Hall worden lezingen &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;gehouden die aansluiten op de route en de bestemmingen. U kunt onder begeleiding &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;van een van de experts met de zodiac op excursie.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Gegevens: &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;MS HANSEATIC&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Bouwjaar: 1993&lt;br /&gt;\r\n	Tonnage: 8.378&lt;br /&gt;\r\n	Lengte: 123 m&lt;br /&gt;\r\n	Breedte: 18 m&lt;br /&gt;\r\n	Passagiers: 184&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Bemanningsleden: 125&lt;br /&gt;\r\n	Snelheid: 16 knp&lt;br /&gt;\r\n	Restaurants: 2&lt;br /&gt;\r\n	Bars: 2&lt;br /&gt;\r\n	Zwembaden: 1&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Whirlpools: 1&lt;br /&gt;\r\n	Casino: 0&lt;br /&gt;\r\n	Winkeltjes: 1&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Suites&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Categorie 4 &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(Marco Polo Deck) ca. 22 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;panoramaraam, apart zitje, bureau, interactief &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;televisiesysteem, minibar, walk-in closet en badkamer &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;met bad en aparte douche. In&amp;nbsp; alle hutten en suites is &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Wi-Fi beschikbaar.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Categorie 3, 5 &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(Explorer Deck) ca. 22 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: deze hutten &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;zijn in 2011 geheel gerenoveerd en bieden u een luxe, &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;moderne en warme uitstraling. Als extra beschikken zij &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;over een kluisje.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Categorie 6 &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(Bridge Deck) ca. 22 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: als extra kunt &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;u gebruikmaken van de 24-uur butler service. &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Suite &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(Bridge Deck) ca. 44 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: deze ruime suites bieden &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;u ruime zithoek met prachtig uitzicht op de natuur &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;buiten. 24-uur butlerservice is uiteraard inbegrepen en &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;in de badkamer heeft u de beschikking over een seperate bad en douche.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(10, 15, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(41, 40, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(70, 39, '&lt;p&gt;\r\n	IMP 2&lt;/p&gt;\r\n', '&lt;p&gt;\r\n	Facs 2&lt;/p&gt;\r\n', '&lt;p&gt;\r\n	Geg 2&lt;/p&gt;\r\n', '2012-03-14', '2099-12-31'),
(18, 47, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(20, 29, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(15, 23, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(31, 22, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(34, 11, '&lt;p&gt;\r\n	Mooi bootje&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(36, 48, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(6, 10, '&lt;p&gt;\r\n	Mooie schuit&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(23, 24, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(50, 8, '&lt;p&gt;\r\n	Mooi schip&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(26, 12, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(35, 44, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(19, 17, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(12, 34, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(5, 43, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(27, 5, '&lt;p&gt;\r\n	Mooi bootje&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(21, 16, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(22, 37, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(39, 13, '&lt;p&gt;\r\n	Mooi bootje&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(14, 6, '&lt;p&gt;\r\n	Heel mooi bootje&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(11, 31, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(44, 45, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(48, 4, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(42, 46, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(1, 7, '&lt;p&gt;\r\n	Mooi schip&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(68, 1, '&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Dit fantastische schip is al 12 jaar achter elkaar bekroond tot het beste cruiseschip &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;ter wereld. Luxe, kwaliteit en comfort staan hoog in het vaandel. Dit kleine en &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;exclusieve schip biedt ruimte aan 408 passagiers en 280 bemanningsleden staan &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;voor u klaar. U verblijft in een luxe suite, waarvan vele een balkon hebben.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n', '&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;In Restaurant Dieter M&amp;uuml;ller kunt u uw smaakpapillen laten verwennen met de &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;verfijnde gerechten van deze meester-kok. In Restaurant Venezia wordt de mediterrane &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;keuken geserveerd. Daarnaast kunt u in Restaurant Europa terecht voor &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;ontbijt, lunch en diner. Verspreid over het schip zijn er meerdere sfeervolle bars. In &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Havana Bar waant u zich in Cuba waar u &amp;lsquo;s avonds kunt genieten van sigaren van &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;topkwaliteit en diverse likeuren. Wilt u in de avond genieten van de buitenlucht &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;dan kunt u buiten in de Poolbar of de Sansibar een drankje nemen. Het zwembad &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;en de whirlpool worden bij een lagere temperatuur overdekt door de magrodome. &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;In het fitnesscentrum worden verschillende programma&amp;rsquo;s aangeboden. Wilt u een &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;persoonlijk trainer dan behoort dit tot de mogelijkheden. In de Ocean Spa kunt u &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;lekker ontspannen in &amp;eacute;&amp;eacute;n van de sauna&amp;rsquo;s of gebruik maken van het uitgebreide &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;aanbod van behandelingen. Daarnaast kunt u golflessen nemen met behulp van &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;de golfsimulator en golfleraar.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n', '&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Bouwjaar: 1999&lt;br /&gt;\r\n	Tonnage: 28.890&lt;br /&gt;\r\n	Lengte: 199 m&lt;br /&gt;\r\n	Breedte: 24 m&lt;br /&gt;\r\n	Passagiers: 408&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Bemanningsleden: 280&lt;br /&gt;\r\n	Snelheid: 21 knp&lt;br /&gt;\r\n	Restaurants: 4&lt;br /&gt;\r\n	Bars: 6&lt;br /&gt;\r\n	Zwembaden: 1&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Whirlpools: 1&lt;br /&gt;\r\n	Casino: 0&lt;br /&gt;\r\n	Winkeltjes: 2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n', '1970-01-01', '2099-12-31'),
(13, 36, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(25, 19, '&lt;p&gt;\r\n	Zeer mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(40, 25, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(47, 33, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(17, 26, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(29, 32, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(16, 50, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(37, 42, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(69, 39, '&lt;p&gt;\r\n	IMP 1&lt;/p&gt;\r\n', '&lt;p&gt;\r\n	Facs 1&lt;/p&gt;\r\n', '&lt;p&gt;\r\n	Gegevens 1&lt;/p&gt;\r\n', '1970-01-01', '2012-03-13'),
(24, 35, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(46, 30, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(2, 3, '&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Impressie&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;De MS BREMEN is door haar kleine formaat zeer flexibel en wendbaar en heeft de &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;mogelijkheid om op plaatsen te komen, waar andere schepen hiertoe niet in staat &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;zijn. Naast&amp;nbsp; de MS HANSEATIC heeft dit schip klasse E4 van ijsdichtheid en kan &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;daardoor door ijsgebieden varen. De zeer ervaren bemanning en sprekers zullen &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;uw verblijf aan boord onvergetelijk maken. Het schip biedt plaats aan 164 passagiers &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;en 100 bemanningsleden. De ruime hutten en suites zijn luxueus ingericht.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Faciliteiten&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;De MS BREMEN kenmerkt zich door de informele en persoonlijke sfeer. In de Panorama &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Lounge kunt u deelnemen aan &amp;eacute;&amp;eacute;n van de vele lezingen die door de experts &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;gegeven worden. In het restaurant kunt u genieten van de smaakvolle gerechten &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;tijdens ontbijt, lunch en diner. Bij mooi weer kunt u zelfs buiten op het Lido Deck &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;ontbijten en genieten van het indrukwekkende uitzicht. The Club biedt u de mogelijkheid &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;om te ontbijten of te lunchen, aan het einde van de dag kunt u genieten &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;van een drankje en muziek. Verder zijn er wifi, internet, een fitnessruimte, sauna &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;en verwarmbaar zwembad aan boord.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Gegevens: &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;MS BREMEN&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Bouwjaar: 1990&lt;br /&gt;\r\n	Tonnage: 6.752&lt;br /&gt;\r\n	Lengte: 111 m&lt;br /&gt;\r\n	Breedte: 17 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Passagiers: 164&lt;br /&gt;\r\n	Bemanningsleden: 100&lt;br /&gt;\r\n	Snelheid: 15 knp&lt;br /&gt;\r\n	Restaurants: 1&lt;br /&gt;\r\n	Bars: 2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;br /&gt;\r\n	&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;Zwembaden: 1&lt;br /&gt;\r\n	Whirlpools: 0&lt;br /&gt;\r\n	Casino: 0&lt;br /&gt;\r\n	Winkeltjes: 1&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#11175f&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Hutten &amp;amp; Suites&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Buitenhut &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(cat. 2 -5) ca. 18 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: panoramaraam, apart &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;zitje, bureau, televisie met dvd-speler, radio, telefoon, &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;minibar, kluisje, badkamer met douche en toilet.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Buitenhut met balkon &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(cat. 6) ca. 18 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2 &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;+ balkon 5 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;naast de faciliteiten van de voorgaande buitenhut, &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;beschikken de hutten op dek 6 over een balkon met zitje.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&lt;b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-BoldCn&quot; size=&quot;2&quot;&gt;Suite &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/b&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;(cat. 7) ca. 24 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2 &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;+ balkon 6 m&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;1&quot;&gt;2&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;: &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;naast de faciliteiten van de voorgaande hutten, zijn de &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;suites ruimer qua afmeting en beschikken zij tevens over &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;&lt;font color=&quot;#414142&quot; face=&quot;FrutigerLTStd-Cn&quot; size=&quot;2&quot;&gt;een zithoekje en badkamer met ligbad.&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\r\n&lt;p align=&quot;LEFT&quot;&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(45, 38, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(30, 21, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(33, 14, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(4, 28, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(49, 49, '&lt;p&gt;\r\n	Mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31'),
(8, 18, '&lt;p&gt;\r\n	Zeer mooie boot&lt;/p&gt;\r\n', '', '', '1970-01-01', '2099-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `framework__language`
--

CREATE TABLE IF NOT EXISTS `framework__language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `directory` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `filename` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`language_id`),
  KEY `name` (`name`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `framework__language`
--

INSERT INTO `framework__language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `filename`, `sort_order`, `status`) VALUES
(1, 'Nederlands', 'nl', 'nl_NL.UTF-8,nl_NL', 'nl.png', 'dutch', 'dutch', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `framework__setting`
--

CREATE TABLE IF NOT EXISTS `framework__setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `key` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `value` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24358 ;

--
-- Dumping data for table `framework__setting`
--

INSERT INTO `framework__setting` (`setting_id`, `group`, `key`, `value`, `serialized`) VALUES
(24299, 'config', 'config_tax', '1', 0),
(24355, 'config', 'config_google_analytics', '', 0),
(24336, 'config', 'config_image_cart_height', '80', 0),
(24308, 'config', 'config_affiliate_id', '0', 0),
(24325, 'config', 'config_image_product_width', '80', 0),
(24327, 'config', 'config_image_additional_width', '74', 0),
(24322, 'config', 'config_image_thumb_height', '228', 0),
(24292, 'config', 'config_telephone', '123456789', 0),
(24288, 'config', 'config_name', 'SilverJet IntraNet', 0),
(24342, 'config', 'config_smtp_port', '25', 0),
(24334, 'config', 'config_image_wishlist_height', '50', 0),
(24354, 'config', 'config_error_filename', 'error.txt', 0),
(24340, 'config', 'config_smtp_username', '', 0),
(24293, 'config', 'config_fax', '', 0),
(24317, 'config', 'config_logo', 'data/logo.png', 0),
(24315, 'config', 'config_upload_allowed', 'jpg, JPG, jpeg, gif, png, txt', 0),
(24347, 'config', 'config_use_ssl', '0', 0),
(24339, 'config', 'config_smtp_host', '', 0),
(24305, 'config', 'config_guest_checkout', '1', 0),
(24319, 'config', 'config_image_category_width', '80', 0),
(24312, 'config', 'config_stock_checkout', '0', 0),
(24331, 'config', 'config_image_compare_width', '90', 0),
(24314, 'config', 'config_download', '1', 0),
(24326, 'config', 'config_image_product_height', '80', 0),
(24296, 'config', 'config_currency_auto', '0', 0),
(24357, 'config', 'config_admin_language', 'nl', 0),
(24341, 'config', 'config_smtp_password', '', 0),
(24350, 'config', 'config_encryption', '12345', 0),
(24313, 'config', 'config_review_status', '1', 0),
(24301, 'config', 'config_tax_customer', 'shipping', 0),
(24330, 'config', 'config_image_related_height', '80', 0),
(24332, 'config', 'config_image_compare_height', '90', 0),
(24335, 'config', 'config_image_cart_width', '80', 0),
(24349, 'config', 'config_maintenance', '0', 0),
(24351, 'config', 'config_compression', '0', 0),
(24295, 'config', 'config_meta_description', 'Travel in Style', 0),
(24346, 'config', 'config_alert_emails', '', 0),
(24303, 'config', 'config_customer_price', '0', 0),
(24290, 'config', 'config_address', 'Address 1', 0),
(24345, 'config', 'config_account_mail', '0', 0),
(24348, 'config', 'config_seo_url', '0', 0),
(24309, 'config', 'config_commission', '5', 0),
(24316, 'config', 'config_cart_weight', '1', 0),
(24298, 'config', 'config_admin_limit', '20', 0),
(24302, 'config', 'config_invoice_prefix', 'INV-2011-00', 0),
(24304, 'config', 'config_customer_approval', '0', 0),
(24310, 'config', 'config_stock_display', '0', 0),
(24291, 'config', 'config_email', 'jeroen@silverjet.nl', 0),
(24356, 'config', 'config_admin_language', 'nl', 0),
(24321, 'config', 'config_image_thumb_width', '228', 0),
(24324, 'config', 'config_image_popup_height', '500', 0),
(24297, 'config', 'config_catalog_limit', '15', 0),
(24328, 'config', 'config_image_additional_height', '74', 0),
(24289, 'config', 'config_owner', 'SilverJet', 0),
(24353, 'config', 'config_error_log', '1', 0),
(24323, 'config', 'config_image_popup_width', '500', 0),
(24306, 'config', 'config_account_id', '0', 0),
(24333, 'config', 'config_image_wishlist_width', '50', 0),
(24318, 'config', 'config_icon', 'data/cart.png', 0),
(24320, 'config', 'config_image_category_height', '80', 0),
(24311, 'config', 'config_stock_warning', '0', 0),
(24294, 'config', 'config_title', 'SilverJet IntraNet', 0),
(24343, 'config', 'config_smtp_timeout', '5', 0),
(24344, 'config', 'config_alert_mail', '0', 0),
(24352, 'config', 'config_error_display', '1', 0),
(24338, 'config', 'config_mail_parameter', '', 0),
(24300, 'config', 'config_tax_default', 'shipping', 0),
(24329, 'config', 'config_image_related_width', '80', 0),
(24337, 'config', 'config_mail_protocol', 'mail', 0),
(24307, 'config', 'config_checkout_id', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `framework__user`
--

CREATE TABLE IF NOT EXISTS `framework__user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `firstname` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lastname` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(96) COLLATE utf8_bin NOT NULL DEFAULT '',
  `code` varchar(32) COLLATE utf8_bin NOT NULL,
  `ip` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `framework__user`
--

INSERT INTO `framework__user` (`user_id`, `user_group_id`, `username`, `password`, `firstname`, `lastname`, `email`, `code`, `ip`, `status`, `date_added`) VALUES
(3, 11, 'cruiseverkoper', 'cb873f296c8f578b70bdfc61fd7ed7e7', 'Cruise', 'Verkoper', 'jeroen@silverjet.nl', '', '192.165.10.79', 1, '2012-03-14 10:16:22'),
(5, 1, 'alex', 'cb873f296c8f578b70bdfc61fd7ed7e7', 'Alexander', 'Presman', 'alex@silverjet.nl', '', '', 1, '2012-03-15 11:02:50'),
(1, 1, 'admin', '0d760969fea0f4977517a7276250c7ec', 'Admin', 'Istrator', 'j.guyt@silverjet.nl', '831d5b849495031932e6637d76331c93', '192.165.10.79', 1, '1973-08-06 00:00:00'),
(2, 10, 'tester', '098f6bcd4621d373cade4e832627b4f6', 'T.', 'Ester', 'jeroen@silverjet.nl', '', '192.165.10.79', 1, '2012-03-13 16:48:24'),
(4, 12, 'cruisesupervisor', 'cb873f296c8f578b70bdfc61fd7ed7e7', 'Cruise', 'Supervisor', 'jeroen@silverjet.nl', '', '192.165.10.79', 1, '2012-03-14 12:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `framework__user_group`
--

CREATE TABLE IF NOT EXISTS `framework__user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `permission` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `framework__user_group`
--

INSERT INTO `framework__user_group` (`user_group_id`, `name`, `permission`) VALUES
(10, 'Demonstration', 'a:2:{s:6:"access";a:11:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:12:"cruise/cabin";i:3;s:20:"cruise/cabincategory";i:4;s:16:"cruise/cabintype";i:5;s:13:"cruise/cruise";i:6;s:12:"cruise/price";i:7;s:12:"cruise/route";i:8;s:11:"cruise/ship";i:9;s:22:"cruise/shippingcompany";i:10;s:18:"common/filemanager";}s:6:"modify";a:1:{i:0;s:18:"common/filemanager";}}'),
(12, 'Cruises Supervisor', 'a:2:{s:6:"access";a:11:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:12:"cruise/cabin";i:3;s:20:"cruise/cabincategory";i:4;s:16:"cruise/cabintype";i:5;s:13:"cruise/cruise";i:6;s:12:"cruise/price";i:7;s:12:"cruise/route";i:8;s:11:"cruise/ship";i:9;s:22:"cruise/shippingcompany";i:10;s:18:"common/filemanager";}s:6:"modify";a:11:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:12:"cruise/cabin";i:3;s:20:"cruise/cabincategory";i:4;s:16:"cruise/cabintype";i:5;s:13:"cruise/cruise";i:6;s:12:"cruise/price";i:7;s:12:"cruise/route";i:8;s:11:"cruise/ship";i:9;s:22:"cruise/shippingcompany";i:10;s:18:"common/filemanager";}}'),
(11, 'Cruises Verkoop', 'a:2:{s:6:"access";a:11:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:12:"cruise/cabin";i:3;s:20:"cruise/cabincategory";i:4;s:16:"cruise/cabintype";i:5;s:13:"cruise/cruise";i:6;s:12:"cruise/price";i:7;s:12:"cruise/route";i:8;s:11:"cruise/ship";i:9;s:22:"cruise/shippingcompany";i:10;s:18:"common/filemanager";}s:6:"modify";a:3:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:18:"common/filemanager";}}'),
(1, 'Top Administrator', 'a:2:{s:6:"access";a:28:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:12:"cruise/cabin";i:3;s:20:"cruise/cabincategory";i:4;s:16:"cruise/cabintype";i:5;s:13:"cruise/cruise";i:6;s:12:"cruise/price";i:7;s:12:"cruise/route";i:8;s:11:"cruise/ship";i:9;s:22:"cruise/shippingcompany";i:10;s:15:"setting/setting";i:11;s:11:"tool/backup";i:12;s:14:"tool/error_log";i:13;s:9:"user/user";i:14;s:16:"user/user_groups";i:15;s:11:"vis/aroutes";i:16;s:11:"vis/bprices";i:17;s:15:"vis/bpricescopy";i:18;s:20:"vis/destinationready";i:19;s:9:"vis/letop";i:20;s:9:"vis/taxes";i:21;s:11:"vis/xoffers";i:22;s:15:"vis/zaltclasses";i:23;s:13:"vis/zaltmeals";i:24;s:13:"vis/zaltseats";i:25;s:17:"vis/zdiscountbaby";i:26;s:17:"vis/zdiscountkind";i:27;s:18:"common/filemanager";}s:6:"modify";a:28:{i:0;s:18:"cruise/aplanbydate";i:1;s:25:"cruise/aplanbydestination";i:2;s:12:"cruise/cabin";i:3;s:20:"cruise/cabincategory";i:4;s:16:"cruise/cabintype";i:5;s:13:"cruise/cruise";i:6;s:12:"cruise/price";i:7;s:12:"cruise/route";i:8;s:11:"cruise/ship";i:9;s:22:"cruise/shippingcompany";i:10;s:15:"setting/setting";i:11;s:11:"tool/backup";i:12;s:14:"tool/error_log";i:13;s:9:"user/user";i:14;s:16:"user/user_groups";i:15;s:11:"vis/aroutes";i:16;s:11:"vis/bprices";i:17;s:15:"vis/bpricescopy";i:18;s:20:"vis/destinationready";i:19;s:9:"vis/letop";i:20;s:9:"vis/taxes";i:21;s:11:"vis/xoffers";i:22;s:15:"vis/zaltclasses";i:23;s:13:"vis/zaltmeals";i:24;s:13:"vis/zaltseats";i:25;s:17:"vis/zdiscountbaby";i:26;s:17:"vis/zdiscountkind";i:27;s:18:"common/filemanager";}}');

-- --------------------------------------------------------

--
-- Table structure for table `framework__vis_discount_baby`
--

CREATE TABLE IF NOT EXISTS `framework__vis_discount_baby` (
  `discount_baby_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`discount_baby_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `framework__vis_discount_baby`
--

INSERT INTO `framework__vis_discount_baby` (`discount_baby_id`, `title`, `sort_order`) VALUES
(5, '90%', 50),
(11, 'CRS RATE', 90),
(1, '0%', 10),
(2, '10%', 20),
(4, '80%', 40),
(7, 'EUR 30', 70),
(3, '25%', 30),
(9, 'EUR 50', 80),
(6, '100%', 60);

-- --------------------------------------------------------

--
-- Table structure for table `framework__vis_discount_kind`
--

CREATE TABLE IF NOT EXISTS `framework__vis_discount_kind` (
  `discount_kind_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`discount_kind_id`)
) ENGINE=ndbcluster  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `framework__vis_discount_kind`
--

INSERT INTO `framework__vis_discount_kind` (`discount_kind_id`, `title`, `sort_order`) VALUES
(7, 'CRS RATE', 70),
(3, '25%', 30),
(6, 'EUR 20', 60),
(5, '50%', 50),
(1, '0%', 10),
(2, '20%', 20),
(4, '33%', 40);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
