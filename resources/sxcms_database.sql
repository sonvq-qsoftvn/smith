-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 03 mei 2013 om 14:34
-- Serverversie: 5.1.61
-- PHP-Versie: 5.3.10-pl0-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2013_11_sxcms_default`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Brands`
--

CREATE TABLE IF NOT EXISTS `Brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `picture` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Gegevens worden uitgevoerd voor tabel `Brands`
--

INSERT INTO `Brands` (`id`, `date_created`, `date_updated`, `picture`, `place`, `active`) VALUES
(32, '2012-07-30 14:22:58', '0000-00-00 00:00:00', 'saintroch_1343651164.jpg', 7, 1),
(33, '2012-07-30 14:23:15', '0000-00-00 00:00:00', 'stelrad_1343651181.jpg', 4, 1),
(5, '2012-02-23 15:44:05', '0000-00-00 00:00:00', '002_1330008244.jpg', 4, 1),
(6, '2012-02-23 15:44:40', '0000-00-00 00:00:00', '002_1330008280.jpg', 4, 1),
(7, '2012-02-23 15:44:52', '0000-00-00 00:00:00', '002_1330008292.jpg', 4, 1),
(29, '2012-07-30 14:22:02', '0000-00-00 00:00:00', 'honeywell_1343651108.jpg', 3, 1),
(30, '2012-07-30 14:22:23', '0000-00-00 00:00:00', 'ithodaalderop_1343651128.jpg', 6, 1),
(31, '2012-07-30 14:22:42', '2013-01-14 09:38:52', 'pneumatex_1343651147.jpg', 1, 1),
(28, '2012-07-30 14:21:45', '0000-00-00 00:00:00', 'eurosun_1343651091.jpg', 5, 1),
(27, '2012-07-30 14:21:30', '0000-00-00 00:00:00', 'electrooil_1343651075.jpg', 2, 1),
(26, '2012-07-30 14:20:24', '0000-00-00 00:00:00', 'acv_1343651008.jpg', 9, 1),
(34, '2012-07-30 14:23:32', '0000-00-00 00:00:00', 'tempolec_1343651198.jpg', 8, 1),
(39, '2013-01-14 12:23:33', '0000-00-00 00:00:00', 'euroscoop-1349793832_1358162613.jpg', 10, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `BrandsTsl`
--

CREATE TABLE IF NOT EXISTS `BrandsTsl` (
  `e_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `BrandsTsl`
--

INSERT INTO `BrandsTsl` (`e_id`, `lng`, `url`, `title`, `subtitle`) VALUES
(28, 'nl', '', 'Eurosun', 'Eurosun'),
(28, 'fr', '', 'Eurosun', 'Eurosun'),
(28, 'en', '', 'Eurosun', 'Eurosun'),
(29, 'nl', '', 'Honeywell', 'Honeywell'),
(29, 'fr', '', 'Honeywell', 'Honeywell'),
(29, 'en', '', 'Honeywell', 'Honeywell'),
(30, 'nl', '', 'Itho Daalderop', 'Itho Daalderop'),
(30, 'fr', '', 'Itho Daalderop', 'Itho Daalderop'),
(30, 'en', '', 'Itho Daalderop', 'Itho Daalderop'),
(31, 'nl', '', 'Pneumatex', 'Pneumatex'),
(31, 'fr', '', 'Pneumatex', 'Pneumatex'),
(31, 'en', '', 'Pneumatex', 'Pneumatex'),
(32, 'nl', '', 'Saint Roch', 'Saint Roch'),
(32, 'fr', '', 'Saint Roch', 'Saint Roch'),
(32, 'en', '', 'Saint Roch', 'Saint Roch'),
(33, 'nl', '', 'Stelrad', 'Stelrad'),
(33, 'fr', '', 'Stelrad', 'Stelrad'),
(33, 'en', '', 'Stelrad', 'Stelrad'),
(34, 'nl', '', 'Tempolec', 'Tempolec'),
(34, 'fr', '', 'Tempolec', 'Tempolec'),
(34, 'en', '', 'Tempolec', 'Tempolec'),
(27, 'en', '', 'Electro Oil', 'Electro Oil'),
(27, 'fr', '', 'Electro Oil', 'Electro Oil'),
(27, 'nl', '', 'Electro Oil', 'Electro Oil'),
(26, 'nl', '', 'ACV', 'ACV'),
(26, 'fr', '', 'ACV', 'ACV'),
(26, 'en', '', 'ACV', 'ACV'),
(39, 'nl', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Cases`
--

CREATE TABLE IF NOT EXISTS `Cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Gegevens worden uitgevoerd voor tabel `Cases`
--

INSERT INTO `Cases` (`id`, `place`, `active`, `file`, `date_created`, `date_updated`) VALUES
(5, 4, 1, 'tulips_1357825466.jpg', '2012-10-09 10:54:37', '2013-01-10 14:44:27'),
(6, 1, 1, 'uz-1349772932_1357901228.jpg', '2012-10-09 10:55:32', '2013-01-11 11:47:08'),
(8, 2, 1, 'velinx_1349772977.jpg', '2012-10-09 10:56:17', '0000-00-00 00:00:00'),
(9, 3, 1, 'akzo_1349773020.jpg', '2012-10-09 10:57:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `CasesPictures`
--

CREATE TABLE IF NOT EXISTS `CasesPictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `copyright_website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Gegevens worden uitgevoerd voor tabel `CasesPictures`
--

INSERT INTO `CasesPictures` (`picture_id`, `album_id`, `file`, `place`, `copyright`, `copyright_website`) VALUES
(1, 6, 'bc21ebe81a4434c5e4242c527cf54c30.jpg', 1, '', ''),
(2, 15, 'd30f5db70a3589907a93f42bcbb7b72c.jpg', 1, '', ''),
(3, 15, 'a4598d55d680027640406b0858bc677e.jpg', 2, '', ''),
(4, 15, '68a0648b430f229e0143989f3cae0df0.jpg', 3, '', ''),
(6, 17, 'ec46f018928301ee2fee35bdf4d6df05.jpg', 1, '', ''),
(7, 17, 'ab8631a6067b5a6f2e0b35449c075382.jpg', 2, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `CasesPicturesTsl`
--

CREATE TABLE IF NOT EXISTS `CasesPicturesTsl` (
  `picture_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `CasesPicturesTsl`
--

INSERT INTO `CasesPicturesTsl` (`picture_id`, `text`, `language`) VALUES
(1, '', 'nl'),
(1, '', 'fr'),
(1, '', 'en'),
(2, '', 'nl'),
(2, '', 'fr'),
(2, '', 'en'),
(3, '', 'nl'),
(3, '', 'fr'),
(3, '', 'en'),
(4, '', 'nl'),
(4, '', 'fr'),
(4, '', 'en'),
(5, '', 'nl'),
(5, '', 'fr'),
(5, '', 'en'),
(6, '', 'nl'),
(6, '', 'fr'),
(6, '', 'en'),
(7, '', 'nl'),
(7, '', 'fr'),
(7, '', 'en');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `CasesTsl`
--

CREATE TABLE IF NOT EXISTS `CasesTsl` (
  `p_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `CasesTsl`
--

INSERT INTO `CasesTsl` (`p_id`, `lng`, `title`, `text`) VALUES
(5, 'nl', 'ZARA - Hasselt', '<p>Kleding winkel</p>'),
(5, 'fr', 'ZARA - Hasselt', '<p>Kleding winkel</p>'),
(6, 'nl', 'UZ Leuven', '<p>Ziekenhuis</p>'),
(6, 'fr', 'UZ Leuven', '<p>Ziekenhuis</p>'),
(8, 'nl', 'De Velinx', '<p>Cultureel centrum</p>'),
(8, 'fr', 'De Velinx', '<p>Cultureel centrum</p>'),
(9, 'nl', 'Akzo Nobel - Vilvoorde', '<p>Kantoorgebouw</p>'),
(9, 'fr', 'Akzo Nobel - Vilvoorde', '<p>Kantoorgebouw</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `CategoryTsl`
--

CREATE TABLE IF NOT EXISTS `CategoryTsl` (
  `category_id` int(10) unsigned NOT NULL,
  `language` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ContentBlocks`
--

CREATE TABLE IF NOT EXISTS `ContentBlocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blockname` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ContentBlocksTsl`
--

CREATE TABLE IF NOT EXISTS `ContentBlocksTsl` (
  `tsl_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`tsl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_allow` tinyint(1) DEFAULT '1',
  `subscription_max` tinyint(1) NOT NULL,
  `notify_email` varchar(255) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `datetime_event` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `remember_days` int(3) DEFAULT '0',
  `confirmation_link` tinyint(1) DEFAULT '1',
  `validate_intern` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventField`
--

CREATE TABLE IF NOT EXISTS `EventField` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `language` varchar(3) NOT NULL,
  `label` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `type` enum('text','select','checkbox','radio','textarea') NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventFieldList`
--

CREATE TABLE IF NOT EXISTS `EventFieldList` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_field_id` int(11) NOT NULL,
  `label` varchar(55) NOT NULL,
  `value` varchar(55) NOT NULL,
  PRIMARY KEY (`list_id`),
  UNIQUE KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `from` date NOT NULL,
  `till` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `Events`
--

INSERT INTO `Events` (`id`, `date_created`, `date_updated`, `from`, `till`) VALUES
(1, '2012-09-18 19:03:57', '2013-01-09 16:13:26', '2012-09-18', '2012-09-19'),
(2, '2012-09-19 11:55:08', '0000-00-00 00:00:00', '2012-09-19', '2012-09-22');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventSettings`
--

CREATE TABLE IF NOT EXISTS `EventSettings` (
  `variable` varchar(20) NOT NULL,
  `value` text,
  `language` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Gegevens worden uitgevoerd voor tabel `EventSettings`
--

INSERT INTO `EventSettings` (`variable`, `value`, `language`) VALUES
('mailRemember', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>dit is de default herinneringsmail (nederlands)</p>', 'nl'),
('mailRemember', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>dit is de default herinneringsmail (frans)</p>', 'fr'),
('mailConfirmation', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>Dit is de default bevestingsmail (nederlands)</p>', 'nl'),
('mailConfirmation', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>dit is de default bevestiginsmail (frans)</p>', 'fr');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventsTsl`
--

CREATE TABLE IF NOT EXISTS `EventsTsl` (
  `e_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `EventsTsl`
--

INSERT INTO `EventsTsl` (`e_id`, `lng`, `active`, `title`, `content`) VALUES
(1, 'nl', 1, 'Dit is een test event', '<h1>Dit is een test event</h1>\r\n<p>bla bla bla</p>'),
(1, 'fr', 1, 'Dit is een test event FR', '<h1>Dit is een test event</h1>\r\n<p>bla bla bla</p>'),
(1, 'en', 1, 'Dit is een test event', '<h1>Dit is een test event</h1>\r\n<p>bla bla bla</p>'),
(1, 'de', 1, 'Dit is een test event', '<h1>Dit is een test event</h1>\r\n<p>bla bla bla</p>'),
(2, 'nl', 1, 'Dit is een 2e event', '<p>Dit is een 2e test</p>'),
(2, 'fr', 1, 'Dit is een 2e event', '<p>Dit is een 2e test</p>'),
(2, 'en', 1, 'Dit is een 2e event', '<p>Dit is een 2e test</p>'),
(2, 'de', 1, 'Dit is een 2e event', '<p>Dit is een 2e test</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventSubscription`
--

CREATE TABLE IF NOT EXISTS `EventSubscription` (
  `event_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL COMMENT '0=waiting,1=approved,2=rejected',
  PRIMARY KEY (`subscription_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventSubscriptionField`
--

CREATE TABLE IF NOT EXISTS `EventSubscriptionField` (
  `subscription_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventTsl`
--

CREATE TABLE IF NOT EXISTS `EventTsl` (
  `event_id` int(11) NOT NULL,
  `language` varchar(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mail_remember` text,
  `mail_confirmation` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Eyecatchers`
--

CREATE TABLE IF NOT EXISTS `Eyecatchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `picture` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `Eyecatchers`
--

INSERT INTO `Eyecatchers` (`id`, `date_created`, `date_updated`, `picture`, `place`, `active`) VALUES
(1, '2013-04-15 14:12:27', '0000-00-00 00:00:00', 'chrysanthemum_1366027947.jpg', 0, 1),
(2, '2013-04-15 14:12:52', '0000-00-00 00:00:00', 'chrysanthemum_1366027971.jpg', 0, 1),
(3, '2013-04-15 14:15:11', '0000-00-00 00:00:00', 'chrysanthemum_1366028111.jpg', 0, 1),
(7, '2013-04-19 15:13:05', '2013-04-19 15:16:03', 'jellyfish_1366377185.jpg', 0, 1),
(8, '2013-04-19 15:16:13', '0000-00-00 00:00:00', 'koala_1366377373.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EyecatchersTsl`
--

CREATE TABLE IF NOT EXISTS `EyecatchersTsl` (
  `tsl_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  PRIMARY KEY (`tsl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `EyecatchersTsl`
--

INSERT INTO `EyecatchersTsl` (`tsl_id`, `e_id`, `lng`, `url`, `title`, `subtitle`) VALUES
(14, 8, 'fr', 'test', 'test', 'test'),
(11, 7, 'fr', 'test123.comtest', 'test', 'test'),
(12, 7, 'en', 'test123.comtest', 'test', 'test'),
(13, 8, 'nl', 'test', 'test', 'test'),
(10, 7, 'nl', 'test123.comtest', 'test', 'test'),
(15, 8, 'en', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Faq`
--

CREATE TABLE IF NOT EXISTS `Faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentID` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `Faq`
--

INSERT INTO `Faq` (`id`, `parentID`, `position`, `active`, `date_created`, `date_updated`) VALUES
(1, 4, 2, 1, '2012-12-06 11:33:30', '0000-00-00 00:00:00'),
(2, 4, 1, 0, '2012-12-06 11:35:31', '2013-04-19 14:49:24'),
(3, 4, 3, 1, '2012-12-06 11:35:43', '0000-00-00 00:00:00'),
(4, 6, 1, 1, '2012-12-11 14:45:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `FaqCategory`
--

CREATE TABLE IF NOT EXISTS `FaqCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `FaqCategory`
--

INSERT INTO `FaqCategory` (`id`, `position`, `active`, `picture`, `date_created`, `date_updated`) VALUES
(1, 6, 1, 'subscription.png', '2012-12-06 11:11:37', '0000-00-00 00:00:00'),
(2, 3, 1, 'events.png', '2012-12-06 11:13:39', '0000-00-00 00:00:00'),
(3, 1, 1, 'merchandising.png', '2012-12-06 11:13:54', '0000-00-00 00:00:00'),
(4, 2, 1, 'problem-orders.png', '2012-12-06 11:14:10', '2013-04-19 14:54:20'),
(5, 4, 1, 'riders.png', '2012-12-06 11:14:30', '0000-00-00 00:00:00'),
(6, 5, 1, 'material.png', '2012-12-06 11:14:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `FaqCategoryTsl`
--

CREATE TABLE IF NOT EXISTS `FaqCategoryTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `FaqCategoryTsl`
--

INSERT INTO `FaqCategoryTsl` (`id`, `c_id`, `lng`, `title`, `url`) VALUES
(1, 1, 'nl', 'Subscription', 'subscription'),
(2, 1, 'en', 'Subscription', 'subscription'),
(3, 2, 'nl', 'Events', 'events'),
(4, 2, 'en', 'Events', 'events'),
(5, 3, 'nl', 'Merchandising', 'merchandising'),
(6, 3, 'en', 'Merchandising', 'merchandising'),
(7, 4, 'nl', 'Problem with orderstest', 'problem-with-orderstest'),
(8, 4, 'en', 'Problem with orders', 'problem-with-orders'),
(9, 5, 'nl', 'Rider/staff soliciation', 'rider/staff-soliciation'),
(10, 5, 'en', 'Rider/staff soliciation', 'rider/staff-soliciation'),
(11, 6, 'nl', 'Material', 'material'),
(12, 6, 'en', 'Material', 'material');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `FaqTsl`
--

CREATE TABLE IF NOT EXISTS `FaqTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `FaqTsl`
--

INSERT INTO `FaqTsl` (`id`, `f_id`, `lng`, `question`, `answer`) VALUES
(1, 1, 'nl', 'What is the delivery time?', '<p>After payment the order is sent within the week.</p>'),
(2, 1, 'en', 'What is the delivery time?', '<p>After payment the order is sent within the week.</p>'),
(3, 2, 'nl', 'Who can we contact if the ordered items are not yet arrived?', '<p>Contact: <a href="mailto:info@decolef.com">info@decolef.com</a></p>'),
(4, 2, 'en', 'Who can we contact if the ordered items are not yet arrived?', '<p>Contact: <a href="mailto:info@decolef.com">info@decolef.com</a></p>'),
(5, 3, 'nl', 'What if we get the wrong order?', '<p>Contact: <a href="mailto:info@decolef.com">info@decolef.com</a></p>'),
(6, 3, 'en', 'What if we get the wrong order?', '<p>Contact: <a href="mailto:info@decolef.com">info@decolef.com</a></p>'),
(7, 4, 'nl', 'Test question under the section material', '<p>Test answer under the section material</p>'),
(8, 4, 'en', 'Test question under the section material', '<p>Test answer under the section material</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Gallery`
--

CREATE TABLE IF NOT EXISTS `Gallery` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_till` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Gegevens worden uitgevoerd voor tabel `Gallery`
--

INSERT INTO `Gallery` (`gid`, `author_id`, `date_created`, `date_from`, `date_till`, `date_updated`) VALUES
(8, 0, '2012-02-23 09:49:13', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL),
(7, 0, '2012-02-23 09:29:45', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL),
(9, 0, '2012-02-23 10:34:49', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL),
(10, 0, '2012-02-23 10:35:10', '2012-02-21 00:00:00', '2012-02-23 00:00:00', NULL),
(11, 0, '2012-02-23 10:36:13', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `GalleryPictures`
--

CREATE TABLE IF NOT EXISTS `GalleryPictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `copyright_website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `GalleryPictures`
--

INSERT INTO `GalleryPictures` (`picture_id`, `album_id`, `file`, `place`, `copyright`, `copyright_website`) VALUES
(13, 11, '4ae2d6fd4f872d3984acf4eac2894aeb.jpg', 1, '', ''),
(12, 11, 'bc96fa61b42c668505080329953bbcb9.jpg', 2, '', ''),
(11, 11, '760356b0848adcd0bbe30f2f14f71a19.jpg', 0, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `GalleryPicturesTsl`
--

CREATE TABLE IF NOT EXISTS `GalleryPicturesTsl` (
  `picture_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `GalleryPicturesTsl`
--

INSERT INTO `GalleryPicturesTsl` (`picture_id`, `text`, `language`) VALUES
(12, '', 'en'),
(12, '', 'fr'),
(11, '', 'nl'),
(11, '', 'fr'),
(11, '', 'en'),
(12, '', 'nl'),
(13, '', 'nl'),
(13, '', 'fr'),
(13, '', 'en');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `GalleryTsl`
--

CREATE TABLE IF NOT EXISTS `GalleryTsl` (
  `g_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `content` text,
  `url` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `GalleryTsl`
--

INSERT INTO `GalleryTsl` (`g_id`, `lng`, `active`, `title`, `summary`, `content`, `url`, `seo_description`, `seo_title`, `seo_keywords`) VALUES
(8, 'en', 0, 'Donec orci mauris', 'Donec orci mauris; dapibus vitae bibendum eu, rhoncus id enim? Vivamus dignissim volutpat ante ac pulvinar. Quisque auctor, risus et condimentum condimentum, nisl felis massa nunc.\r\n', '', 'donec-orci-mauris', NULL, NULL, NULL),
(8, 'fr', 0, 'Donec orci mauris', 'Donec orci mauris; dapibus vitae bibendum eu, rhoncus id enim? Vivamus dignissim volutpat ante ac pulvinar. Quisque auctor, risus et condimentum condimentum, nisl felis massa nunc.\r\n', '', 'donec-orci-mauris', NULL, NULL, NULL),
(8, 'nl', 1, 'Donec orci mauris', 'Donec orci mauris; dapibus vitae bibendum eu, rhoncus id enim? Vivamus dignissim volutpat ante ac pulvinar. Quisque auctor, risus et condimentum condimentum, nisl felis massa nunc.\r\n', '', 'donec-orci-mauris', NULL, NULL, NULL),
(7, 'en', 0, 'Pellentesque sollicitudin', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque sollicitudin aliquet risus, fermentum aliquet magna lacinia sed. Donec posuere.\r\n', '', 'pellentesque-sollicitudin', NULL, NULL, NULL),
(7, 'fr', 0, 'Pellentesque sollicitudin', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque sollicitudin aliquet risus, fermentum aliquet magna lacinia sed. Donec posuere.\r\n', '', 'pellentesque-sollicitudin', NULL, NULL, NULL),
(7, 'nl', 1, 'Pellentesque sollicitudin', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque sollicitudin aliquet risus, fermentum aliquet magna lacinia sed. Donec posuere.\r\n', '', 'pellentesque-sollicitudin', NULL, NULL, NULL),
(9, 'nl', 1, 'Class aptent taciti ', 'Nam ut pharetra purus. Proin dui tortor, semper in porttitor et, viverra sed leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos nullam.\r\n', '', 'class-aptent-taciti', NULL, NULL, NULL),
(9, 'fr', 0, 'Class aptent taciti ', 'Nam ut pharetra purus. Proin dui tortor, semper in porttitor et, viverra sed leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos nullam.\r\n', '', 'class-aptent-taciti', NULL, NULL, NULL),
(9, 'en', 0, 'Class aptent taciti ', 'Nam ut pharetra purus. Proin dui tortor, semper in porttitor et, viverra sed leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos nullam.\r\n', '', 'class-aptent-taciti', NULL, NULL, NULL),
(10, 'nl', 1, 'Quisque malesuada', 'Quisque malesuada ante id justo volutpat tincidunt. Nam lacinia felis dignissim tellus interdum fringilla! Donec mollis, purus eget porttitor iaculis; risus sem interdum diam amet.\r\n', '', 'quisque-malesuada', NULL, NULL, NULL),
(10, 'fr', 0, 'Quisque malesuada', 'Quisque malesuada ante id justo volutpat tincidunt. Nam lacinia felis dignissim tellus interdum fringilla! Donec mollis, purus eget porttitor iaculis; risus sem interdum diam amet.\r\n', '', 'quisque-malesuada', NULL, NULL, NULL),
(10, 'en', 0, 'Quisque malesuada', 'Quisque malesuada ante id justo volutpat tincidunt. Nam lacinia felis dignissim tellus interdum fringilla! Donec mollis, purus eget porttitor iaculis; risus sem interdum diam amet.\r\n', '', 'quisque-malesuada', NULL, NULL, NULL),
(11, 'nl', 1, 'Fusce laoreet nisi', 'Fusce laoreet nisi sed nunc feugiat vestibulum. Morbi tempor feugiat diam. Proin imperdiet, lacus sed tincidunt tincidunt; justo odio ultricies tellus, non mattis urna dui in amet.\r\n', '', 'fusce-laoreet-nisi', NULL, NULL, NULL),
(11, 'fr', 0, 'Fusce laoreet nisi', 'Fusce laoreet nisi sed nunc feugiat vestibulum. Morbi tempor feugiat diam. Proin imperdiet, lacus sed tincidunt tincidunt; justo odio ultricies tellus, non mattis urna dui in amet.\r\n', '', 'fusce-laoreet-nisi', NULL, NULL, NULL),
(11, 'en', 0, 'Fusce laoreet nisi', 'Fusce laoreet nisi sed nunc feugiat vestibulum. Morbi tempor feugiat diam. Proin imperdiet, lacus sed tincidunt tincidunt; justo odio ultricies tellus, non mattis urna dui in amet.\r\n', '', 'fusce-laoreet-nisi', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Group`
--

CREATE TABLE IF NOT EXISTS `Group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `Group`
--

INSERT INTO `Group` (`group_id`, `identifier`, `name`, `date_created`, `date_updated`) VALUES
(1, 'none', 'Administrators', '2010-02-22 00:00:00', '2013-04-16 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `GroupAcl`
--

CREATE TABLE IF NOT EXISTS `GroupAcl` (
  `group_id` int(10) unsigned NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `params` varchar(255) NOT NULL,
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Logs`
--

CREATE TABLE IF NOT EXISTS `Logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `priority` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Gegevens worden uitgevoerd voor tabel `Logs`
--

INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(1, '2013-02-05 11:30:09', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '/css/Site.css'),
(2, '2013-02-05 11:30:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '/css/Menu.css'),
(3, '2013-02-05 11:30:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '/images/website/favicon.ico/'),
(4, '2013-02-05 11:30:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '/images/website/favicon.ico/'),
(5, '2013-02-05 12:09:00', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(6, '2013-02-05 12:09:00', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(7, '2013-02-05 12:09:02', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(8, '2013-02-05 12:09:02', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(9, '2013-02-05 12:09:02', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(10, '2013-02-05 12:09:02', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(11, '2013-02-05 12:29:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (color)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 [internal function]: Zend_View_Helper_Action->action(''index'', ''color'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''index'', ''color'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(12, '2013-02-05 12:29:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(13, '2013-02-05 12:29:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(14, '2013-02-05 12:29:43', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (color)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 [internal function]: Zend_View_Helper_Action->action(''index'', ''color'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''index'', ''color'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(15, '2013-02-05 12:29:43', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(16, '2013-02-05 12:29:43', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(17, '2013-02-05 12:29:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (color)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 [internal function]: Zend_View_Helper_Action->action(''index'', ''color'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''index'', ''color'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(18, '2013-02-05 12:29:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(19, '2013-02-05 12:29:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(20, '2013-02-05 12:29:58', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''index/color.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''index/color.pht...'')\n#1 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(897): Zend_View_Abstract->render(''index/color.pht...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''index/color.pht...'', NULL)\n#3 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php(295): Zend_Controller_Action->dispatch(''colorAction'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 [internal function]: Zend_View_Helper_Action->action(''color'', ''index'')\n#9 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#10 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#11 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''color'', ''index'')\n#12 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#13 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#14 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#15 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#16 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#17 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#18 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#19 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(21, '2013-02-05 12:29:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(22, '2013-02-05 12:29:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(23, '2013-02-05 12:33:41', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''color/select.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''color/select.ph...'')\n#1 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(897): Zend_View_Abstract->render(''color/select.ph...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''color/select.ph...'', NULL)\n#3 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php(295): Zend_Controller_Action->dispatch(''selectAction'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 [internal function]: Zend_View_Helper_Action->action(''select'', ''color'')\n#9 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#10 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#11 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''select'', ''color'')\n#12 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#13 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#14 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#15 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#16 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#17 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#18 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#19 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(24, '2013-02-05 12:33:41', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(25, '2013-02-05 12:33:41', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(26, '2013-02-05 12:33:44', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''color/select.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''color/select.ph...'')\n#1 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(897): Zend_View_Abstract->render(''color/select.ph...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''color/select.ph...'', NULL)\n#3 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/Helper/ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action/HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 /home/data/websites/www/doktertemplate/library/Zend/Controller/Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php(295): Zend_Controller_Action->dispatch(''selectAction'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 [internal function]: Zend_View_Helper_Action->action(''select'', ''color'')\n#9 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#10 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#11 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''select'', ''color'')\n#12 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#13 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#14 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#15 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#16 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#17 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#18 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#19 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(27, '2013-02-05 12:33:44', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(28, '2013-02-05 12:33:44', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(29, '2013-02-05 12:35:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (members)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 [internal function]: Zend_View_Helper_Action->action(''viewdirector'', ''members'', NULL, Array)\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''viewdirector'', ''members'', NULL, Array)\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(30, '2013-02-05 12:35:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(31, '2013-02-05 12:35:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(32, '2013-02-05 12:36:07', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (members)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 [internal function]: Zend_View_Helper_Action->action(''viewdirector'', ''members'', NULL, Array)\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''viewdirector'', ''members'', NULL, Array)\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(33, '2013-02-05 12:36:07', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(34, '2013-02-05 12:36:07', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(35, '2013-02-05 12:36:17', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (members)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Helper/Action.php(135): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 [internal function]: Zend_View_Helper_Action->action(''viewdirector'', ''members'', NULL, Array)\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(342): call_user_func_array(Array, Array)\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View_Abstract->__call(''action'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(14): Zend_View->action(''viewdirector'', ''members'', NULL, Array)\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(36, '2013-02-05 12:36:17', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(37, '2013-02-05 12:36:17', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(38, '2013-02-05 13:08:36', 3, 'EXCEPTION_OTHER', 'exception ''Zend_Loader_PluginLoader_Exception'' with message ''Plugin by name ''Color'' was not found in the registry; used paths:\nSxCms_View_Helper_: /home/data/websites/www/doktertemplate/library/SxCms/View/Helper/\nZend_View_Helper_: Zend/View/Helper/:./views/helpers/:/home/data/websites/www/doktertemplate/application/modules/default/views/helpers/'' in /home/data/websites/www/doktertemplate/library/Zend/Loader/PluginLoader.php:412\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(1170): Zend_Loader_PluginLoader->load(''Color'')\n#1 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(610): Zend_View_Abstract->_getPlugin(''helper'', ''color'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(336): Zend_View_Abstract->getHelper(''color'')\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(18): Zend_View_Abstract->__call(''color'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(18): Zend_View->color()\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(39, '2013-02-05 13:08:36', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(40, '2013-02-05 13:08:36', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(41, '2013-02-05 13:08:52', 3, 'EXCEPTION_OTHER', 'exception ''Zend_Loader_PluginLoader_Exception'' with message ''Plugin by name ''Color'' was not found in the registry; used paths:\nSxCms_View_Helper_: /home/data/websites/www/doktertemplate/library/SxCms/View/Helper/\nZend_View_Helper_: Zend/View/Helper/:./views/helpers/:/home/data/websites/www/doktertemplate/application/modules/default/views/helpers/'' in /home/data/websites/www/doktertemplate/library/Zend/Loader/PluginLoader.php:412\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(1170): Zend_Loader_PluginLoader->load(''Color'')\n#1 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(610): Zend_View_Abstract->_getPlugin(''helper'', ''color'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(336): Zend_View_Abstract->getHelper(''color'')\n#3 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(17): Zend_View_Abstract->__call(''color'', Array)\n#4 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/default.phtml(17): Zend_View->color()\n#5 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#6 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#7 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''default.phtml'')\n#8 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#9 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#10 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#11 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#12 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(42, '2013-02-05 13:08:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(43, '2013-02-05 13:08:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css');
INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(44, '2013-02-05 14:02:31', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)', '/favicon.ico'),
(45, '2013-02-05 14:02:36', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)', '/favicon.ico'),
(46, '2013-02-06 13:03:09', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/favicon.ico'),
(47, '2013-02-06 13:38:10', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''__layout/header2.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''__layout/header...'')\n#1 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/defaultv2.phtml(27): Zend_View_Abstract->render(''__layout/header...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#3 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#4 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''defaultv2.phtml'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#7 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#8 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(48, '2013-02-06 13:38:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(49, '2013-02-06 13:38:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(50, '2013-02-06 13:38:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/images/website/favicon.ico/'),
(51, '2013-02-06 13:38:11', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/images/website/favicon.ico/'),
(52, '2013-02-06 13:38:12', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''__layout/header2.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''__layout/header...'')\n#1 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/defaultv2.phtml(27): Zend_View_Abstract->render(''__layout/header...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#3 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#4 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''defaultv2.phtml'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#7 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#8 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(53, '2013-02-06 13:38:12', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(54, '2013-02-06 13:38:12', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(55, '2013-02-06 13:38:20', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''__layout/header2.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''__layout/header...'')\n#1 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/defaultv2.phtml(27): Zend_View_Abstract->render(''__layout/header...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#3 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#4 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''defaultv2.phtml'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#7 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#8 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(56, '2013-02-06 13:38:20', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(57, '2013-02-06 13:38:20', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(58, '2013-02-06 13:38:25', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''__layout/header2.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''__layout/header...'')\n#1 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/defaultv2.phtml(27): Zend_View_Abstract->render(''__layout/header...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#3 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#4 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''defaultv2.phtml'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#7 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#8 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(59, '2013-02-06 13:38:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(60, '2013-02-06 13:38:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(61, '2013-02-06 13:38:33', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''__layout/header2.phtml'' not found in path (/home/data/websites/www/doktertemplate/application/modules/default/views/scripts/:./views/scripts/)'' in /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php:976\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(876): Zend_View_Abstract->_script(''__layout/header...'')\n#1 /home/data/websites/www/doktertemplate/application/modules/default/views/scripts/defaultv2.phtml(27): Zend_View_Abstract->render(''__layout/header...'')\n#2 /home/data/websites/www/doktertemplate/library/Zend/View.php(108): include(''/home/data/webs...'')\n#3 /home/data/websites/www/doktertemplate/library/Zend/View/Abstract.php(880): Zend_View->_run(''/home/data/webs...'')\n#4 /home/data/websites/www/doktertemplate/library/Zend/Layout.php(796): Zend_View_Abstract->render(''defaultv2.phtml'')\n#5 /home/data/websites/www/doktertemplate/library/Zend/Layout/Controller/Plugin/Layout.php(143): Zend_Layout->render()\n#6 /home/data/websites/www/doktertemplate/library/Zend/Controller/Plugin/Broker.php(331): Zend_Layout_Controller_Plugin_Layout->postDispatch(Object(Zend_Controller_Request_Http))\n#7 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(965): Zend_Controller_Plugin_Broker->postDispatch(Object(Zend_Controller_Request_Http))\n#8 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/'),
(62, '2013-02-06 13:38:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Site.css'),
(63, '2013-02-06 13:38:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/Menu.css'),
(64, '2013-02-06 13:39:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(65, '2013-02-06 13:41:03', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(66, '2013-02-06 13:41:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(67, '2013-02-06 13:41:29', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(68, '2013-02-06 13:41:34', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(69, '2013-02-06 13:41:36', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(70, '2013-02-06 13:41:39', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(71, '2013-02-06 13:41:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(72, '2013-02-06 13:41:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(73, '2013-02-06 13:41:55', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(74, '2013-02-06 13:41:56', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (css)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/css/SxCms.css'),
(75, '2013-02-06 13:43:39', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/images/ajax-loader.gif'),
(76, '2013-02-06 13:44:23', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/images/ajax-loader.gif'),
(77, '2013-02-06 13:45:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/images/ajax-loader.gif'),
(78, '2013-02-06 13:46:48', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/doktertemplate/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/doktertemplate/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/doktertemplate/public_html/index.php(9): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.110', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0 FirePHP/0.7.1', '/images/ajax-loader.gif'),
(79, '2013-04-05 11:15:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (hdfjgf)'' in /home/data/websites/www/nick/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/nick/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/nick/public_html/index.php(8): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.109', 'Mozilla/5.0 (Windows NT 6.0; rv:12.0) Gecko/20100101 Firefox/12.0', '/hdfjgf'),
(80, '2013-04-05 11:15:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in /home/data/websites/www/nick/library/Zend/Controller/Dispatcher/Standard.php:248\nStack trace:\n#0 /home/data/websites/www/nick/library/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 /home/data/websites/www/nick/public_html/index.php(8): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.0.109', 'Mozilla/5.0 (Windows NT 6.0; rv:12.0) Gecko/20100101 Firefox/12.0', '/images/website/logo.jpg/');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Member`
--

CREATE TABLE IF NOT EXISTS `Member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `postalcode` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `board_member` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Gegevens worden uitgevoerd voor tabel `Member`
--

INSERT INTO `Member` (`id`, `active`, `lng`, `sex`, `name`, `first_name`, `company`, `website`, `email`, `password`, `phone`, `fax`, `mobile_phone`, `street`, `number`, `postalcode`, `place`, `country`, `board_member`, `date_created`, `date_updated`) VALUES
(2, 1, 'nl', 'V', 'Stukken', 'Mindy', 'Sanmax', 'www.sanmax.be', 'nick@sanmax.be', 'abcde123', '070 250 236', '089 656 639', '', 'Weg naar Zwartberg', '18', '3660', 'Opglabbeek', 'België', 0, '2011-10-26 09:17:57', '2011-10-26 09:18:48'),
(7, 1, 'nl', 'M', 'Claes', 'Gwen', 'Sanmax bvba', 'www.sanmax.be', 'nick@sanmax.be', 'abcde123', '070 250 236', '089 656 639', '0499409369', 'Weg naar Zwartberg', '18', '3660', 'Opglabbeek', 'België', 0, '2011-11-03 14:24:40', '0000-00-00 00:00:00'),
(12, 1, '', 'M', 'Verbeek', 'Nick', 'Sanmax bvba', 'www.sanmax.be', 'nick@sanmax.be', 'abcde123', '070 250 236', '089 656 639', '0499409369', 'Weg naar Zwartberg', '18', '3660', 'Opglabbeek', 'België', 0, '0000-00-00 00:00:00', '2013-01-18 10:04:10'),
(25, 1, '', 'M', 'test', 'test', 'test', 'test.te', 'test@test.com', 'testtest', '049465465466', '0879876540', '5408709870', 'teststraat', '55', '55555', 'etsetsdf', 'testset', 0, '2013-04-19 14:59:55', '0000-00-00 00:00:00'),
(24, 1, '', 'M', 'weldon', 'Test2', 'Test3', 'www.appmax.be', 'ruben@sanmax.be', 'test123', '01818118181', '8888888888', '0499409369', 'Teststraat', '10', '1111', 'Testgemeente', 'Testland12', 0, '2013-04-18 10:22:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `MemberGroups`
--

CREATE TABLE IF NOT EXISTS `MemberGroups` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `MemberGroups`
--

INSERT INTO `MemberGroups` (`member_id`, `group_id`) VALUES
(24, 1),
(24, 12),
(2, 2),
(2, 9),
(24, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `MemberMail`
--

CREATE TABLE IF NOT EXISTS `MemberMail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `reply_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Gegevens worden uitgevoerd voor tabel `MemberMail`
--

INSERT INTO `MemberMail` (`id`, `from_email`, `from_name`, `reply`, `reply_name`) VALUES
(1, 'gwen2@sanmax.be', 'Claes Gwen2', 'nick2@sanmax.be', 'Nick Verbeek2'),
(2, 'gwen@sanmax.be', 'Claes Gwen', 'nick@sanmax.be', 'Nick Verbeek'),
(3, 'gwen@sanmax.be', 'Claes Gwen', 'nick@sanmax.be', 'Nick Verbeek'),
(17, 'Test2@test.be', 'Test1', 'Test1b@test.be', 'Test3'),
(18, 'ainfo@intellisol.be', 'ainfo', 'Test1b@test.be', 'Test3'),
(19, 'ainfo@intellisol.be', 'ainfo', 'Test1b@test.be', 'Test3'),
(20, 'ainfo@intellisol.be', 'ainfo', 'Test1b@test.be', 'Test3'),
(21, 'testestest@test.be', 'testestest', 'Test4@test.be', 'testtestestse'),
(22, 'testestest@test.be', 'testestest', 'Test4@test.be', 'testtestestse');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `MemberMailTsl`
--

CREATE TABLE IF NOT EXISTS `MemberMailTsl` (
  `mail_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `MemberMailTsl`
--

INSERT INTO `MemberMailTsl` (`mail_id`, `lng`, `subject`, `content`) VALUES
(1, 'nl', 'Registratie2', '<h1>Bedankt voor uw registratie</h1>\r\n<p>Bedankt voor uw registratie. U kan inloggen met onderstaande gegevens.</p>\r\n<p>Login: [login]<br />Paswoord: [password]2</p>'),
(1, 'fr', 'Registratie', '<h1>Bedankt voor uw registratie</h1>\r\n<p>Bedankt voor uw registratie. Wij contacteren u zo snel mogelijk.</p>'),
(1, 'en', 'Registratie', '<h1>Bedankt voor uw registratie</h1>\r\n<p>Bedankt voor uw registratie. Wij contacteren u zo snel mogelijk.</p>'),
(2, 'nl', 'Paswoord vergeten', '<h1>Paswoord vergeten ? Geen nood !</h1>\r\n<p>U kan inloggen met de volgende gegeven:</p>\r\n<p>Login: [login]<br />Paswoord: [password]</p>'),
(2, 'fr', 'Paswoord vergeten', '<h1>Paswoord vergeten ? Geen nood !</h1>\r\n<p>U kan inloggen met de volgende gegeven:</p>\r\n<p>Login: [login]<br />Paswoord: [password]</p>'),
(2, 'en', 'Paswoord vergeten', '<h1>Paswoord vergeten ? Geen nood !</h1>\r\n<p>U kan inloggen met de volgende gegeven:</p>\r\n<p>Login: [login]<br />Paswoord: [password]</p>'),
(3, 'nl', 'Nieuw document', '<p>Beste [firstname],</p>\r\n<p>Er werd een nieuw document geupload op de website.</p>\r\n<p>[docu-description]</p>'),
(3, 'fr', 'Nieuw document', '<p>Beste [firstname],</p>\r\n<p>Er werd een nieuw document geupload op de website.</p>\r\n<p>[docu-description]</p>'),
(3, 'en', 'Nieuw document', '<p>Beste [firstname],</p>\r\n<p>Er werd een nieuw document geupload op de website.</p>\r\n<p>[docu-description]</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Members`
--

CREATE TABLE IF NOT EXISTS `Members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `function` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `director` int(1) NOT NULL,
  `picture` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `Members`
--

INSERT INTO `Members` (`id`, `name`, `first_name`, `function`, `website`, `email`, `director`, `picture`) VALUES
(1, 'D''Helft', 'Pascal', 'Zaakvoerder sanmax', 'www.sanmax.be', 'pascal.dhelft@sanmax.be', 0, 'pascal.png'),
(2, 'Hayen', 'Geert', 'Partner Monard-D''Hulst ', 'www.monard-dhulst.be', 'info@monard-dhulst.be', 1, 'geert.png'),
(3, 'Vanluyten', 'Stefan', 'Zaakvoerder B&K Projects', 'www.bkbprojects.be', 'info@bkbprojects.be', 1, 'stefan.png'),
(7, 'Nelissen', 'Wilfried ', 'test', 'test', 'testmail@mail.be', 0, 'chrysanthemum_1359388959.jpg'),
(8, 'Van Eylen', 'Peter ', 'test', 'test', 'testmail@mail.be', 0, 'hydrangeas_1359388950.jpg'),
(10, 'Verbeek', 'Nick', 'stage', 'www.sanmax.be', 'nick@sanmax.be', 1, 'tulips_1359389186.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_published` datetime NOT NULL,
  `date_expired` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_message` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Gegevens worden uitgevoerd voor tabel `News`
--

INSERT INTO `News` (`nid`, `author_id`, `date_created`, `date_published`, `date_expired`, `date_updated`, `date_message`, `picture`) VALUES
(90, 9, '2013-01-18 14:28:26', '2013-01-18 14:00:00', NULL, NULL, '2013-01-15 00:00:00', NULL),
(91, 0, '2013-04-18 17:35:44', '2013-04-18 17:05:00', '2013-04-10 00:00:00', '2013-04-19 15:02:47', '2013-04-24 00:00:00', NULL),
(92, 0, '2013-05-02 16:03:17', '2013-05-02 15:59:00', '2013-05-10 01:00:00', '2013-05-02 16:11:38', '2013-05-08 00:00:00', 'chrysanthemum_1367503897.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `NewsTsl`
--

CREATE TABLE IF NOT EXISTS `NewsTsl` (
  `nid` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `seo_keywords` varchar(500) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `NewsTsl`
--

INSERT INTO `NewsTsl` (`nid`, `lng`, `title`, `summary`, `content`, `url`, `seo_keywords`, `seo_title`, `seo_description`, `active`) VALUES
(91, 'nl', 'test', 'test', '<p>test</p>', 'test', 'test', 'test', 'test', 1),
(90, 'en', 'abc', 'abc', '<p>abc</p>', 'abc', '123', '123', '123', 0),
(91, 'fr', 'test', 'test', '<p>test</p>', 'test', 'test', 'test', 'test', 1),
(91, 'en', 'test', 'test', '<p>test</p>', 'test', 'test', 'test', 'test', 1),
(90, 'fr', 'abc', 'abc', '<p>abc</p>', 'abc', '123', '123', '123', 0),
(90, 'nl', 'abc', 'abc', '<p>abc</p>', 'abc', '123', '123', '123', 1),
(92, 'nl', 'test', 'test', '<p>test</p>', 'test', 'test', 'test', 'test', 1),
(92, 'fr', 'test', 'test', '<p>test</p>', 'test', 'test', 'test', 'test', 1),
(92, 'en', 'test', 'test', '<p>test</p>', 'test', 'test', 'test', 'test', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Page`
--

CREATE TABLE IF NOT EXISTS `Page` (
  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `layout` varchar(255) DEFAULT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `navigation` tinyint(1) unsigned NOT NULL,
  `sitemap` tinyint(1) unsigned NOT NULL,
  `comments` tinyint(1) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `locked_by` int(10) unsigned NOT NULL,
  `date_locked` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_published` datetime DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `author_id` (`author_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=244 ;

--
-- Gegevens worden uitgevoerd voor tabel `Page`
--

INSERT INTO `Page` (`page_id`, `parent_id`, `author_id`, `layout`, `type`, `navigation`, `sitemap`, `comments`, `thumb`, `locked_by`, `date_locked`, `date_created`, `date_updated`, `date_published`, `date_expired`) VALUES
(0, 0, 0, 'default', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00', '2009-08-01 00:00:00', '2013-02-13 14:10:13', '2009-08-01 00:00:00', NULL),
(240, 0, 9, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2013-01-28 14:18:33', '2013-01-28 14:32:06', '2013-01-28 01:00:00', NULL),
(241, 0, 9, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2013-01-28 14:28:59', '2013-01-28 14:29:30', '2013-01-28 00:00:00', NULL),
(242, 0, 9, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2013-01-28 14:29:55', '2013-01-28 14:29:55', '2013-01-28 01:00:00', NULL),
(243, 0, 9, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2013-01-28 14:30:24', '2013-01-28 14:30:24', '2013-01-28 01:00:00', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PageAcl`
--

CREATE TABLE IF NOT EXISTS `PageAcl` (
  `page_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  KEY `page_id` (`page_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PageComment`
--

CREATE TABLE IF NOT EXISTS `PageComment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `comment` text NOT NULL,
  `datePosted` datetime NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_email` varchar(255) NOT NULL,
  `author_link` text NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `dateApproved` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PagePictures`
--

CREATE TABLE IF NOT EXISTS `PagePictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `season` tinyint(1) NOT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `PagePictures`
--

INSERT INTO `PagePictures` (`picture_id`, `page_id`, `file`, `place`, `season`) VALUES
(2, 0, 'afd0111e13cec8613d3bb89c6ba2f0fd.jpg', 1, 0),
(3, 0, '5c4402a7737c69d6ca18c985262ed8cb.jpg', 2, 0),
(4, 0, '6a863d6680d8bb974a60c38b1c77bbee.jpg', 3, 0),
(5, 0, 'b5e842fe6ee03109271ea7d6d1a9879e.jpg', 4, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PagePicturesTsl`
--

CREATE TABLE IF NOT EXISTS `PagePicturesTsl` (
  `picture_id` int(12) NOT NULL,
  `text` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  KEY `picture_id` (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `PagePicturesTsl`
--

INSERT INTO `PagePicturesTsl` (`picture_id`, `text`, `language`) VALUES
(1, '', 'nl'),
(1, '', 'fr'),
(1, '', 'en'),
(2, '', 'nl'),
(2, '', 'fr'),
(2, '', 'en'),
(3, 'test', 'nl'),
(3, '', 'fr'),
(3, '', 'en'),
(4, '', 'nl'),
(4, '', 'fr'),
(4, '', 'en'),
(5, '', 'nl'),
(5, '', 'fr'),
(5, '', 'en');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PageRev`
--

CREATE TABLE IF NOT EXISTS `PageRev` (
  `revision_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) unsigned NOT NULL,
  `language` char(2) NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `reviewer_id` int(11) unsigned DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approved` tinyint(1) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_fb` tinyint(1) unsigned NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `summary_fb` tinyint(1) unsigned NOT NULL,
  `content` text,
  `content_fb` tinyint(1) unsigned NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_fb` tinyint(1) unsigned NOT NULL,
  `link` text,
  `link_fb` tinyint(1) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_revised` datetime DEFAULT NULL,
  `invisible` int(1) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seotags` varchar(500) NOT NULL,
  `seodescription` varchar(255) NOT NULL,
  PRIMARY KEY (`revision_id`),
  KEY `page_id` (`page_id`),
  KEY `author_id` (`author_id`),
  KEY `reviewer_id` (`reviewer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Gegevens worden uitgevoerd voor tabel `PageRev`
--

INSERT INTO `PageRev` (`revision_id`, `page_id`, `language`, `author_id`, `reviewer_id`, `notes`, `approved`, `title`, `title_fb`, `summary`, `summary_fb`, `content`, `content_fb`, `source`, `source_fb`, `link`, `link_fb`, `date_created`, `date_revised`, `invisible`, `seotitle`, `seotags`, `seodescription`) VALUES
(1, 0, 'nl', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus  neque. Cras volutpat mattis ligula, nec egestas felis consectetur  vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque.  Mauris posuere fermentum justo, vel dictum mauris imperdiet eget.  Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing  lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et  nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit.  Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae  turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus  id ut ligula. Pellentesque habitant morbi tristique senectus et netus  et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit  amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2010-12-22 09:20:25', '2010-12-22 09:20:25', 0, '', '', ''),
(2, 0, 'en', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget  aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim,  enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse  luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris  magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem  orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut  viverra metus commodo. Nam semper blandit lacus quis aliquet. In et  egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar  gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed  gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada  nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut  faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in  suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus  elit ac tempus.</p>\r\n<p>Nullam eget dui tincidunt ante sollicitudin tincidunt. Phasellus a  egestas lacus. Duis id urna orci, sit amet luctus justo. Nam euismod  dignissim ultrices. Praesent non dolor nec nisl sodales congue. Nunc  lacus arcu, adipiscing id egestas id, lacinia adipiscing nunc. Praesent  sed luctus sapien. Ut sodales, mauris vel ultricies fermentum, erat diam  facilisis tellus, non adipiscing dolor justo nec nunc. Cras vel nibh  dolor. Morbi venenatis enim nec ipsum dapibus vel commodo augue  dignissim.</p>', 0, '', 0, NULL, 0, '2010-12-22 09:30:59', '2010-12-22 09:30:59', 0, '', '', ''),
(3, 0, 'fr', 0, 0, 'Pagina aangepast', 1, 'Page d''accueil', 0, 'Home', 0, '<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan. Morbi mattis dui et est luctus in volutpat urna  volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et  ultrices posuere cubilia Curae; Vestibulum malesuada viverra massa,  fermentum vehicula lorem sodales tempor. Curabitur massa purus, dapibus  sed bibendum nec, tincidunt at enim. Aliquam porta, enim at rhoncus  consectetur, ipsum nisl dapibus odio, ac consectetur eros ipsum iaculis  quam. Phasellus tristique rutrum dolor non feugiat. Cras id tortor nunc.  Cras laoreet vehicula neque non malesuada. Proin urna risus,  scelerisque sit amet semper ac, varius at nisi.</p>\r\n<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget  aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim,  enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse  luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris  magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem  orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut  viverra metus commodo. Nam semper blandit lacus quis aliquet. In et  egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar  gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed  gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada  nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut  faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in  suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus  elit ac tempus.</p>', 0, '', 0, NULL, 0, '2010-12-22 09:31:17', '2010-12-22 09:31:17', 0, '', '', ''),
(36, 0, 'nl', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus  neque. Cras volutpat mattis ligula, nec egestas felis consectetur  vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque.  Mauris posuere fermentum justo, vel dictum mauris imperdiet eget.  Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing  lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et  nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit.  Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae  turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus  id ut ligula. Pellentesque habitant morbi tristique senectus et netus  et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit  amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2010-12-22 16:39:57', '2010-12-22 16:39:57', 1, '', '', ''),
(37, 0, 'nl', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus  neque. Cras volutpat mattis ligula, nec egestas felis consectetur  vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque.  Mauris posuere fermentum justo, vel dictum mauris imperdiet eget.  Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing  lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et  nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit.  Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae  turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus  id ut ligula. Pellentesque habitant morbi tristique senectus et netus  et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit  amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2010-12-22 16:40:05', '2010-12-22 16:40:05', 0, '', '', ''),
(38, 0, 'nl', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus  neque. Cras volutpat mattis ligula, nec egestas felis consectetur  vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque.  Mauris posuere fermentum justo, vel dictum mauris imperdiet eget.  Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing  lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et  nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit.  Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae  turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus  id ut ligula. Pellentesque habitant morbi tristique senectus et netus  et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit  amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2010-12-22 16:40:32', '2010-12-22 16:40:32', 0, '', '', ''),
(39, 0, 'nl', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus  neque. Cras volutpat mattis ligula, nec egestas felis consectetur  vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque.  Mauris posuere fermentum justo, vel dictum mauris imperdiet eget.  Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing  lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et  nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit.  Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae  turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus  id ut ligula. Pellentesque habitant morbi tristique senectus et netus  et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit  amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2011-01-13 16:22:19', '2011-01-13 16:22:19', 0, '', '', ''),
(44, 0, 'nl', 9, 9, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus neque. Cras volutpat mattis ligula, nec egestas felis consectetur vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque. Mauris posuere fermentum justo, vel dictum mauris imperdiet eget. Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit. Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus id ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2013-01-28 13:43:02', '2013-01-28 13:43:02', 0, '', '', ''),
(45, 240, 'nl', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'waarom abc', 0, '', 0, '<p>sdfqsdf</p>', 0, '', 0, 'waarom-abc', 0, '2013-01-28 14:18:33', '2013-01-28 14:18:33', 0, '', '', ''),
(46, 240, 'fr', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'waarom abc', 0, '', 0, '<p>sdfqsdf</p>', 0, '', 0, 'waarom-abc', 0, '2013-01-28 14:18:33', '2013-01-28 14:18:33', 0, '', '', ''),
(47, 240, 'en', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'waarom abc', 0, '', 0, '<p>sdfqsdf</p>', 0, '', 0, 'waarom-abc', 0, '2013-01-28 14:18:33', '2013-01-28 14:18:33', 0, '', '', ''),
(48, 0, 'nl', 9, 9, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus neque. Cras volutpat mattis ligula, nec egestas felis consectetur vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque. Mauris posuere fermentum justo, vel dictum mauris imperdiet eget. Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit. Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus id ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2013-01-28 14:19:51', '2013-01-28 14:19:51', 0, '', '', ''),
(49, 241, 'nl', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'over abc', 0, '', 0, '<p>over abc</p>', 0, '', 0, 'over-abc', 0, '2013-01-28 14:28:59', '2013-01-28 14:28:59', 0, '', '', ''),
(50, 241, 'fr', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'over abc', 0, '', 0, '<p>over abc</p>', 0, '', 0, 'over-abc', 0, '2013-01-28 14:28:59', '2013-01-28 14:28:59', 0, '', '', ''),
(51, 241, 'en', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'over abc', 0, '', 0, '<p>over abc</p>', 0, '', 0, 'over-abc', 0, '2013-01-28 14:28:59', '2013-01-28 14:28:59', 0, '', '', ''),
(52, 241, 'nl', 9, 9, 'Pagina aangepast', 1, 'leden abc', 0, '', 0, '<p>over abc</p>', 0, '', 0, 'leden-abc', 0, '2013-01-28 14:29:16', '2013-01-28 14:29:16', 0, '', '', ''),
(53, 241, 'nl', 9, 9, 'Pagina aangepast', 1, 'abc leden', 0, '', 0, '<p>over abc</p>', 0, '', 0, 'abc-leden', 0, '2013-01-28 14:29:30', '2013-01-28 14:29:30', 0, '', '', ''),
(54, 242, 'nl', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'wat doet abc', 0, '', 0, '<p>wat doet abc</p>', 0, '', 0, 'wat-doet-abc', 0, '2013-01-28 14:29:55', '2013-01-28 14:29:55', 0, '', '', ''),
(55, 242, 'fr', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'wat doet abc', 0, '', 0, '<p>wat doet abc</p>', 0, '', 0, 'wat-doet-abc', 0, '2013-01-28 14:29:55', '2013-01-28 14:29:55', 0, '', '', ''),
(56, 242, 'en', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'wat doet abc', 0, '', 0, '<p>wat doet abc</p>', 0, '', 0, 'wat-doet-abc', 0, '2013-01-28 14:29:55', '2013-01-28 14:29:55', 0, '', '', ''),
(57, 243, 'nl', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'contact', 0, '', 0, '<p>contact</p>', 0, '', 0, 'contact', 0, '2013-01-28 14:30:24', '2013-01-28 14:30:24', 0, '', '', ''),
(58, 243, 'fr', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'contact', 0, '', 0, '<p>contact</p>', 0, '', 0, 'contact', 0, '2013-01-28 14:30:24', '2013-01-28 14:30:24', 0, '', '', ''),
(59, 243, 'en', 9, 9, 'Nieuwe pagina aangemaakt', 1, 'contact', 0, '', 0, '<p>contact</p>', 0, '', 0, 'contact', 0, '2013-01-28 14:30:24', '2013-01-28 14:30:24', 0, '', '', ''),
(60, 240, 'nl', 9, 9, 'Pagina aangepast', 1, 'waarom abc', 0, '', 0, '<p>sdfqsdf</p>', 0, '', 0, 'waarom-abc', 0, '2013-01-28 14:32:06', '2013-01-28 14:32:06', 0, '', '', ''),
(61, 0, 'nl', 9, 9, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus neque. Cras volutpat mattis ligula, nec egestas felis consectetur vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque. Mauris posuere fermentum justo, vel dictum mauris imperdiet eget. Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit. Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus id ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2013-01-29 10:34:41', '2013-01-29 10:34:41', 0, 'test123', 'test', 'test'),
(62, 0, 'nl', 0, 0, 'Pagina aangepast', 1, 'Homepage', 0, 'Home', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus neque. Cras volutpat mattis ligula, nec egestas felis consectetur vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque. Mauris posuere fermentum justo, vel dictum mauris imperdiet eget. Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit. Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus id ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan.</p>', 0, '', 0, NULL, 0, '2013-02-13 14:10:13', '2013-02-13 14:10:13', 0, 'Home', 'test', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PageTag`
--

CREATE TABLE IF NOT EXISTS `PageTag` (
  `page_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PageTsl`
--

CREATE TABLE IF NOT EXISTS `PageTsl` (
  `page_id` int(11) unsigned NOT NULL,
  `language` char(2) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_fb` tinyint(1) NOT NULL,
  `summary` text,
  `summary_fb` tinyint(1) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_fb` tinyint(1) NOT NULL,
  `content` text,
  `content_fb` tinyint(1) NOT NULL,
  `link` text,
  `link_fb` tinyint(1) unsigned NOT NULL,
  `final` tinyint(4) NOT NULL COMMENT 'Vertaling al dan niet aan te passen',
  `invisible` int(1) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `seotags` varchar(500) NOT NULL,
  `seodescription` varchar(155) NOT NULL,
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `PageTsl`
--

INSERT INTO `PageTsl` (`page_id`, `language`, `title`, `title_fb`, `summary`, `summary_fb`, `source`, `source_fb`, `content`, `content_fb`, `link`, `link_fb`, `final`, `invisible`, `seotitle`, `seotags`, `seodescription`) VALUES
(0, 'nl', 'Homepage', 0, 'Home', 0, '', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus neque. Cras volutpat mattis ligula, nec egestas felis consectetur vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque. Mauris posuere fermentum justo, vel dictum mauris imperdiet eget. Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit. Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus id ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan.</p>', 0, NULL, 0, 0, 0, 'Home', 'test', 'test'),
(0, 'fr', 'Page d''accueil', 0, 'Home', 0, '', 0, '<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam  velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui  condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare  convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam.  Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum  tempor turpis, et vestibulum lorem blandit a. Quisque luctus  pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend  vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam,  pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec  lacus interdum accumsan. Morbi mattis dui et est luctus in volutpat urna  volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et  ultrices posuere cubilia Curae; Vestibulum malesuada viverra massa,  fermentum vehicula lorem sodales tempor. Curabitur massa purus, dapibus  sed bibendum nec, tincidunt at enim. Aliquam porta, enim at rhoncus  consectetur, ipsum nisl dapibus odio, ac consectetur eros ipsum iaculis  quam. Phasellus tristique rutrum dolor non feugiat. Cras id tortor nunc.  Cras laoreet vehicula neque non malesuada. Proin urna risus,  scelerisque sit amet semper ac, varius at nisi.</p>\r\n<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget  aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim,  enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse  luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris  magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem  orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut  viverra metus commodo. Nam semper blandit lacus quis aliquet. In et  egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar  gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed  gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada  nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut  faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in  suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus  elit ac tempus.</p>', 0, NULL, 0, 1, 0, '', '', ''),
(0, 'en', 'Homepage', 0, 'Home', 0, '', 0, '<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget  aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim,  enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse  luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris  magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem  orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut  viverra metus commodo. Nam semper blandit lacus quis aliquet. In et  egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar  gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed  gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada  nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut  faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in  suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus  elit ac tempus.</p>\r\n<p>Nullam eget dui tincidunt ante sollicitudin tincidunt. Phasellus a  egestas lacus. Duis id urna orci, sit amet luctus justo. Nam euismod  dignissim ultrices. Praesent non dolor nec nisl sodales congue. Nunc  lacus arcu, adipiscing id egestas id, lacinia adipiscing nunc. Praesent  sed luctus sapien. Ut sodales, mauris vel ultricies fermentum, erat diam  facilisis tellus, non adipiscing dolor justo nec nunc. Cras vel nibh  dolor. Morbi venenatis enim nec ipsum dapibus vel commodo augue  dignissim.</p>', 0, NULL, 0, 1, 0, '', '', ''),
(240, 'nl', 'waarom abc', 0, '', 0, '', 0, '<p>sdfqsdf</p>', 0, 'waarom-abc', 0, 0, 0, '', '', ''),
(240, 'fr', 'waarom abc', 0, '', 0, '', 0, '<p>sdfqsdf</p>', 0, 'waarom-abc', 0, 1, 0, '', '', ''),
(240, 'en', 'waarom abc', 0, '', 0, '', 0, '<p>sdfqsdf</p>', 0, 'waarom-abc', 0, 1, 0, '', '', ''),
(241, 'nl', 'abc leden', 0, '', 0, '', 0, '<p>over abc</p>', 0, 'abc-leden', 0, 0, 0, '', '', ''),
(241, 'fr', 'over abc', 0, '', 0, '', 0, '<p>over abc</p>', 0, 'over-abc', 0, 1, 0, '', '', ''),
(241, 'en', 'over abc', 0, '', 0, '', 0, '<p>over abc</p>', 0, 'over-abc', 0, 1, 0, '', '', ''),
(242, 'nl', 'wat doet abc', 0, '', 0, '', 0, '<p>wat doet abc</p>', 0, 'wat-doet-abc', 0, 0, 0, '', '', ''),
(242, 'fr', 'wat doet abc', 0, '', 0, '', 0, '<p>wat doet abc</p>', 0, 'wat-doet-abc', 0, 1, 0, '', '', ''),
(242, 'en', 'wat doet abc', 0, '', 0, '', 0, '<p>wat doet abc</p>', 0, 'wat-doet-abc', 0, 0, 0, '', '', ''),
(243, 'nl', 'contact', 0, '', 0, '', 0, '<p>contact</p>', 0, 'contact', 0, 0, 0, '', '', ''),
(243, 'fr', 'contact', 0, '', 0, '', 0, '<p>contact</p>', 0, 'contact', 0, 1, 0, '', '', ''),
(243, 'en', 'contact', 0, '', 0, '', 0, '<p>contact</p>', 0, 'contact', 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ProductTsl`
--

CREATE TABLE IF NOT EXISTS `ProductTsl` (
  `product_id` int(11) NOT NULL,
  `language` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `description` text NOT NULL,
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Publication`
--

CREATE TABLE IF NOT EXISTS `Publication` (
  `publication_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publication_cat_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `publication_date` datetime NOT NULL,
  `language` char(2) NOT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_cat_id` (`publication_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PublicationCat`
--

CREATE TABLE IF NOT EXISTS `PublicationCat` (
  `publication_cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `language` char(2) NOT NULL,
  PRIMARY KEY (`publication_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Quicklinks`
--

CREATE TABLE IF NOT EXISTS `Quicklinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `language` varchar(50) NOT NULL,
  `place` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Gegevens worden uitgevoerd voor tabel `Quicklinks`
--

INSERT INTO `Quicklinks` (`id`, `title`, `url`, `language`, `place`, `type`, `active`) VALUES
(16, 'Toegang zwemparadijs', '/index/quick/lng/nl/id/281', 'nl', 4, 1, 1),
(17, 'Herfstvakantie', '#', 'nl', 7, 2, 1),
(18, 'Toegang speelparaijds', '/index/quick/lng/nl/id/260', 'nl', 0, 1, 1),
(19, 'Bedlinnen, badlinnen.', '/index/quick/lng/nl/id/319', 'nl', 3, 1, 1),
(20, 'Kerstvakantie', '#', 'nl', 2, 2, 1),
(21, 'Openingsuren speeltuin', '/index/quick/lng/nl/id/314', 'nl', 5, 2, 1),
(22, 'Openingsuren zwembad', '/index/quick/lng/nl/id/309', 'nl', 6, 2, 1),
(23, 'Verjaardagsfeestje', '/index/quick/lng/nl/id/279', 'nl', 1, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SecureDocsFolder`
--

CREATE TABLE IF NOT EXISTS `SecureDocsFolder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `foldername` varchar(255) NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `SecureDocsFolder`
--

INSERT INTO `SecureDocsFolder` (`folder_id`, `foldername`) VALUES
(2, 'Developers'),
(3, 'Algemeen nieuws'),
(10, '524'),
(11, '4242');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SecureDocsGroup`
--

CREATE TABLE IF NOT EXISTS `SecureDocsGroup` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `SecureDocsGroup`
--

INSERT INTO `SecureDocsGroup` (`group_id`, `group`) VALUES
(1, 'Webdesigners sanmax'),
(2, 'Developers Sanmax'),
(12, 'kben ketse');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SecureDocsGroupMaps`
--

CREATE TABLE IF NOT EXISTS `SecureDocsGroupMaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `mapname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Gegevens worden uitgevoerd voor tabel `SecureDocsGroupMaps`
--

INSERT INTO `SecureDocsGroupMaps` (`id`, `group_id`, `mapname`) VALUES
(4, 1, '3'),
(3, 1, '1'),
(8, 2, '2'),
(23, 12, '2'),
(9, 2, '3'),
(22, 12, '3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SecureFilemanager`
--

CREATE TABLE IF NOT EXISTS `SecureFilemanager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `mail` tinyint(1) NOT NULL,
  `summary` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Gegevens worden uitgevoerd voor tabel `SecureFilemanager`
--

INSERT INTO `SecureFilemanager` (`id`, `filename`, `mail`, `summary`) VALUES
(43, 'L0ZyYW5naXBhbmlGbG93ZXJzLmpwZw==', 0, ''),
(22, 'L0RldmVsb3BlcnMvVHJlZS5qcGc=', 1, 'dit is een foto van een boom'),
(35, 'L0RldmVsb3BlcnMvV2F0ZXJmYWxsLmpwZw==', 1, 'Dit is een waterval.'),
(36, 'L0RldmVsb3BlcnMvRGVzZXJ0IExhbmRzY2FwZS5qcGc=', 1, 'Dit is een landschap, speciaal voor Mindy'),
(37, 'L291dGxvb2tleHByLnBkZg==', 0, ''),
(38, 'L0FsZ2VtZWVuIG5pZXV3cy9IdWlzcmVnbGVtZW50L091dGxvb2sucGRm', 0, ''),
(44, 'L0F1dHVtbiBMZWF2ZXMuanBn', 0, 'tesdt test'),
(74, 'L0FsZ2VtZWVuIG5pZXV3cy9XYXRlcmZhbGwuanBn', 0, ''),
(78, 'L3Rlc3QuanBn', 0, 'test'),
(76, 'L3Rlc3RtYXAvUGVuZ3VpbnMuanBn', 0, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Sheets`
--

CREATE TABLE IF NOT EXISTS `Sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `subtype` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `Sheets`
--

INSERT INTO `Sheets` (`id`, `date_created`, `date_updated`, `type`, `subtype`, `active`, `place`) VALUES
(1, '2013-04-18 10:33:07', '2013-04-18 10:33:07', 1, 3, 0, 0),
(2, '2013-04-19 15:19:06', '2013-04-19 15:19:06', 1, 3, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SheetsSubtype`
--

CREATE TABLE IF NOT EXISTS `SheetsSubtype` (
  `subtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`subtype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `SheetsSubtype`
--

INSERT INTO `SheetsSubtype` (`subtype_id`, `type`, `active`, `position`) VALUES
(4, 2, 0, 0),
(2, 1, 0, 0),
(3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SheetsSubtypeTsl`
--

CREATE TABLE IF NOT EXISTS `SheetsSubtypeTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subtype_id` int(11) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `SheetsSubtypeTsl`
--

INSERT INTO `SheetsSubtypeTsl` (`id`, `subtype_id`, `lng`, `name`) VALUES
(12, 4, 'en', 'testset'),
(11, 4, 'fr', 'testset'),
(10, 4, 'nl', 'testset'),
(4, 2, 'nl', 'Test2'),
(5, 2, 'fr', 'Test2'),
(6, 2, 'en', 'Test2'),
(7, 3, 'nl', 'Test3'),
(8, 3, 'fr', 'Test3'),
(9, 3, 'en', 'Test3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SheetsTsl`
--

CREATE TABLE IF NOT EXISTS `SheetsTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `t_desc` text NOT NULL,
  `t_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `SheetsTsl`
--

INSERT INTO `SheetsTsl` (`id`, `s_id`, `lng`, `name`, `t_desc`, `t_file`) VALUES
(1, 1, 'nl', 'Test5', 'Test6', 'jellyfish-2013-04-18-103307'),
(2, 1, 'fr', 'Test5', 'Test6', 'jellyfish-2013-04-18-103307'),
(3, 1, 'en', 'Test5', 'Test6', 'jellyfish-2013-04-18-103307'),
(4, 2, 'nl', 'test', 'test', ''),
(5, 2, 'fr', 'test', 'test', ''),
(6, 2, 'en', 'test', 'test', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SheetsType`
--

CREATE TABLE IF NOT EXISTS `SheetsType` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `SheetsType`
--

INSERT INTO `SheetsType` (`type_id`, `scheme`, `active`, `position`) VALUES
(2, '', 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SheetsTypeTsl`
--

CREATE TABLE IF NOT EXISTS `SheetsTypeTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `SheetsTypeTsl`
--

INSERT INTO `SheetsTypeTsl` (`id`, `type_id`, `lng`, `name`) VALUES
(4, 2, 'nl', 'testestsetsettesttset'),
(5, 2, 'fr', 'testestsetset'),
(6, 2, 'en', 'testestsetset');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Subscribe`
--

CREATE TABLE IF NOT EXISTS `Subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lng` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `Subscribe`
--

INSERT INTO `Subscribe` (`id`, `lng`, `name`, `firstname`, `email`, `active`) VALUES
(1, 'nl', 'claes', 'gwen', 'gwen@sanmax.be', 1),
(2, 'nl', 'caes', 'gwen', 'gwen@sanmax.be', 0),
(3, 'nl', 'Aert', 'Krt', 'kurt@sanmax.be', 1),
(4, 'nl', 'Schoonbrood', 'Domi', 'dominiqe@sanmax.be', 0),
(5, 'nl', 'Schoonbrood', 'Domi', 'sakn@sanmax.be', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SubscribeMail`
--

CREATE TABLE IF NOT EXISTS `SubscribeMail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `reply_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `SubscribeMail`
--

INSERT INTO `SubscribeMail` (`id`, `from_email`, `from_name`, `reply`, `reply_name`) VALUES
(3, 'Test2@test.be', 'test', 'info2@intellisol.be', 'Test3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SubscribeMailTsl`
--

CREATE TABLE IF NOT EXISTS `SubscribeMailTsl` (
  `mail_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `SubscribeMailTsl`
--

INSERT INTO `SubscribeMailTsl` (`mail_id`, `lng`, `subject`, `content`) VALUES
(3, 'en', 'test', '<p>test</p>'),
(3, 'nl', 'test', '<p>test</p>'),
(3, 'fr', 'test', '<p>test</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Survey`
--

CREATE TABLE IF NOT EXISTS `Survey` (
  `survey_id` int(11) NOT NULL,
  `language` varchar(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_published` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SurveyQuestion`
--

CREATE TABLE IF NOT EXISTS `SurveyQuestion` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `language` varchar(2) NOT NULL,
  `question` varchar(255) NOT NULL,
  `type` enum('text','select','checkbox','textarea') NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `survey_id` (`survey_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `SurveyQuestionAnswer`
--

CREATE TABLE IF NOT EXISTS `SurveyQuestionAnswer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Ticker`
--

CREATE TABLE IF NOT EXISTS `Ticker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TopcontentBlocks`
--

CREATE TABLE IF NOT EXISTS `TopcontentBlocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blockname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `TopcontentBlocks`
--

INSERT INTO `TopcontentBlocks` (`id`, `blockname`) VALUES
(1, 'wat'),
(2, 'waarom');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TopcontentBlocksTsl`
--

CREATE TABLE IF NOT EXISTS `TopcontentBlocksTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `TopcontentBlocksTsl`
--

INSERT INTO `TopcontentBlocksTsl` (`id`, `b_id`, `lng`, `title`, `content`, `url`, `picture`) VALUES
(1, 2, 'nl', 'waaromtest23', '<p>Gezonde logica en rede heersen<br /> tijdens onze maandelijkse meetings, <br /> maar de ervaringsuitwisseling en <br /> het onderlinge vertrouwen tussen <br /> de groepsleden maken het verschil.test23fzo</p>', '/index/quick/lng/nl/id/0', 'hydrangeas_1366377340.jpg'),
(2, 1, 'nl', 'wat', '<p id="about" class="right green">Wat men moet leren doen,<br /> leert men door het te doen.</p>', '/index/quick/lng/nl/id/74', 'penguins_1358327659.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` char(40) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `User`
--

INSERT INTO `User` (`user_id`, `email`, `password`, `active`, `first_name`, `last_name`, `date_created`, `date_updated`) VALUES
(0, 'info@sanmax.be', '3b3108ab8c18aa16565db860a7cb70b4ee04e1f7', 1, 'Sanmax', 'Consultancy', '2009-01-01 00:00:00', '2010-03-02 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `UserGroup`
--

CREATE TABLE IF NOT EXISTS `UserGroup` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(255) unsigned NOT NULL,
  KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `UserGroup`
--

INSERT INTO `UserGroup` (`user_id`, `group_id`) VALUES
(0, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Vacancy`
--

CREATE TABLE IF NOT EXISTS `Vacancy` (
  `vacancy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `region` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `term` int(11) NOT NULL,
  `seeker_name` varchar(255) NOT NULL,
  `seeker_fname` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_published` date NOT NULL,
  `date_expired` date NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`vacancy_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `VacancyCat`
--

CREATE TABLE IF NOT EXISTS `VacancyCat` (
  `vacancy_cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `language` char(2) NOT NULL,
  PRIMARY KEY (`vacancy_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `WebTv`
--

CREATE TABLE IF NOT EXISTS `WebTv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `date_published` date NOT NULL,
  `youtube` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `WebTvTsl`
--

CREATE TABLE IF NOT EXISTS `WebTvTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webtv_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `lng` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `PageComment`
--
ALTER TABLE `PageComment`
  ADD CONSTRAINT `PageComment_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `Page` (`page_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `PageRev`
--
ALTER TABLE `PageRev`
  ADD CONSTRAINT `PageRev_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `Page` (`page_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `PageTag`
--
ALTER TABLE `PageTag`
  ADD CONSTRAINT `PageTag_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `Page` (`page_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
