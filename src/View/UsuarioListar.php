<?php
session_start();
include_once __DIR__ . '/../Controller/UsuarioDAO.php';

$usuarioDAO = new UsuarioDAO();


if (isset($_POST['remover_id'])) {
    $usuarioDAO->remover($_POST['remover_id']);
    header("Location: UsuarioListar.php");
    exit;
}


if (isset($_POST['atualizar_id']) && isset($_POST['nova_role'])) {
    $usuarioDAO->atualizarRole($_POST['atualizar_id'], $_POST['nova_role']);
    header("Location: UsuarioListar.php");
    exit;
}

$usuarios = $usuarioDAO->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <Link rel="stylesheet" href="../Css/usuariosListar.css">
     <link rel="stylesheet" href="../Css/footer.css">
    <title> Usuários</title>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>

<body>
    <?php include_once __DIR__ . '/header.php'; ?>
    <main>
        <h1> Lista de Usuários</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['nome_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="atualizar_id" value="<?= $usuario['id'] ?>">
                                <select name="nova_role" aria-label="Alterar função do usuário">
                                    
                                    <option value="admin" <?= $usuario['tipo'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="comum" <?= $usuario['tipo'] == 'comum' ? 'selected' : '' ?>>Comum</option>
                                </select>
                                <button type="submit">Atualizar</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                <input type="hidden" name="remover_id" value="<?= $usuario['id'] ?>">
                                <button type="submit" class="btn-excluir">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>


                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="5">Nenhum usuário encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <br><br>
        <div class="text-center mt-3">
            <a href="Home.php" class="btn-voltar" tabindex="0">
                Voltar para página inicial
            </a>
        </div>
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