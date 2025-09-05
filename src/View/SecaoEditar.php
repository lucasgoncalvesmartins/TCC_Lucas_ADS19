<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SecaoController.php';

$secaoDAO = new SecaoDAO();
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$secao = null;
if ($nome) {
    $secao = $secaoDAO->buscarPorNome($nome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        if ($secaoDAO->excluir($id)) {
            header('Location: home.php?msg=excluido');
            exit();
        } else {
            $erro = "Erro ao excluir seção.";
        }
    } else {
        $sucesso = $secaoDAO->editar($_POST);
        if ($sucesso) {
            header("Location: home.php?msg=editado");
            exit();
        } else {
            $erro = "Erro ao editar seção.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Seção</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<?php include 'header.php'; ?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Editar Seção</h1>

    <!-- Formulário de busca -->
    <form method="get" action="" class="mb-4">
        <div class="mb-3">
            <label for="nomeBusca" class="form-label">Buscar por Nome:</label>
            <input type="text" name="nome" id="nomeBusca" class="form-control" placeholder="Digite o nome da seção" required />
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Mensagem de sucesso -->
    <?php if (@$sucesso): ?>
        <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <!-- Formulário de edição -->
    <?php if ($secao): ?>
        <form method="post" class="mb-3">
            <input type="hidden" name="id" value="<?= ($secao['id']) ?>" />

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?=($secao['nome']) ?>" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" class="form-control" required><?= ($secao['descricao']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>

        <!-- Botão de exclusão -->
        <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta seção?');">
            <input type="hidden" name="id" value="<?= ($secao['id']) ?>" />
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </form>

    <?php elseif (@$nome): ?>
        <div class="alert alert-warning">Seção não encontrada.</div>
    <?php endif; ?>

    <!-- Mensagem de erro -->
    <?php if (@$erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
</div>
</body>
</html>
