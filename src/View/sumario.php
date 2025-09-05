<?php 

include_once __DIR__ . '/../Controller/SecaoDAO.php';

$SecaoDAO = new SecaoDAO();
$Secaoes = $SecaoDAO->listarSecaoComPosts();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Css/sumario.css">
    <title>Document</title>
</head>
<body>
    
<aside id="sumario" aria-label="Sumário de navegação">
    <ul>
        <?php foreach ($Secaoes as $Secao): ?>
            <li>
                <strong><?= htmlspecialchars($Secao['nome']) ?></strong>
                <?php if (!empty($Secao['posts'])): ?>
                    <ul>
                        <?php foreach ($Secao['posts'] as $SubSecao): ?>
                            <li>
                                <a href="PostDetalhes.php?id=<?= $SubSecao['id'] ?>">
                                    <?= htmlspecialchars($SubSecao['titulo']) ?>
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



