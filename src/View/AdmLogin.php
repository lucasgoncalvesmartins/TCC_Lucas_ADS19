<?php



if (isset($_SESSION['id'])) {
    header('Location: AdmHome.php');
    exit;
}

include_once __DIR__ . '/../Controller/LoginDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../Controller/LoginController.php';
    $dao = new LoginDAO();
    $dao->login();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/AdmLogin.css">
    <title>Login Administrador</title>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>

<body>

    <?php
    include_once __DIR__ . '/header.php';

    ?>
    <main>
        <form action="" method="post">
            <h1>Login</h1>

            <?php
            if (!empty($_GET['msg']) && $_GET['msg'] === 'erro'): ?>
                <div class="msg erro">Email ou senha incorretos.</div>
            <?php elseif (!empty($_GET['msg']) && $_GET['msg'] === 'senhaAtualizada'): ?>
                <div class="msg sucesso">Senha redefinida com sucesso! Faça login.</div>
            <?php endif; ?>

            <div>
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" aria-label="Insira seu email aqui" required>
            </div>

            <div>
                <label for="senha">Senha:</label>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="password" id="senha" name="senha" required aria-label="Insira sua senha aqui">
                    <button type="button" id="toggleSenha" aria-label="tornar senha que você digitou visivel">
                        👁️
                    </button>
                </div>
            </div>

            <div>
                <button type="submit">Entrar</button>
            </div>

            <a href="Solicitar_Recuperacao.php" tabindex="0">Esqueci a senha</a> <br>
            <a href="AdmCadastra.php" class="link-cadastro" tabindex="0">Quero Me Cadastrar</a>
            <a href="Home.php" class="btn-voltar" tabindex="0">
                Voltar para página inicial
            </a>

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

    <script>
        document.getElementById('toggleSenha').addEventListener('click', function() {
            const campo = document.getElementById('senha');

            if (campo.type === 'password') {
                campo.type = 'text';
                this.setAttribute('aria-label', 'A senha que você digitou está visivel oculta');
            } else {
                campo.type = 'password';
                this.setAttribute('aria-label', 'A senha que você digitou está visivel');
            }
        });
    </script>

</body>

</html>