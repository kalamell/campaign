-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2018 at 11:40 AM
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
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `campaign_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `total_user` int(100) NOT NULL,
  `lucky_draw` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `on_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaign_id`, `member_id`, `campaign_name`, `total_user`, `lucky_draw`, `on_date`, `end_date`) VALUES
(1, 1, 'Friday Night #10', 100, '0', '2018-02-19', '2018-02-28'),
(2, 1, '#2', 10, '1', '2018-02-19', '2018-02-21');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `name`, `email`, `mobile`, `startdate`, `enddate`, `active`, `isstaff`) VALUES
(1, 'member', '6467baa3b187373e3931422e2a8ef22f3e447d77', 'บัณฑิต แสนคำภา', 'sankhumpha84@gmail.com', '0954027399', '2018-02-19', '2018-02-28', 1, 'N'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', '-', '-', '0000-00-00', '0000-00-00', 1, 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
