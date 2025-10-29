<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SecaoDAO.php';
$secaoDAO = new SecaoDAO();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$secao = null;
$erro = '';
$sucesso = '';

if ($id) {
    $secao = $secaoDAO->buscarPorId($id);
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
        // Copia o conteúdo do editor para $_POST['descricao']
        $_POST['descricao'] = $_POST['descricao_html'] ?? '';
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
    <style>
        /* Estilo do editor */
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
</head>
<body>
<?php include 'header.php'; ?>

<div class="container my-5">

    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <?php if ($secao): ?>
        <form method="post" onsubmit="document.getElementById('descricao_html').value = document.getElementById('editor').innerHTML;">
            <input type="hidden" name="id" value="<?= ($secao['id']) ?>" />
            <input type="hidden" name="descricao_html" id="descricao_html" />

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($secao['nome']) ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <div class="mb-2 editor-buttons">
                    <button type="button" onclick="execCommand('bold')" aria-label="Aplicar negrito ao texto"><b>B</b></button>
                    <button type="button" onclick="execCommand('italic')" aria-label="Aplicar italico ao texto"><i>I</i></button>
                    <button type="button" onclick="execCommand('insertUnorderedList')" aria-label="Aplicar lista bolinha">UL</button>
                    <button type="button" onclick="execCommand('insertOrderedList')" aria-label="Aplicar lista numerada">OL</button>
                    <button type="button" onclick="insertLink()" aria-label="inserir link">Link</button>
                    <button type="button" onclick="insertNota()" aria-label="inserir nota">Nota</button>
                </div>
                <div id="editor" contenteditable="true"><?= $secao['descricao'] ?></div>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>

        

    <?php else: ?>
        <?php if ($id): ?>
            <div class="alert alert-warning">Seção não encontrada.</div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
</div>

<script>
function execCommand(command) {
    document.execCommand(command, false, null);
}

function insertLink() {
    const url = prompt("Digite a URL do link:");
    if (!url) return;
    const sel = window.getSelection();
    if (!sel.rangeCount) return;
    const range = sel.getRangeAt(0);
    const link = document.createElement('a');
    link.href = url;
    link.target = "_blank";
    link.textContent = range.toString() || "Texto do link";
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
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>

</body>
</html>
