-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/10/2025 às 02:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcclucas_ads19`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `secoes`
--

CREATE TABLE `secoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `secoes`
--

INSERT INTO `secoes` (`id`, `nome`, `descricao`, `ordem`) VALUES
(57, 'primeira', 'asdasddsa', 1),
(58, 'segunda', 'adsadsad', 2),
(59, 'terceira editada', '<b>asdasdasd</b><br><br><ul style=\"font-weight: bold;\"><li><b>editada</b></li><li><b>asdasda</b></li><li><b>asdasd</b></li></ul><ol><li><b>asdasdasd</b></li><li><b>asdasdas</b></li><li><b>adasd</b></li></ol>', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subsecoes`
--

CREATE TABLE `subsecoes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_secao` int(11) NOT NULL,
  `data_publicacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ordem` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subsecoes`
--

INSERT INTO `subsecoes` (`id`, `titulo`, `conteudo`, `id_autor`, `id_secao`, `data_publicacao`, `data_atualizacao`, `ordem`) VALUES
(46, 'PRIMEIRA', 'ADASDASD', 9, 59, '2025-10-08 20:28:45', '2025-10-08 15:29:18', 1),
(47, 'SEG', 'SDAASSDAAD', 9, 59, '2025-10-08 20:28:57', '2025-10-08 15:29:18', 2),
(48, 'terceira', 'ADSASDA', 9, 59, '2025-10-08 20:29:06', '2025-10-08 15:29:06', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `sessaoID` varchar(255) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `codigo_recuperacao` varchar(10) DEFAULT NULL,
  `codigo_expiracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_usuario`, `email`, `tipo`, `sessaoID`, `senha`, `codigo_recuperacao`, `codigo_expiracao`) VALUES
(9, 'adm', 'adm@gmail.com', 'admin', NULL, '12', NULL, NULL),
(12, 'lucas', 'lucas.2023001290@aluno.iffar.edu.br', 'comum', NULL, '12', NULL, NULL),
(14, 'eliana', 'elina@gmail', 'admin', NULL, '12', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `secoes`
--
ALTER TABLE `secoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_secao` (`id_secao`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `secoes`
--
ALTER TABLE `secoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `subsecoes`
--
ALTER TABLE `subsecoes`
  ADD CONSTRAINT `subsecoes_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subsecoes_ibfk_2` FOREIGN KEY (`id_secao`) REFERENCES `secoes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
