-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 13-Jun-2015 às 14:24
-- Versão do servidor: 5.5.42
-- PHP Version: 5.4.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `topicos_especiais`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estabelecimentos`
--

CREATE TABLE IF NOT EXISTS `estabelecimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razaosocial` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estabelecimentos`
--

INSERT INTO `estabelecimentos` (`id`, `nome`, `razaosocial`, `grupo`) VALUES
(8, 'Ipirangão', 'Posto Ipiranga Taquara RS', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupoestabelecimentos`
--

CREATE TABLE IF NOT EXISTS `grupoestabelecimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `grupoestabelecimentos`
--

INSERT INTO `grupoestabelecimentos` (`id`, `nome`) VALUES
(1, 'Grupo Ipiranga Taquara'),
(2, 'Grupo Antigo Texaco');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `estabelecimento` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `valor`, `estabelecimento`) VALUES
(1, 'Gasolina', '4.00', 8),
(2, 'Alcool', '20000.00', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nasc` date NOT NULL,
  `sexo` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissao` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nasc`, `sexo`, `email`, `senha`, `permissao`) VALUES
(1, 'Rafael Streit', '1989-12-31', 'masc', 'radasist@gmail.com', '9135d8523ad3da99d8a4eb83afac13d1', 'a'),
(2, 'Ariana', '1990-01-01', 'fem', 'ariana', 'ariana', 'a'),
(3, 'Ariel', '1990-01-01', 'masc', 'arielfeiber@faccat.br', 'ariel', 'a'),
(4, 'Fabio', '1990-01-01', 'masc', 'fabio', 'fabio', 'a'),
(6, 'Olaf', '2012-01-01', 'masc', 'Olaf', 'olaf', 'a'),
(13, 'Bob', '2010-10-10', 'masc', 'bob', 'bob', 'a'),
(14, 'Nanny', '1981-07-12', 'fem', 'Nanny', 'nanny', 'a'),
(15, 'Francisco', '1987-01-01', 'masc', 'chico', 'chico', 'a'),
(16, 'Fulano', '0010-01-01', 'masc', 'fulano', 'fulano', 'a'),
(17, 'Fulano', '0010-01-01', 'masc', 'fulano', 'fulano', 'a'),
(19, 'Fulano', '0100-01-01', 'masc', 'fulano', 'fulano', 'a'),
(21, 'Ciclano', '0011-01-01', 'masc', 'Ciclano', 'ciclano', 'a'),
(22, 'Beltrano', '0001-01-01', 'masc', 'belt', 'belt', 'a'),
(23, 'Maria', '0011-01-01', 'fem', 'ma', 'ma', 'a'),
(24, 'Joana', '0001-01-01', 'fem', 'jo', 'jo', 'a'),
(25, 'Luana', '0001-01-01', 'fem', 'lu', 'lu', 'a'),
(26, 'Eli', '0001-01-01', 'fem', 'eli', 'eli', 'a'),
(27, 'Vanessa', '0001-01-01', 'fem', 'vanessa', 'va', 'a'),
(28, 'Mili', '0001-01-01', 'fem', 'Mili', 'mi', 'a'),
(29, 'Ivana', '0001-01-01', 'fem', 'ivana', 'iv', 'a'),
(30, 'Marlene', '0101-01-01', 'fem', 'marlene', 'ma', 'a'),
(31, 'João', '1910-01-01', 'masc', 'joao', 'joao', 'a'),
(32, 'Nelci', '1972-12-12', 'fem', 'nelci@ggmail.com', '202cb962ac59075b964b07152d234b70', 'a'),
(33, 'Juliana', '0001-01-01', 'fem', 'ju@j.com', '21', 'a'),
(34, 'Planta do vaso de Planta', '2015-06-04', 'fem', 'planta@planta.com', '123', 'a'),
(35, 'TS', '0001-01-01', 'fem', 't@s.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 'f'),
(36, 'teste', '0011-11-11', 'masc', '11@11.11', '6512bd43d9caa6e02c990b0a82652dca', 'f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estabelecimentos`
--
ALTER TABLE `estabelecimentos`
  ADD PRIMARY KEY (`id`), ADD KEY `grupo` (`grupo`);

--
-- Indexes for table `grupoestabelecimentos`
--
ALTER TABLE `grupoestabelecimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`), ADD KEY `estabelecimento` (`estabelecimento`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estabelecimentos`
--
ALTER TABLE `estabelecimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `grupoestabelecimentos`
--
ALTER TABLE `grupoestabelecimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `estabelecimentos`
--
ALTER TABLE `estabelecimentos`
ADD CONSTRAINT `fk_grupoestabelecimento` FOREIGN KEY (`grupo`) REFERENCES `grupoestabelecimentos` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `fk_estabelecimento` FOREIGN KEY (`estabelecimento`) REFERENCES `estabelecimentos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
