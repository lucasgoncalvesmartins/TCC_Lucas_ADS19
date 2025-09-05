<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    
<aside id="sumario" aria-label="Sumário de navegação">
    <ul>
        
        <?php if (!empty($categorias)): ?>
            <?php foreach ($categorias as $categoria): ?>
                <?php if ($categoria): ?>
                    <li>
                        <a href="PostListarPorCategoria.php?categoria_id=<?= $categoria['id'] ?>">
                            <?= htmlspecialchars($categoria['nome']) ?>
                        </a>
                        <?php if (!empty($categoria['subcategorias'])): ?>
                            <ul>
                                <?php foreach ($categoria['subcategorias'] as $sub): ?>
                                    <li>
                                        <a href="PostListarPorCategoria.php?categoria_id=<?= $sub['id'] ?>">
                                            <?= htmlspecialchars($sub['nome']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</aside>


</body>
</html>



