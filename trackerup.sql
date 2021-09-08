-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 08/09/2021 às 19:29
-- Versão do servidor: 5.7.34
-- Versão do PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trackerup`
--
CREATE DATABASE IF NOT EXISTS `trackerup` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `trackerup`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `deleted`) VALUES
(1, 'televisão', NULL, 0),
(2, 'geladeiras', 'Categoria geral', 0),
(3, 'microondas', NULL, 1),
(4, 'geladeira', 'nova categoria', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fk_categories` int(11) NOT NULL,
  `description` text,
  `qty` int(11) DEFAULT NULL,
  `ncm` varchar(25) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `parts`
--

INSERT INTO `parts` (`id`, `code`, `name`, `fk_categories`, `description`, `qty`, `ncm`, `deleted`) VALUES
(125, '124', 'compressor', 2, 'Compressor 1hp', 6, '123457', 0),
(127, '123', 'compressor', 2, 'Compressor 2hp', 3, '12345', 1),
(128, 'tete', 'tetet', 1, 'tetet', 12, 'asdasd', 0),
(129, 'sdfsd', 'sdfs', 2, 'sdfsd', 123, 'dsfsd', 0),
(130, 'sdf', 'sfds', 2, '', 0, '', 0),
(135, 'hjkhjk', 'hjkh', 2, '', 0, '', 0),
(136, 'hjk', 'hjk', 2, '', 0, '', 0),
(137, '001', 'Compressor 1hp', 2, 'Modelo xyz...a', 12, '12345-6', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(15, 'Rafael Nery', 'nery@test.com', '202cb962ac59075b964b07152d234b70'),
(14, 'Teste', 'teste@teste.com', '202cb962ac59075b964b07152d234b70'),
(13, 'teste', '1@1.com.br', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'teste', '1@1.com', 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices de tabela `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `fk_category` (`fk_categories`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`fk_categories`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
