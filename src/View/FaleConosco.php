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
     <link rel="stylesheet" href="../Css/footer.css">
    <title>Fale Conosco</title>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Enviar Sugestão</h1>

        <?php if ($msg): ?>
            <p style="color: <?= strpos($msg, 'sucesso') !== false ? 'green' : 'red' ?>;">
                <?= htmlspecialchars($msg) ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="nome">Nome completo:</label><br>
                <input type="text" name="nome" id="nome" aria-label="Insira seu nome aqui" required>
            </div>
            <br>
            <div>
                <label for="profissao">Profissão:</label><br>
                <input type="text" name="profissao" id="profissao" aria-label="Insira sua profissão aqui" required>
            </div>
            <br>
            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" aria-label="Insira seu email aqui" required>
            </div>
            <br>
            <div>
                <label for="sugestoes">Sugestões:</label><br>
                <textarea name="sugestoes" id="sugestoes" aria-label="Insira sua sugestão aqui" rows="4" cols="50"></textarea>
            </div>
            <br>

            <button type="submit">Enviar Sugestão</button>
            <div class="text-center mt-3">
                <a href="Home.php" class="btn-voltar" tabindex="0">
                    Voltar para página inicial
                </a>
            </div>
        </form>

        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
        
    </main>
    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
  
</html>