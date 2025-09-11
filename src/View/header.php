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
            <div class="nav-container">
                <?php if (!isset($_SESSION['id']) || (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'comum')): ?>
                    <a href="Home.php"  tabindex="0">Home</a>
                    <a href="UsuarioSugestao.php"  tabindex="0">Enviar Sugestões</a>
                    <a href="#"  tabindex="0">Contato</a>
                    <a href="#"  tabindex="0">Sobre</a>
                    <a href="AdmLogin.php"  tabindex="0">Login</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['id']) && ($_SESSION['tipo'] === 'autor' || $_SESSION['tipo'] === 'admin')): ?>
                    <a href="SecaoCadastrar.php"  tabindex="0">Adicionar Seção</a>
                    <a href="SecaoEditar.php"  tabindex="0">Editar Seção</a>
                    <a href="SubSecaoCadastrar.php"  tabindex="0">Adicionar SubSeção</a>
                    <a href="SubSecaoEditar-Excluir.php"  tabindex="0">Editar SubSeção</a>
                    <?php if ($_SESSION['tipo'] === 'admin'): ?>
                        <a href="UsuarioListar.php"  tabindex="0">Usuários</a>
                    <?php endif; ?>
                <?php endif; ?>

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