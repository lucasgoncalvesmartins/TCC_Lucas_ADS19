<?php
require_once __DIR__ . '/../Controller/EnviarPdfController.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/usuarioSugestao.css">
    <title>Enviar PDF</title>
</head>
<body>
    <?php include_once __DIR__ . '/header.php'; ?>
    

    <?php if (!empty($msg)): ?>
        <p style="color: <?= strpos($msg, 'sucesso') !== false ? 'green' : 'red' ?>;">
            <?= htmlspecialchars($msg) ?>
        </p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Enviar Sugestão</h1>
        <div>
            <label for="nome">Nome completo:</label><br>
            <input type="text" name="nome" id="nome" required>
        </div>
        <br>
        <div>
            <label for="cpf">CPF:</label><br>
            <input type="text" name="cpf" id="cpf" required>
        </div>
        <br>
        <div>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required>
        </div>
        <br>
        <div>
            <label for="pdf">Selecione o PDF:</label><br>
            <input type="file" name="pdf" id="pdf" accept=".pdf" required>
        </div>
        <br>
        <button type="submit">Enviar PDF</button> <br>
        <a href="Home.php"  tabindex="0">Voltar</a>
    </form>
</body>
</html>
