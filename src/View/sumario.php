<?php

include_once __DIR__ . '/../Controller/SecaoDAO.php';

$SecaoDAO = new SecaoDAO();
$Secaoes = $SecaoDAO->listarSecaoComPosts();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/sumario.css">
    <title>Sumário</title>
</head>

<body>

    <aside id="sumario" aria-label="Sumário de navegação">
        <h2>Sumario</h2>
        <ul>
            <?php foreach ($agrupado as $secao): ?>
                <li>
                    <a href="#secao-<?= $secao['id'] ?>" aria-label="Ir para a seção <?= htmlspecialchars($secao['nome']) ?>">
                        <?= htmlspecialchars($secao['nome']) ?>
                    </a>
                    <?php if (!empty($secao['subsecoes'])): ?>
                        <ul>
                            <?php foreach ($secao['subsecoes'] as $sub): ?>
                                <li>
                                    <a href="#subsecao-<?= $sub['id'] ?>"
                                        aria-label="Ir para a subseção <?= htmlspecialchars($sub['titulo']) ?>">
                                        <?= htmlspecialchars($sub['titulo']) ?>
                                    </a>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

</body>

</html>