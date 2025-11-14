<?php
session_start();


if (!isset($_SESSION['recuperar_email'])) {
    header("Location: RecuperarSenha.php");
    exit;
}

$email = $_SESSION['recuperar_email'];

try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=tcclucas_ads19;charset=utf8mb4',
        'root',
        ''
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if (!$senha || !$confirmar) {
        $erro = "Preencha todos os campos.";
    } elseif ($senha !== $confirmar) {
        $erro = "As senhas não coincidem.";
    } else {

        // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
        $ok = $stmt->execute([
            'senha' => $senha,
            'email' => $email
        ]);

        if ($ok) {

            unset($_SESSION['recuperar_email']);


            header("Location: AdmLogin.php");
            exit;
        } else {
            $erro = "Erro ao atualizar senha. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="../Css/RedefinirSenha.css">
     <link rel="stylesheet" href="../Css/footer.css">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

</head>

<body>
    <main>
        <h1>Redefinir Senha</h1>

        <?php if ($erro): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="senha">Nova Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <label for="confirmar">Confirmar Senha:</label>
            <input type="password" name="confirmar" id="confirmar" required>

            <button type="submit">Salvar Nova Senha</button>
        </form>
        <a href="Home.php" class="btn btn-link" tabindex="0">Voltar para pagina inicial</a>
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