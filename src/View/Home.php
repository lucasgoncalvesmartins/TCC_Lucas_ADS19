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
        <h1>Cartilha de Orientações para o ensino de Programação de Computadores para estudantes cegos
        </h1>


    </main>

    <?php include_once __DIR__ . '/footer.php'; ?>

</body>

</html>