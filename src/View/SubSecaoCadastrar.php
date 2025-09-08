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
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Cadastrar SubSeção</h1>

    <?php if (!empty($erro)): ?>
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>

        <!-- Barra de botões para formatação -->
        <div>
            <button type="button" onclick="wrapText('conteudo', '<b>', '</b>')"><b>B</b></button>
            <button type="button" onclick="wrapText('conteudo', '<i>', '</i>')"><i>I</i></button>
            <button type="button" onclick="insertLink('conteudo')"> Link</button>
            <button type="button" onclick="insertNota('conteudo')">Nota</button>
        </div>

        <textarea name="conteudo" id="conteudo" rows="6" required></textarea><br><br>

        <label for="id_secao">Seção:</label><br>
        <select name="id_secao" id="id_secao" required>
            <option value="">-- Selecione uma seção --</option>
            <?php foreach ($secoes as $secao): ?>
                <option value="<?= $secao['id'] ?>"><?= htmlspecialchars($secao['nome']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Cadastrar</button>
    </form>

<script>
function wrapText(textareaId, before, after) {
    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;

    const selected = text.substring(start, end);
    const replacement = before + selected + after;

    textarea.value = text.substring(0, start) + replacement + text.substring(end);
    textarea.focus();
    textarea.selectionStart = start + before.length;
    textarea.selectionEnd = start + before.length + selected.length;
}

function insertLink(textareaId) {
    const url = prompt("Digite a URL do link:");
    if (!url) return;

    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;

    const selected = text.substring(start, end) || "";
    const replacement = `<a href="${url}" target="_blank">${selected}</a>`;

    textarea.value = text.substring(0, start) + replacement + text.substring(end);
    textarea.focus();
    textarea.selectionStart = start;
    textarea.selectionEnd = start + replacement.length;
}

function insertNota(textareaId) {
    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;

    const selected = text.substring(start, end) || "";
    const replacement = `[nota]${selected}[/nota]`;

    textarea.value = text.substring(0, start) + replacement + text.substring(end);
    textarea.focus();
    textarea.selectionStart = start + 6; // Posição dentro da nota
    textarea.selectionEnd = start + 6 + selected.length;
}
</script>

</body>
</html>
