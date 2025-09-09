-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/09/2025 às 20:38
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
(16, 'Apresentação', 'Estudantes de cursos de computação frequentemente enfrentam diversos desafios e obstáculos ao longo de seus estudos [5], em especial, nas disciplinas que envolvem Programação de Computadores. No caso de estudantes cegos, surgem várias barreiras adicionais durante o processo de aprendizagem [14], que podem impactar negativamente no engajamento e na dedicação desses estudantes, comprometendo a sua formação e preparação para ingressar no mercado de trabalho.\r\n\r\nNeste sentido, esta Cartilha foi elaborada para apoiar os professores de disciplinas relacionadas à Programação de Computadores no planejamento e na condução das aulas para estudantes cegos. São apresentadas informações sobre os principais desafios enfrentados por esses estudantes e fornecidas orientações sobre a elaboração e seleção de materiais, tarefas e estratégias de avaliação, além de uma lista de ferramentas que podem aprimorar a acessibilidade e auxiliar esses estudantes durante o processo de aprendizado.'),
(17, 'Visão geral da deficiência visual', 'O DECRETO 5.296 [9], de 02 de dezembro de 2004, define a deficiência visual como sendo:\r\n\r\n[ul]\r\n[li]cegueira, quando acuidade visual¹ menor ou igual de 0,05 no melhor olho, com a melhor correção óptica;[/li]\r\n[li]baixa visão, quando acuidade visual entre 0,3 e 0,05 no melhor olho, com a melhor correção óptica;[/li]\r\n[li]os casos em que a soma da medida do campo visual2 em ambos os olhos for igual ou menor que 60°; ou,[/li]\r\n[li]a ocorrência simultânea de qualquer das condições anteriores.[/li]\r\n[li]A cegueira ocorre quando há perda total da visão, pouquíssima capacidade de enxergar [10], até a ausência de projeção de luz [8].[/li]\r\n[/ul]\r\n\r\nA baixa visão ou visão subnormal, por sua vez, é caracterizada pelo comprometimento do funcionamento visual dos olhos, mesmo após tratamento ou correção [1].\r\n\r\n[nota][ol]\r\n[li]Capacidade do sistema visual de discriminar dois pontos de alto contraste no espaço [20].[/li]\r\n[li]Capacidade de percepção da amplitude ou extensão total da visão [6].[/li]\r\n[/ol][/nota]'),
(18, 'Tecnologia Assistiva', 'Refere-se à pesquisa, produção e uso de equipamentos, recursos ou estratégias desenvolvidos para ampliar as habilidades funcionais das pessoas com deficiência, proporcionando-lhes maior independência, qualidade de vida e inclusão social [7,3].\r\n\r\nUma Tecnologia Assistiva (TA) pode ser tanto um dispositivo de hardware quanto de software, desenvolvido pela indústria ou personalizado pelos próprios usuários finais [4].\r\n\r\nNos ambientes digitais, recursos de TA são essenciais para proporcionar a inserção de usuários com deficiência visual, pois promovem igualdade de oportunidades [13] e propiciam liberdade e autonomia para realizarem tarefas difíceis sem dependerem de assistência visual [4].\r\n\r\nEm se tratando especificamente de Programação de Computadores, os principais recursos de TA utilizados por pessoas com deficiência visual são os leitores de tela e os Displays Braille.'),
(19, 'Desafios enfrentados por estudantes cegos', 'Programação de Computadores pode ser descrita como o processo de escrever, testar, depurar e manter o código-fonte de programas [21], para instruir um computador a solucionar problemas [15].\r\n\r\nPara programar, é necessário utilizar uma sequência de instruções ou comandos textuais específicos, escritos em linguagem de programação [21].\r\n\r\nEssa é uma área que requer a compreensão de conceitos abstratos [16] e o desenvolvimento de habilidades e competências para conceber programas que solucionem problemas reais, o que pode ser desafiador para estudantes iniciantes [12].\r\n\r\nNo caso específico de estudantes cegos, a ausência da visão pode impor obstáculos tanto para o processo de leitura e escrita de código-fonte quanto para a utilização das ferramentas que oferecem suporte a realização dessas atividades.'),
(20, 'Estratégias para ensinar programação', 'Algumas estratégias podem ser adotadas no intuito de melhorar a aprendizagem dos estudantes cegos e proporcionar um ambiente de aprendizagem mais inclusivo.'),
(21, 'Recursos Úteis', '<b>AccessComputing</b>\r\n<a href=\"https://www.washington.edu/accesscomputing/\" target=\"_blank\">https://www.washington.edu/accesscomputing/</a>\r\nDisponibilizada pela Universidade de Washington, essa plataforma permite que estudantes universitários e de pós-graduação com deficiência se conectem com mentores e profissionais para obter informações sobre estágios e outras oportunidades nas áreas de computação. Também auxilia instituições de ensino superior e outras organizações a promover a inclusão de pessoas com deficiência na educação e no mercado de trabalho em tecnologia da informação.\r\n\r\n<b>Audio Descrição</b>\r\n<a href=\"https://milnel2.github.io/blocks4alliOS/\" target=\"_blank\">https://milnel2.github.io/blocks4alliOS/</a>\r\nFornece recursos que permitem a inclusão de pessoas com deficiência visual em cinema, teatro e programas de televisão.\r\n\r\n<b>Blocks4All</b>\r\n<a href=\"https://www.washington.edu/accesscomputing/\" target=\"_blank\">https://milnel2.github.io/blocks4alliOS/</a>\r\nAmbiente de programação baseado em blocos desenvolvido para iPad, para ensino de programação de computadores para pessoas com deficiência visual. Nesse ambiente, o usuário utiliza comandos de voz para controlar um robô Dash e movimentar os blocos. Permite trabalhar conceitos de programação como variáveis, tipos de dados e estruturas de controle.\r\n\r\n<b>CodeJumper</b>\r\n<a href=\"https://www.washington.edu/accesscomputing/\" target=\"_blank\">https://codejumper.com/index.php</a>\r\nAmbiente de programação tangível desenvolvido pela Microsoft Research Cambridge projetada para alunos cegos ou com baixa visão. Inclui um kit físico composto por um hub, pods, plugues e cabos, além de um aplicativo compatível com leitores de tela e Displays Braille.\r\n\r\n<b>Code Talk</b>\r\n<a href=\"https://microsoft.github.io/CodeTalk/\" target=\"_blank\">https://microsoft.github.io/CodeTalk/</a>\r\nPlug-in de acessibilidade desenvolvido para Microsoft Visual Studio que aborda em três principais aspectos da programação:\r\n\r\noferece um resumo acessível da estrutura do código-fonte;\r\npossibilita acesso a informações em tempo real;\r\ntorna as atividades de depuração de código mais acessíveis.\r\n\r\n<b>Developer toolkit</b> (DTK)\r\n<a href=\"https://addons.nvda-project.org/addons/developerToolkit.en.html\" target=\"_blank\">https://addons.nvda-project.org/addons/developerToolkit.en.html</a>\r\nPlug-in para NVDA que auxilia usuários cegos no desenvolvimento de interfaces de usuário e conteúdo web, oferecendo ferramentas para navegar pelos objetos e acessar informações sobre eles, como tamanho, posição e características.\r\n\r\n<b>Donnie</b>\r\n<a href=\"https://github.com/lsa-pucrs/donnie-assistive-robot-sw\" target=\"_blank\">https://github.com/lsa-pucrs/donnie-assistive-robot-sw</a>\r\nAmbiente de programação de robô projetado para estimular as habilidades de orientação e mobilidade de pessoas com deficiência visual através da exploração de cenários. O sistema conta com uma linguagem de programação (GoDonnie), um robô simulado e um robô físico baseado em Arduino, permitindo abordar conteúdos relacionados a programação de computadores como tipos de dados e estruturas de controle.\r\n\r\n<b>JavaSpeak</b>\r\n<a href=\"https://cs.winona.edu/cscap/javaspeak.html\" target=\"_blank\">https://cs.winona.edu/cscap/javaspeak.html</a>\r\nAmbiente de Desenvolvimento Integrado projetado para fornecer a um usuário cego informações úteis sobre a estrutura e a semântica de um programa Java. A versão atual do JavaSpeak (3.0) é implementada como um conjunto de plug-ins para o IDE Eclipse.\r\n\r\n<b>Learning Ally</b>\r\n<a href=\"https://learningally.org/\" target=\"_blank\">https://learningally.org/</a>\r\nOrganização sem fins lucrativos que fornece soluções educacionais e uma biblioteca de audiolivros lidos por humanos especialistas no assunto. Inclui vários livros relacionados à diversos temas e áreas, incluindo Ciência da Computação e Programação de Computadores. Entretanto, a maioria dos livros está em língua inglesa\r\n\r\n<b>Noodle</b>\r\n<a href=\"https://hackage.haskell.org/package/noodle\" target=\"_blank\">https://hackage.haskell.org/package/noodle</a>\r\nAmbiente de programação acessível para criação de som e música em que os elementos do programa podem ser inseridos e organizados apenas por meio de comandos do teclado.\r\n\r\n<b>Quorum Programming Language</b>\r\n<a href=\"https://quorumlanguage.com/\" target=\"_blank\">https://quorumlanguage.com/</a>\r\nLinguagem de programação baseada em evidências criada para simplificar a sintaxe e fornecer acessibilidade para alunos cegos ou com deficiência visual.\r\n\r\n<b>SodBeans</b> (SonifiedOmniscient Debugger no Netbeans)\r\n<a href=\"https://sourceforge.net/projects/sodbeans/\" target=\"_blank\">https://sourceforge.net/projects/sodbeans/</a>\r\nPlug-in de acessibilidade para NetBeans que adiciona suporte para a linguagem de programação Quorum.\r\n\r\n<b>Visual Studio Code</b>\r\nhttps://code.visualstudio.com/\r\nEditor de código-fonte desenvolvido pela Microsoft para Windows, Linux e macOS que fornece vários de acessibilidade para pessoas com deficiência visual.\r\n\r\n<b>Web Accessibility Extension to Visual Studio Code</b>\r\n<a href=\"https://marketplace.visualstudio.com/items?itemName=MaxvanderSchee.web -accessibility\" target=\"_blank\">https://marketplace.visualstudio.com/items?itemName=MaxvanderSchee.web -accessibility</a>\r\nFornece informações sobre a acessibilidade de uma interface originada a partir de um código-fonte, identificando os elementos que requerem ajustes e oferecendo orientações sobre como realizar essas alterações de forma aprimorar a acessibilidade.'),
(23, 'Considerações finais', 'Ao planejar e selecionar as tecnologias e materiais que serão utilizados nas aulas de Programação de Computadores para estudantes cegos, é necessário que os professores tenham clareza de que os níveis de familiaridade desses estudantes com Tecnologia Assistiva e com computadores pode variar consideravelmente. Por exemplo, alguns estudantes podem estar familiarizados com leitores de tela, mas apresentar diferentes níveis de familiaridade com o layout do teclado.\r\n\r\nAlém disso, estudantes com a mesma deficiência visual podem ter necessidades, preferências e hábitos distintos. Em outras palavras, um abordagem eficaz para um estudante pode não ser tão útil para outro com a mesma deficiência.\r\n\r\nÉ essencial, portanto, dialogar com esses estudantes, explorar suas experiências anteriores, tanto as bem-sucedidas quanto as que não deram certo, e então planejar as aulas e selecionar recursos que melhor atendam a esses estudantes.\r\n\r\nÉ fundamental, ainda, que os professores estejam familiarizados com as possibilidade de configuração de acessibilidade oferecidos pelos Ambientes de Desenvolvimento Integrado e saibam usar os recursos de Tecnologia Assistiva utilizados pelos estudantes.\r\n\r\nPor fim, acredita-se que as metodologias, sugestões e recursos apresentados nesta Cartilha possam beneficiar a aprendizagem de todos os estudantes, não apenas aqueles que são cegos.'),
(25, 'Glossário', '<b>Programação de Computadores </b>- Atividade de escrever código em linguagens de programação para criar sistemas e aplicativos (TAVARES 2023).\r\n\r\n<b>Linguagem de Programação</b> - Conjunto de regras e sintaxe usada para escrever programas de computador (TAVARES 2023).\r\n\r\n<b>Ambiente de Desenvolvimento Integrado (IDE)</b> - Software que combina várias ferramentas de desenvolvimento como editor de código, compilador, depurador facilitando a criação, teste e depuração de aplicação (BRASILC 2012).\r\n\r\n<b>Código-Fonte</b> - Conjunto de instruções escritas pelo programador que serão interpretadas e compiladas pelo computador (BRASILD 2021).\r\n\r\n<b>Depurar </b>(<i>Debugging</i>) - Processo de identificar e corrigir erros ou bugs no código-fonte de qualquer software (AWS 2024 ).\r\n\r\n<b>audiolivros</b> - Transcrição em áudio de um material impresso (EB 2025).\r\n\r\n<b>feedback</b> - Termo utilizado para indicar uma comunicação de retorno, seja positiva ou negativa (DOS SANTOS; DA SILVEIRA, 2018).\r\n\r\n<b>Layout do teclado</b> - Refere-se a disposição fisica das teclas em um teclado, podendo influenciar na facilidade de uso e digitação (DIGITOW 2024).\r\n\r\n<b>Atalhos de Teclado</b> - Combinações de teclas que substituem ações feitas com o mouse, essenciais para pessoas cegas (MICROSOFT 2025).\r\n\r\n'),
(26, 'Referências Bibliográficas', '[1] AAO.ORG. American Academy of Ophthalmology. (Acesso: 06/19/2022), https://www.aao.org/ .\r\n[2] ABREU, Stênio et al. Usability evaluation of a resource to read mathematical formulae in a screen reader for people with visual disabilities. In: Proceedings of the 18th Brazilian Symposium on Human Factors in Computing Systems. 2019. p. 1-11.\r\n[3] DE AJUDAS TÉCNICAS, Comitê. Tecnologia assistiva. Brasília: Corde, 2009\r\n[4] ALBUSAYS, Khaled; LUDI, Stephanie; HUENERFAUTH, Matt. Interviews and observation of blind software developers at work to understand code navigation challenges. In: Proceedings of the 19th International ACM SIGACCESS Conference on Computers and Accessibility. 2017. p. 91-100.\r\n[5] BAKER, Catherine M.; BENNETT, Cynthia L.; LADNER, Richard E. Educational experiences of blind programmers. In: Proceedings of the 50th ACM Technical Symposium on Computer Science Education. 2019. p. 759-765.\r\n[6] BEAL, Franciele et al. Braille-CM-TUI: ambiente de apoio à construção de conhecimento via mapas conceituais por estudantes com cegueira. 2020.\r\n[7] BERSCH, Rita. Introdução à tecnologia assistiva. Porto Alegre: CEDI, v. 21, 2008.\r\n[8] CARVALHO, Thiago et al. Saberes e práticas da inclusão: desenvolvendo competências para o atendimento às necessidades educacionais especiais de alunos cegos e de alunos com baixa visão. 2015\r\n[9] BRASIL. Decreto n5.296, 2 de dezembro de 2004. Brasília, DF, 2004. Disponível em: https://www.planalto.gov.br/ccivil_03/_Ato2004-2006/2004/Decreto/D5296.htm Acesso em: 28 de novembro de 2023\r\n[10] DA LUZ DIAS, James; DIAS, Maria da Luz Oliveira. Os leitores de tela como ferramenta de acessibilidade e inclusão da pessoa com Deficiência Visual. Brazilian Journal of Development, v. 5, n. 12, p. 28869-28878, 2019.\r\n[11] GERALDO, Rafael José. Um auxílio à navegação acessível na web para usuários cegos. 2016. Tese de Doutorado. Universidade de São Paulo.\r\n[12] GOMES, Marina et al. Um estudo sobre erros em programação- Reconhecendo as dificuldades de programadores iniciantes. In: Anais dos Workshops do Congresso Brasileiro de Informática na Educação. 2015. p. 1398.\r\n[13] GUIMARÃES, Ítalo José Bastos et al. Acessibilidade em websites de comércio eletrônico: avaliação através da interação com usuários cegos. 2016.\r\n[14] HADWEN-BENNETT, Alex; SENTANCE, Sue; MORRISON, Cecily. Making programming accessible to learners with visual impairments: a literature review. International Journal of Computer Science Education in Schools, v. 2, n. 2, p. 3-13, 2018.\r\n[15] HERMANS, Felienne; ALDEWERELD, Marlies. Programming is writing is programming. In: Companion Proceedings of the 1st International Conference on the Art, Science, and Engineering of Programming. 2017. p. 1-8.\r\n[16] LAHTINEN, Essi; ALA-MUTKA, Kirsti; JÄRVINEN, Hannu-Matti. A study of the difficulties of novice programmers. Acm sigcse bulletin, v. 37, n. 3, p. 14-18, 2005.\r\n[17] LEITE, Luís Adelmo Barbosa; FREITAS, André Lage. Levantamento de Tecnologias de Assistência à Educação para Pessoas com Deficiências Visuais. In: Anais do II Workshop de Desafios da Computação aplicada à Educação. SBC, 2013. p. 1339-1348.\r\n[18] LEONARDIS, Daniele; CLAUDIO, Loconsole; FRISOLI, Antonio. A survey on innovative refreshable braille display technologies. In: Advances in Design for Inclusion: Proceedings of the AHFE 2017 International Conference on Design for Inclusion, July 17-21, 2017, The Westin Bonaventure Hotel, Los Angeles, California, USA 8. Springer International Publishing, 2018. p. 488-498.\r\n[19] MOUNTAPMBEME, Aboubakar; OKAFOR, Obianuju; LUDI, Stephanie. Addressing Accessibility Barriers in Programming for People with Visual Impairments: A Literature Review. ACM Transactions on Accessible Computing (TACCESS), v. 15, n. 1, p. 1-26, 2022.\r\n[20] SAÚDE, O. Organização Mundial da. Relatório Mundial sobre a Visão. [S.I.]: Light for the World International, 2021. (Acesso: 06/15/2022).\r\n[21] SHARMA, Mamill');

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

--
-- Despejando dados para a tabela `subsecoes`
--

INSERT INTO `subsecoes` (`id`, `titulo`, `conteudo`, `id_autor`, `id_secao`, `data_publicacao`, `data_atualizacao`) VALUES
(23, 'Objetivos', 'O principal objetivo desta Cartilha é fornecer orientações para que os professores propiciem uma experiência educacional mais inclusiva e eficaz para todos os estudantes, independentemente de suas limitações visuais. Para isso, pretende-se atender aos seguintes propósitos:\r\n\r\n[ul]\r\n[li]Apresentar os principais desafios e limitações encontrados por estudantes cegos nas disciplinas relacionadas à Programação de Computadores;[/li]\r\n[li]Sugerir estratégias para que professores propiciem um ambiente mais inclusivo para os estudantes cegos nessas disciplinas;[/li]\r\n[li]Oferecer orientações para auxiliar o planejamento das aulas e a seleção e adaptação de materiais, atividades e estratégias de avaliação; e,[/li]\r\n[li]Listar recursos e ferramentas que podem proporcionar uma maior acessibilidade aos estudantes cegos.[/li]\r\n[/ul]', 1, 16, '2025-09-08 21:27:22', '2025-09-08 16:27:22'),
(24, 'Licença de Uso', 'Esta Cartilha é disponibilizada sob a licença \"Creative Commons Atribuição - Uso não comercial - Sem derivações 4.0 Internacional\" (CC BY-NC 4.0 DEED). Qualquer pessoa que tenha acesso ao seu conteúdo pode copiá-lo e compartilhá-lo, desde que atribua crédito aos autores, não realize alterações e não utilize a obra para fins comerciais.', 1, 16, '2025-09-08 21:27:56', '2025-09-08 16:27:56'),
(25, 'Publico-alvo', 'A Cartilha tem como público-alvo:\r\n\r\n[ul]\r\n[li]Professores que lecionam disciplinas relacionadas à Programação de Computadores para estudantes cegos; e,[/li]\r\n[li]Pedagogos, Educadores Especiais e outros profissionais que precisem orientar professores para condução das aulas dessas disciplinas.[/li]\r\n[/ul]', 1, 16, '2025-09-08 21:28:22', '2025-09-08 16:28:22'),
(26, 'Siglas', '[ul]\r\n[li]<b>IDE</b>: Integrated Development Environment Job Access With Speech[/li]\r\n[li]<b>JAWS</b>: Job Access With Speech[/li]\r\n[li]<b>NVDA</b>: NonVisual Desktop Access[/li]\r\n[li]<b>SodBeans</b>: Sonified Omniscient Debugger no Netbeans[/li]\r\n[li]<b>TA</b>: Tecnologia Assistiva[/li]\r\n[li]<b>UFRJ</b>: Universidade Federal do Rio de Janeiro[/li]\r\n[li]<b>VSCode</b>: Visual Studio Code[/li]\r\n[/ul]', 1, 16, '2025-09-08 21:30:14', '2025-09-08 16:30:14'),
(27, 'Leitores de Tela', 'Software que captura as informações textuais exibidas em dispositivos eletrônicos e as converte em saída de áudio, utilizando voz sintetizada [10,11].\r\n\r\nNormalmente, os leitores de telas realizam a leitura sequencial da interface, uma linha por vez, iniciando na parte superior à esquerda e seguindo pela direita [2].\r\n\r\nLeitores de tela mais conhecidos:\r\n\r\n[ul]\r\n[li]<b>JAWS</b> (<i>Job Access With Speech</i>). Desenvolvido pela empresa Freedom Scientific para Microsoft Windows.<br>\r\n<a href=\"https://www.freedomscientific.com/products/software/jaws/\" target=\"_blank\">https://www.freedomscientific.com/products/software/jaws/</a>[/li]\r\n[li]<b>NVDA</b> (NonVisual Desktop Access). Sistema de código aberto desenvolvido pela NV Access para Microsoft Windows.<br>\r\n<a href=\"https://www.nvaccess.org/\" target=\"_blank\">https://www.nvaccess.org/</a>[/li]\r\n[li]<b>Virtual Vision</b>. Software brasileiro desenvolvido para Microsoft Windows<br>\r\n<a href=\"https://www.virtualvision.com.br/\" target=\"_blank\">https://www.virtualvision.com.br/</a>[/li]\r\n[li]<b>Orca</b>. Software livre, de código aberto, flexível e extensível para Linux e Solaris.<br>\r\n<a href=\"https://help.gnome.org/users/orca/\" target=\"_blank\">https://help.gnome.org/users/orca/</a>[/li]\r\n[li]<b>DosVox</b>. Desenvolvido pela Universidade Federal do Rio de Janeiro (UFRJ) para Microsoft Windows.<br>\r\n<a href=\"https://intervox.nce.ufrj.br/dosvox/\" target=\"_blank\">https://intervox.nce.ufrj.br/dosvox/</a>[/li]\r\n[li]<b>VoiceOver</b>. Leitor de telas para watchOS, iOS, iPadOS e macOS<br>\r\n<a href=\"https://www.apple.com/br/accessibility/vision/\" target=\"_blank\">https://www.apple.com/br/accessibility/vision/</a>[/li]\r\n[li]<b>TalkBack</b>. Desenvolvido pela Google, incluído em dispositivos móveis que utilizam Android. <br>\r\n<a href=\"https://support.google.com/accessibility/android/#topic=9078845\" target=\"_blank\">https://support.google.com/accessibility/android/#topic=9078845</a>[/li]\r\n[/ul]', 1, 18, '2025-09-08 21:49:24', '2025-09-08 16:49:24'),
(28, 'Displays Braille', 'Dispositivo eletromecânico que traduz informações digitais em caracteres braile [4].\r\n\r\nDisponíveis em diferentes. tamanhos (quantidade de linhas), transmitem as informações utilizando pinos de ponta redonda dinamicamente elevados em uma superfície plana [18].\r\n\r\nNo caso de Programação de Computadores, podem auxiliar:\r\n\r\n[ul]\r\n[li]Na leitura do código, proporcionando uma visão mais abrangente de sua estrutura;[/li]\r\n[li]Na identificação de indentação em um código-fonte; e,[/li]\r\n[li]Na redução da carga auditiva³.[/li]\r\n[/ul]\r\n\r\n[nota]³Estresse experimentado quando muitas informações são transmitidas pelo canal de áudio [4][/nota]', 1, 18, '2025-09-08 21:52:29', '2025-09-08 16:52:29'),
(29, 'Desafios Tecnológicos', 'Os leitores de tela são o recurso de Tecnologia Assistiva mais utilizados por estudantes cegos, mas apresentam algumas limitações quando utilizados em conjunto com ferramentas e ambientes de programação:\r\n\r\n[ul]\r\n[li]Navegam pela interface gráfica do IDE e pelo código-fonte de forma linear, obrigando o usuário a percorrer o código uma linha de cada vez, em sequência [4][19].[/li]\r\n[li]Não verbalizam o código-fonte de maneira que faça sentido para o ouvinte o que pode acarretar omissão de partes importante ou a transmissão inadequada das informações.[/li]\r\n[li]Não interpretam caracteres não-alfanuméricos e não identificam partes relevantes ou irrelevantes do código, podendo tornar a leitura incompreensível para o ouvinte.[/li]\r\n[li]A grande variedade de funcionalidades oferecidas pelos IDEs para aumentar a produtividade e eficiência dos programadores pode resultar em interfaces complexas que não são totalmente acessíveis aos leitores de tela.[/li]\r\n[/ul]\r\n\r\nQuando os IDEs adotados pelos professores e colegas nas disciplinas não atendem a todas as necessidades de acessibilidade dos estudantes cegos, esses estudantes costumam procurar por soluções alternativas para realização das atividades.\r\n\r\nAo fazer isso, alguns desafios podem surgir:\r\n\r\n[ul]\r\n[li]Quando essas soluções não são as mesmas utilizadas pelos colegas, os estudantes cegos podem não ter a quem recorrer caso necessitem de ajuda para utilizá-las.[/li]\r\n[li]Ao realizarem atividades em grupo ou que requerem a colaboração dos colegas, pode ser difícil contribuir e compreender as ações que são realizadas.[/li]\r\n[li]Normalmente, esses recursos possuem funcionalidades reduzidas, o que pode impactar em maior tempo para concluir as atividades e maior esforço cognitivo, causando frustração nos estudantes.[/li]\r\n[/ul]', 1, 19, '2025-09-08 21:55:55', '2025-09-08 16:55:55'),
(30, 'Desafios Educacionais', '<b>Obtenção do contexto das falas:</b>\r\n\r\n<ul>\r\n  <li>Durante as aulas presenciais ou em palestras, geralmente, quem está falando não verbaliza ou descreve todas as informações transmitidas quando utiliza gestos, imagens ou escreve algo no quadro, o que pode dificultar a compreensão adequada do conteúdo pelos estudantes.</li>\r\n  <li>Ao utilizar ferramentas de compartilhamento de tela ou videoaulas, há problemas relacionados ao fato de que o leitor de tela não consegue pronunciar o que está sendo exibido, porque as informações são transmitidas como uma imagem.</li>\r\n  <li>Por não poderem observar o que está sendo digitado e exibido na tela, os estudantes cegos podem perder informações importantes caso não sejam pronunciadas todas as particularidades do código.\r\n    <ul>\r\n      <li>Considerando a natureza imperativa da sintaxe na computação, qualquer erro de digitação pode confundi-los.</li>\r\n    </ul>\r\n  </li>\r\n  <li>A velocidade da fala dos professores também pode ser um obstáculo, pois os estudantes podem ter dificuldade para acompanhar as atividades e compreender as explicações.</li>\r\n</ul>\r\n\r\n<b>Acessibilidade dos materiais de apoio:</b>\r\n\r\n[ul]\r\n[li]É difícil obter livros, apostilas e tutoriais em formato acessível e em tempo hábil para o melhor acompanhamento das aulas se realização das atividades solicitadas nas disciplinas.[/li]\r\n[li]A produção de livros didáticos em braile é demorada, requer equipamentos e conhecimentos especializados e tem um custo elevado. Além disso, alguns estudantes podem não estar familiarizados com esse sistema de escrita.[/li]\r\n[li]Os audiolivros são bastante acessíveis, pois proporcionam uma leitura contextual do conteúdo. No entanto, a obtenção de materiais nesse formato é desafiadora, e aqueles disponíveis, geralmente estão em língua inglesa.[/li]\r\n[li]Materiais de apoio impressos, quando escaneados em formato de imagem, não podem ser lidos pelos leitores de tela.[/li]\r\n[li]Quando os materiais usados pelo professor não são acessíveis aos leitores de tela, os estudantes precisam encontrar soluções alternativas, que nem sempre atendem completamente às suas necessidades.[/li]\r\n[/ul]\r\n\r\n<b>Tarefas, atividades e avaliações:</b>\r\n\r\n<ul>\r\n  <li>Por vezes, estudantes cegos precisam utilizar ferramentas diferentes dos colegas, construir sistemas alternativos, necessitam de auxílio humano, realizam avaliações apenas com base nos componentes acessíveis ou são dispensados totalmente de algumas atividades ou avaliações.\r\n    <ul>\r\n      <li>O estudante pode se sentir isolado dos colegas quando ele é a única pessoa a trabalhar com um parceiro ou a construir um sistema completamente diferente dos demais.</li>\r\n      <li>Essas disparidades podem desmotivar os estudantes.</li>\r\n    </ul>\r\n  </li>\r\n  <li>Tarefas que exigem trabalho em grupo podem ser desafiadoras, porque pode ser difícil acompanhar a sua execução ou se comunicar com os colegas.</li>\r\n  <li>Falhas de comunicação podem surgir quando o monitor designado para auxiliar o estudante não tem domínio das ferramentas ou do conteúdo estudado.\r\n    <ul>\r\n      <li>Se o monitor não estiver familiarizado com o tema abordado, pode não conseguir descrever adequadamente o conteúdo ou o enunciado de uma questão, o que prejudicaria o entendimento ou a transcrição das respostas do estudante.</li>\r\n    </ul>\r\n  </li>\r\n</ul>\r\n', 1, 19, '2025-09-08 22:02:03', '2025-09-08 17:02:03'),
(31, 'Apresentação do Professor', '[ul]\r\n[li]Ao se apresentar para o estudante com deficiência visual, o professor pode descrever algumas de suas características mais marcantes (atributos físicos, etnia, estatura, etc.), permitindo que o estudante possa criar uma imagem mental do professor e associe a voz deste professor à disciplina que estiver sendo ministrada.[/li]\r\n[/ul]', 1, 20, '2025-09-08 22:05:24', '2025-09-08 17:05:24'),
(38, 'Obtenção do contexto das falas', '[ul]\r\n[li]Pronunciar todos os detalhes do código-fonte que estiver sendo digitado ou apresentado: letras maiúsculas/minúsculas, caracteres não-alfanuméricos, etc. É importante esclarecer a importância de utilizá-los.\r\n[/li]\r\n\r\n[li]Descrever verbalmente tudo o que for relevante e que esteja sendo anotado no quadro ou exibido na tela.[/li][/ul]', 1, 20, '2025-09-08 22:46:16', '2025-09-08 17:46:16'),
(39, 'Tecnologias', '[ul]\r\n[li]Testar previamente se todas as ferramentas que serão adotadas na disciplina para verificar se são acessíveis aos leitores de tela.[/li][li]Explorar soluções alternativas que forneçam o suporte de acessibilidade necessário quando as ferramentas utilizadas não forem completamente acessíveis. Adotar, sempre que possível, recursos e ferramentas que possam ser utilizados por todos os estudantes da turma.[/li]\r\n[li]Fornecer tutoriais e guias acessíveis para instalação e utilização das ferramentas adotadas nas disciplinas e para configuração dos recursos de acessibilidade;[/li]\r\n[li]Disponibilizar um resumo contendo todos os atalhos de teclado necessários para acessar as funcionalidades das ferramentas que serão utilizadas nas aulas.[/li]\r\n[/ul]', 1, 20, '2025-09-08 22:48:05', '2025-09-08 17:48:05'),
(40, 'Materiais de apoio', '[ul][li]Enviar todos os materiais e códigos-fonte que serão utilizados em cada aula em um formato acessível. Esses materiais estar disponíveis aos estudantes com antecedência suficiente para que eles possam estudá-los antecipadamente e se prepararem melhor para as aulas e realização das atividades solicitadas nas disciplinas.[/li][li]Digitalizar os materiais impressos em formato de texto ou de áudio. Transcrições para áudio devem ser realizadas por alguém familiarizado com o conteúdo, facilitando a compreensão do código-fonte. Isso porque o leitor saberia \"o que deve ser lido\" e \"como deve ser lido\", considerando aspectos como pontuação e formatação, por exemplo.[/li][li]Disponibilizar audiolivros aos estudantes sempre que possível.[/li][li]Utilizar materiais táteis para explicar o conteúdo ou para oferecer melhor feedback dos resultados aos estudantes.[/li][li]Descrever todas as imagens contidas nos materiais de apoio ou apresentados em aula e que forem importantes para a compreensão do conteúdo.[/li][/ul]', 1, 20, '2025-09-08 22:49:22', '2025-09-08 17:49:22');

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
(1, 'adm', 'adm@gmail.com', 'admin', NULL, '12', NULL, NULL),
(2, 'Eliana Zen', 'eliana@gmail.com', 'admin', NULL, '1', NULL, NULL),
(3, 'lucas', 'lucas@gmail.com', 'comum', NULL, '123', NULL, NULL),
(4, 'novo', 'novo@gmail.com', 'comum', NULL, '12', NULL, NULL),
(5, 'teste', 'lucas.2023001290@aluno.iffar.edu.br', 'comum', NULL, '12', NULL, NULL),
(6, 'Lucas', 'martinslucas.cgm@gmail.com', 'comum', NULL, '12345', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
