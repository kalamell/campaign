-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 12:19 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `campaign`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `campaign_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `total_user` int(100) NOT NULL,
  `lucky_draw` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `on_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaign_id`, `member_id`, `campaign_name`, `total_user`, `lucky_draw`, `on_date`, `end_date`) VALUES
('r1A46', 5, 'Major 2018', 250, '1', '2018-02-27', '2018-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `campaign_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`, `campaign_id`) VALUES
(1, 'Production', 'r1A46'),
(8, 'MAG', '4'),
(9, 'MGC', '4'),
(10, 'MAXI', '4'),
(11, 'MCR', '4'),
(12, 'MDS', '4'),
(13, 'AM', '4'),
(14, 'RR', '4'),
(15, 'SHA', '4'),
(16, 'AZM', '4'),
(17, 'i24', '4'),
(18, 'MAT', '4'),
(19, 'MMS', '4'),
(20, 'MS', '4'),
(21, 'US', '4'),
(22, 'YHM', '4'),
(23, '', '4'),
(24, 'ตัวย่อ บริษัท', '4');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `active` int(1) NOT NULL,
  `isstaff` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `name`, `email`, `mobile`, `startdate`, `enddate`, `active`, `isstaff`) VALUES
(1, 'member', '6467baa3b187373e3931422e2a8ef22f3e447d77', 'บัณฑิต แสนคำภา', 'sankhumpha84@gmail.com', '0954027399', '2018-02-19', '2018-02-28', 1, 'N'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', '-', '-', '0000-00-00', '0000-00-00', 1, 'Y'),
(5, 'test', '9bc34549d565d9505b287de0cd20ac77be1d3f2c', 'test', 'cheetah_ok@hotmail.com', '0852120255', '2018-02-23', '2018-02-25', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `prize`
--

CREATE TABLE IF NOT EXISTS `prize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` int(11) NOT NULL,
  `staff_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_dep` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fix_staff_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_id` (`staff_id`),
  KEY `group_id` (`name`),
  KEY `order` (`order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `staff_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dep_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checkin` datetime DEFAULT NULL,
  `prize_id` int(11) DEFAULT NULL,
  `prize_date` datetime DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `campaign_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `no_prize` int(11) NOT NULL,
  `lotto_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`,`prize_id`,`prize_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `staff_code`, `dep_id`, `name`, `position`, `email`, `mobile`, `checkin`, `prize_id`, `prize_date`, `group_id`, `campaign_id`, `no_prize`, `lotto_no`) VALUES
(1, 'P00001', 'Vax9A', 1, 'บัณฑิต', 'แสนคำภา', '', '0000000000', '2018-02-27 18:04:50', NULL, NULL, NULL, 'r1A46', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
