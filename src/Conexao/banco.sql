-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/11/2025 às 14:01
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
(67, 'Introdução à Acessibilidade Digital', '<span id=\"docs-internal-guid-b4a2db11-7fff-1b6f-5e1e-a1adc5dcc214\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">A acessibilidade digital busca garantir que todas as pessoas, independentemente de suas condições físicas, sensoriais, cognitivas ou tecnológicas, possam acessar, compreender e interagir com conteúdos disponíveis em meios digitais. Tornar ambientes virtuais acessíveis é um passo essencial para a inclusão social e o exercício pleno da cidadania.</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>', 1),
(68, 'Tecnologia Assistiva e Inclusão Digital', '<span id=\"docs-internal-guid-fd1e2c51-7fff-3496-1f15-9017b669ff36\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">O termo Tecnologia Assistiva abrange recursos e serviços que ampliam as habilidades funcionais de pessoas com deficiência, facilitando o acesso à informação, à comunicação e à aprendizagem. No contexto digital, elas desempenham um papel fundamental para garantir que todos possam utilizar computadores, celulares e aplicativos de forma autônoma.</span></span>', 2),
(69, 'Glossário', '<span id=\"docs-internal-guid-14a6e813-7fff-4a53-4931-e021f7410112\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><b>Ambientes virtuais:</b> Espaços digitais de interação e aprendizado que permitem a comunicação, o compartilhamento de informações e o acesso a conteúdos por meio da internet. Exemplos incluem plataformas de ensino, redes sociais e sistemas online de gestão.</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><b>Dispositivos móveis: </b>Equipamentos portáteis com capacidade de processamento e conexão à internet, como smartphones e tablets. Eles permitem acesso a aplicativos, sites e serviços digitais em qualquer lugar, promovendo mobilidade e conectividade.</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><b>Pessoa com deficiência:</b> É o indivíduo que tem impedimentos de natureza física, sensorial, intelectual ou mental que, em interação com barreiras, podem limitar sua participação plena e efetiva na sociedade em igualdade de condições com as demais pessoas (conforme a Lei Brasileira de Inclusão – Lei nº 13.146/2015).</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>', 3);

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
(56, 'O que é Acessibilidade Digital', '<span id=\"docs-internal-guid-5067ebef-7fff-9366-a9f2-2d7abe447c5e\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">A acessibilidade digital refere-se à prática de desenvolver e adaptar conteúdos, sistemas e interfaces de forma que possam ser utilizados por todos, inclusive por pessoas com deficiência. Isso inclui recursos como leitores de tela, legendas, descrições em áudio, navegação por teclado e contraste adequado entre cores.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Quando um site, aplicativo ou documento é acessível, ele se torna mais fácil de usar para todos. Não apenas para quem depende de Tecnologia Assistiva, mas também para pessoas idosas, com conexão lenta ou que utilizam dispositivos móveis.</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>\r\n            ', 9, 67, '2025-11-10 06:41:19', '2025-11-10 02:41:19', 0),
(57, 'Importância da Acessibilidade na Web', '<span id=\"docs-internal-guid-a79b941d-7fff-e889-c58d-97a0f87bd610\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">A acessibilidade na web promove igualdade de acesso à informação e amplia a participação de diferentes grupos sociais no ambiente digital.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Seguir diretrizes de acessibilidade, como as WCAG (Web Content Accessibility Guidelines), contribui para o cumprimento de leis e políticas públicas, além de melhorar a experiência geral dos usuários.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Sites acessíveis são mais fáceis de navegar, têm melhor desempenho em buscadores e demonstram compromisso com a inclusão e a responsabilidade social.</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>\r\n            ', 9, 67, '2025-11-10 06:41:39', '2025-11-10 02:41:39', 0),
(59, ' Leitores de Tela', '<span id=\"docs-internal-guid-bb23d790-7fff-2050-3def-f650ab7b0301\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Leitores de tela são programas que transformam em voz o conteúdo exibido na tela do computador ou do celular. Eles permitem que pessoas cegas ou com baixa visão naveguem por interfaces digitais utilizando comandos de teclado.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Entre os leitores de tela mais conhecidos estão o NVDA (NonVisual Desktop Access), gratuito e de código aberto, e o JAWS (Job Access With Speech), amplamente usado em ambientes corporativos.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Essas ferramentas interpretam textos, botões, menus e imagens com descrição alternativa, possibilitando o uso completo de sistemas e páginas da web.</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>\r\n            ', 9, 68, '2025-11-10 06:44:05', '2025-11-10 02:44:05', 0),
(60, ' Ampliadores de tela ', '<span id=\"docs-internal-guid-f222c296-7fff-73ed-438f-50d6ec6483c3\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Esses dispositivos aumentam o tamanho dos elementos visuais, beneficiando pessoas com baixa visão. Os teclados e mouses adaptados facilitam o uso por pessoas com limitações motoras.</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>\r\n            ', 9, 68, '2025-11-10 06:44:29', '2025-11-10 02:44:29', 0),
(61, 'Displays Braille', '<span id=\"docs-internal-guid-9a36815e-7fff-e24d-dc9a-7f0b52b85d06\"><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">são dispositivos de hardware que convertem o texto digital em braille tátil.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Essas soluções contribuem para uma interação mais autônoma, acessível e inclusiva com as tecnologias digitais.</span></p><div><span style=\"font-size: 12pt; font-family: Calibri, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>\r\n            ', 9, 68, '2025-11-10 06:44:57', '2025-11-10 02:44:57', 0);

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
(16, 'UsuarioTeste', 'Usuarioteste@gmail.com', 'admin', NULL, '123', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
