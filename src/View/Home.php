<?php
session_start();


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
    <title>Página Inicial</title>
 
</head>

<body>
        <?php include_once __DIR__ . '/header.php'; ?>

        <?php include __DIR__ . '/sumario.php'; ?>

        <main>
            <h1 class="text-center mb-5">Cartilha de Orientações para o ensino de Programação de Computadores para estudantes cegos</h1>

            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <article class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title"><?= $post['titulo'] ?></h2>
                            <p class="mb-2 text-muted">
                                <strong>Autor:</strong> <?= $post['autor'] ?> |
                                <strong>Categoria:</strong> <?= $post['categoria'] ?> |
                                <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($post['data_publicacao'])) ?>
                            </p>
                            <p class="card-text"><?= nl2br($post['conteudo']) ?></p>

                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">Nenhum post encontrado.</p>
            <?php endif; ?>
        </main>

        <?php include_once __DIR__ . '/footer.php'; ?>

</body>

</html>