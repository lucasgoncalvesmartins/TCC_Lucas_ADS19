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

if ($titulo) {
    $subSecao = $subSecaoDAO->buscarSubSecaoPorTitulo($titulo);
}

// Busca seções para o select
$secoes = $subSecaoDAO->buscaSecao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php'; ?>

<h1>Editar SubSeção</h1>

<form method="get" action="">
    <label for="tituloBusca">Buscar por Título:</label><br>
    <input type="text" name="titulo" id="tituloBusca" required><br><br>
    <button type="submit">Buscar</button>
</form>

<?php if ($subSecao): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= ($subSecao['id']) ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($subSecao['titulo']) ?>" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="6" required><?= htmlspecialchars($subSecao['conteudo']) ?></textarea><br><br>

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
    <p><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

</body>
</html>
