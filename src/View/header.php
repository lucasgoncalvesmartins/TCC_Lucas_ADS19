

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADS</title>
</head>

<body>
    <header>
        <div>
            <div>
                

                <nav>
                    <a href="home.php">Home</a>
                    <?php if (!empty($categorias)): ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <?php if ($categoria): ?>
                                <a href="PostListarPorCategoria.php?categoria_id=<?= $categoria['id'] ?>">
                                    <?= $categoria['nome'] ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </nav>

                <div>
                    <?php if (isset($_SESSION['id'])): ?>
                        <a href="Perfil.php">Perfil</a>
                        <form action="logout.php" method="post">
                            <button type="submit">Sair</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'autor'): ?>
                <div>
                    <a href="PostCadastrar.php">Adcionar Publicação</a>
                    <a href="PostEditar-Excluir.php">Editar/Excluir Publicação</a>
                    <a href="PostEditar-Excluir.php">Meu Parfil</a>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'admin'): ?>
            <div>
                <a href="PostCadastrar.php">Adcionar Publicação</a>
                <a href="PostEditar-Excluir.php">Editar/Excluir Publicação</a>
                <a href="Perfil.php">Meu Perfil</a>
                <a href="">Categoria</a>
                <a href="">Editar Categoria</a>
                <a href="">Usuários</a>
            </div>
        <?php endif; ?>
        </div>

        </div>
        <?php if (!isset($_SESSION['id'])): ?>
            <div>
                <a href="">Enviar Sugestões</a>
                <a href="">Sobre Nós</a>
                <a href="">Contato</a>
                <a href="">Glossário</a>
                
            </div>
        <?php endif; ?>
        </div>



    </header>


</body>

</html>