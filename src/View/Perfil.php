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

    // Valida o email e atualizar a senha e email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido.";
    } else {
        
        if (!empty($senhaAtual) || !empty($novaSenha) || !empty($confSenha)) {
            
            if ($senhaAtual !== $usuario['senha']) {
                $erro = "Senha atual incorreta.";
            } elseif ($novaSenha !== $confSenha) {
                $erro = "A nova senha e a confirmação não coincidem.";
            } else {
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
        .erro {
            color: red;
        }

        .sucesso {
            color: green;
        }

        form div {
            margin-bottom: 10px;
        }
    </style>
     <link rel="stylesheet" href="../Css/footer.css">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
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
                    required>
            </div>

            <h2>Alterar senha</h2>
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

            <button type="submit">Atualizar</button> <br>
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