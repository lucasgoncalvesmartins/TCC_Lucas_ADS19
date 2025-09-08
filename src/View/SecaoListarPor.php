<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: TelaLogin.php');
    exit;
}

include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$secao_id = isset($_GET['secao_id']) && is_numeric($_GET['secao_id']) ? (int) $_GET['secao_id'] : null;

if ($secao_id === null) {
    echo "Seção inválida.";
    exit;
}

$subSecaoDAO = new SubSecaoDAO();
$subsecoes = $subSecaoDAO->buscarPorSecao($secao_id);

$secaoDAO = new SecaoDAO();
$secao = $secaoDAO->buscarPorId($secao_id); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SubSeções da Seção</title>
</head>
<body>
<?php include 'header.php'; ?>

<div>
    <h1>SubSeções da Seção: <?= htmlspecialchars($secao['nome'] ?? '') ?></h1>

    <?php if (!empty($subsecoes)): ?>
        <?php foreach ($subsecoes as $subSecao): ?>
            <article>
                <h2><?= htmlspecialchars($subSecao['titulo']) ?></h2>
                <p>
                    <strong>Autor:</strong> <?= htmlspecialchars($subSecao['autor']) ?> |
                    <strong>Seção:</strong> <?= htmlspecialchars($subSecao['secao']) ?> |
                    <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($subSecao['data_publicacao'])) ?>
                </p>
                <p><?= nl2br(htmlspecialchars($subSecao['conteudo'])) ?></p>
            </article>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma SubSeção encontrada.</p>
    <?php endif; ?>
</div>

</body>
</html>
