<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SecaoDAO.php';

$SecaoDAO = new SecaoDAO();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // O método cadastrar já redireciona em caso de sucesso
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
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Cadastrar Seção</h1>

    <?php if (!empty($erro)): ?>
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="" method="post">
    <label for="nome">Nome da Seção:</label><br>
    <input type="text" name="nome" id="nome" required><br><br>

    <label for="descricao">Descrição:</label><br>

    <!-- Barra de botões -->
    <div>
        <button type="button" onclick="wrapText('descricao', '<b>', '</b>')"><b>B</b></button>
        <button type="button" onclick="wrapText('descricao', '<i>', '</i>')"><i>I</i></button>
        <button type="button" onclick="insertLink('descricao')"> Link</button>
        <button type="button" onclick="wrapText('descricao', '[nota]', '[/nota]')">Nota</button>

    </div>

    <textarea name="descricao" id="descricao" rows="6" required></textarea><br><br>

    <button type="submit">Cadastrar Seção</button>
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

    // manter seleção após inserir
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

    const selected = text.substring(start, end) || "texto do link";
    const replacement = `<a href="${url}" target="_blank">${selected}</a>`;

    textarea.value = text.substring(0, start) + replacement + text.substring(end);
    textarea.focus();

    textarea.selectionStart = start;
    textarea.selectionEnd = start + replacement.length;
}
</script>
</body>
</html>
