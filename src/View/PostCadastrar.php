<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/PostDAO.php';

$postDAO = new PostDAO();
$autores = $postDAO->buscaAutor();
$categorias = $postDAO->buscaCategoria();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sucesso = $postDAO->cadastrar($_POST);
    if ($sucesso) {
        header("Location: ./../View/home.php?msg=sucesso");
        exit();
    } else {
        $erro = "Erro ao cadastrar post.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Cadastrar Post</h1>

    <?php if (!empty($erro)): ?>
        <p><?= $erro ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="6" required></textarea><br><br>

        <label for="id_autor">Autor:</label><br>
        <select name="id_autor" id="id_autor" required>
            <option value="">-- Selecione um autor --</option>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor['id'] ?>"><?= $autor['nome_usuario'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="id_categoria">Categoria:</label><br>
        <select name="id_categoria" id="id_categoria">
            <option value="">-- Selecione uma categoria --</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
