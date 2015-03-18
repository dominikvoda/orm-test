-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 18. bře 2015, 17:08
-- Verze serveru: 5.6.20
-- Verze PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `cml`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(3) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `url` varchar(64) NOT NULL,
  `icon` varchar(64) NOT NULL,
  `progress` float NOT NULL,
  `git` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `projects_x_contacts`
--

CREATE TABLE IF NOT EXISTS `projects_x_contacts` (
  `project_id` int(3) NOT NULL,
  `contact_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(6) NOT NULL,
  `progress` float NOT NULL,
  `project` int(3) NOT NULL,
  `parent` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `add_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `users_x_tasks`
--

CREATE TABLE IF NOT EXISTS `users_x_tasks` (
  `user_id` int(3) NOT NULL,
  `task_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `projects_x_contacts`
--
ALTER TABLE `projects_x_contacts`
  ADD PRIMARY KEY (`project_id`,`contact_id`), ADD KEY `projects_x_contacts_ibfk_2` (`contact_id`);

--
-- Klíče pro tabulku `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`), ADD KEY `project` (`project`), ADD KEY `parent` (`parent`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users_x_tasks`
--
ALTER TABLE `users_x_tasks`
  ADD PRIMARY KEY (`user_id`,`task_id`), ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `projects_x_contacts`
--
ALTER TABLE `projects_x_contacts`
ADD CONSTRAINT `projects_x_contacts_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
ADD CONSTRAINT `projects_x_contacts_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`);

--
-- Omezení pro tabulku `tasks`
--
ALTER TABLE `tasks`
ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project`) REFERENCES `projects` (`id`);

--
-- Omezení pro tabulku `users_x_tasks`
--
ALTER TABLE `users_x_tasks`
ADD CONSTRAINT `users_x_tasks_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
ADD CONSTRAINT `users_x_tasks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
