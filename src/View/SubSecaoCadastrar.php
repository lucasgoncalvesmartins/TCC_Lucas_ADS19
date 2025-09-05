<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: AdmLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$autores = $subSecaoDAO->buscaAutor();

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sucesso = $subSecaoDAO->cadastrar($_POST);
    if ($sucesso) {
        header("Location: ./../View/home.php?msg=sucesso");
        exit();
    } else {
        $erro = "Erro ao cadastrar subseção.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar SubSeção</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Cadastrar SubSeção</h1>

    <?php if (!empty($erro)): ?>
        <p><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="" method="post">
    <label for="titulo">Título:</label><br>
    <input type="text" name="titulo" id="titulo" required><br><br>

    <label for="conteudo">Conteúdo:</label><br>
    <textarea name="conteudo" id="conteudo" rows="6" required></textarea><br><br>

    <label for="id_secao">Seção:</label><br>
    <select name="id_secao" id="id_secao" required>
        <option value="">-- Selecione uma seção --</option>
        <?php
        $secaoDAO = new SecaoDAO();
        $secoes = $secaoDAO->listarTodas();
        foreach ($secoes as $secao): ?>
            <option value="<?= $secao['id'] ?>"><?= htmlspecialchars($secao['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Cadastrar</button>
</form>

</body>
</html>
