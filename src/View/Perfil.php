<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/UsuarioDAO.php';

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->buscarPorId($_SESSION['id']);

$erro = '';
$sucessoMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senhaAtual = $_POST['senha_atual'] ?? '';
    $novaSenha = $_POST['nova_senha'] ?? '';
    $confSenha = $_POST['conf_senha'] ?? '';

    // Validação do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido.";
    } else {
        // Verifica se o usuário quer alterar a senha
        if (!empty($senhaAtual) || !empty($novaSenha) || !empty($confSenha)) {
            // Verifica senha atual (texto puro)
            if ($senhaAtual !== $usuario['senha']) {
                $erro = "Senha atual incorreta.";
            } elseif ($novaSenha !== $confSenha) {
                $erro = "A nova senha e a confirmação não coincidem.";
            } else {
                // Atualiza email e senha 
                $sucesso = $usuarioDAO->atualizar($_SESSION['id'], $email, $novaSenha);
                if ($sucesso) {
                    $sucessoMsg = "Perfil e senha atualizados com sucesso!";
                    $usuario['senha'] = $novaSenha; 
                    $usuario['email'] = $email;
                } else {
                    $erro = "Erro ao atualizar perfil.";
                }
            }
        } else {
            // Apenas atualiza o email mantendo a senha antiga
            $sucesso = $usuarioDAO->atualizar($_SESSION['id'], $email, $usuario['senha']);
            if ($sucesso) {
                $sucessoMsg = "Perfil atualizado com sucesso!";
                $usuario['email'] = $email;
            } else {
                $erro = "Erro ao atualizar perfil.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="../Css/perfil.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .erro { color: red; }
        .sucesso { color: green; }
        form div { margin-bottom: 10px; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Meu Perfil</h1>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php elseif (!empty($sucessoMsg)): ?>
            <div class="sucesso"><?= htmlspecialchars($sucessoMsg) ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div>
                <label for="email">E-mail:</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="<?= htmlspecialchars($usuario['email']) ?>" 
                    required
                >
            </div>

            <h3>Alterar senha</h3>
            <div>
                <label for="senha_atual">Senha Atual:</label>
                <input type="password" name="senha_atual" id="senha_atual" placeholder="Digite sua senha atual">
            </div>

            <div>
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" name="nova_senha" id="nova_senha" placeholder="Digite a nova senha">
            </div>

            <div>
                <label for="conf_senha">Confirmar Nova Senha:</label>
                <input type="password" name="conf_senha" id="conf_senha" placeholder="Repita a nova senha">
            </div>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>
