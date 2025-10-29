<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php'; 

$subSecaoDAO = new SubSecaoDAO();
$secoes = $subSecaoDAO->buscaSecao();

$id_secao_selecionada = $_GET['secao'] ?? null;
$subsecoes = [];

if ($id_secao_selecionada) {
    $subsecoes = $subSecaoDAO->buscarPorSecao((int)$id_secao_selecionada);
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir']) && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        if ($subSecaoDAO->excluir($id)) { 
            header('Location: home.php?msg=excluido');
            exit();
        } else {
            $erro = "Erro ao excluir subseção.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Sub-seções</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 4px 8px; margin-right: 5px; border-radius: 3px; text-decoration: none; color: white; }
        .btn.edit { background-color: #4CAF50; }
        .btn.delete { background-color: #f44336; border: none; cursor: pointer; }
    </style>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Listar SubSeções</h1>
<h2 style="text-align:center;">Sub-seções por Seção</h2>

<?php if (!empty($erro)): ?>
    <p style="color:red; text-align:center;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="get" style="text-align:center; margin-bottom: 20px;">
    <label for="secao">Selecione a Seção:</label>
    <select name="secao" id="secao" onchange="this.form.submit()">
        <option value="">-- Selecione --</option>
        <?php foreach ($secoes as $secao): ?>
            <option value="<?= $secao['id'] ?>" <?= ($secao['id'] == $id_secao_selecionada) ? 'selected' : '' ?>>
                <?= htmlspecialchars($secao['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if ($id_secao_selecionada && $subsecoes): ?>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Data Publicação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subsecoes as $sub): ?>
                <tr>
                    <td><?= htmlspecialchars($sub['titulo']) ?></td>
                    <td><?= htmlspecialchars($sub['autor']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($sub['data_publicacao'])) ?></td>
                    <td>
                        <a class="btn edit" href="SubSecaoEditar.php?id=<?= $sub['id'] ?>">Editar</a>
                        <a class="btn edit" href="OrdenarSubSecao.php?secao=<?= $id_secao_selecionada ?>">Ordenar Subseção</a>
                        <form method="post" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir esta subseção?');">
                            <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                            <button type="submit" name="excluir" class="btn delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>
<?php elseif ($id_secao_selecionada): ?>
    <p style="text-align:center;">Nenhuma subseção encontrada para esta seção.</p>
<?php endif; ?>
</main>
</body>
</html>
