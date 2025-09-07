<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/header.css">
    <title></title>
</head>
<body>
    <header>
        <nav aria-label="Menu principal">
            <div class="nav-left">
                <?php if (!isset($_SESSION['id'])): ?>
                    <a href="UsuarioSugestao.php">Enviar Sugestões</a>
                    <a href="#">Sobre</a>
                    <a href="#">Glossário</a>
                    <a href="#">Contato</a>
                    <a href="AdmLogin.php">Login</a>
                <?php endif; ?>
            </div>

            <div class="nav-center">
                <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'autor'): ?>
                    <a href="SubSecaoCadastrar.php">Adicionar Publicação</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'admin'): ?>
                    <a href="SubSecaoCadastrar.php">Adicionar SubSeção</a>
                    <a href="SubSecaoEditar-Excluir.php">Editar Publicação</a>
                    <a href="SecaoEditar.php">Editar Seção</a>
                    <a href="UsuarioListar.php">Usuários</a>
                    <a href="SecaoCadastrar.php">Adcionar Seção</a>
                <?php endif; ?>
            </div>

            <div class="nav-right">
                <?php if (isset($_SESSION['id'])): ?>
                    <a href="Perfil.php">Perfil</a>
                    <form action="logout.php" method="post" style="display:inline;">
                        <button type="submit">Sair</button>
                    </form>
                <?php endif; ?>
            </div>
        </nav>
    </header>
</body>
</html>
