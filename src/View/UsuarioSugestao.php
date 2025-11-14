<?php
require_once __DIR__ . '/../Controller/EnviarPdfController.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/usuarioSugestao.css">
    <link rel="stylesheet" href="../Css/header.css">
     <link rel="stylesheet" href="../Css/footer.css">
    <title>Enviar PDF</title>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

</head>

<body>
    <?php
    include_once __DIR__ . '/header.php';
    ?>
    <main>
        <h1>Enviar Material</h1>

        <?php if (!empty($msg)): ?>
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
                <label for="descricao">Descrição:</label><br>
                <textarea name="descricao" id="descricao" rows="4" cols="50"></textarea>
            </div>
            <br>
            <div>
                <label for="pdf">Selecione o PDF:</label><br>
                <input type="file" name="pdf" id="pdf" accept=".pdf">
            </div>
            <br>
            <button type="submit">Enviar PDF</button>
            <div class="text-center mt-3">
                <a href="Home.php" class="btn-voltar" tabindex="0">
                    Voltar para página inicial
                </a>
            </div>
        </form>
        </script>
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