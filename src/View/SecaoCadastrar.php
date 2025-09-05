<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SecaoDAO.php';

$SecaoDAO = new SecaoDAO();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // O método cadastrar já redireciona em caso de sucesso
        $SecaoDAO->cadastrar();
    } catch (Exception $e) {
        $erro = "Erro ao cadastrar Seção: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Seção</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Cadastrar Seção</h1>

    <?php if (!empty($erro)): ?>
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="nome">Nome da Seção:</label><br>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" rows="4" required></textarea><br><br>

        <button type="submit">Cadastrar Seção</button>
    </form>
</body>
</html>
