<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

require_once __DIR__ . '/../Controller/PostDAO.php';

$postDAO = new PostDAO();
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$post = null;
if ($titulo) {
    $post = $postDAO->buscarPostPorTitulo($titulo);
}

// Busca categorias para o select
$categorias = $postDAO->buscaCategoria();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        if ($postDAO->excluir($id)) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            $erro = "Erro ao excluir o post.";
        }
    } else {
        $postDAO->editar();
        header("Location: home.php?msg=editado");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php'; ?>

<h1>Editar Post</h1>

<form method="get" action="">
    <label for="tituloBusca">Buscar por Título:</label><br>
    <input type="text" name="titulo" id="tituloBusca" required><br><br>
    <button type="submit">Buscar</button>
</form>

<?php if ($post): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= ($post['id']) ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="<?= ($post['titulo']) ?>" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="6" required><?= ($post['conteudo']) ?></textarea><br><br>

        <label for="id_categoria">Categoria:</label><br>
        <select name="id_categoria" id="id_categoria" required>
            <option value="">-- Selecione a categoria --</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $post['id_categoria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoria['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>

    <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir?');">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <button type="submit" name="excluir">Excluir</button>
    </form>

<?php elseif ($titulo): ?>
    <p>Post não encontrado.</p>
<?php endif; ?>

<?php if (!empty($erro)): ?>
    <p><?= $erro ?></p>
<?php endif; ?>

</body>
</html>
