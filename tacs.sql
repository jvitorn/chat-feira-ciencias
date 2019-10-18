-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 18-Out-2019 às 03:21
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tacs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
CREATE TABLE IF NOT EXISTS `pergunta` (
  `id_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pergunta` varchar(255) NOT NULL,
  `tem_resposta` enum('sim','nao') DEFAULT 'nao',
  PRIMARY KEY (`id_pergunta`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pergunta`
--

INSERT INTO `pergunta` (`id_pergunta`, `nm_pergunta`, `tem_resposta`) VALUES
(1, 'oi', 'sim'),
(2, 'ola', 'sim'),
(3, 'gfg', 'nao'),
(4, 'voce sabe com quantos pau se faz uma canoa?', 'sim'),
(5, 'voce gostaria de ir tomar no copo?', 'sim'),
(6, 'oq?', 'sim'),
(7, 'ue?', 'sim'),
(8, 'que?', 'sim'),
(9, 'nao', 'nao'),
(10, 'que foi?', 'sim'),
(11, 'atapo', 'nao'),
(12, 'sei nao :(', 'nao'),
(13, 'nada nossa', 'nao'),
(14, 'oq oq', 'nao'),
(15, 'oq oq?', 'sim'),
(16, 'alo', 'nao'),
(17, 'oq oq oq', 'nao'),
(18, 'ae', 'nao'),
(19, 'nada', 'nao'),
(20, 'td bem?', 'nao'),
(21, 'olar', 'nao'),
(22, 'ma', 'nao'),
(23, 'mamao', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `id_pergunta` int(11) DEFAULT NULL,
  `nm_resposta` varchar(255) NOT NULL,
  PRIMARY KEY (`id_resposta`),
  KEY `id_pergunta` (`id_pergunta`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `resposta`
--

INSERT INTO `resposta` (`id_resposta`, `id_pergunta`, `nm_resposta`) VALUES
(1, 1, 'ola'),
(2, 2, 'oi'),
(3, 1, 'que foi?'),
(4, 1, 'nsei'),
(5, 5, 'nao, obrigado'),
(6, 7, 'oq'),
(7, 4, 'nao'),
(8, 4, 'alou?'),
(9, 10, 'nada'),
(10, 20, 'sim :)'),
(11, 8, 'de queijo'),
(12, 8, 'batata'),
(13, 8, 'puta q o pariu'),
(14, 15, '...'),
(15, 5, 'nao, vai voce bot infeliz'),
(16, 5, 'voce gostaria de ir tomar no copo?'),
(17, 8, 'aaaaaaa'),
(18, 8, 'voce gostaria de ir tomar no copo?'),
(19, 5, 'nao'),
(20, 10, 'voce gostaria de ir tomar no copo?'),
(21, 5, 'nau'),
(22, 5, 'voce gostaria de ir tomar no copo?'),
(23, 10, 'voce gostaria de ir tomar no copo?'),
(24, 10, 'nada'),
(25, 10, 'que foi?'),
(26, 6, 'oq oq'),
(27, 10, 'oq?'),
(28, 10, 'oq?'),
(29, 10, 'nada'),
(30, 15, 'qqq'),
(31, 7, 'que foi?'),
(32, 8, 'aaa'),
(33, 15, 'oq'),
(34, 7, 'batata'),
(35, 15, 'bla bla bla'),
(36, 15, 'oq oq?'),
(37, 15, 'oq oq?'),
(38, 15, 'oq oq?'),
(39, 10, 'oq oq?'),
(40, 10, 'ahusahaus'),
(41, 5, 'nao'),
(42, 5, 'voce gostaria de ir tomar no copo?'),
(43, 5, 'voce gostaria de ir tomar no copo?'),
(44, 4, 'nau'),
(45, 4, 'alou'),
(46, 10, 'nna'),
(47, 10, 'oi'),
(48, 8, 'xzds'),
(49, 8, 'que de queijo'),
(50, 10, 'nada nao ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
