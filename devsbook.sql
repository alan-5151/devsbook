-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 23-Ago-2020 às 22:01
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devsbook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `postcomments`
--

CREATE TABLE `postcomments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postlikes`
--

CREATE TABLE `postlikes` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `body` text NOT NULL,
  `like_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `type`, `created_at`, `body`, `like_count`) VALUES
(1, 44, 'text', '2020-08-20 20:48:14', 'Post de teste', NULL),
(2, 44, 'text', '2020-08-20 20:49:41', 'Olá,\r\n\r\n\r\nTudo bem?\r\n\r\n\r\nPassando para mandar boas notícias...', NULL),
(7, 44, 'text', '2020-08-20 22:42:44', 'Boa tarde,\r\nMais um post de teste.', NULL),
(8, 44, 'text', '2020-08-20 23:11:07', 'mais uma postagem', NULL),
(9, 44, 'text', '2020-08-20 23:43:20', 'outra postagem', NULL),
(10, 44, 'text', '2020-08-20 23:43:28', 'mais uma', NULL),
(11, 44, 'text', '2020-08-20 23:43:33', 'outra uma', NULL),
(12, 44, 'text', '2020-08-20 23:43:44', 'quanta páginas?', NULL),
(13, 44, 'text', '2020-08-20 23:43:53', 'oi', NULL),
(14, 44, 'photo', '2020-08-21 20:37:17', '1.jpg', NULL),
(15, 44, 'text', '2020-08-21 22:01:31', 'Olá... funcionando?', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `userrelations`
--

CREATE TABLE `userrelations` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `userrelations`
--

INSERT INTO `userrelations` (`id`, `user_from`, `user_to`) VALUES
(12, 44, 50),
(13, 44, 53);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `work` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `cover` varchar(100) NOT NULL DEFAULT 'cover.jpg',
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Usuários - DevsBook';

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `birthdate`, `city`, `work`, `avatar`, `cover`, `token`) VALUES
(42, 'am@123.com', 'd65298dfc2528c566c8a3c468b4407ec', 'Amancio', '1958-06-24', NULL, NULL, 'default.jpg', 'cover.jpg', '6afba128de851dc9161bb5bc9fc3e508'),
(43, 'bb@123.com', '$2y$10$kJB/6v6tqneDZ1VwL0Gto.TA72b.J8WsUdkbWDiiFcIRfxCfBCRnu', 'Batista', '1958-06-24', NULL, NULL, 'default.jpg', 'cover.jpg', '3505bd697580fc727bf43d6fb343a00d'),
(44, 'mm@123.com', '$2y$10$wC94zFCWuSQLOvx4MGHaz.qD5eq8grF.DNQP6Tx.KDW7f52QeXPry', 'Manoel Monteiro ', '1958-06-24', NULL, NULL, 'default.jpg', 'cover.jpg', '46da76f66eb53401846eccfbe219ee20'),
(50, 'ac@nossosite.com', '1234', 'Alan Carvalho', '1958-06-24', NULL, NULL, 'default.jpg', 'cover.jpg', '0e87464a33d8ed06e3a572723ee957bd'),
(53, 'amarildo@123.com', '1234', 'Amarildo', '1958-06-24', NULL, NULL, 'default.jpg', 'cover.jpg', 'cd89db59c05d8b34b1d81ec5b169a22c');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `postlikes`
--
ALTER TABLE `postlikes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `userrelations`
--
ALTER TABLE `userrelations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postlikes`
--
ALTER TABLE `postlikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `userrelations`
--
ALTER TABLE `userrelations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
