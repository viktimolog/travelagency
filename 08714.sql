-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 08 2017 г., 23:16
-- Версия сервера: 5.7.16
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `08714`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Cities`
--

CREATE TABLE `Cities` (
  `id` int(11) NOT NULL,
  `city` varchar(64) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Cities`
--

INSERT INTO `Cities` (`id`, `city`, `countryid`) VALUES
(1, 'Lviv', 1),
(2, 'Kyiv', 1),
(3, 'Budva', 2),
(4, 'Herceg Novi', 2),
(5, 'Kemer', 3),
(7, 'Side', 3),
(8, 'Hurgada', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `hotelid` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Comments`
--

INSERT INTO `Comments` (`id`, `hotelid`, `comment`) VALUES
(1, 3, 'Alexander: Отдыхали в июне 2015 года. Персонал ненавязчивый, кормят хорошо. Расположение - самое лучшее на побережье. Из минусов: анимация только детская, дискотеки в отеле нет, а на побережье всё рано закрывается - закон у них такой.'),
(2, 3, 'Serg: Good hotel.');

-- --------------------------------------------------------

--
-- Структура таблицы `Countries`
--

CREATE TABLE `Countries` (
  `id` int(11) NOT NULL,
  `country` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Countries`
--

INSERT INTO `Countries` (`id`, `country`) VALUES
(1, 'Ukraine'),
(2, 'Montenegro'),
(3, 'Turkey'),
(4, 'Egypt');

-- --------------------------------------------------------

--
-- Структура таблицы `Hotels`
--

CREATE TABLE `Hotels` (
  `id` int(11) NOT NULL,
  `hotel` varchar(64) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL,
  `stars` float DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `info` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Hotels`
--

INSERT INTO `Hotels` (`id`, `hotel`, `countryid`, `cityid`, `stars`, `cost`, `info`) VALUES
(3, 'Slovenska Plaza', 2, 3, 4, 70, 'Популярный курортный комплекс с развитой инфраструктурой расположен в центре Будвы, на первой береговой линии и предлагает размещение в современных комфортабельных номерах и апартаментах уровня 4*. Бесплатный Wi-Fi доступен для гостей в номерах и в лобби.'),
(5, 'Lviv', 1, 1, 3, 20, 'Отель Львов построен в 1965 году. В тот период именно мы были визитной карточкой Львова и центром туризма на Западной Украине. В эти годы отель был одним из самых модных мест и пользовался очень большой популярностью среди гостей города. Особой благосклонностью наш отель отмечался у туристов из Средней Азии и Востока. Об этом свидетельствует его неформальное название - Кавказская пленница, которую получил отель Львов от своих довольных гостей.\r\n\r\nГордостью нашего отеля является размещение у нас, в период проведения Евро 2012, подразделений полиции Португалии, Дании и Германии. Все они остались довольны пребыванием в гостинице Львов, высоко оценили наше умение обращаться с клиентами и намерены вновь посетить город, остановившись у нас ...'),
(6, 'Perla', 2, 4, 4, 50, 'Отель находится в Игало и расположен в 7 км от города Herceg Novi на первой береговой линии красивого Адриатического Побережья республики Черногории. Отель состоит из нескольких корпусов, все из которых находятся на первой береговой линии, или за главным зданием. Всего в отеле 27 номеров, 4 корпуса. Типы номеров: Depandans Perla (главное здание), Depandans Natalie (Blok A, Blok B), Depandans DeMar, Depandans Mohom.'),
(8, 'Hilton Hurghada Resort', 4, 8, 5, 35, '');

-- --------------------------------------------------------

--
-- Структура таблицы `Images`
--

CREATE TABLE `Images` (
  `id` int(11) NOT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  `hotelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Images`
--

INSERT INTO `Images` (`id`, `imagepath`, `hotelid`) VALUES
(1, 'images/hotels/slplaza1.jpg', 3),
(2, 'images/hotels/slplaza2.jpg', 3),
(3, 'images/hotels/slplaza3.jpg', 3),
(7, 'images/hotels/lviv1.jpg', 5),
(8, 'images/hotels/lviv2.jpg', 5),
(9, 'images/hotels/lviv3.jpg', 5),
(10, 'images/hotels/perla1.jpg', 6),
(11, 'images/hotels/perla2.jpg', 6),
(12, 'images/hotels/perla3.jpg', 6),
(17, 'images/hotels/hilton1.jpg', 8),
(18, 'images/hotels/hilton2.jpg', 8),
(19, 'images/hotels/hilton3.jpg', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `role` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Roles`
--

INSERT INTO `Roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `roleid` int(11) DEFAULT NULL,
  `avatar` mediumblob,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `pass`, `email`, `discount`, `roleid`, `avatar`, `phone`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', NULL, 1, NULL, NULL),
(2, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user1@gmail.com', NULL, 2, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Cities`
--
ALTER TABLE `Cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryid` (`countryid`);

--
-- Индексы таблицы `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Countries`
--
ALTER TABLE `Countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Hotels`
--
ALTER TABLE `Hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryid` (`countryid`),
  ADD KEY `cityid` (`cityid`);

--
-- Индексы таблицы `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotelid` (`hotelid`);

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleid` (`roleid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Cities`
--
ALTER TABLE `Cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Countries`
--
ALTER TABLE `Countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `Hotels`
--
ALTER TABLE `Hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `Images`
--
ALTER TABLE `Images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Cities`
--
ALTER TABLE `Cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`countryid`) REFERENCES `Countries` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Hotels`
--
ALTER TABLE `Hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`countryid`) REFERENCES `Countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotels_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `Cities` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Images`
--
ALTER TABLE `Images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`hotelid`) REFERENCES `Hotels` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `Roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
