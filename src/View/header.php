<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title></title>
</head>
<body>
    <header>
        <nav aria-label="Menu principal">
            <div class="nav-left">
                <?php if (!isset($_SESSION['id'])): ?>
                    <a href="UsuarioSugestao.php">Enviar Sugestões</a>
                    <a href="#">Sobre Nós</a>
                    <a href="#">Contato</a>
                    <a href="#">Glossário</a>
                <?php endif; ?>
            </div>

            <div class="nav-center">
                <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'autor'): ?>
                    <a href="PostCadastrar.php">Adicionar Publicação</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'admin'): ?>
                    <a href="PostCadastrar.php">Adicionar Publicação</a>
                    <a href="PostEditar-Excluir.php">Editar Publicação</a>
                    <a href="CategoriaEditar.php">Editar Categoria</a>
                    <a href="UsuarioListar.php">Usuários</a>
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
