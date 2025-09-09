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
    
</head>
<body>
    <form action="" method="post">
        <h2>Login</h2>

        <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'erro'): ?>
            <div class="msg erro">Email ou senha incorretos.</div>
        <?php elseif (!empty($_GET['msg']) && $_GET['msg'] === 'senhaAtualizada'): ?>
            <div class="msg sucesso">Senha redefinida com sucesso! Faça login.</div>
        <?php endif; ?>

        <div>
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required>
        </div>

        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <div>
            <button type="submit">Entrar</button>
        </div>

        <a href="Solicitar_Recuperacao.php">Esqueci a senha</a> <br>
        <a href="AdmCadastra.php">Quero Me Cadastrar</a>
        
    </form>
</body>
</html>
