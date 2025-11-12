<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SecaoDAO.php';
$SecaoDAO = new SecaoDAO();
$erro = '';

$secoes = $SecaoDAO->listarTodas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Copia o conteúdo do editor contenteditable para o POST
        $_POST['descricao'] = $_POST['descricao_html'] ?? '';
        $SecaoDAO->cadastrar();
    } catch (Exception $e) {
        $erro = "Erro ao cadastrar Seção: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Seção</title>
    <link rel="stylesheet" href="../Css/cadastroSecao.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* visualizar o editor */
        #editor {
            border: 1px solid #ccc;
            padding: 5px;
            min-height: 150px;
        }

        .editor-buttons button {
            margin-right: 5px;
            cursor: pointer;
        }

        #editor ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }

        #editor ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
        }

        #editor li {
            margin-bottom: 0.3rem;
        }
    </style>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <main id="conteudo-principal">
        <?php if (!empty($erro)): ?>
            <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form action="" method="post" onsubmit="document.getElementById('descricao_html').value = document.getElementById('editor').innerHTML;">
            <h1>Cadastrar Seção</h1>

            <label for="nome">Nome da Seção:</label><br>
            <input type="text" name="nome" id="nome" required><br><br>

            <label for="descricao">Descrição:</label><br>

            <div class="editor-buttons">
                <button type="button" onclick="execCommand('bold')" aria-label="Aplicar negrito ao texto"><b>B</b></button>
                <button type="button" onclick="execCommand('italic')" aria-label="Aplicar italico ao texto"><i>I</i></button>
                <button type="button" onclick="execCommand('insertUnorderedList')" aria-label="Aplicar lista bolinha">UL</button>
                <button type="button" onclick="execCommand('insertOrderedList')" aria-label="Aplicar lista numerada">OL</button>
                <button type="button" onclick="insertLink()" aria-label="inserir link">Link</button>
            </div><br>

            <!-- Editor contenteditable isso aqui faz aparecer as bolinhas e tals -->
            <div id="editor" contenteditable="true" aria-label="Escrever descrição da seção"></div>

            <!-- Input hidden para enviar -->
            <input type="hidden" name="descricao_html" id="descricao_html"><br><br>

            <!-- 
<label for="ordem">Posição:</label>
<select name="ordem" id="ordem">
    <php
   // $total = count($secoes);
   // for ($i = 1; $i <= $total + 1; $i++) {
     //   echo "<option value='$i'>$i</option>";
    //}
    //?>
</select>
-->
            <button type="submit">Cadastrar Seção</button><br><br>
            <div class="text-center mt-3">
                <a href="Home.php" class="btn-voltar" tabindex="0">
                    Voltar para página inicial
                </a>
            </div>
        </form>

        </script>
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
    </main>
    <script>
        function execCommand(command) {
            document.execCommand(command, false, null);
        }

        function insertLink() {
            const url = prompt("Digite a URL do link:");
            if (!url) return;
            document.execCommand('createLink', false, url);
        }
    </script>


</body>

</html>