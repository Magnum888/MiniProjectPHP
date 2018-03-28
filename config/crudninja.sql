-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 28 2018 г., 01:24
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crudninja`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `email` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT './images/0.jpg',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `done` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email`, `description`, `image`, `user_id`, `done`) VALUES
(1, 'serg', 'serg@gmail.com', 'aaaaaaaaaaaaaaa', '', 1, 0),
(2, 'mark', 'mark@gmail.com', 'sssssssssssssssss', './images/20180326203044294069.jpg', 2, 0),
(3, 'dak', 'dak@gmail.com', 'ddddddddddddd', './images/20180326203044294069.jpg', 3, 0),
(4, 'frank', 'frank@gmail.com', 'ffffffffffffffffffffffff', './images/20180326203044294069.jpg', 4, 0),
(5, 'alex', 'alex@mail.org', 'alex', './images/20180326203044294069.jpg', 9999, 0),
(6, 'alex2', 'alex@mail.org', 'alex2', './images/20180326203044294069.jpg', 9999, 0),
(7, 'alex3', 'alex3@mail.org', 'alex3', './images/20180326203044294069.jpg', 9999, 0),
(9, 'alex4', 'alex@mail.org', 'a', './images/20180326203044294069.jpg', 9999, 0),
(10, 'alex4', 'alex@mail.org', 'aa', './images/20180326203044294069.jpg', 9999, 0),
(11, 'alex455', 'alex@mail.org', 'aaa', './images/20180326203044294069.jpg', 99, 1),
(12, 'alex4', 'alex@mail.org', 'aaaaa', './images/20180326203044294069.jpg', 9999, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `admin` varchar(11) NOT NULL DEFAULT 'customer',
  `task_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `task_id`) VALUES
(1, 'serg', 'serg@gmail.com', '$2y$10$tLq9lTKDUt7EyTFhxL0QHuen/BgO9YQzFYTUyH50kJXLJ.ISO3HAO', 'customer', 1),
(2, 'mark', 'mark@gmail.com', '', 'customer', 2),
(3, 'dak', 'dak@gmail.com', '', 'customer', 3),
(4, 'frank', 'frank@gmail.com', '', 'customer', 4),
(5, 'alex45', 'alexx@mail.org', '$2y$10$6/wxBkrM9AVXZLRA.qto8edBFtiv.Y/VdcHv4bFyZMv9zpcuZKVG.', 'customer', 55),
(6, 'admin', 'admin@gmail.com', '$2y$10$rnNQesTXwG11F.BIvpYVLuJFTDmDxDbHpvXj2JBavBf59nqMaufjq', 'admin', 55);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
