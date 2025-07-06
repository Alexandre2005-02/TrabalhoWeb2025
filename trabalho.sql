-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Jul-2025 às 04:43
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificados`
--

CREATE TABLE `certificados` (
  `idCertificado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTreinamento` int(11) NOT NULL,
  `dataEmissao` datetime DEFAULT current_timestamp(),
  `idTutorEmissor` int(11) NOT NULL,
  `codigoCertificado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `certificados`
--

INSERT INTO `certificados` (`idCertificado`, `idUsuario`, `idTreinamento`, `dataEmissao`, `idTutorEmissor`, `codigoCertificado`) VALUES
(1, 7, 1, '2025-07-05 21:27:37', 6, 'CERT_86CC9E22E95BB4EE'),
(2, 7, 2, '2025-07-05 21:56:03', 6, 'CERT_E0246E1F9038741C'),
(3, 8, 2, '2025-07-05 23:06:17', 6, 'CERT_84B2B86B0ACBF1BB');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conclusaovideousuario`
--

CREATE TABLE `conclusaovideousuario` (
  `idConclusao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `dataConclusao` datetime DEFAULT current_timestamp(),
  `estaConcluido` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `conclusaovideousuario`
--

INSERT INTO `conclusaovideousuario` (`idConclusao`, `idUsuario`, `idVideo`, `dataConclusao`, `estaConcluido`) VALUES
(1, 7, 1, '2025-07-05 21:27:02', 1),
(2, 7, 2, '2025-07-05 21:53:24', 1),
(3, 8, 2, '2025-07-05 23:05:15', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `tipoUsuario` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `tipoUsuario`) VALUES
(1, 'teste', 'teste@gmail.com', '$2y$10$gUqb1C7tNKeeGYVNY0nhL.QAltUJMr826M2ZobfMDlm5aIrOSbCoK', 'Aprendiz'),
(2, 'jao', 'jao@gmail.com', '$2y$10$UGdahkuFztf5IAXOt2sjoeX/7jFWAUEd3vuMtgvEBQ54ePHFHYNu2', 'Aprendiz'),
(3, 'yyyy', 'ygygyug@gmail.com', '$2y$10$Ipj0iJDjwzaf3aHAbVxUt.5scnevJmtSkDu.mCN6LP9/Shc3RU.f2', 'Aprendiz'),
(4, 'monica', 'monica@gmail.com', '$2y$10$dZ.0zYJvaSFCHFs8lw25MOSi5xoQMgG6ofRwDsI2va1tUNan0bQbK', 'Aprendiz'),
(5, 'jailson', 'jailson@gmail.com', '$2y$10$hridXH5.ueWxJgBE/o.KG.ZatTUtwRPWmskwrADFONceHJi.Ub8JO', 'Aprendiz'),
(6, 'tutor', 'tutor@gmail.com', '$2y$10$nksDjDlucy5pyWnLXoYSpurvHHI0tJDhfG.coPehiAFRFEzqtTMK6', 'Tutor'),
(7, 'aprendiz', 'aprendiz@gmail.com', '$2y$10$Tq2NLuMKQ.HRzc3eIsWbyOtK5Q.bU8wph8l1Grn4CgTAjT5SBGs9y', 'Aprendiz'),
(8, 'novoaprendiz', 'novo@gmail.com', '$2y$10$7JBnEWIhGYUt/Mw/coKMA.ONXPkKn.VX9uaLstUM7jt25elQ4xdkO', 'Aprendiz');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videostreinamento`
--

CREATE TABLE `videostreinamento` (
  `idVideo` int(11) NOT NULL,
  `tituloVideo` varchar(255) NOT NULL,
  `descricaoVideo` text DEFAULT NULL,
  `urlVideo` varchar(255) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `dataAdicao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `videostreinamento`
--

INSERT INTO `videostreinamento` (`idVideo`, `tituloVideo`, `descricaoVideo`, `urlVideo`, `idUsuario`, `dataAdicao`) VALUES
(1, 'Introdução a Extintores de Incêndio', 'Esse é um teste para adicionar vídeo ao sistema!', 'https://www.youtube.com/embed/HhUF2tf987M', 6, '2025-07-05 19:05:51'),
(2, 'Introdução a Primeiros Socorros', 'Aprenda sobre primeiros socorros e sua importância para o dia a dia!', 'https://www.youtube.com/embed/1MtKw-uP1NM', 6, '2025-07-05 21:52:32');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`idCertificado`),
  ADD UNIQUE KEY `codigoCertificado` (`codigoCertificado`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTreinamento` (`idTreinamento`),
  ADD KEY `idTutorEmissor` (`idTutorEmissor`);

--
-- Índices para tabela `conclusaovideousuario`
--
ALTER TABLE `conclusaovideousuario`
  ADD PRIMARY KEY (`idConclusao`),
  ADD UNIQUE KEY `idUsuario` (`idUsuario`,`idVideo`),
  ADD KEY `idVideo` (`idVideo`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Índices para tabela `videostreinamento`
--
ALTER TABLE `videostreinamento`
  ADD PRIMARY KEY (`idVideo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `certificados`
--
ALTER TABLE `certificados`
  MODIFY `idCertificado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `conclusaovideousuario`
--
ALTER TABLE `conclusaovideousuario`
  MODIFY `idConclusao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `videostreinamento`
--
ALTER TABLE `videostreinamento`
  MODIFY `idVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_2` FOREIGN KEY (`idTreinamento`) REFERENCES `videostreinamento` (`idVideo`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_3` FOREIGN KEY (`idTutorEmissor`) REFERENCES `usuarios` (`idUsuario`);

--
-- Limitadores para a tabela `conclusaovideousuario`
--
ALTER TABLE `conclusaovideousuario`
  ADD CONSTRAINT `conclusaovideousuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `conclusaovideousuario_ibfk_2` FOREIGN KEY (`idVideo`) REFERENCES `videostreinamento` (`idVideo`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `videostreinamento`
--
ALTER TABLE `videostreinamento`
  ADD CONSTRAINT `videostreinamento_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
