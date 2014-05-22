-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Време на генериране: 
-- Версия на сървъра: 5.5.27
-- Версия на PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `vedis`
--

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `cattalogueID` int(11) unsigned NOT NULL COMMENT 'catalogue number',
  `typeID` tinyint(3) unsigned NOT NULL COMMENT 'type foregn key',
  `genderID` tinyint(3) unsigned NOT NULL COMMENT 'gender foreign key',
  `usageID` tinyint(3) unsigned NOT NULL COMMENT 'usage foreign key',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active',
  PRIMARY KEY (`productID`),
  KEY `typeID` (`typeID`),
  KEY `genderID` (`genderID`),
  KEY `usageID` (`usageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `product_gender`
--

CREATE TABLE IF NOT EXISTS `product_gender` (
  `genderID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`genderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Ссхема на данните от таблица `product_gender`
--

INSERT INTO `product_gender` (`genderID`, `name`) VALUES
(1, 'Дамски'),
(2, 'Мъжки'),
(3, 'Унисекс');

-- --------------------------------------------------------

--
-- Структура на таблица `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `imageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productID` int(11) unsigned NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`imageID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `typeID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Ссхема на данните от таблица `product_type`
--

INSERT INTO `product_type` (`typeID`, `name`) VALUES
(1, 'Чанти');

-- --------------------------------------------------------

--
-- Структура на таблица `product_usage`
--

CREATE TABLE IF NOT EXISTS `product_usage` (
  `usageID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`usageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Ссхема на данните от таблица `product_usage`
--

INSERT INTO `product_usage` (`usageID`, `name`) VALUES
(1, 'Ежедневни'),
(2, 'Официални'),
(3, 'Спортни');

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`typeID`) REFERENCES `product_type` (`typeID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`genderID`) REFERENCES `product_gender` (`genderID`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`usageID`) REFERENCES `product_usage` (`usageID`);

--
-- Ограничения за таблица `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
