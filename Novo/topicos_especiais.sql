-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 13-Jun-2015 às 19:58
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
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE IF NOT EXISTS `configuracoes` (
  `nivelbonus` int(11) NOT NULL,
  `porcentagembonus` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`nivelbonus`, `porcentagembonus`) VALUES
(3, '10.00');

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
-- Estrutura da tabela `indicacao`
--

CREATE TABLE IF NOT EXISTS `indicacao` (
  `id` int(11) NOT NULL,
  `indica` int(11) NOT NULL,
  `indicado` int(11) NOT NULL DEFAULT '0',
  `emailindicado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `indicacao`
--

INSERT INTO `indicacao` (`id`, `indica`, `indicado`, `emailindicado`) VALUES
(2, 1, 0, 'feliciamegue@gmail.com'),
(3, 1, 37, 'barbarastreit@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentos`
--

CREATE TABLE IF NOT EXISTS `movimentos` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` decimal(10,3) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `movimentos`
--

INSERT INTO `movimentos` (`id`, `cliente`, `produto`, `quantidade`, `total`) VALUES
(1, 1, 1, '1.750', '7.00'),
(2, 1, 2, '0.001', '20.00'),
(3, 3, 1, '5.509', '22.04');

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
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `permissao` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nasc`, `sexo`, `email`, `senha`, `bonus`, `permissao`) VALUES
(1, 'Rafael Streit', '1989-12-31', 'masc', 'radasist@gmail.com', '9135d8523ad3da99d8a4eb83afac13d1', '0.00', 'a'),
(2, 'Ariana', '1990-01-01', 'fem', 'ariana', 'ariana', '0.00', 'a'),
(3, 'Ariel', '1990-01-01', 'masc', 'arielfeiber@faccat.br', 'ariel', '0.00', 'a'),
(4, 'Fabio', '1990-01-01', 'masc', 'fabio', 'fabio', '0.00', 'a'),
(6, 'Olaf', '2012-01-01', 'masc', 'Olaf', 'olaf', '0.00', 'a'),
(13, 'Bob', '2010-10-10', 'masc', 'bob', 'bob', '0.00', 'a'),
(14, 'Nanny', '1981-07-12', 'fem', 'Nanny', 'nanny', '0.00', 'a'),
(15, 'Francisco', '1987-01-01', 'masc', 'chico', 'chico', '0.00', 'a'),
(16, 'Fulano', '0010-01-01', 'masc', 'fulano', 'fulano', '0.00', 'a'),
(17, 'Fulano', '0010-01-01', 'masc', 'fulano', 'fulano', '0.00', 'a'),
(19, 'Fulano', '0100-01-01', 'masc', 'fulano', 'fulano', '0.00', 'a'),
(21, 'Ciclano', '0011-01-01', 'masc', 'Ciclano', 'ciclano', '0.00', 'a'),
(22, 'Beltrano', '0001-01-01', 'masc', 'belt', 'belt', '0.00', 'a'),
(23, 'Maria', '0011-01-01', 'fem', 'ma', 'ma', '0.00', 'a'),
(24, 'Joana', '0001-01-01', 'fem', 'jo', 'jo', '0.00', 'a'),
(25, 'Luana', '0001-01-01', 'fem', 'lu', 'lu', '0.00', 'a'),
(26, 'Eli', '0001-01-01', 'fem', 'eli', 'eli', '0.00', 'a'),
(27, 'Vanessa', '0001-01-01', 'fem', 'vanessa', 'va', '0.00', 'a'),
(28, 'Mili', '0001-01-01', 'fem', 'Mili', 'mi', '0.00', 'a'),
(29, 'Ivana', '0001-01-01', 'fem', 'ivana', 'iv', '0.00', 'a'),
(30, 'Marlene', '0101-01-01', 'fem', 'marlene', 'ma', '0.00', 'a'),
(31, 'João', '1910-01-01', 'masc', 'joao', 'joao', '0.00', 'a'),
(32, 'Nelci', '1972-12-12', 'fem', 'nelci@ggmail.com', '202cb962ac59075b964b07152d234b70', '0.00', 'a'),
(33, 'Juliana', '0001-01-01', 'fem', 'ju@j.com', '21', '0.00', 'a'),
(34, 'Planta do vaso de Planta', '2015-06-04', 'fem', 'planta@planta.com', '123', '0.00', 'a'),
(35, 'TS', '0001-01-01', 'fem', 't@s.com', 'caf1a3dfb505ffed0d024130f58c5cfa', '0.00', 'f'),
(36, 'teste', '0011-11-11', 'masc', '11@11.11', '6512bd43d9caa6e02c990b0a82652dca', '0.00', 'f'),
(37, 'Barbara', '1986-06-25', 'fem', 'barbarastreit@gmail.com', '4d6c4d6b5b6c7fd2c43727ce32a56f4e', '0.00', 'c');

--
-- Acionadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `setIndicado` AFTER INSERT ON `usuarios`
 FOR EACH ROW BEGIN
    UPDATE indicacao SET indicado = NEW.id WHERE emailindicado = NEW.email;
  END
$$
DELIMITER ;

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
-- Indexes for table `indicacao`
--
ALTER TABLE `indicacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movimentos`
--
ALTER TABLE `movimentos`
  ADD PRIMARY KEY (`id`), ADD KEY `cliente` (`cliente`), ADD KEY `produto` (`produto`);

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
-- AUTO_INCREMENT for table `indicacao`
--
ALTER TABLE `indicacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `movimentos`
--
ALTER TABLE `movimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `estabelecimentos`
--
ALTER TABLE `estabelecimentos`
ADD CONSTRAINT `fk_grupoestabelecimento` FOREIGN KEY (`grupo`) REFERENCES `grupoestabelecimentos` (`id`);

--
-- Limitadores para a tabela `movimentos`
--
ALTER TABLE `movimentos`
ADD CONSTRAINT `fk_mv_produto` FOREIGN KEY (`produto`) REFERENCES `produtos` (`id`),
ADD CONSTRAINT `fk_mv_cliente` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `fk_estabelecimento` FOREIGN KEY (`estabelecimento`) REFERENCES `estabelecimentos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
