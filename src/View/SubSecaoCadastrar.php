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

        <div>
            <button type="button" onclick="wrapText('conteudo', '<b>', '</b>')"><b>B</b></button>
            <button type="button" onclick="wrapText('conteudo', '<i>', '</i>')"><i>I</i></button>
            <button type="button" onclick="insertLink('conteudo')">Link</button>
            <button type="button" onclick="insertNota('conteudo')">Nota</button>
            <button type="button" onclick="insertList('conteudo', 'ul')">Lista UL</button>
            <button type="button" onclick="insertList('conteudo', 'ol')">Lista OL</button>
        </div>

        <textarea name="conteudo" id="conteudo" rows="10" required></textarea><br><br>

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
            const selected = text.substring(start, end) || "texto do link";
            const safeUrl = url.replace(/"/g, '%22');
            const replacement = `<a href="${safeUrl}" target="_blank">${selected}</a>`;

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
            const selected = text.substring(start, end) || "Escreva sua nota aqui";
            const replacement = `[nota]${selected}[/nota]`;

            textarea.value = text.substring(0, start) + replacement + text.substring(end);
            textarea.focus();
            const innerStart = start + 6;
            textarea.selectionStart = innerStart;
            textarea.selectionEnd = innerStart + selected.length;
        }

        function insertList(textareaId, type) {
            const textarea = document.getElementById(textareaId);
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const full = textarea.value;
            const selected = full.substring(start, end);

            let linesArr = [];
            if (selected.trim()) {
                linesArr = selected.split(/\r?\n/).map(l => l.trim()).filter(l => l !== '');
            }

            let items;
            if (linesArr.length) {
                // remove quebras de linha extras
                items = linesArr.map(l => '[li]' + l + '[/li]').join('');
            } else {
                items = '[li]Item 1[/li][li]Item 2[/li]';
            }

            const replacement = '[' + type + ']' + items + '[/' + type + ']';

            textarea.value = full.substring(0, start) + replacement + full.substring(end);
            textarea.focus();

            // seleciona o conteúdo do primeiro item
            const firstLiIndex = replacement.indexOf('[li]');
            if (firstLiIndex !== -1) {
                const firstContentStart = start + firstLiIndex + 4;
                const firstContentLen = linesArr.length ? linesArr[0].length : 6;
                textarea.selectionStart = firstContentStart;
                textarea.selectionEnd = firstContentStart + firstContentLen;
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.shiftKey) {
                const active = document.activeElement;
                if (active && active.tagName === 'TEXTAREA' && active.id === 'conteudo') {
                    if (e.key.toLowerCase() === 'u') {
                        e.preventDefault();
                        insertList('conteudo', 'ul');
                    } else if (e.key.toLowerCase() === 'o') {
                        e.preventDefault();
                        insertList('conteudo', 'ol');
                    } else if (e.key.toLowerCase() === 'n') {
                        e.preventDefault();
                        insertNota('conteudo');
                    }
                }
            }
        });
    </script>

</body>
</html>
