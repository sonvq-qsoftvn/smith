-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2014 at 04:06 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pas466_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brands`
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
-- Dumping data for table `Brands`
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
-- Table structure for table `BrandsTsl`
--

CREATE TABLE IF NOT EXISTS `BrandsTsl` (
  `e_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `BrandsTsl`
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
-- Table structure for table `Cases`
--

CREATE TABLE IF NOT EXISTS `Cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Cases`
--

INSERT INTO `Cases` (`id`, `place`, `active`, `file`, `date_created`, `date_updated`) VALUES
(5, 4, 1, 'tulips_1357825466.jpg', '2012-10-09 10:54:37', '2013-01-10 14:44:27'),
(6, 1, 1, 'uz-1349772932_1357901228.jpg', '2012-10-09 10:55:32', '2013-01-11 11:47:08'),
(8, 2, 1, 'velinx_1349772977.jpg', '2012-10-09 10:56:17', '0000-00-00 00:00:00'),
(9, 3, 1, 'akzo_1349773020.jpg', '2012-10-09 10:57:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `CasesPictures`
--

CREATE TABLE IF NOT EXISTS `CasesPictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `copyright_website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `CasesPictures`
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
-- Table structure for table `CasesPicturesTsl`
--

CREATE TABLE IF NOT EXISTS `CasesPicturesTsl` (
  `picture_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CasesPicturesTsl`
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
-- Table structure for table `CasesTsl`
--

CREATE TABLE IF NOT EXISTS `CasesTsl` (
  `p_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CasesTsl`
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
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CategoryTsl`
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
-- Table structure for table `ContentBlocks`
--

CREATE TABLE IF NOT EXISTS `ContentBlocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blockname` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ContentBlocks`
--

INSERT INTO `ContentBlocks` (`id`, `blockname`, `active`) VALUES
(1, 'footer_contact', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ContentBlocksTsl`
--

CREATE TABLE IF NOT EXISTS `ContentBlocksTsl` (
  `tsl_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`tsl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ContentBlocksTsl`
--

INSERT INTO `ContentBlocksTsl` (`tsl_id`, `b_id`, `lng`, `title`, `content`) VALUES
(1, 1, 'en', 'footer_contact', '<p>&copy; 2014 Designsmith. All rights reserved</p>');

-- --------------------------------------------------------

--
-- Table structure for table `Event`
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
-- Table structure for table `EventField`
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
-- Table structure for table `EventFieldList`
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
-- Table structure for table `Events`
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
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`id`, `date_created`, `date_updated`, `from`, `till`) VALUES
(1, '2012-09-18 19:03:57', '2013-01-09 16:13:26', '2012-09-18', '2012-09-19'),
(2, '2012-09-19 11:55:08', '0000-00-00 00:00:00', '2012-09-19', '2012-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `EventSettings`
--

CREATE TABLE IF NOT EXISTS `EventSettings` (
  `variable` varchar(20) NOT NULL,
  `value` text,
  `language` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `EventSettings`
--

INSERT INTO `EventSettings` (`variable`, `value`, `language`) VALUES
('mailRemember', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>dit is de default herinneringsmail (nederlands)</p>', 'nl'),
('mailRemember', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>dit is de default herinneringsmail (frans)</p>', 'fr'),
('mailConfirmation', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>Dit is de default bevestingsmail (nederlands)</p>', 'nl'),
('mailConfirmation', '<p>Beste,</p>\r\n<p>&nbsp;</p>\r\n<p>dit is de default bevestiginsmail (frans)</p>', 'fr');

-- --------------------------------------------------------

--
-- Table structure for table `EventsTsl`
--

CREATE TABLE IF NOT EXISTS `EventsTsl` (
  `e_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EventsTsl`
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
-- Table structure for table `EventSubscription`
--

CREATE TABLE IF NOT EXISTS `EventSubscription` (
  `event_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL COMMENT '0=waiting,1=approved,2=rejected',
  PRIMARY KEY (`subscription_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `EventSubscriptionField`
--

CREATE TABLE IF NOT EXISTS `EventSubscriptionField` (
  `subscription_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EventTsl`
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
-- Table structure for table `Eyecatchers`
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
-- Dumping data for table `Eyecatchers`
--

INSERT INTO `Eyecatchers` (`id`, `date_created`, `date_updated`, `picture`, `place`, `active`) VALUES
(1, '2013-04-15 14:12:27', '0000-00-00 00:00:00', 'chrysanthemum_1366027947.jpg', 0, 1),
(2, '2013-04-15 14:12:52', '0000-00-00 00:00:00', 'chrysanthemum_1366027971.jpg', 0, 1),
(3, '2013-04-15 14:15:11', '0000-00-00 00:00:00', 'chrysanthemum_1366028111.jpg', 0, 1),
(7, '2013-04-19 15:13:05', '2013-04-19 15:16:03', 'jellyfish_1366377185.jpg', 0, 1),
(8, '2013-04-19 15:16:13', '0000-00-00 00:00:00', 'koala_1366377373.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `EyecatchersTsl`
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
-- Dumping data for table `EyecatchersTsl`
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
-- Table structure for table `Faq`
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
-- Dumping data for table `Faq`
--

INSERT INTO `Faq` (`id`, `parentID`, `position`, `active`, `date_created`, `date_updated`) VALUES
(1, 4, 2, 1, '2012-12-06 11:33:30', '0000-00-00 00:00:00'),
(2, 4, 1, 0, '2012-12-06 11:35:31', '2013-04-19 14:49:24'),
(3, 4, 3, 1, '2012-12-06 11:35:43', '0000-00-00 00:00:00'),
(4, 6, 1, 1, '2012-12-11 14:45:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `FaqCategory`
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
-- Dumping data for table `FaqCategory`
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
-- Table structure for table `FaqCategoryTsl`
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
-- Dumping data for table `FaqCategoryTsl`
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
-- Table structure for table `FaqTsl`
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
-- Dumping data for table `FaqTsl`
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
-- Table structure for table `Gallery`
--

CREATE TABLE IF NOT EXISTS `Gallery` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_till` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Gallery`
--

INSERT INTO `Gallery` (`gid`, `author_id`, `date_created`, `date_from`, `date_till`, `date_updated`) VALUES
(8, 0, '2012-02-23 09:49:13', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL),
(7, 0, '2012-02-23 09:29:45', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL),
(9, 0, '2012-02-23 10:34:49', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL),
(10, 0, '2012-02-23 10:35:10', '2012-02-21 00:00:00', '2012-02-23 00:00:00', NULL),
(11, 0, '2012-02-23 10:36:13', '2012-02-23 00:00:00', '2012-02-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `GalleryPictures`
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
-- Dumping data for table `GalleryPictures`
--

INSERT INTO `GalleryPictures` (`picture_id`, `album_id`, `file`, `place`, `copyright`, `copyright_website`) VALUES
(13, 11, '4ae2d6fd4f872d3984acf4eac2894aeb.jpg', 1, '', ''),
(12, 11, 'bc96fa61b42c668505080329953bbcb9.jpg', 2, '', ''),
(11, 11, '760356b0848adcd0bbe30f2f14f71a19.jpg', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `GalleryPicturesTsl`
--

CREATE TABLE IF NOT EXISTS `GalleryPicturesTsl` (
  `picture_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `GalleryPicturesTsl`
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
-- Table structure for table `GalleryTsl`
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
-- Dumping data for table `GalleryTsl`
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
-- Table structure for table `Group`
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
-- Dumping data for table `Group`
--

INSERT INTO `Group` (`group_id`, `identifier`, `name`, `date_created`, `date_updated`) VALUES
(1, 'none', 'Administrators', '2010-02-22 00:00:00', '2013-11-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `GroupAcl`
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
-- Table structure for table `Logs`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=271 ;

--
-- Dumping data for table `Logs`
--

INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(1, '2014-12-14 08:04:27', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(2, '2014-12-14 08:04:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(3, '2014-12-14 08:13:03', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (work)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(4, '2014-12-14 08:13:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(5, '2014-12-14 08:13:06', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (work)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(6, '2014-12-14 08:14:29', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(7, '2014-12-14 08:14:33', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(8, '2014-12-14 08:14:34', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(9, '2014-12-14 08:22:17', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(10, '2014-12-14 08:23:01', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(11, '2014-12-14 08:23:22', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(12, '2014-12-14 08:24:24', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(13, '2014-12-14 08:37:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(14, '2014-12-14 08:37:34', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(15, '2014-12-14 08:42:50', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(16, '2014-12-14 08:43:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(17, '2014-12-14 08:44:11', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(18, '2014-12-14 08:44:47', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(19, '2014-12-14 08:45:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(20, '2014-12-14 08:45:13', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(21, '2014-12-14 08:45:23', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(22, '2014-12-14 08:46:01', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(23, '2014-12-14 08:47:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(24, '2014-12-14 08:54:03', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(25, '2014-12-14 08:57:11', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(26, '2014-12-14 08:57:36', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(27, '2014-12-14 08:57:50', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(28, '2014-12-14 08:58:18', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(29, '2014-12-14 09:01:14', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(30, '2014-12-14 09:02:12', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(31, '2014-12-14 09:15:37', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(32, '2014-12-14 09:16:04', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(33, '2014-12-14 09:16:10', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(34, '2014-12-14 09:16:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(35, '2014-12-14 09:16:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(36, '2014-12-14 09:16:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/pattern.jpg/'),
(37, '2014-12-14 09:16:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(38, '2014-12-14 09:16:27', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(39, '2014-12-14 09:16:30', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(40, '2014-12-14 09:17:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(41, '2014-12-14 09:17:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(42, '2014-12-14 09:17:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(43, '2014-12-14 09:54:53', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(44, '2014-12-14 09:55:45', 3, 'EXCEPTION_OTHER', 'exception ''PDOException'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:228\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php(228): PDOStatement->execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#9 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#10 {main}\n\nNext exception ''Zend_Db_Statement_Exception'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:234\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(45, '2014-12-14 09:55:47', 3, 'EXCEPTION_OTHER', 'exception ''PDOException'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:228\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php(228): PDOStatement->execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#9 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#10 {main}\n\nNext exception ''Zend_Db_Statement_Exception'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:234\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work');
INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(46, '2014-12-14 09:56:15', 3, 'EXCEPTION_OTHER', 'exception ''PDOException'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:228\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php(228): PDOStatement->execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#9 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#10 {main}\n\nNext exception ''Zend_Db_Statement_Exception'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:234\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(47, '2014-12-14 09:57:28', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(48, '2014-12-14 09:57:28', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(49, '2014-12-14 09:57:29', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(50, '2014-12-14 09:57:34', 3, 'EXCEPTION_OTHER', 'exception ''PDOException'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:228\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php(228): PDOStatement->execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#9 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#10 {main}\n\nNext exception ''Zend_Db_Statement_Exception'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:234\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(51, '2014-12-14 10:00:51', 3, 'EXCEPTION_OTHER', 'exception ''PDOException'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:228\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php(228): PDOStatement->execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#9 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#10 {main}\n\nNext exception ''Zend_Db_Statement_Exception'' with message ''SQLSTATE[HY093]: Invalid parameter number: no parameters were bound'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement\\Pdo.php:234\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Statement.php(300): Zend_Db_Statement_Pdo->_execute(Array)\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Abstract.php(468): Zend_Db_Statement->execute(Array)\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Db\\Adapter\\Pdo\\Abstract.php(238): Zend_Db_Adapter_Abstract->query(Object(Zend_Db_Select), Array)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\SxCms\\Page\\Proxy.php(391): Zend_Db_Adapter_Pdo_Abstract->query(Object(Zend_Db_Select))\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\application\\modules\\default\\controllers\\WorkController.php(14): SxCms_Page_Proxy->getPageByUrl(''work'', NULL, NULL)\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(513): WorkController->indexAction()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(52, '2014-12-14 10:01:01', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(53, '2014-12-14 10:01:01', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(54, '2014-12-14 10:01:40', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(55, '2014-12-14 10:01:40', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(56, '2014-12-14 10:01:43', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(57, '2014-12-14 10:01:45', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(58, '2014-12-14 10:01:45', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(59, '2014-12-14 10:01:47', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(60, '2014-12-14 10:02:00', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(61, '2014-12-14 10:02:00', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(62, '2014-12-14 10:02:02', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(63, '2014-12-14 10:02:06', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(64, '2014-12-14 10:02:06', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(65, '2014-12-14 10:02:22', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(66, '2014-12-14 10:02:53', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(67, '2014-12-14 10:02:53', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(68, '2014-12-14 10:03:01', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(69, '2014-12-14 10:05:57', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(70, '2014-12-14 10:05:59', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(71, '2014-12-14 10:06:05', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(72, '2014-12-14 10:06:08', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(73, '2014-12-14 10:06:22', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(74, '2014-12-14 10:06:32', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(75, '2014-12-14 10:06:32', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(76, '2014-12-14 10:06:38', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(77, '2014-12-14 10:07:06', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(78, '2014-12-14 10:07:26', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(79, '2014-12-14 10:07:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(80, '2014-12-14 10:07:41', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(81, '2014-12-14 10:07:47', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(82, '2014-12-14 10:07:56', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller class ("WorkController")'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:352\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(262): Zend_Controller_Dispatcher_Standard->loadClass(''WorkController'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#3 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(83, '2014-12-14 10:07:57', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller class ("WorkController")'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:352\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(262): Zend_Controller_Dispatcher_Standard->loadClass(''WorkController'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#3 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(84, '2014-12-14 10:07:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller class ("WorkController")'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:352\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(262): Zend_Controller_Dispatcher_Standard->loadClass(''WorkController'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#3 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(85, '2014-12-14 10:08:14', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(86, '2014-12-14 10:08:15', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico');
INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(87, '2014-12-14 10:14:33', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(88, '2014-12-14 10:16:22', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(89, '2014-12-14 10:16:51', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(90, '2014-12-14 10:16:52', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(91, '2014-12-14 10:17:05', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(92, '2014-12-14 10:17:14', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(93, '2014-12-14 10:17:38', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(94, '2014-12-14 10:17:39', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(95, '2014-12-14 10:17:58', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(96, '2014-12-14 10:17:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(97, '2014-12-14 10:18:36', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(98, '2014-12-14 10:18:37', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(99, '2014-12-14 10:18:41', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(100, '2014-12-14 10:18:44', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(101, '2014-12-14 10:18:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(102, '2014-12-14 10:18:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(103, '2014-12-14 10:18:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/pattern.jpg/'),
(104, '2014-12-14 10:18:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(105, '2014-12-14 10:18:47', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(106, '2014-12-14 10:18:53', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(107, '2014-12-14 10:19:00', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(108, '2014-12-14 10:21:44', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(109, '2014-12-14 10:21:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(110, '2014-12-14 10:22:37', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(111, '2014-12-14 10:22:40', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(112, '2014-12-14 10:31:11', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(113, '2014-12-14 10:32:21', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(114, '2014-12-14 10:33:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(115, '2014-12-14 10:33:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(116, '2014-12-14 10:33:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(117, '2014-12-14 10:38:55', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(118, '2014-12-14 10:43:23', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(119, '2014-12-14 10:43:34', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(120, '2014-12-14 11:00:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(121, '2014-12-14 11:00:05', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(122, '2014-12-14 11:00:05', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(123, '2014-12-14 11:00:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(124, '2014-12-14 11:00:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(125, '2014-12-14 11:00:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(126, '2014-12-14 11:00:21', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(127, '2014-12-15 01:37:19', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/');
INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(128, '2014-12-15 01:41:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(129, '2014-12-15 01:41:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(130, '2014-12-15 01:51:16', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(131, '2014-12-15 01:51:16', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(132, '2014-12-15 01:52:42', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(133, '2014-12-15 01:52:51', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(134, '2014-12-15 01:52:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(135, '2014-12-15 01:52:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(136, '2014-12-15 01:52:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/pattern.jpg/'),
(137, '2014-12-15 01:52:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(138, '2014-12-15 01:52:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(139, '2014-12-15 01:58:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(140, '2014-12-15 01:58:10', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(141, '2014-12-15 01:58:14', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(142, '2014-12-15 02:16:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(143, '2014-12-15 02:17:07', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(144, '2014-12-15 02:17:44', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(145, '2014-12-15 02:17:56', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(146, '2014-12-15 02:18:29', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(147, '2014-12-15 03:12:32', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(148, '2014-12-15 03:29:00', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(149, '2014-12-15 03:44:56', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(150, '2014-12-15 04:01:54', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(151, '2014-12-15 04:01:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(152, '2014-12-15 04:01:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(153, '2014-12-15 04:01:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/pattern.jpg/'),
(154, '2014-12-15 04:01:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(155, '2014-12-15 04:02:04', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(156, '2014-12-15 04:02:09', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(157, '2014-12-15 04:11:20', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(158, '2014-12-15 04:11:23', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(159, '2014-12-15 04:15:48', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(160, '2014-12-15 04:20:41', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(161, '2014-12-15 07:09:21', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(162, '2014-12-15 08:21:38', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(163, '2014-12-15 08:50:17', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(164, '2014-12-15 10:52:27', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(165, '2014-12-15 10:52:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(166, '2014-12-15 10:52:31', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(167, '2014-12-15 10:52:31', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/pattern.jpg/'),
(168, '2014-12-15 10:52:31', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(169, '2014-12-15 10:52:33', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(170, '2014-12-15 10:52:35', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(171, '2014-12-15 10:56:55', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(172, '2014-12-15 10:57:03', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(173, '2014-12-15 10:57:55', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(174, '2014-12-15 11:07:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/');
INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(175, '2014-12-15 11:12:54', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(176, '2014-12-15 11:13:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(177, '2014-12-15 11:19:24', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(178, '2014-12-15 11:25:20', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(179, '2014-12-15 11:26:17', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(180, '2014-12-15 11:26:18', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(181, '2014-12-15 11:28:52', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(182, '2014-12-15 11:29:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(183, '2014-12-15 11:29:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(184, '2014-12-15 11:29:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/logo.jpg/'),
(185, '2014-12-15 11:29:09', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/pattern.jpg/'),
(186, '2014-12-15 11:29:09', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(187, '2014-12-15 11:29:09', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(188, '2014-12-15 11:29:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(189, '2014-12-15 11:30:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(190, '2014-12-15 11:30:36', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(191, '2014-12-15 11:30:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(192, '2014-12-15 11:40:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(193, '2014-12-15 11:40:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(194, '2014-12-15 11:40:27', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(195, '2014-12-15 11:40:27', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(196, '2014-12-15 11:40:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (styles)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/styles/contact.css'),
(197, '2014-12-15 11:40:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(198, '2014-12-15 11:40:50', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(199, '2014-12-15 11:42:03', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(200, '2014-12-15 11:42:13', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(201, '2014-12-15 11:42:25', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(202, '2014-12-15 11:42:54', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(203, '2014-12-15 11:43:05', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(204, '2014-12-15 11:45:42', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(205, '2014-12-15 11:45:57', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/sprite.png/'),
(206, '2014-12-15 11:45:58', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(207, '2014-12-15 11:46:05', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/marker.png/'),
(208, '2014-12-15 11:48:35', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(209, '2014-12-15 11:48:50', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(210, '2014-12-15 11:56:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(211, '2014-12-15 11:58:29', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(212, '2014-12-15 12:06:49', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(213, '2014-12-15 12:08:00', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(214, '2014-12-15 12:10:28', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(215, '2014-12-15 12:10:39', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(216, '2014-12-15 12:10:39', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(217, '2014-12-16 01:46:31', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(218, '2014-12-16 01:46:32', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(219, '2014-12-16 10:44:48', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(220, '2014-12-16 10:44:55', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(221, '2014-12-16 10:56:34', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(222, '2014-12-16 10:57:34', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(223, '2014-12-16 11:04:37', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(224, '2014-12-16 11:04:38', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(225, '2014-12-16 11:04:43', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(226, '2014-12-16 11:04:43', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(227, '2014-12-16 11:04:59', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(228, '2014-12-16 11:13:27', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(229, '2014-12-16 11:14:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(230, '2014-12-16 11:14:15', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(231, '2014-12-16 11:16:16', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(232, '2014-12-16 11:16:16', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(233, '2014-12-16 11:16:16', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(234, '2014-12-16 11:19:16', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif');
INSERT INTO `Logs` (`log_id`, `date`, `priority`, `type`, `message`, `user`, `ip`, `agent`, `url`) VALUES
(235, '2014-12-16 11:19:19', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(236, '2014-12-16 11:19:19', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(237, '2014-12-16 11:19:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(238, '2014-12-16 11:19:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(239, '2014-12-16 11:19:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(240, '2014-12-16 11:19:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (js)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/js/tiny_mce/langs/nl.js'),
(241, '2014-12-16 11:19:31', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(242, '2014-12-16 11:22:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(243, '2014-12-16 11:22:04', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(244, '2014-12-16 11:22:24', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(245, '2014-12-16 11:22:37', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(246, '2014-12-16 11:22:51', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(247, '2014-12-16 11:23:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(248, '2014-12-16 11:24:08', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(249, '2014-12-16 11:24:20', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(250, '2014-12-16 11:26:50', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/default/thumbnail.jpg/'),
(251, '2014-12-16 11:26:50', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/cms/templates/homepage/thumbnail.jpg/'),
(252, '2014-12-16 11:26:51', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(253, '2014-12-16 11:27:19', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(254, '2014-12-16 11:27:43', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work'),
(255, '2014-12-16 11:30:01', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(256, '2014-12-16 11:32:46', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(257, '2014-12-16 11:52:47', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(258, '2014-12-16 11:55:33', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(259, '2014-12-16 11:56:03', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(260, '2014-12-16 12:06:30', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(261, '2014-12-16 12:09:14', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (favicon.ico)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/favicon.ico'),
(262, '2014-12-16 12:20:03', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(263, '2014-12-16 12:27:26', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(264, '2014-12-16 12:27:28', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(265, '2014-12-17 01:44:27', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/ajax-loader.gif'),
(266, '2014-12-17 10:24:06', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(267, '2014-12-17 10:25:07', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(268, '2014-12-17 10:25:51', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(269, '2014-12-17 10:25:55', 3, 'EXCEPTION_NO_CONTROLLER', 'exception ''Zend_Controller_Dispatcher_Exception'' with message ''Invalid controller specified (images)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php:248\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#2 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/images/website/smith.ico/'),
(270, '2014-12-17 10:43:53', 3, 'EXCEPTION_OTHER', 'exception ''Zend_View_Exception'' with message ''script ''work/index.phtml'' not found in path (E:/xampp/htdocs/smithcode/smith/application/modules/default/views\\scripts/;./views\\scripts/)'' in E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php:976\nStack trace:\n#0 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\View\\Abstract.php(876): Zend_View_Abstract->_script(''work/index.phtm...'')\n#1 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(897): Zend_View_Abstract->render(''work/index.phtm...'')\n#2 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(918): Zend_Controller_Action_Helper_ViewRenderer->renderScript(''work/index.phtm...'', NULL)\n#3 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\Helper\\ViewRenderer.php(957): Zend_Controller_Action_Helper_ViewRenderer->render()\n#4 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action\\HelperBroker.php(277): Zend_Controller_Action_Helper_ViewRenderer->postDispatch()\n#5 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Action.php(523): Zend_Controller_Action_HelperBroker->notifyPostDispatch()\n#6 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Dispatcher\\Standard.php(295): Zend_Controller_Action->dispatch(''indexAction'')\n#7 E:\\xampp\\htdocs\\smithcode\\smith\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#8 E:\\xampp\\htdocs\\smithcode\\smith\\public_html\\index.php(10): Zend_Controller_Front->dispatch()\n#9 {main}', 'anonymous', '192.168.1.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '/en/work');

-- --------------------------------------------------------

--
-- Table structure for table `Member`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MemberGroups`
--

CREATE TABLE IF NOT EXISTS `MemberGroups` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MemberGroups`
--

INSERT INTO `MemberGroups` (`member_id`, `group_id`) VALUES
(24, 1),
(24, 12),
(2, 2),
(2, 9),
(24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `MemberMail`
--

CREATE TABLE IF NOT EXISTS `MemberMail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `reply_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MemberMailTsl`
--

CREATE TABLE IF NOT EXISTS `MemberMailTsl` (
  `mail_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Members`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `News`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `NewsTsl`
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

-- --------------------------------------------------------

--
-- Table structure for table `Page`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`page_id`, `parent_id`, `author_id`, `layout`, `type`, `navigation`, `sitemap`, `comments`, `thumb`, `locked_by`, `date_locked`, `date_created`, `date_updated`, `date_published`, `date_expired`) VALUES
(0, 0, 1, 'homepage', 0, 1, 0, 0, '', 0, '0000-00-00 00:00:00', '2009-08-01 00:00:00', '2014-12-12 23:56:13', '2009-08-01 00:00:00', NULL),
(1, 0, 1, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2014-12-12 23:26:38', '2014-12-14 18:58:13', '2014-12-12 07:00:00', NULL),
(2, 0, 1, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2014-12-12 23:27:17', '2014-12-16 04:27:18', '2014-12-12 07:00:00', NULL),
(4, 0, 1, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2014-12-12 23:35:37', '2014-12-16 04:22:24', '2014-12-12 07:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `PageAcl`
--

CREATE TABLE IF NOT EXISTS `PageAcl` (
  `page_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  KEY `page_id` (`page_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PageComment`
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
-- Table structure for table `PagePictures`
--

CREATE TABLE IF NOT EXISTS `PagePictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `season` tinyint(1) NOT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PagePicturesTsl`
--

CREATE TABLE IF NOT EXISTS `PagePicturesTsl` (
  `picture_id` int(12) NOT NULL,
  `text` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  KEY `picture_id` (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PageRev`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `PageRev`
--

INSERT INTO `PageRev` (`revision_id`, `page_id`, `language`, `author_id`, `reviewer_id`, `notes`, `approved`, `title`, `title_fb`, `summary`, `summary_fb`, `content`, `content_fb`, `source`, `source_fb`, `link`, `link_fb`, `date_created`, `date_revised`, `invisible`, `seotitle`, `seotags`, `seodescription`) VALUES
(89, 0, 'en', 1, 1, 'Page edited', 1, 'HOME', 0, 'home', 0, '<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim, enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut viverra metus commodo. Nam semper blandit lacus quis aliquet. In et egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus elit ac tempus.</p>\r\n<p>Nullam eget dui tincidunt ante sollicitudin tincidunt. Phasellus a egestas lacus. Duis id urna orci, sit amet luctus justo. Nam euismod dignissim ultrices. Praesent non dolor nec nisl sodales congue. Nunc lacus arcu, adipiscing id egestas id, lacinia adipiscing nunc. Praesent sed luctus sapien. Ut sodales, mauris vel ultricies fermentum, erat diam facilisis tellus, non adipiscing dolor justo nec nunc. Cras vel nibh dolor. Morbi venenatis enim nec ipsum dapibus vel commodo augue dignissim.</p>', 0, '', 0, NULL, 0, '2014-12-12 23:26:02', '2014-12-12 23:26:02', 0, '', '', ''),
(90, 1, 'en', 1, 1, 'New page created', 1, 'WORK', 0, 'work summary', 0, '<p>work content</p>', 0, '', 0, 'work', 0, '2014-12-12 23:26:38', '2014-12-12 23:26:38', 0, '', '', ''),
(91, 2, 'en', 1, 1, 'New page created', 1, 'ABOUT', 0, 'about summary', 0, '<p>about content</p>', 0, '', 0, 'about', 0, '2014-12-12 23:27:17', '2014-12-12 23:27:17', 0, '', '', ''),
(94, 4, 'en', 1, 1, 'New page created', 1, 'CONTACT', 0, 'contact summary', 0, '<p>contact content</p>', 0, '', 0, 'contact', 0, '2014-12-12 23:35:38', '2014-12-12 23:35:38', 0, '', '', ''),
(95, 0, 'en', 1, 1, 'Page edited', 1, 'HOME', 0, 'home', 0, '<h1>FREELANCE DIGITAL</h1>\r\n<h2>UI UX DESIGNER</h2>', 0, '', 0, NULL, 0, '2014-12-12 23:56:13', '2014-12-12 23:56:13', 0, '', '', ''),
(96, 2, 'en', 1, 1, 'Page edited', 1, 'ABOUT', 0, 'about summary', 0, '<h1>Get to know me</h1>\r\n<p>I&rsquo;m a freelance UI/UX designer based in Ha Noi . When I''m not working with clients I''m creating my own things. I''m not available for fulltime job but whether you would like my services for a project, get extra information on any of my work, or just say hello then I would love to hear from you.</p>\r\n<p>&nbsp;</p>\r\n<h3>Adward</h3>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://google.com" target="_blank">Link</a></li>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://facebook.com" target="_blank">Link</a></li>\r\n</ul>', 0, '', 0, 'about', 0, '2014-12-14 03:38:54', '2014-12-14 03:38:54', 0, '', '', ''),
(97, 2, 'en', 1, 1, 'Page edited', 1, 'ABOUT', 0, 'about summary', 0, '<h1>Get to know me</h1>\r\n<p>I&rsquo;m a freelance UI/UX designer based in Ha Noi. When I''m not working with clients I''m creating my own things. I''m not available for fulltime job but whether you would like my services for a project, get extra information on any of my work, or just say hello then I would love to hear from you.</p>\r\n<p>&nbsp;</p>\r\n<h3>Adward</h3>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://google.com" target="_blank">Link</a></li>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://facebook.com" target="_blank">Link</a></li>\r\n</ul>', 0, '', 0, 'about', 0, '2014-12-14 04:00:20', '2014-12-14 04:00:20', 0, '', '', ''),
(98, 1, 'en', 1, 1, 'Page edited', 1, 'WORK', 0, 'work summary', 0, '<p>work content</p>', 0, '', 0, 'work', 0, '2014-12-14 18:58:13', '2014-12-14 18:58:13', 0, '', '', ''),
(99, 2, 'en', 1, 1, 'Page edited', 1, 'ABOUT', 0, 'about summary', 0, '<h1>Get to know me</h1>\r\n<p>I&rsquo;m a freelance UI/UX designer based in Ha Noi. When I''m not working with clients I''m creating my own things. I''m not available for fulltime job but whether you would like my services for a project, get extra information on any of my work, or just say hello then I would love to hear from you.</p>\r\n<p>&nbsp;</p>\r\n<h3>Award</h3>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://google.com" target="_blank">Link</a></li>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://facebook.com" target="_blank">Link</a></li>\r\n</ul>', 0, '', 0, 'about', 0, '2014-12-16 04:04:59', '2014-12-16 04:04:59', 0, '', '', ''),
(100, 4, 'en', 1, 1, 'Page edited', 1, 'CONTACT', 0, 'contact summary', 0, '<h1>Say Hello!</h1>\r\n<p>thieusmith@gmail.com<br />facebook<br />H&agrave; Nội - Việt Nam</p>', 0, '', 0, 'contact', 0, '2014-12-16 04:19:15', '2014-12-16 04:19:15', 0, '', '', ''),
(101, 4, 'en', 1, 1, 'Page edited', 1, 'CONTACT', 0, 'contact summary', 0, '<h1>Say Hello!</h1>\r\n<p>thieusmith@gmail.com<br />facebook<br />H&agrave; Nội - Việt Nam</p>', 0, '', 0, 'contact', 0, '2014-12-16 04:22:24', '2014-12-16 04:22:24', 0, '', '', ''),
(102, 2, 'en', 1, 1, 'Page edited', 1, 'ABOUT', 0, 'about summary', 0, '<h1>GET TO KNOW ME</h1>\r\n<p>I&rsquo;m a freelance UI/UX designer based in Ha Noi. When I''m not working with clients I''m creating my own things. I''m not available for fulltime job but whether you would like my services for a project, get extra information on any of my work, or just say hello then I would love to hear from you.</p>\r\n<p>&nbsp;</p>\r\n<h3>Award</h3>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://google.com" target="_blank">Link</a></li>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://facebook.com" target="_blank">Link</a></li>\r\n</ul>', 0, '', 0, 'about', 0, '2014-12-16 04:27:18', '2014-12-16 04:27:18', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `PageTag`
--

CREATE TABLE IF NOT EXISTS `PageTag` (
  `page_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PageTsl`
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
-- Dumping data for table `PageTsl`
--

INSERT INTO `PageTsl` (`page_id`, `language`, `title`, `title_fb`, `summary`, `summary_fb`, `source`, `source_fb`, `content`, `content_fb`, `link`, `link_fb`, `final`, `invisible`, `seotitle`, `seotags`, `seodescription`) VALUES
(0, 'nl', 'home', 0, 'home', 0, '', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut tellus neque. Cras volutpat mattis ligula, nec egestas felis consectetur vitae. Mauris id dolor mauris, a feugiat libero. Cras ut interdum neque. Mauris posuere fermentum justo, vel dictum mauris imperdiet eget. Mauris hendrerit, mauris vitae varius volutpat, quam tortor adipiscing lacus, ac ullamcorper velit odio sit amet justo. Etiam id ligula et nulla accumsan adipiscing. Nulla varius neque non magna varius suscipit. Aliquam leo mauris, pretium tristique hendrerit id, dictum vitae turpis. Cras quis sodales velit. Nullam vel mauris a erat commodo tempus id ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia fringilla leo, sit amet ornare lacus ullamcorper eu.</p>\r\n<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan.</p>', 0, NULL, 0, 0, 0, 'Home', 'test', 'test'),
(0, 'fr', 'home', 0, 'home', 0, '', 0, '<p>Mauris nisl nulla, vehicula eu blandit non, porttitor id lacus. Nullam velit erat, volutpat sed tristique eu, ultricies non sapien. Nam sed dui condimentum tellus blandit mollis. Aliquam iaculis, ipsum sed ornare convallis, leo purus adipiscing dui, eu vulputate neque augue sed diam. Praesent malesuada libero varius lorem mollis tempor. Nullam bibendum tempor turpis, et vestibulum lorem blandit a. Quisque luctus pellentesque massa eu ultricies. Fusce et tortor eu ligula eleifend vulputate. Fusce faucibus gravida elementum. Vestibulum lacus diam, pellentesque a convallis a, aliquam at lacus. Morbi semper urna nec lacus interdum accumsan. Morbi mattis dui et est luctus in volutpat urna volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum malesuada viverra massa, fermentum vehicula lorem sodales tempor. Curabitur massa purus, dapibus sed bibendum nec, tincidunt at enim. Aliquam porta, enim at rhoncus consectetur, ipsum nisl dapibus odio, ac consectetur eros ipsum iaculis quam. Phasellus tristique rutrum dolor non feugiat. Cras id tortor nunc. Cras laoreet vehicula neque non malesuada. Proin urna risus, scelerisque sit amet semper ac, varius at nisi.</p>\r\n<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim, enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut viverra metus commodo. Nam semper blandit lacus quis aliquet. In et egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus elit ac tempus.</p>', 0, NULL, 0, 1, 0, '', '', ''),
(0, 'en', 'HOME', 0, 'home', 0, '', 0, '<h1>FREELANCE DIGITAL</h1>\r\n<h2>UI UX DESIGNER</h2>', 0, NULL, 0, 0, 0, '', '', ''),
(0, 'de', 'home', 0, 'home', 0, NULL, 0, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>', 0, NULL, 0, 1, 0, '', '', ''),
(1, 'en', 'WORK', 0, 'work summary', 0, '', 0, '<p>work content</p>', 0, 'work', 0, 0, 0, '', '', ''),
(2, 'en', 'ABOUT', 0, 'about summary', 0, '', 0, '<h1>GET TO KNOW ME</h1>\r\n<p>I&rsquo;m a freelance UI/UX designer based in Ha Noi. When I''m not working with clients I''m creating my own things. I''m not available for fulltime job but whether you would like my services for a project, get extra information on any of my work, or just say hello then I would love to hear from you.</p>\r\n<p>&nbsp;</p>\r\n<h3>Award</h3>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://google.com" target="_blank">Link</a></li>\r\n<li>Lorem ipsum dolor sit amet - <a href="http://facebook.com" target="_blank">Link</a></li>\r\n</ul>', 0, 'about', 0, 0, 0, '', '', ''),
(4, 'en', 'CONTACT', 0, 'contact summary', 0, '', 0, '<h1>Say Hello!</h1>\r\n<p>thieusmith@gmail.com<br />facebook<br />H&agrave; Nội - Việt Nam</p>', 0, 'contact', 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
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
-- Table structure for table `ProductTsl`
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
-- Table structure for table `Publication`
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
-- Table structure for table `PublicationCat`
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
-- Table structure for table `Quicklinks`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SecureDocsFolder`
--

CREATE TABLE IF NOT EXISTS `SecureDocsFolder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `foldername` varchar(255) NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SecureDocsGroup`
--

CREATE TABLE IF NOT EXISTS `SecureDocsGroup` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SecureDocsGroupMaps`
--

CREATE TABLE IF NOT EXISTS `SecureDocsGroupMaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `mapname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SecureFilemanager`
--

CREATE TABLE IF NOT EXISTS `SecureFilemanager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `mail` tinyint(1) NOT NULL,
  `summary` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Sheets`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SheetsSubtype`
--

CREATE TABLE IF NOT EXISTS `SheetsSubtype` (
  `subtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`subtype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SheetsSubtypeTsl`
--

CREATE TABLE IF NOT EXISTS `SheetsSubtypeTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subtype_id` int(11) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SheetsTsl`
--

CREATE TABLE IF NOT EXISTS `SheetsTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `t_desc` text NOT NULL,
  `t_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SheetsType`
--

CREATE TABLE IF NOT EXISTS `SheetsType` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SheetsTypeTsl`
--

CREATE TABLE IF NOT EXISTS `SheetsTypeTsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Subscribe`
--

CREATE TABLE IF NOT EXISTS `Subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lng` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SubscribeMail`
--

CREATE TABLE IF NOT EXISTS `SubscribeMail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `reply_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SubscribeMailTsl`
--

CREATE TABLE IF NOT EXISTS `SubscribeMailTsl` (
  `mail_id` int(11) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Survey`
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
-- Table structure for table `SurveyQuestion`
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
-- Table structure for table `SurveyQuestionAnswer`
--

CREATE TABLE IF NOT EXISTS `SurveyQuestionAnswer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Ticker`
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
-- Table structure for table `TopcontentBlocks`
--

CREATE TABLE IF NOT EXISTS `TopcontentBlocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blockname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TopcontentBlocksTsl`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `email`, `password`, `active`, `first_name`, `last_name`, `date_created`, `date_updated`) VALUES
(0, 'info@sanmax.be', '3b3108ab8c18aa16565db860a7cb70b4ee04e1f7', 1, 'Sanmax', 'Consultancy', '2009-01-01 00:00:00', '2010-03-02 00:00:00'),
(1, 'thieusmith@gmail.com', '3bf264855de091c7c87ff95bc1710d1fe6dd08c9', 1, 'Thieu', 'Smith', '2013-05-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UserGroup`
--

CREATE TABLE IF NOT EXISTS `UserGroup` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(255) unsigned NOT NULL,
  KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UserGroup`
--

INSERT INTO `UserGroup` (`user_id`, `group_id`) VALUES
(0, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Vacancy`
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
-- Table structure for table `VacancyCat`
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
-- Table structure for table `WebTv`
--

CREATE TABLE IF NOT EXISTS `WebTv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `date_published` date NOT NULL,
  `youtube` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `WebTvTsl`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `PageComment`
--
ALTER TABLE `PageComment`
  ADD CONSTRAINT `PageComment_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `Page` (`page_id`) ON DELETE CASCADE;

--
-- Constraints for table `PageRev`
--
ALTER TABLE `PageRev`
  ADD CONSTRAINT `PageRev_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `Page` (`page_id`) ON DELETE CASCADE;

--
-- Constraints for table `PageTag`
--
ALTER TABLE `PageTag`
  ADD CONSTRAINT `PageTag_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `Page` (`page_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
