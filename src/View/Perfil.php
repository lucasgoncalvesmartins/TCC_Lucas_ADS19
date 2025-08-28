<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/UsuarioDAO.php';

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->buscarPorId($_SESSION['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sucesso = $usuarioDAO->atualizar($_SESSION['id'], $_POST['email'], $_POST['senha']);
    if ($sucesso) {
        header("Location: perfil.php?msg=sucesso");
        exit();
    } else {
        $erro = "Erro ao atualizar perfil.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Meu Perfil</h1>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php elseif (!empty($_GET['msg']) && $_GET['msg'] === 'sucesso'): ?>
            <div class="sucesso">Perfil atualizado com sucesso!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div>
                <label for="email">E-mail:</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="<?= ($usuario['email']) ?>" 
                    required
                >
            </div>

            <div>
                <label for="senha">Senha:</label>
                <input 
                    type="password" 
                    name="senha" 
                    id="senha" 
                    value="<?= ($usuario['senha']) ?>" 
                    required
                >
            </div>

            <button type="submit">Atualizar</button>
        </form>
        
    </main>
</body>
</html>