<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav aria-label="Menu principal">
        <div class="nav-container">

            <?php 
            if (!isset($_SESSION['id']) || (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'comum')): ?>
                <a href="Home.php" tabindex="0">Home</a>
                <a href="FaleConosco.php" tabindex="0">Enviar Sugestão</a>
                <a href="UsuarioSugestao.php" tabindex="0">Enviar Material</a>
                <a href="AdmLogin.php" tabindex="0">Login</a>
            <?php endif; ?>

            <?php 
            if (isset($_SESSION['id']) && ($_SESSION['tipo'] === 'autor' || $_SESSION['tipo'] === 'admin')): ?>
                <a href="Home.php" tabindex="0">Home</a>
                <a href="SecaoCadastrar.php" tabindex="0">Adicionar Seção</a>
                <a href="ListarSecoes.php" tabindex="0">Listar Seção</a>
                <a href="SubSecaoCadastrar.php" tabindex="0">Adicionar SubSeção</a>
                <a href="ListarSubsecao.php" tabindex="0">Listar SubSeção</a>
                <?php if ($_SESSION['tipo'] === 'admin'): ?>
                    <a href="UsuarioListar.php" tabindex="0">Listar Usuários</a>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['id'])): ?>
                <a href="Perfil.php" tabindex="0">Perfil</a>
                <form action="logout.php" method="post" style="display:inline;">
                    <button type="submit">Sair</button>
                </form>
            <?php endif; ?>

        </div>
    </nav>
</header>
