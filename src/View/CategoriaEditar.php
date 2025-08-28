<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/CategoriaController.php';

$categoriaDAO = new CategoriaDAO();
//$nome = $_GET['nome'] ?? '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$categoria = null;
if ($nome) {
    $categoria = $categoriaDAO->buscarPorNome($nome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        if ($categoriaDAO->excluir($id)) {
            header('Location: home.php?msg=excluido');
            exit();
        } else {
            $erro = "Erro ao excluir categoria.";
        }
    } else {
        $sucesso = $categoriaDAO->editar($_POST);
        if ($sucesso) {
            header("Location: home.php?msg=editado");
            exit();
        } else {
            $erro = "Erro ao editar categoria.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Categoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
 
</head>
<body>
<?php include 'header.php'; ?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Editar Categoria</h1>

    <form method="get" action="" class="mb-4">
        <div class="mb-3">
            <label for="nomeBusca" class="form-label">Buscar por Nome:</label>
            <input type="text" name="nome" id="nomeBusca" class="form-control" placeholder="Digite o nome da categoria" required />
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <?php if (@$sucesso): ?>
        <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <?php if ($categoria): ?>
        <form method="post" class="mb-3">
            <input type="hidden" name="id" value="<?= ($categoria['id']) ?>" />

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?=($categoria['nome']) ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" class="form-control" required><?= ($categoria['descricao']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>

        <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
            <input type="hidden" name="id" value="<?= ($categoria['id']) ?>" />
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </form>

    <?php elseif (@$nomeBusca): ?>
        <div class="alert alert-warning">Categoria não encontrada.</div>
    <?php endif; ?>

    <?php if (@$erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
</div>
</body>
</html>