<?php
include_once __DIR__ . '/../Controller/PostDAO.php';
include_once __DIR__ . '/../Controller/CategoriaDAO.php';

$postDAO = new PostDAO();
$posts = $postDAO->listarTodos();
$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->listarTodas();


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Página Inicial</title>
</head>

<body>
    <?php include_once __DIR__ . '/header.php'; ?>

    <main>
        <h1>BEM VINDO</h1>

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

                    <form method="POST">
                        <input type="hidden" name="tipo" value="curtida">
                        
                    </form>
                </article>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum post encontrado.</p>
        <?php endif; ?>
    </main>

    <?php include_once __DIR__ . '/footer.php'; ?>

</body>

</html>
