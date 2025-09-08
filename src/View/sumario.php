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
    <ul>
        <?php foreach ($Secaoes as $Secao): ?>
            <li>
                
                <a href="#secao-<?= $Secao['id'] ?>">
                    <strong><?= htmlspecialchars($Secao['nome']) ?></strong>
                </a>

                <?php if (!empty($Secao['posts'])): ?>
                    <ul>
                        <?php 
                        $SubSecoes = $Secao['posts'];
                        
                        $SubSecoes = array_reverse($Secao['posts']);
                        foreach ($SubSecoes as $SubSecao): 
                        ?>
                            <li>
                                <a href="#subsecao-<?= $SubSecao['id'] ?>">
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
