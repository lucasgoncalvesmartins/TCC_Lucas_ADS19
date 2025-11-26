<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: home.php');
    exit;
}

include_once __DIR__ . '/../Controller/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UsuarioDAO = new UsuarioDAO();
    $sucesso = $UsuarioDAO->cadastrar($_POST);
    if ($sucesso) {
        header("Location: home.php?msg=sucesso");
        exit();
    } else {
        echo "Erro ao cadastrar usuário";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../Css/AdmCadastra.css">
     <link rel="stylesheet" href="../Css/footer.css">
     <link rel="stylesheet" href="../Css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>
 <!---  ///body com form de cadastro de usuário com campos nome, email e senha, botão de submit e link para voltar para home -->
<body>
    <?php
    include_once __DIR__ . '/header.php';

    ?>
    <main>
        <div class="container my-5">
            <div class="text-center mb-4">
                <h1>Criar Conta</h1>
                <p>Preencha os dados para se cadastrar</p>
            </div>

            <form action="" method="post" class="mx-auto" style="max-width: 500px;">
                <div class="mb-3">
                    <label for="nome_usuario" class="form-label">Nome</label>
                    <input type="text" name="nome_usuario" id="nome_usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>

                <div class="text-center mt-3">
                    <a href="Home.php" class="btn-voltar" tabindex="0">
                        Voltar para página inicial
                    </a>
                </div>
            </form>
        </div>
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