-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 19 2018 г., 19:35
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `books_catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(35, 'Ben Teodore'),
(36, 'Ted Walk'),
(37, 'Bob Brown');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `descr` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `price`, `descr`) VALUES
(1, 'Test 1', '10', 'wawawawa awwa wa wa '),
(2, 'Test 2', '10', 'saawwaweawe'),
(5, 'sasasasasa', '100', 'sasadsa'),
(6, 'aawwawawawee', '111', 'assdawwewqeq'),
(7, 'wwwqwqeqwe', '11', 'qweqewqe'),
(8, 'wwwqwqeqwe', '11', 'qweqewqe'),
(9, 'wwwqwqeqwe', '11', 'qweqewqe');

-- --------------------------------------------------------

--
-- Структура таблицы `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `books_authors`
--

INSERT INTO `books_authors` (`id`, `book_id`, `auth_id`) VALUES
(1, 1, 35),
(2, 2, 36),
(3, 4, 35),
(27, 5, 35),
(28, 5, 37),
(29, 6, 37),
(30, 7, 36),
(31, 7, 37),
(32, 8, 36),
(33, 8, 37),
(34, 9, 36),
(35, 9, 37);

-- --------------------------------------------------------

--
-- Структура таблицы `books_auth_genres`
--

CREATE TABLE IF NOT EXISTS `books_auth_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `genres_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `books_auth_genres`
--

INSERT INTO `books_auth_genres` (`id`, `book_id`, `auth_id`, `genres_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `books_genres`
--

CREATE TABLE IF NOT EXISTS `books_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `books_genres`
--

INSERT INTO `books_genres` (`id`, `book_id`, `genre_id`) VALUES
(1, 1, 12),
(2, 2, 13),
(3, 4, 12),
(25, 5, 1),
(26, 5, 12),
(27, 6, 13),
(28, 7, 13),
(29, 8, 13),
(30, 9, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Drama'),
(12, 'Novel'),
(13, 'Romance');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
