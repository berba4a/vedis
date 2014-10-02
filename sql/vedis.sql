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
-- Структура на таблица `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `cityID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=256 ;

--
-- Ссхема на данните от таблица `cities`
--

INSERT INTO `cities` (`cityID`, `city_name`, `post_code`) VALUES
(1, 'София', '1000'),
(2, 'Пловдив', '4000'),
(3, 'Варна', '9000'),
(4, 'Бургас', '8000'),
(5, 'Русе', '7000'),
(6, 'Стара Загора', '6000'),
(7, 'Плевен', '5800'),
(8, 'Добрич', '9300'),
(9, 'Сливен', '8800'),
(10, 'Шумен', '9700'),
(11, 'Перник', '2300'),
(12, 'Ямбол', '8600'),
(13, 'Хасково', '6300'),
(14, 'Пазарджик', '4400'),
(15, 'Благоевград', '2700'),
(16, 'Велико Търново', '5000'),
(17, 'Враца', '3000'),
(18, 'Габрово', '5300'),
(19, 'Видин', '3700'),
(20, 'Асеновград', '4230'),
(21, 'Казанлък', '6100'),
(22, 'Кюстендил', '2500'),
(23, 'Кърджали', '6600'),
(24, 'Монтана', '3400'),
(25, 'Димитровград', '6400'),
(26, 'Търговище', '7700'),
(27, 'Силистра', '7500'),
(28, 'Ловеч', '5500'),
(29, 'Дупница', '2600'),
(30, 'Разград', '7200'),
(31, 'Свищов', '5250'),
(32, 'Горна Оряховица', '5100'),
(33, 'Смолян', '4700'),
(34, 'Петрич', '2850'),
(35, 'Сандански', '2800'),
(36, 'Самоков', '2000'),
(37, 'Севлиево', '5400'),
(38, 'Лом', '3600'),
(39, 'Велинград', '4600'),
(40, 'Карлово', '4300'),
(41, 'Нова Загора', '8900'),
(42, 'Троян', '5600'),
(43, 'Айтос', '8500'),
(44, 'Ботевград', '2140'),
(45, 'Пещера', '4550'),
(46, 'Гоце Делчев', '2900'),
(47, 'Харманли', '6450'),
(48, 'Карнобат', '8400'),
(49, 'Свиленград', '6500'),
(50, 'Панагюрище', '4500'),
(51, 'Чирпан', '6200'),
(52, 'Попово', '7800'),
(53, 'Раковски', '4150'),
(54, 'Радомир', '2400'),
(55, 'Червен бряг', '5980'),
(56, 'Първомай', '4270'),
(57, 'Берковица', '3500'),
(58, 'Козлодуй', '3320'),
(59, 'Поморие', '8200'),
(60, 'Нови пазар', '9900'),
(61, 'Нови Искър', '1000'),
(62, 'Раднево', '6260'),
(63, 'Провадия', '9200'),
(64, 'Ихтиман', '2050'),
(65, 'Несебър', '8230'),
(66, 'Бяла Слатина', '3000'),
(67, 'Разлог', '2760'),
(68, 'Балчик', '9600'),
(69, 'Стамболийски', '4210'),
(70, 'Каварна', '9650'),
(71, 'Костинброд', '2230'),
(72, 'Павликени', '5200'),
(73, 'Мездра', '3100'),
(74, 'Кнежа', '5835'),
(75, 'Етрополе', '2180'),
(76, 'Левски', '5900'),
(77, 'Банкя', '1320'),
(78, 'Елхово', '8700'),
(79, 'Тетевен', '5700'),
(80, 'Трявна', '5350'),
(81, 'Луковит', '5770'),
(82, 'Тутракан', '7600'),
(83, 'Сопот', '4330'),
(84, 'Исперих', '7400'),
(85, 'Бяла', '7100'),
(86, 'Девня', '9160'),
(87, 'Средец', '8300'),
(88, 'Омуртаг', '7900'),
(89, 'Велики Преслав', '9850'),
(90, 'Гълъбово', '6280'),
(91, 'Лясковец', '5140'),
(92, 'Белене', '5930'),
(93, 'Кричим', '4220'),
(94, 'Септември', '4490'),
(95, 'Ракитово', '4640'),
(96, 'Момчилград', '6800'),
(97, 'Банско', '2770'),
(98, 'Дряново', '5370'),
(99, 'Белослав', '9178'),
(100, 'Кубрат', '7300'),
(101, 'Своге', '2260'),
(102, 'Аксаково', '9154'),
(103, 'Любимец', '6550'),
(104, 'Пирдоп', '2070'),
(105, 'Хисаря', '4180'),
(106, 'Златоград', '4980'),
(107, 'Сливница', '2200'),
(108, 'Симитли', '2730'),
(109, 'Симеоновград', '6490'),
(110, 'Долни чифлик', '9120'),
(111, 'Генерал Тошево', '9500'),
(112, 'Елин Пелин', '2100'),
(113, 'Дулово', '7650'),
(114, 'Костенец', '2030'),
(115, 'Девин', '4800'),
(116, 'Тервел', '9450'),
(117, 'Мадан', '4900'),
(118, 'Вършец', '3540'),
(119, 'Бобов дол', '2670'),
(120, 'Стралджа', '8680'),
(121, 'Царево', '8260'),
(122, 'Котел', '8970'),
(123, 'Твърдица', '8890'),
(124, 'Елена', '5070'),
(125, 'Куклен', '4101'),
(126, 'Съединение', '4190'),
(127, 'Оряхово', '3300'),
(128, 'Тополовград', '6560'),
(129, 'Якоруда', '2790'),
(130, 'Созопол', '8130'),
(131, 'Белоградчик', '3900'),
(132, 'Чепеларе', '4850'),
(133, 'Стражица', '5150'),
(134, 'Камено', '8120'),
(135, 'Перущица', ' 4225'),
(136, 'Божурище', '2227'),
(137, 'Златица', '2080'),
(138, 'Суворово', '9170'),
(139, 'Крумовград', '6900'),
(140, 'Дългопол', '9250'),
(141, 'Ветово', '7080'),
(142, 'Долна баня', '2040'),
(143, 'Полски Тръмбеш', '5180'),
(144, 'Койнаре', '5986'),
(145, 'Долни Дъбник', '5870'),
(146, 'Тръстеник', '5857'),
(147, 'Неделино', '4990'),
(148, 'Славяново', '5840'),
(149, 'Правец', '2161'),
(150, 'Годеч', '2240'),
(151, 'Брацигово', '4579'),
(152, 'Стрелча', '4530'),
(153, 'Две могили', '7150'),
(154, 'Костандово', '4644'),
(155, 'Игнатиево', '9143'),
(156, 'Свети Влас', '8256'),
(157, 'Смядово', '9820'),
(158, 'Брезник', '2360'),
(159, 'Сапарева баня', '2650'),
(160, 'Дебелец', '5030'),
(161, 'Никопол', '5940'),
(162, 'Белово', '4470'),
(163, 'Ардино', '6750'),
(164, 'Цар Калоян', '7280'),
(165, 'Ивайловград', '6570'),
(166, 'Шивачево', '8895'),
(167, 'Рудозем', '4960'),
(168, 'Вълчедръм', '3650'),
(169, 'Летница', '5570'),
(170, 'Мартен', '7058'),
(171, 'Искър', '5972'),
(172, 'Приморско', '8180'),
(173, 'Глоджево', '7040'),
(174, 'Кресна', '2840'),
(175, 'Върбица', '9870'),
(176, 'Сърница', '4633'),
(177, 'Шабла', '9680'),
(178, 'Гулянци', '5960'),
(179, 'Долна Митрополия', '5855'),
(180, 'Батак', '4580'),
(181, 'Мъглиж', '6180'),
(182, 'Мизия', '3330'),
(183, 'Кула', '3800'),
(184, 'Баня - Община Карлово', '4360'),
(185, 'Криводол', '3060'),
(186, 'Завет', '7330'),
(187, 'Сливо поле', '7060'),
(188, 'Каспичан', '9930'),
(189, 'Драгоман', '2210'),
(190, 'Ветрен', '4480'),
(191, 'Сунгурларе', '8470'),
(192, 'Белица', '2780'),
(193, 'Роман', '3130'),
(194, 'Джебел', '6850'),
(195, 'Калофер', '4370'),
(196, 'Априлци', '5641'),
(197, 'Николаево', '6190'),
(198, 'Гурково', '6199'),
(199, 'Бухово', '1830'),
(200, 'Павел баня', '6155'),
(201, 'Долна Оряховица', '5130'),
(202, 'Опака', '7840'),
(203, 'Каблешково', '8210'),
(204, 'Рила', '2630'),
(205, 'Ябланица', '5750'),
(206, 'Хаджидимово', '2933'),
(207, 'Угърчин', '5580'),
(208, 'Златарица', '5090'),
(209, 'Добринище', '2777'),
(210, 'Бяла черква', '5220'),
(211, 'Дунавци', '3740'),
(212, 'Брегово', '3790'),
(213, 'Трън', '2460'),
(214, 'Лъки', '4241'),
(215, 'Малко Търново', '8162'),
(216, 'Копривщица', '2077'),
(217, 'Садово', '4122'),
(218, 'Доспат', '4831'),
(219, 'Борово', '7174'),
(220, 'Кочериново', '2640'),
(221, 'Обзор', '8250'),
(222, 'Килифарево', '5050'),
(223, 'Лозница', '7290'),
(224, 'Бяла', '9101'),
(225, 'Батановци', '2340'),
(226, 'Черноморец', '8142'),
(227, 'Пордим', '5898'),
(228, 'Ахелой', '8217'),
(229, 'Сухиндол', '5240'),
(230, 'Българово', '8110'),
(231, 'Чипровци', '3460'),
(232, 'Главиница', '7630'),
(233, 'Брезово', '4160'),
(234, 'Кермен', '8870'),
(235, 'Меричлери', '6430'),
(236, 'Плачковци', '5360'),
(237, 'Земен', '2440'),
(238, 'Каолиново', '9960'),
(239, 'Алфатар', '7570'),
(240, 'Момин проход', '2035'),
(241, 'Бойчиновци', '3430'),
(242, 'Грамада', '3830'),
(243, 'Сеново', '7038'),
(244, 'Антоново', '7970'),
(245, 'Ахтопол', '8280'),
(246, 'Шипка', '6150'),
(247, 'Бобошево', '2660'),
(248, 'Болярово', '8720'),
(249, 'Брусарци', '3680'),
(250, 'Димово', '3750'),
(251, 'Клисура', '4341'),
(252, 'Китен', '8183'),
(253, 'Плиска', '9920'),
(254, 'Маджарово', '6480'),
(255, 'Мелник', '2820');

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `catalogueID` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'catalogue number',
  `typeID` tinyint(3) unsigned NOT NULL COMMENT 'type foregn key',
  `genderID` tinyint(3) unsigned NOT NULL COMMENT 'gender foreign key',
  `usageID` tinyint(3) unsigned NOT NULL COMMENT 'usage foreign key',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active',
  PRIMARY KEY (`productID`),
  UNIQUE KEY `catalogueID` (`catalogueID`),
  KEY `typeID` (`typeID`),
  KEY `genderID` (`genderID`),
  KEY `usageID` (`usageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Ссхема на данните от таблица `products`
--

INSERT INTO `products` (`productID`, `catalogueID`, `typeID`, `genderID`, `usageID`, `description`, `release_date`, `last_update`, `is_active`) VALUES
(18, 1010, 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2014-09-01', '2014-09-19 17:12:08', '1'),
(19, 1020, 1, 2, 1, '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2014-09-02', '2014-09-19 17:29:08', '1'),
(20, 1030, 1, 3, 2, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2014-09-03', '2014-09-19 17:37:56', '1'),
(21, 1040, 1, 1, 2, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2014-09-04', '2014-09-19 17:39:15', '1'),
(22, 1050, 1, 2, 1, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2014-09-05', '2014-09-19 17:43:01', '1'),
(23, 1060, 1, 3, 1, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2014-09-06', '2014-09-24 06:33:43', '1'),
(24, 1070, 1, 2, 2, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2014-09-07', '2014-09-19 17:47:18', '1'),
(25, 1080, 1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-09-11', '2014-09-27 05:35:21', '1'),
(26, 1090, 1, 2, 2, 'sfdasdfsd', '2014-09-23', '2014-09-30 11:47:36', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Ссхема на данните от таблица `product_images`
--

INSERT INTO `product_images` (`imageID`, `productID`, `name`) VALUES
(1, 18, 'model_1010_79554.jpg'),
(2, 18, 'model_1010_27725.jpg'),
(3, 18, 'model_1010_76911.jpg'),
(4, 18, 'model_1010_67783.jpg'),
(5, 18, 'model_1010_8789.jpg'),
(6, 18, 'model_1010_95682.jpg'),
(7, 18, 'model_1010_16629.jpg'),
(8, 18, 'model_1010_98676.jpg'),
(9, 19, 'model_1020_7632.JPG'),
(10, 19, 'model_1020_74298.JPG'),
(11, 19, 'model_1020_20541.JPG'),
(12, 19, 'model_1020_46997.JPG'),
(13, 19, 'model_1020_97855.JPG'),
(14, 19, 'model_1020_64765.JPG'),
(15, 19, 'model_1020_12619.JPG'),
(16, 19, 'model_1020_89710.JPG'),
(17, 20, 'model_1030_90577.JPG'),
(18, 20, 'model_1030_35477.JPG'),
(19, 20, 'model_1030_3070.JPG'),
(20, 20, 'model_1030_75437.JPG'),
(21, 20, 'model_1030_74304.JPG'),
(22, 21, 'model_1040_23953.JPG'),
(23, 21, 'model_1040_47015.JPG'),
(24, 21, 'model_1040_65476.JPG'),
(25, 21, 'model_1040_88562.JPG'),
(26, 21, 'model_1040_97184.JPG'),
(27, 22, 'model_1050_83695.JPG'),
(28, 22, 'model_1050_71308.JPG'),
(29, 24, 'model_1070_75803.JPG'),
(30, 24, 'model_1070_26721.JPG'),
(31, 24, 'model_1070_19034.JPG'),
(32, 24, 'model_1070_79547.JPG');

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

-- --------------------------------------------------------

--
-- Структура на таблица `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `shopID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'shop address',
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `mail` text COLLATE utf8_unicode_ci,
  `web` text COLLATE utf8_unicode_ci,
  `gpsLat` double DEFAULT NULL,
  `gpsLon` double DEFAULT NULL,
  `cityID` int(11) unsigned NOT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`shopID`),
  KEY `cityID` (`cityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Ссхема на данните от таблица `shops`
--

INSERT INTO `shops` (`shopID`, `name`, `address`, `phone`, `mail`, `web`, `gpsLat`, `gpsLon`, `cityID`, `is_active`) VALUES
(1, 'тест', 'тест1', '0123456', 'mail@mail.bg', 'test.com', 123456, 123456, 2, '1'),
(2, 'read', 'dsfsdf', '0123456', 'sdsdvsd@mailbg', 'sdvcsdcs.com', 452424, 42424, 1, '1'),
(3, 'тест', 'тест1', '0123456', 'mail@mail.bg', 'test.com', 123456, 123456, 2, '1'),
(4, 'read', 'dsfsdf', '0123456', 'sdsdvsd@mailbg', 'sdvcsdcs.com', 452424, 42424, 1, '1'),
(5, 'asdassdv', 'тест1', '0123456', 'mail@mail.bg', 'test.com', 123456, 123456, 2, '1'),
(6, 'асдасд', 'асдас', 'асдасд', NULL, NULL, NULL, NULL, 239, '0');

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`typeID`) REFERENCES `product_type` (`typeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`genderID`) REFERENCES `product_gender` (`genderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`usageID`) REFERENCES `product_usage` (`usageID`) ON UPDATE CASCADE;

--
-- Ограничения за таблица `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `cities` (`cityID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
