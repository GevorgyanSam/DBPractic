-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 27 2022 г., 21:07
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gen` varchar(7) NOT NULL,
  `month` varchar(255) NOT NULL,
  `day` int(3) NOT NULL,
  `year` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `login`, `password`, `image`, `gen`, `month`, `day`, `year`) VALUES
(1, 'Samvel', 'Gevorgyan', 'Gevorgyan@mail.ru', 'GSam', 'd91ac493291efec9ef943999ff4297a6', 'Sam.jpg', 'Male', 'January', 18, 2005),
(2, 'Samvel', 'Hayrapetyan', 'Hayrapetyan@mail.ru', 'Sami', '83374adc2060a1d85245bcc293f28e3d', 'Sam.jpg', 'Male', 'April', 10, 2018),
(3, 'Stepan', 'Hovsepyan', 'Hovsepyan@gmail.com', 'Step', '4060ebec0f8c118b9c92d91966b901d8', 'Sam.jpg', 'Male', 'July', 5, 2013),
(4, 'Harut', 'Farfaryan', 'Farfaryan@mail.ru', 'Har', 'e02dde4b4d9a1bab0ecfc27cce3b8fb0', 'Sam.jpg', 'Male', 'February', 2, 2020);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
