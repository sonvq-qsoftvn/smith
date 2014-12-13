-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2014 at 11:33 PM
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CasesPicturesTsl`
--

CREATE TABLE IF NOT EXISTS `CasesPicturesTsl` (
  `picture_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `EventSettings`
--

CREATE TABLE IF NOT EXISTS `EventSettings` (
  `variable` varchar(20) NOT NULL,
  `value` text,
  `language` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `GalleryPicturesTsl`
--

CREATE TABLE IF NOT EXISTS `GalleryPicturesTsl` (
  `picture_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`page_id`, `parent_id`, `author_id`, `layout`, `type`, `navigation`, `sitemap`, `comments`, `thumb`, `locked_by`, `date_locked`, `date_created`, `date_updated`, `date_published`, `date_expired`) VALUES
(0, 0, 1, 'homepage', 0, 1, 0, 0, '', 0, '0000-00-00 00:00:00', '2009-08-01 00:00:00', '2014-12-12 23:26:02', '2009-08-01 00:00:00', NULL),
(1, 0, 1, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2014-12-12 23:26:38', '2014-12-12 23:26:38', '2014-12-12 07:00:00', NULL),
(2, 0, 1, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2014-12-12 23:27:17', '2014-12-12 23:27:17', '2014-12-12 07:00:00', NULL),
(3, 0, 1, 'default', 0, 1, 1, 0, NULL, 0, '0000-00-00 00:00:00', '2014-12-12 23:28:15', '2014-12-12 23:28:15', '2014-12-13 07:00:00', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `PageRev`
--

INSERT INTO `PageRev` (`revision_id`, `page_id`, `language`, `author_id`, `reviewer_id`, `notes`, `approved`, `title`, `title_fb`, `summary`, `summary_fb`, `content`, `content_fb`, `source`, `source_fb`, `link`, `link_fb`, `date_created`, `date_revised`, `invisible`, `seotitle`, `seotags`, `seodescription`) VALUES
(89, 0, 'en', 1, 1, 'Page edited', 1, 'HOME', 0, 'home', 0, '<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim, enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut viverra metus commodo. Nam semper blandit lacus quis aliquet. In et egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus elit ac tempus.</p>\r\n<p>Nullam eget dui tincidunt ante sollicitudin tincidunt. Phasellus a egestas lacus. Duis id urna orci, sit amet luctus justo. Nam euismod dignissim ultrices. Praesent non dolor nec nisl sodales congue. Nunc lacus arcu, adipiscing id egestas id, lacinia adipiscing nunc. Praesent sed luctus sapien. Ut sodales, mauris vel ultricies fermentum, erat diam facilisis tellus, non adipiscing dolor justo nec nunc. Cras vel nibh dolor. Morbi venenatis enim nec ipsum dapibus vel commodo augue dignissim.</p>', 0, '', 0, NULL, 0, '2014-12-12 23:26:02', '2014-12-12 23:26:02', 0, '', '', ''),
(90, 1, 'en', 1, 1, 'New page created', 1, 'WORK', 0, 'work summary', 0, '<p>work content</p>', 0, '', 0, 'work', 0, '2014-12-12 23:26:38', '2014-12-12 23:26:38', 0, '', '', ''),
(91, 2, 'en', 1, 1, 'New page created', 1, 'ABOUT', 0, 'about summary', 0, '<p>about content</p>', 0, '', 0, 'about', 0, '2014-12-12 23:27:17', '2014-12-12 23:27:17', 0, '', '', ''),
(92, 3, 'en', 1, 1, 'New page created', 1, 'CONTACT', 0, 'contact summary', 0, '<p>contact content</p>', 0, '', 0, 'contact', 0, '2014-12-12 23:28:15', '2014-12-12 23:28:15', 0, '', '', '');

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
(0, 'en', 'HOME', 0, 'home', 0, '', 0, '<p>Nullam venenatis, dui vel auctor tristique, est dui cursus enim, eget aliquam libero lectus ac nulla. In volutpat, ante in placerat dignissim, enim elit sodales mi, ac dictum erat est sit amet est. Suspendisse luctus laoreet velit, non accumsan quam fringilla sit amet. Nunc mauris magna, imperdiet ut dignissim et, vestibulum sit amet erat. Sed ac sem orci, nec commodo augue. Curabitur aliquet nibh ut lectus auctor ut viverra metus commodo. Nam semper blandit lacus quis aliquet. In et egestas purus. Sed auctor volutpat lacus. Sed sed eros in lorem pulvinar gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida, augue ut cursus placerat, magna leo ornare diam, eu malesuada nunc enim in velit. Sed id consequat nibh. In velit dui, tristique ut faucibus pulvinar, molestie at quam. Maecenas imperdiet dictum justo in suscipit. Ut vel mi at quam aliquam convallis. Duis pharetra rhoncus elit ac tempus.</p>\r\n<p>Nullam eget dui tincidunt ante sollicitudin tincidunt. Phasellus a egestas lacus. Duis id urna orci, sit amet luctus justo. Nam euismod dignissim ultrices. Praesent non dolor nec nisl sodales congue. Nunc lacus arcu, adipiscing id egestas id, lacinia adipiscing nunc. Praesent sed luctus sapien. Ut sodales, mauris vel ultricies fermentum, erat diam facilisis tellus, non adipiscing dolor justo nec nunc. Cras vel nibh dolor. Morbi venenatis enim nec ipsum dapibus vel commodo augue dignissim.</p>', 0, NULL, 0, 0, 0, '', '', ''),
(0, 'de', 'home', 0, 'home', 0, NULL, 0, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>', 0, NULL, 0, 1, 0, '', '', ''),
(1, 'en', 'WORK', 0, 'work summary', 0, '', 0, '<p>work content</p>', 0, 'work', 0, 0, 0, '', '', ''),
(2, 'en', 'ABOUT', 0, 'about summary', 0, '', 0, '<p>about content</p>', 0, 'about', 0, 0, 0, '', '', ''),
(3, 'en', 'CONTACT', 0, 'contact summary', 0, '', 0, '<p>contact content</p>', 0, 'contact', 0, 0, 0, '', '', '');

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
