<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: AdmLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$autores = $subSecaoDAO->buscaAutor();

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Copia conteúdo do editor contenteditable para o POST
    $_POST['conteudo'] = $_POST['conteudo_html'] ?? '';
    $sucesso = $subSecaoDAO->cadastrar($_POST);
    if ($sucesso) {
        header("Location: ./../View/home.php?msg=sucesso");
        exit();
    } else {
        $erro = "Erro ao cadastrar subseção.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar SubSeção</title>
    <link rel="stylesheet" href="../Css/cadastroSubSecao.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #editor {
            border: 1px solid #ccc;
            padding: 5px;
            min-height: 150px;
        }
        .editor-buttons button {
            margin-right: 5px;
            cursor: pointer;
        }
        #editor ul { list-style-type: disc; padding-left: 1.5rem; }
        #editor ol { list-style-type: decimal; padding-left: 1.5rem; }
        #editor li { margin-bottom: 0.3rem; }
    </style>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
<main>
    <?php if (!empty($erro)): ?>
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="" method="post" onsubmit="document.getElementById('conteudo_html').value = document.getElementById('editor').innerHTML;">
        <h1>Cadastrar SubSeção</h1>

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <div class="editor-buttons">
            <button type="button" onclick="execCommand('bold')" aria-label="Aplicar negrito ao texto"><b>B</b></button>
            <button type="button" onclick="execCommand('italic')" aria-label="Aplicar italico ao texto"><i>I</i></button>
            <button type="button" onclick="execCommand('insertUnorderedList')" aria-label="Aplicar lista bolinha">UL</button>
            <button type="button" onclick="execCommand('insertOrderedList')" aria-label="Aplicar lista numerada">OL</button>
            <button type="button" onclick="insertLink()" aria-label="inserir link">Link</button>
            <button type="button" onclick="insertNota()" aria-label="inserir nota">Nota</button>
        </div><br>

        <div id="editor" contenteditable="true" aria-label="Escrever descrição da subseção"></div>
        <input type="hidden" name="conteudo_html" id="conteudo_html"><br><br>

        <label for="id_secao">Selicione a Seção pertecente:</label><br>
        <select name="id_secao" id="id_secao" required>
            <option value="">-- Selecione uma seção --</option>
            <?php foreach ($secoes as $secao): ?>
                <option value="<?= $secao['id'] ?>"><?= htmlspecialchars($secao['nome']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Cadastrar</button>
        <br><br>
        <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>
    </form>
            </main>
<script>
function execCommand(command) {
    // Executa um comando de edição no documento 
    // API document.execCommand
    document.execCommand(command, false, null);
}

function insertLink() {
    const url = prompt("Digite a URL do link:");
    if (!url) return;

    // aqui ta capturando a seleção de texto feita pelo usuário
    const sel = window.getSelection();
    if (!sel.rangeCount) return;

    // Pega o texto selecionado 
    const range = sel.getRangeAt(0);
    const link = document.createElement('a');
    link.href = url;
    link.target = "_blank";
    link.textContent = range.toString() || "Texto do link";
    // texto vira o link;
    
     // Substitui o conteúdo selecionado pelo link criado
    range.deleteContents();
    range.insertNode(link);
}

function insertNota() {
    const sel = window.getSelection();
    if (!sel.rangeCount) return;
    const range = sel.getRangeAt(0);
    const span = document.createElement('span');
    span.textContent = "[nota]" + (range.toString() || "Texto da nota") + "[/nota]";
    range.deleteContents();
    range.insertNode(span);
}


</script>
  
</body>
</html>
