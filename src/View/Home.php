<?php
ini_set('session.cookie_lifetime', 0);
include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$subsecoes = $subSecaoDAO->listarTodas();

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();

// Ordena seções pelo id ou data de criação (ascendente)
usort($secoes, function($a, $b) {
    return ($a['id'] ?? 0) <=> ($b['id'] ?? 0);
});

// Inicializa todas as seções no array agrupado
$agrupado = [];
foreach ($secoes as $sec) {
    $secaoId = $sec['id'] ?? 'sec_undefined';
    $agrupado[$secaoId] = [
        'id' => $secaoId,
        'nome' => $sec['nome'] ?? 'Sem título de seção',
        'descricao' => $sec['descricao'] ?? '',
        'subsecoes' => []
    ];
}

// Agrupar subseções por seção
if (is_array($subsecoes)) {
    // Ordena subseções pelo id ou data de criação (ascendente)
    usort($subsecoes, function($a, $b) {
        return ($a['sub_id'] ?? 0) <=> ($b['sub_id'] ?? 0);
    });

    foreach ($subsecoes as $row) {
        $secaoId = $row['secao_id'] ?? 'sec_undefined';

        if (!isset($agrupado[$secaoId])) {
            $agrupado[$secaoId] = [
                'id' => $secaoId,
                'nome' => $row['secao_nome'] ?? 'Sem título de seção',
                'descricao' => $row['secao_descricao'] ?? '',
                'subsecoes' => []
            ];
        }

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
    <link rel="stylesheet" href="../Css/sumario.css">
    <style>
        /* Rolagem suave para links internos */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/header.php'; ?>

    <!-- Sumário -->
    <aside id="sumario" aria-label="Sumário de navegação">
        <ul>
            <?php foreach ($agrupado as $secao): ?>
                <li>
                    <a href="#secao-<?= $secao['id'] ?>">
                        <strong><?= htmlspecialchars($secao['nome']) ?></strong>
                    </a>
                    <?php if (!empty($secao['subsecoes'])): ?>
                        <ul>
                            <?php foreach ($secao['subsecoes'] as $sub): ?>
                                <li>
                                    <a href="#subsecao-<?= $sub['id'] ?>">
                                        <?= htmlspecialchars($sub['titulo']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <main>
        <h1 class="text-center mb-5">
            Cartilha de Orientações para o ensino de Programação de Computadores para estudantes cegos
        </h1>

        <?php if (!empty($agrupado)): ?>
            <?php foreach ($agrupado as $secao): ?>
                <section id="secao-<?= $secao['id'] ?>" class="mb-5">
                    <h2><?= htmlspecialchars($secao['nome']) ?></h2>
                    <hr class="linha">
                    <!-- Permite HTML em descrição -->
                    <p><?= nl2br($secao['descricao']) ?></p>

                    <?php if (!empty($secao['subsecoes'])): ?>
                        <?php foreach ($secao['subsecoes'] as $sub): ?>
                            <article id="subsecao-<?= $sub['id'] ?>" class="card mb-3">
                                <div class="card-body">
                                    <h3 class="card-title"><?= htmlspecialchars($sub['titulo']) ?></h3>
                                    <!-- Permite HTML em conteúdo -->
                                    <p class="card-text"><?= nl2br($sub['conteudo']) ?></p>
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
