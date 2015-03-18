-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 18. bře 2015, 17:11
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

--
-- Vypisuji data pro tabulku `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_at`, `url`, `icon`, `progress`, `git`) VALUES
(1, 'Společenství vlastníků Kukelská 903/1', '2015-03-03 00:00:00', 'http://www.svkukelska.cz', '', 68, 'https://wassy123@bitbucket.org/inpexcz/svkukelska.cz.git'),
(2, 'Ronyo Technologies s.r.o.', '2015-03-09 00:00:00', 'http://www.ronyo.cz', '', 0, ''),
(3, 'PICTURESLAND', '2015-03-03 00:00:00', 'http://www.picturesland.net\r\n', '', 0, ''),
(4, 'Mladé nápady', '2015-03-01 00:00:00', 'http://www.mladenapady.cz', '', 0, '');

--
-- Vypisuji data pro tabulku `projects_x_contacts`
--

INSERT INTO `projects_x_contacts` (`project_id`, `contact_id`) VALUES
(1, 1),
(1, 2);

--
-- Vypisuji data pro tabulku `tasks`
--

INSERT INTO `tasks` (`id`, `progress`, `project`, `parent`, `name`, `add_date`, `finish_date`, `end_date`, `deleted_at`) VALUES
(1, 100, 1, 0, 'Grafický návrh webu', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-28 00:00:00', NULL),
(2, 40, 1, 1, 'Návrh úvodní stránky', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-01 00:00:00', NULL),
(3, 100, 1, 1, 'Návrh podstránky s kontakty', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-27 00:00:00', NULL),
(5, 100, 1, 0, 'Programování', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-29 00:00:00', NULL),
(23, 0, 1, 0, 'Úkol 1', '2015-03-15 00:00:00', '0000-00-00 00:00:00', '2015-03-31 00:00:00', NULL),
(24, 0, 1, 0, 'Úkol 2', '2015-03-15 00:00:00', '0000-00-00 00:00:00', '2015-04-25 00:00:00', NULL),
(25, 40, 4, 0, 'Zkušební úkol', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-17 17:00:00', NULL),
(26, 40, 4, 0, 'Zkušební úkol', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-17 17:00:00', '2015-03-25 00:00:00'),
(27, 40, 4, 0, 'Zkušební úkol', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-17 17:00:00', '2015-03-25 00:00:00'),
(28, 20, 4, 25, 'podukol', '2015-03-12 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `last_login`) VALUES
(1, 'admin', '$2y$10$0Xj2S5EYlTkPzEzDfRvXa.Yiq2YCRsmuqCg.zWd5qjIiqkzCLR5TG', 'superadmin', 'Dominik Voda', 'd.voda94@gmail.com', '2015-03-15 21:39:32'),
(2, 'sharker', '$2y$10$4DZvNH1A6Qy5Zc.A3nMp6.7ai/B6vMj1x1FYOQeECsSwnwxyh9XTm', 'superadmin', 'Radek Čistecký', 'cistecky2@seznam.cz', '0000-00-00 00:00:00');

--
-- Vypisuji data pro tabulku `users_x_tasks`
--

INSERT INTO `users_x_tasks` (`user_id`, `task_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 23),
(1, 24),
(1, 26),
(2, 26),
(1, 27),
(2, 27);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
