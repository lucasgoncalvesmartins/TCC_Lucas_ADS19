<?php
ini_set('session.cookie_lifetime', 0);
include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$subsecoes = $subSecaoDAO->listarTodas();


$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();

// agrupar subseções por seção
$agrupado = [];
if (is_array($subsecoes)) {
    foreach ($subsecoes as $row) {

        $secaoId   = $row['secao_id'] ?? null;
        $secaoNome = $row['secao_nome'] ?? 'Sem título de seção';
        $secaoDesc = $row['secao_descricao'] ?? '';


        if (empty($secaoId)) {
            $secaoId = 'sec_undefined';
        }

        if (!isset($agrupado[$secaoId])) {
            $agrupado[$secaoId] = [
                'nome' => $secaoNome,
                'descricao' => $secaoDesc,
                'subsecoes' => []
            ];
        }

        // normalizar dados da subseção para uso direto no template
        $agrupado[$secaoId]['subsecoes'][] = [
            'id' => $row['sub_id'] ?? null,
            'titulo' => $row['sub_titulo'] ?? 'Sem título',
            'conteudo' => $row['sub_conteudo'] ?? '',
            'data_publicacao' => $row['sub_data_publicacao'] ?? $row['data_publicacao'] ?? null,
            'autor' => $row['autor'] ?? 'Autor desconhecido',
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="../Css/home.css">
</head>

<body>
    <?php include_once __DIR__ . '/header.php'; ?>
    <?php include __DIR__ . '/sumario.php'; ?>

    <main>
        <h1 class="text-center mb-5">
            Cartilha de Orientações para o ensino de Programação de Computadores para estudantes cegos
        </h1>

        <?php if (!empty($agrupado)): ?>
            <?php foreach ($agrupado as $secao): ?>
                <section class="mb-5">
                    <h2><?= htmlspecialchars($secao['nome']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($secao['descricao'])) ?></p>

                    <?php if (!empty($secao['subsecoes'])): ?>
                        <?php foreach ($secao['subsecoes'] as $sub): ?>
                            <article class="card mb-3">
                                <div class="card-body">
                                    <h3 class="card-title"><?= htmlspecialchars($sub['titulo']) ?></h3>

                                    <p class="card-text"><?= nl2br(htmlspecialchars($sub['conteudo'])) ?></p>

                                    <p class="mt-3 text-muted">
                                        <strong>Autor:</strong> <?= htmlspecialchars($sub['autor']) ?> |
                                        <strong>Data:</strong>
                                        <?= $sub['data_publicacao'] ? date('d/m/Y H:i', strtotime($sub['data_publicacao'])) : '—' ?>
                                    </p>
                                </div>
                            </article>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Nenhuma subseção nessa seção.</p>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Nenhuma seção encontrada.</p>
        <?php endif; ?>
    </main>

    <?php include_once __DIR__ . '/footer.php'; ?>
</body>

</html>