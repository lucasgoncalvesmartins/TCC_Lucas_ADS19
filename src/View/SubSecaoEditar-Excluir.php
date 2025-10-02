<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

require_once __DIR__ . '/../Controller/SubSecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subSecao = null;
$erro = '';

if ($titulo) {
    $subSecao = $subSecaoDAO->buscarSubSecaoPorTitulo($titulo);
}

$secoes = $subSecaoDAO->buscaSecao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Copia o conteúdo do editor contenteditable para POST
    $_POST['conteudo'] = $_POST['conteudo_html'] ?? '';
    
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        if ($subSecaoDAO->excluir($id)) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            $erro = "Erro ao excluir a subseção.";
        }
    } else {
        $subSecaoDAO->editar();
        header("Location: home.php?msg=editado");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar SubSeção</title>
    <link rel="stylesheet" href="../Css/editaSubSecao.css">
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
</head>
<body>
<?php include 'header.php'; ?>

<form method="get" action="">
    <h1>Editar SubSeção</h1>
    <label for="tituloBusca">Buscar por Título:</label><br>
    <input type="text" name="titulo" id="tituloBusca" required><br><br>
    <button type="submit">Buscar</button>
    <br><br>
    <a href="AdmLogin.php" class="btn btn-link" tabindex="0">Voltar</a>
</form>

<?php if ($subSecao): ?>
<form method="post" onsubmit="document.getElementById('conteudo_html').value = document.getElementById('editor').innerHTML;">
    <input type="hidden" name="id" value="<?= ($subSecao['id']) ?>">
    <h2>Editar SubSeção</h2>

    <label for="titulo">Título:</label><br>
    <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($subSecao['titulo']) ?>" required><br><br>

    <label for="conteudo">Conteúdo:</label><br>
    <div class="editor-buttons">
        <button type="button" onclick="execCommand('bold')"><b>B</b></button>
        <button type="button" onclick="execCommand('italic')"><i>I</i></button>
        <button type="button" onclick="execCommand('insertUnorderedList')">UL</button>
        <button type="button" onclick="execCommand('insertOrderedList')">OL</button>
        <button type="button" onclick="insertLink()">Link</button>
        <button type="button" onclick="insertNota()">Nota</button>
    </div><br>

    <!-- Removido htmlspecialchars para renderizar HTML -->
    <div id="editor" contenteditable="true"><?= $subSecao['conteudo'] ?></div>
    <input type="hidden" name="conteudo_html" id="conteudo_html"><br><br>

    <label for="id_secao">Seção:</label><br>
    <select name="id_secao" id="id_secao" required>
        <option value="">-- Selecione a Seção --</option>
        <?php foreach ($secoes as $secao): ?>
            <option value="<?= $secao['id'] ?>" <?= ($secao['id'] == $subSecao['id_secao']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($secao['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>

<form method="post" onsubmit="return confirm('Tem certeza que deseja excluir?');">
    <input type="hidden" name="id" value="<?= $subSecao['id'] ?>">
    <button type="submit" name="excluir">Excluir</button>
</form>

<?php elseif ($titulo): ?>
<p>SubSeção não encontrada.</p>
<?php endif; ?>

<?php if (!empty($erro)): ?>
<p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

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

</body>
</html>
