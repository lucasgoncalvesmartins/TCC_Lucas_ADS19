<?php
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();


usort($secoes, function($a, $b) {
    return $a['ordem'] <=> $b['ordem'];
});

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        if ($secaoDAO->excluir($id)) {
            header('Location: home.php?msg=excluido');
            exit();
        } else {
            $erro = "Erro ao excluir seção.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/listarsecoes.css">
    <title>Listar Seções</title>
    
</head>
<body>
<?php include 'header.php'; ?>
<h2 style="text-align:center;">Lista de Seções</h2>

<?php if ($erro): ?>
    <p style="color:red; text-align:center;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Ordem</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($secoes as $secao): ?>
        <tr>
            <td><?= $secao['ordem'] ?></td>
            <td><?= htmlspecialchars($secao['nome']) ?></td>
            <td>
                <a class="button" href="SecaoEditar.php?id=<?= $secao['id'] ?>">Editar</a>
                <a class="button ordenar" href="OrdenarSecoes.php?id=<?= $secao['id'] ?>">Redefinir numeração</a>
                <form method="post" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir esta seção?');">
                    <input type="hidden" name="id" value="<?= $secao['id'] ?>" />
                    <button type="submit" name="excluir" class="button delete">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>

</body>
</html>
