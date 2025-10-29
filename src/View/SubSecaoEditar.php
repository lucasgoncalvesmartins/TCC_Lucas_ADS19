<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

require_once __DIR__ . '/../Controller/SubSecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$erro = '';
$subSecao = null;

// Busca pelo id passado via GET do link "Editar"
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id) {
    $subSecao = $subSecaoDAO->buscarSubSecaoPorId($id); // precisa criar esse método
}

$secoes = $subSecaoDAO->buscaSecao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Copia conteúdo do editor contenteditable para POST
    $_POST['conteudo'] = $_POST['conteudo_html'] ?? '';

    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        if ($subSecaoDAO->excluir($id)) {
            header('Location: SubSecaoListar.php?msg=excluido');
            exit();
        } else {
            $erro = "Erro ao excluir a subseção.";
        }
    } else {
        $subSecaoDAO->editar();
        header("Location: SubSecaoListar.php?msg=editado");
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

<?php if ($subSecao): ?>
<form method="post" onsubmit="document.getElementById('conteudo_html').value = document.getElementById('editor').innerHTML;">
    <input type="hidden" name="id" value="<?= ($subSecao['id']) ?>">
    <h2>Editar SubSeção</h2>

    <label for="titulo">Título:</label><br>
    <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($subSecao['titulo']) ?>" required><br><br>

    <label for="conteudo">Conteúdo:</label><br>
    <div class="editor-buttons">
        <button type="button" onclick="execCommand('bold')" aria-label="Aplicar negrito ao texto"><b>B</b></button>
        <button type="button" onclick="execCommand('italic')" aria-label="Aplicar italico ao texto"><i>I</i></button>
        <button type="button" onclick="execCommand('insertUnorderedList')" aria-label="Aplicar lista bolinha">UL</button>
        <button type="button" onclick="execCommand('insertOrderedList')" aria-label="Aplicar lista numerada">OL</button>
        <button type="button" onclick="insertLink()" aria-label="inserir link">Link</button>
        <button type="button" onclick="insertNota()" aria-label="inserir nota">Nota</button>
    </div><br>

    
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



<?php elseif ($titulo): ?>
<p>SubSeção não encontrada.</p>
<?php endif; ?>

<?php if (!empty($erro)): ?>
<p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

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
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>

</body>
</html>
