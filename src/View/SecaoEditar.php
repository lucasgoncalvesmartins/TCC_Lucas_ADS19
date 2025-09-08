<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SecaoController.php';

$secaoDAO = new SecaoDAO();
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$secao = null;
$erro = '';
$sucesso = '';

if ($nome) {
    $secao = $secaoDAO->buscarPorNome($nome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        if ($secaoDAO->excluir($id)) {
            header('Location: home.php?msg=excluido');
            exit();
        } else {
            $erro = "Erro ao excluir seção.";
        }
    } else {
        $sucesso = $secaoDAO->editar($_POST);
        if ($sucesso) {
            header("Location: home.php?msg=editado");
            exit();
        } else {
            $erro = "Erro ao editar seção.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Seção</title>
    <link rel="stylesheet" href="../Css/editaSecao.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<?php include 'header.php'; ?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Editar Seção</h1>

    <!-- Formulário de busca -->
    <form method="get" action="" class="mb-4">
        <div class="mb-3">
            <label for="nomeBusca" class="form-label">Buscar por Nome:</label>
            <input type="text" name="nome" id="nomeBusca" class="form-control" placeholder="Digite o nome da seção" required />
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Mensagem de sucesso -->
    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <!-- Formulário de edição -->
    <?php if ($secao): ?>
        <form method="post" class="mb-3">
            <input type="hidden" name="id" value="<?= ($secao['id']) ?>" />

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($secao['nome']) ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>

                <!-- Botões de formatação -->
                <div class="mb-2">
                    <button type="button" onclick="wrapText('descricao','<b>','</b>')"><b>B</b></button>
                    <button type="button" onclick="wrapText('descricao','<i>','</i>')"><i>I</i></button>
                    <button type="button" onclick="insertLink('descricao')">Link</button>
                    <button type="button" onclick="insertNota('descricao')">Nota</button>
                    <button type="button" onclick="insertList('descricao','ul')">Lista UL</button>
                    <button type="button" onclick="insertList('descricao','ol')">Lista OL</button>
                </div>

                <textarea name="descricao" id="descricao" rows="6" class="form-control" required><?= htmlspecialchars($secao['descricao']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>

        <!-- Botão de exclusão -->
        <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta seção?');">
            <input type="hidden" name="id" value="<?= ($secao['id']) ?>" />
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </form>

    <?php elseif ($nome): ?>
        <div class="alert alert-warning">Seção não encontrada.</div>
    <?php endif; ?>

    <!-- Mensagem de erro -->
    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
</div>

<script>
function wrapText(textareaId, before, after) {
    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selected = textarea.value.substring(start, end);
    const replacement = before + selected + after;
    textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
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
    const selected = textarea.value.substring(start, end) || "texto do link";
    const safeUrl = url.replace(/"/g, '%22');
    const replacement = `<a href="${safeUrl}" target="_blank">${selected}</a>`;
    textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
    textarea.focus();
    textarea.selectionStart = start;
    textarea.selectionEnd = start + replacement.length;
}

function insertNota(textareaId) {
    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selected = textarea.value.substring(start, end) || "Escreva sua nota aqui";
    const replacement = `[nota]${selected}[/nota]`;
    textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
    textarea.focus();
    const innerStart = start + 6;
    textarea.selectionStart = innerStart;
    textarea.selectionEnd = innerStart + selected.length;
}

function insertList(textareaId, type) {
    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selected = textarea.value.substring(start, end);
    let linesArr = selected.trim() ? selected.split(/\r?\n/).map(l => l.trim()).filter(l => l) : [];
    let items = linesArr.length ? linesArr.map(l => '[li]' + l + '[/li]').join('\n') : '[li]Item 1[/li]\n[li]Item 2[/li]';
    const replacement = `[${type}]\n${items}\n[/${type}]`;
    textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
    textarea.focus();
    const firstLiIndex = replacement.indexOf('[li]');
    if(firstLiIndex !== -1) {
        const firstContentStart = start + firstLiIndex + 4;
        const firstContentLen = linesArr.length ? linesArr[0].length : 6;
        textarea.selectionStart = firstContentStart;
        textarea.selectionEnd = firstContentStart + firstContentLen;
    }
}
</script>

</body>
</html>
