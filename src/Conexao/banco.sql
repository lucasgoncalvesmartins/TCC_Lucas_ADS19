-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/10/2025 às 07:34
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
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `secoes`
--

INSERT INTO `secoes` (`id`, `nome`, `descricao`) VALUES
(43, 'Apresentação', 'Estudantes de cursos de computação frequentemente enfrentam diversos desafios e obstáculos ao longo de seus estudos [5], em especial, nas disciplinas que envolvem Programação de Computadores. No caso de estudantes cegos, surgem várias barreiras adicionais durante o processo de aprendizagem [14], que podem impactar negativamente no engajamento e na dedicação desses estudantes, comprometendo a sua formação e preparação para ingressar no mercado de trabalho.\r\n\r\nNeste sentido, esta Cartilha foi elaborada para apoiar os professores de disciplinas relacionadas à Programação de Computadores no planejamento e na condução das aulas para estudantes cegos. São apresentadas informações sobre os principais desafios enfrentados por esses estudantes e fornecidas orientações sobre a elaboração e seleção de materiais, tarefas e estratégias de avaliação, além de uma lista de ferramentas que podem aprimorar a acessibilidade e auxiliar esses estudantes durante o processo de aprendizado.'),
(44, 'Visão geral da deficiência visual', 'O <a href=\"https://www.planalto.gov.br/ccivil_03/_Ato2004-2006/2004/Decreto/D5296.htm\" target=\"_blank\">DECRETO 5.296</a> [9], de 02 de dezembro de 2004, define a deficiência visual como sendo:\r\n\r\n[ul]\r\n<li>cegueira, quando acuidade visual¹ menor ou igual de 0,05 no melhor olho, com a melhor correção óptica;</li>\r\n<li>baixa visão, quando acuidade visual entre 0,3 e 0,05 no melhor olho, com a melhor correção óptica;</li>\r\n<li>os casos em que a soma da medida do campo visual2 em ambos os olhos for igual ou menor que 60°; ou,</li>\r\n<li>a ocorrência simultânea de qualquer das condições anteriores.</li>\r\n[/ul]\r\n\r\nA cegueira ocorre quando há perda total da visão, pouquíssima capacidade de enxergar [10], até a ausência de projeção de luz [8].\r\n\r\nA baixa visão ou visão subnormal, por sua vez, é caracterizada pelo comprometimento do funcionamento visual dos olhos, mesmo após tratamento ou correção [1].\r\n\r\n[nota][ol]\r\n<li>Capacidade do sistema visual de discriminar dois pontos de alto contraste no espaço [20].</li>\r\n<li>Capacidade de percepção da amplitude ou extensão total da visão [6] .</li>\r\n[/ol][/nota]\r\n\r\n'),
(45, 'Tecnologia Assistiva', 'Refere-se à pesquisa, produção e uso de equipamentos, recursos ou estratégias desenvolvidos para ampliar as habilidades funcionais das pessoas com deficiência, proporcionando-lhes maior independência, qualidade de vida e inclusão social [7,3].\r\n\r\nUma Tecnologia Assistiva (TA) pode ser tanto um dispositivo de hardware quanto de software, desenvolvido pela indústria ou personalizado pelos próprios usuários finais [4].\r\n\r\nNos ambientes digitais, recursos de TA são essenciais para proporcionar a inserção de usuários com deficiência visual, pois promovem igualdade de oportunidades [13] e propiciam liberdade e autonomia para realizarem tarefas difíceis sem dependerem de assistência visual [4].\r\n\r\nEm se tratando especificamente de Programação de Computadores, os principais recursos de TA utilizados por pessoas com deficiência visual são os leitores de tela e os Displays Braille.Refere-se à pesquisa, produção e uso de equipamentos, recursos ou estratégias desenvolvidos para ampliar as habilidades funcionais das pessoas com deficiência, proporcionando-lhes maior independência, qualidade de vida e inclusão social [7,3].\r\n\r\nUma Tecnologia Assistiva (TA) pode ser tanto um dispositivo de hardware quanto de software, desenvolvido pela indústria ou personalizado pelos próprios usuários finais [4].\r\n\r\nNos ambientes digitais, recursos de TA são essenciais para proporcionar a inserção de usuários com deficiência visual, pois promovem igualdade de oportunidades [13] e propiciam liberdade e autonomia para realizarem tarefas difíceis sem dependerem de assistência visual [4].\r\n\r\nEm se tratando especificamente de Programação de Computadores, os principais recursos de TA utilizados por pessoas com deficiência visual são os leitores de tela e os Displays Braille.'),
(46, 'Desafios enfrentados por estudantes cegos', 'Programação de Computadores pode ser descrita como o processo de escrever, testar, depurar e manter o código-fonte de programas [21], para instruir um computador a solucionar problemas [15].\r\n\r\nPara programar, é necessário utilizar uma sequência de instruções ou comandos textuais específicos, escritos em linguagem de programação [21].\r\n\r\nEssa é uma área que requer a compreensão de conceitos abstratos [16] e o desenvolvimento de habilidades e competências para conceber programas que solucionem problemas reais, o que pode ser desafiador para estudantes iniciantes [12].\r\n\r\nNo caso específico de estudantes cegos, a ausência da visão pode impor obstáculos tanto para o processo de leitura e escrita de código-fonte quanto para a utilização das ferramentas que oferecem suporte a realização dessas atividades.'),
(47, 'Estratégias para ensinar programação', 'Algumas estratégias podem ser adotadas no intuito de melhorar a aprendizagem dos estudantes cegos e proporcionar um ambiente de aprendizagem mais inclusivo.'),
(48, 'Recursos Úteis', '[ul]\r\n<li><b>AccessComputing</b>\r\n<a href=\"https://www.washington.edu/accesscomputing/\" target=\"_blank\">https://www.washington.edu/accesscomputing/</a>\r\n\r\nDisponibilizada pela Universidade de Washington, essa plataforma permite que estudantes universitários e de pós-graduação com deficiência se conectem com mentores e profissionais para obter informações sobre estágios e outras oportunidades nas áreas de computação. Também auxilia instituições de ensino superior e outras organizações a promover a inclusão de pessoas com deficiência na educação e no mercado de trabalho em tecnologia da informação.\r\n</li>\r\n\r\n<li><b>Audio Descrição</b>\r\n<a href=\"http://audiodescricao.com.br/ad/\" target=\"_blank\">http://audiodescricao.com.br/ad/</a>\r\n\r\nFornece recursos que permitem a inclusão de pessoas com deficiência visual em cinema, teatro e programas de televisão.</li>\r\n\r\n<li><b>Blocks4All</b>\r\n<a href=\"https://milnel2.github.io/blocks4alliOS/\" target=\"_blank\">https://milnel2.github.io/blocks4alliOS/</a>\r\n\r\nAmbiente de programação baseado em blocos desenvolvido para iPad, para ensino de programação de computadores para pessoas com deficiência visual. Nesse ambiente, o usuário utiliza comandos de voz para controlar um robô Dash e movimentar os blocos. Permite trabalhar conceitos de programação como variáveis, tipos de dados e estruturas de controle.\r\n</li>\r\n\r\n<li><b>CodeJumper</b>\r\n<a href=\"https://codejumper.com/index.php\" target=\"_blank\">https://codejumper.com/index.php</a>\r\n\r\nAmbiente de programação tangível desenvolvido pela Microsoft Research Cambridge projetada para alunos cegos ou com baixa visão. Inclui um kit físico composto por um hub, pods, plugues e cabos, além de um aplicativo compatível com leitores de tela e Displays Braille.\r\n</li>\r\n\r\n<li><b>Code Talk</b>\r\n<a href=\"https://microsoft.github.io/CodeTalk/\" target=\"_blank\">https://microsoft.github.io/CodeTalk/</a>\r\n\r\nPlug-in de acessibilidade desenvolvido para Microsoft Visual Studio que aborda em três principais aspectos da programação:\r\n[ol]<li>oferece um resumo acessível da estrutura do código-fonte;</li>\r\n<li>possibilita acesso a informações em tempo real;</li>\r\n<li>torna as atividades de depuração de código mais acessíveis.</li>\r\n[/ol]\r\n</li>\r\n<li><b>Developer toolkit (DTK)</b>\r\n<a href=\"https://addons.nvda-project.org/addons/developerToolkit.en.html\" target=\"_blank\">https://addons.nvda-project.org/addons/developerToolkit.en.html</a>\r\n\r\nPlug-in para NVDA que auxilia usuários cegos no desenvolvimento de interfaces de usuário e conteúdo web, oferecendo ferramentas para navegar pelos objetos e acessar informações sobre eles, como tamanho, posição e características.\r\n</li>\r\n\r\n<li><b>Donnie</b>\r\n<a href=\"https://github.com/lsa-pucrs/donnie-assistive-robot-sw\" target=\"_blank\">https://github.com/lsa-pucrs/donnie-assistive-robot-sw</a>\r\n\r\nAmbiente de programação de robô projetado para estimular as habilidades de orientação e mobilidade de pessoas com deficiência visual através da exploração de cenários. O sistema conta com uma linguagem de programação (GoDonnie), um robô simulado e um robô físico baseado em Arduino, permitindo abordar conteúdos relacionados a programação de computadores como tipos de dados e estruturas de controle.\r\n</li>\r\n\r\n<li><b>JavaSpeak</b>\r\n<a href=\"https://cs.winona.edu/cscap/javaspeak.html\" target=\"_blank\">https://cs.winona.edu/cscap/javaspeak.html</a>\r\n\r\nAmbiente de Desenvolvimento Integrado projetado para fornecer a um usuário cego informações úteis sobre a estrutura e a semântica de um programa Java. A versão atual do JavaSpeak (3.0) é implementada como um conjunto de plug-ins para o IDE Eclipse.\r\n</li>\r\n\r\n<li><b>Learning Ally</b>\r\n<a href=\"https://learningally.org/\" target=\"_blank\">https://learningally.org/</a>\r\n\r\nOrganização sem fins lucrativos que fornece soluções educacionais e uma biblioteca de audiolivros lidos por humanos especialistas no assunto. Inclui vários livros relacionados à diversos temas e áreas, incluindo Ciência da Computação e Programação de Computadores. Entretanto, a maioria dos livros está em língua inglesa\r\n</li>\r\n\r\n<li><b>Noodle</b>\r\n<a href=\"https://hackage.haskell.org/package/noodle\" target=\"_blank\">https://hackage.haskell.org/package/noodle</a>\r\n\r\nAmbiente de programação acessível para criação de som e música em que os elementos do programa podem ser inseridos e organizados apenas por meio de comandos do teclado.\r\n</li>\r\n\r\n<li><b>Quorum Programming Language</b>\r\n<a href=\"https://quorumlanguage.com/\" target=\"_blank\">https://quorumlanguage.com/</a>\r\n\r\nLinguagem de programação baseada em evidências criada para simplificar a sintaxe e fornecer acessibilidade para alunos cegos ou com deficiência visual.\r\n</li>\r\n\r\n<li><b>SodBeans (SonifiedOmniscient Debugger no Netbeans)</b>\r\n<a href=\"https://sourceforge.net/projects/sodbeans/\" target=\"_blank\">https://sourceforge.net/projects/sodbeans/</a>\r\n\r\nPlug-in de acessibilidade para NetBeans que adiciona suporte para a linguagem de programação Quorum.\r\n</li>\r\n\r\n<li><b>Visual Studio Code</b>\r\n<a href=\"https://code.visualstudio.com/\" target=\"_blank\">https://code.visualstudio.com/</a>\r\n\r\nEditor de código-fonte desenvolvido pela Microsoft para Windows, Linux e macOS que fornece vários de acessibilidade para pessoas com deficiência visual.\r\n</li>\r\n\r\n<li><b>Web Accessibility Extension to Visual Studio Code</b>\r\n<a href=\"https://marketplace.visualstudio.com/items?itemName=MaxvanderSchee.web -accessibility\" target=\"_blank\">https://marketplace.visualstudio.com/items?itemName=MaxvanderSchee.web -accessibility</a>\r\n\r\nFornece informações sobre a acessibilidade de uma interface originada a partir de um código-fonte, identificando os elementos que requerem ajustes e oferecendo orientações sobre como realizar essas alterações de forma aprimorar a acessibilidade.\r\n</li>\r\n[/ul]\r\n\r\n'),
(49, 'Considerações finais', 'Ao planejar e selecionar as tecnologias e materiais que serão utilizados nas aulas de Programação de Computadores para estudantes cegos, é necessário que os professores tenham clareza de que os níveis de familiaridade desses estudantes com Tecnologia Assistiva e com computadores pode variar consideravelmente. Por exemplo, alguns estudantes podem estar familiarizados com leitores de tela, mas apresentar diferentes níveis de familiaridade com o layout do teclado.\r\n\r\nAlém disso, estudantes com a mesma deficiência visual podem ter necessidades, preferências e hábitos distintos. Em outras palavras, um abordagem eficaz para um estudante pode não ser tão útil para outro com a mesma deficiência.\r\n\r\nÉ essencial, portanto, dialogar com esses estudantes, explorar suas experiências anteriores, tanto as bem-sucedidas quanto as que não deram certo, e então planejar as aulas e selecionar recursos que melhor atendam a esses estudantes.\r\n\r\nÉ fundamental, ainda, que os professores estejam familiarizados com as possibilidade de configuração de acessibilidade oferecidos pelos Ambientes de Desenvolvimento Integrado e saibam usar os recursos de Tecnologia Assistiva utilizados pelos estudantes.\r\n\r\nPor fim, acredita-se que as metodologias, sugestões e recursos apresentados nesta Cartilha possam beneficiar a aprendizagem de todos os estudantes, não apenas aqueles que são cegos.');

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
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 'adm', 'adm@gmail.com', 'admin', NULL, '12', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
