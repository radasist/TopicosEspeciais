-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 18-Jun-2015 às 19:13
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
(2, '15.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `indicacao`
--

INSERT INTO `indicacao` (`id`, `indica`, `indicado`, `emailindicado`) VALUES
(5, 1, 41, 'barbarastreit@gmail.com'),
(6, 41, 42, 'feliciamegue@gmail.com'),
(7, 42, 43, 'gersonstreit@gmail.com'),
(8, 43, 44, 'megue@gmail.com'),
(9, 44, 45, 'isis@gmail.com'),
(10, 4, 0, 'lu@gmail.com'),
(11, 4, 0, 'le@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `movimentos`
--

INSERT INTO `movimentos` (`id`, `cliente`, `produto`, `quantidade`, `total`) VALUES
(1, 1, 1, '1.750', '7.00'),
(2, 1, 2, '0.001', '20.00'),
(3, 3, 1, '5.509', '22.04'),
(4, 1, 1, '1.000', '10.00'),
(5, 45, 1, '1.000', '10.00'),
(6, 45, 1, '1.000', '10.00'),
(7, 45, 2, '1.000', '20000.00'),
(8, 45, 1, '1.000', '10.00'),
(9, 45, 1, '1.000', '10.00'),
(10, 45, 1, '1.000', '10.00'),
(11, 45, 1, '2.000', '20.00'),
(12, 45, 1, '1.000', '10.00'),
(13, 45, 1, '1.000', '10.00'),
(14, 45, 1, '1.000', '10.00'),
(15, 45, 1, '1.000', '10.00'),
(16, 45, 1, '1.000', '10.00'),
(17, 45, 1, '1.000', '10.00'),
(18, 45, 1, '1.000', '10.00'),
(19, 45, 1, '1.000', '10.00'),
(20, 45, 1, '1.000', '10.00'),
(21, 45, 1, '1.000', '10.00'),
(22, 45, 1, '1.000', '10.00'),
(23, 45, 1, '1.000', '10.00'),
(24, 45, 1, '1.000', '10.00'),
(25, 45, 1, '1.000', '10.00'),
(26, 45, 1, '1.000', '10.00'),
(27, 45, 1, '1.000', '10.00'),
(28, 45, 1, '1.000', '10.00'),
(29, 45, 1, '1.000', '10.00'),
(30, 45, 1, '1.000', '10.00'),
(31, 45, 1, '1.000', '10.00'),
(32, 45, 1, '1.000', '10.00'),
(37, 42, 1, '1.000', '10.00'),
(38, 42, 1, '1.000', '-10.00'),
(39, 42, 1, '1.000', '10.00'),
(40, 42, 1, '1.000', '10.00'),
(41, 42, 1, '1.000', '10.00'),
(42, 42, 1, '1.000', '10.00');

--
-- Acionadores `movimentos`
--
DELIMITER $$
CREATE TRIGGER `discountBonus` BEFORE INSERT ON `movimentos`
 FOR EACH ROW BEGIN

	DECLARE bonusUsuario DECIMAL(10,2) default 0;
	DECLARE totalDescBonus DECIMAL(10,2) default 0;

	SET @bonusUsuario := (SELECT bonus FROM usuarios WHERE id = NEW.cliente LIMIT 1);

	IF (NEW.total < @bonusUsuario) THEN
	    SET @totalDescBonus := (@bonusUsuario - NEW.total);
	    SET NEW.total := 0;
	    UPDATE usuarios SET bonus = @totalDescBonus WHERE id = NEW.cliente;
    ELSE
	    SET @totalDescBonus := (NEW.total - @bonusUsuario);
	    SET NEW.total := @totalDescBonus;
	    UPDATE usuarios SET bonus = 0 WHERE id = NEW.cliente;
	END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setBonus` AFTER INSERT ON `movimentos`
 FOR EACH ROW BEGIN

	DECLARE recorrencia_bonus INT default 0;
	DECLARE porcentagem_bonus DECIMAL(10,2) default 0;
	DECLARE loop_i INT default 0;
	DECLARE saldo_bonus DECIMAL(10,2) default 0;
	DECLARE bonus_acumulado DECIMAL(10,2) default 0;
	DECLARE recebe_bonus INT default 0;

	SET @loop_i := 0;
	SET @recorrencia_bonus := (SELECT nivelbonus FROM configuracoes LIMIT 1);
	SET @porcentagem_bonus := (SELECT porcentagembonus FROM configuracoes LIMIT 1);
	SET @recebe_bonus := (SELECT indica FROM indicacao WHERE indicado = NEW.cliente LIMIT 1);

	WHILE @loop_i < @recorrencia_bonus DO

		SET @saldo_bonus := (SELECT bonus FROM usuarios WHERE id = @recebe_bonus LIMIT 1);
		SET @bonus_acumulado := @saldo_bonus + (@totalDescBonus * (@porcentagem_bonus / 100));

	   	UPDATE usuarios SET bonus = @bonus_acumulado WHERE id = @recebe_bonus;

	   	SET @recebe_bonus := (SELECT indica FROM indicacao WHERE indicado = @recebe_bonus);
        SET @loop_i := @loop_i + 1;

	END WHILE;

END
$$
DELIMITER ;

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
(1, 'Gasolina', '10.00', 8),
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nasc`, `sexo`, `email`, `senha`, `bonus`, `permissao`) VALUES
(1, 'Rafael Streit', '1989-12-31', 'masc', 'radasist@gmail.com', '9135d8523ad3da99d8a4eb83afac13d1', '4.20', 'a'),
(2, 'Ariana', '1990-01-01', 'fem', 'arianaestrelar@gmail.com', 'ariana', '20.00', 'a'),
(3, 'Ariel', '1990-01-01', 'masc', 'arielfeiber@faccat.br', 'ariel', '0.00', 'a'),
(4, 'Fabio', '1990-01-01', 'masc', 'fabio', 'fabio', '0.00', 'a'),
(32, 'Nelci', '1972-12-12', 'fem', 'nelci@gmail.com', '202cb962ac59075b964b07152d234b70', '0.00', 'a'),
(34, 'Planta do vaso de Planta', '2015-06-04', 'fem', 'planta@planta.com', '123', '0.00', 'a'),
(41, 'Barbara', '1986-06-25', 'fem', 'barbarastreit@gmail.com', '4d6c4d6b5b6c7fd2c43727ce32a56f4e', '27.30', 'a'),
(42, 'Terezinha', '1965-01-01', 'fem', 'feliciamegue@gmail.com', 'eb4a4a36e4d53916f9979759c3d3b822', '0.00', 'a'),
(43, 'Gerson', '1955-06-22', 'masc', 'gersonstreit@gmail.com', 'd828a5b9b09b334ce76bf241ca16c4eb', '7.50', 'a'),
(44, 'Megue', '2002-04-22', 'fem', 'megue@gmail.com', '548c0e2986f152f5ad7203aae24be45d', '7.50', 'a'),
(45, 'Isis', '2010-01-01', 'fem', 'isis@gmail.com', '529419940a585fb2a83765b2ca5cc091', '0.00', 'a'),
(46, 'Frentista', '0001-01-01', 'masc', 'frentista@gmail.com', '50cead2e182a42320a771beba57e9684', '0.00', 'f'),
(47, 'Cliente', '0001-01-01', 'masc', 'cliente@gmail.com', '4983a0ab83ed86e0e7213c8783940193', '0.00', 'c'),
(48, 'Mariana', '0001-01-01', 'fem', 'mariana@gmail.com', '202cb962ac59075b964b07152d234b70', '0.00', 'a');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `indicacao`
--
ALTER TABLE `indicacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `movimentos`
--
ALTER TABLE `movimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
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
ADD CONSTRAINT `fk_mv_cliente` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`id`),
ADD CONSTRAINT `fk_mv_produto` FOREIGN KEY (`produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `fk_estabelecimento` FOREIGN KEY (`estabelecimento`) REFERENCES `estabelecimentos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
