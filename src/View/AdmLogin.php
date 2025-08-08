<?php
    session_start();
    if(isset($_SESSION['id'])) {
        header('Location: AdmHome.php');
        exit;
    }

    include_once __DIR__ . '/../Controller/LoginDAO.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../Controller/LoginController.php';
    $dao = new loginDAO();
    $dao->login();
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
     <div>
            <label for="email">Gmail:</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="senha" id="senha" name="senha" required>
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
        <div>
            <a href="Solicitar_Recuperacao.php">Esqueci a senha</a>
        </div>


    </form>
</body>
</html>