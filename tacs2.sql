-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 20-Out-2019 às 17:34
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
-- Database: `tacs2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `frase`
--

DROP TABLE IF EXISTS `frase`;
CREATE TABLE IF NOT EXISTS `frase` (
  `id_frase` int(11) NOT NULL AUTO_INCREMENT,
  `frase` varchar(255) NOT NULL,
  PRIMARY KEY (`id_frase`),
  UNIQUE KEY `frase` (`frase`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id_resp_perg` int(11) NOT NULL AUTO_INCREMENT,
  `id_resposta` int(11) DEFAULT NULL,
  `id_pergunta` int(11) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_resp_perg`),
  KEY `id_resposta` (`id_resposta`),
  KEY `id_pergunta` (`id_pergunta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
