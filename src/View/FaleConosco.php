<?php
require_once __DIR__ . '/../Controller/FaleConoscoController.php';

$controller = new Controller\FaleConoscoController();
$controller->enviarMensagem();
$msg = $controller->msg;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/usuarioSugestao.css">
    <title>Fale Conosco</title>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

</head>

<body>
    <?php include 'header.php'; ?>
    <h1>Fale Conosco</h1>

    <?php if ($msg): ?>
        <p style="color: <?= strpos($msg, 'sucesso') !== false ? 'green' : 'red' ?>;">
            <?= htmlspecialchars($msg) ?>
        </p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="nome">Nome completo:</label><br>
            <input type="text" name="nome" id="nome" required>
        </div>
        <br>
        <div>
            <label for="profissao">Profissão:</label><br>
            <input type="text" name="profissao" id="profissao" required>
        </div>
        <br>
        <div>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required>
        </div>
        <br>
        <div>
            <label for="sugestoes">Sugestões:</label><br>
            <textarea name="sugestoes" id="sugestoes" rows="4" cols="50"></textarea>
        </div>
        <br>

        <button type="submit">Enviar</button>
        <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>
    </form>
</body>

</html>