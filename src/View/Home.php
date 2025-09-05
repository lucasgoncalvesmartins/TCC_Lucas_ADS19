<?php

ini_set('session.cookie_lifetime', 0); 
include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$subsecoes = $subSecaoDAO->listarTodas(); // antes $posts

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas(); // antes $categorias
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="../Css/home.css">
</head>
<body>
    <?php include_once __DIR__ . '/header.php'; ?>
    <?php include __DIR__ . '/sumario.php'; ?>

    <main>
        <h1 class="text-center mb-5">Cartilha de Orientações para o ensino de Programação de Computadores para estudantes cegos</h1>

        <?php if (!empty($subsecoes)): ?>
            <?php foreach ($subsecoes as $subSecao): ?>
                <article class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?= htmlspecialchars($subSecao['titulo']) ?></h2>
                        <p class="mb-2 text-muted">
                            <strong>Autor:</strong> <?= htmlspecialchars($subSecao['autor']) ?> |
                            <strong>Seção:</strong> <?= htmlspecialchars($subSecao['secao']) ?> |
                            <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($subSecao['data_publicacao'])) ?>
                        </p>
                        <p class="card-text"><?= nl2br(htmlspecialchars($subSecao['conteudo'])) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Nenhuma subseção encontrada.</p>
        <?php endif; ?>
    </main>

    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
</html>
