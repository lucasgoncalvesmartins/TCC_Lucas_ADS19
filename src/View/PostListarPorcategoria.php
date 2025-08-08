<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/PostDAO.php';
include_once __DIR__ . '/../Controller/CategoriaDAO.php';

$categoria_id = isset($_GET['categoria_id']) && is_numeric($_GET['categoria_id']) ? (int) $_GET['categoria_id'] : null;

if ($categoria_id === null) {
    echo "Categoria inválida.";
    exit;
}

$postDAO = new PostDAO();
$posts = $postDAO->buscarPorCategoria($categoria_id);

$categoriaDAO = new CategoriaDAO();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Posts da Categoria</title>
</head>
<body>
<?php include 'header.php'; ?>

<div>
    <h1>Posts da Categoria</h1>

    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <article>
                <h2><?= $post['titulo'] ?></h2>
                <p>
                    <strong>Autor:</strong> <?= $post['autor'] ?> |
                    <strong>Categoria:</strong> <?= $post['categoria'] ?> |
                    <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($post['data_publicacao'])) ?>
                </p>
                <p><?= nl2br($post['conteudo']) ?></p>
            </article>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum post encontrado.</p>
    <?php endif; ?>
</div>

</body>
</html>
