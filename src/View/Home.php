<?php
ini_set('session.cookie_lifetime', 0);
include_once __DIR__ . '/../Controller/SubSecaoDAO.php';
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$subSecaoDAO = new SubSecaoDAO();
$subsecoes = $subSecaoDAO->listarTodasemOrdem();

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();


usort($secoes, function ($a, $b) {
    return ($a['ordem'] ?? 0) <=> ($b['ordem'] ?? 0);
});


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


if (is_array($subsecoes)) {
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

//tratamento de negrito, italico, listas e links
function renderTexto($texto)
{

    $texto = preg_replace('/\[nota\](.*?)\[\/nota\]/s', '<span class="nota">$1</span>', $texto);
    $texto = preg_replace_callback('/\[li\](.*?)\[\/li\]/s', function ($m) {
        return '<li>' . $m[1] . '</li>';
    }, $texto);
    $texto = preg_replace_callback('/\[ul\](.*?)\[\/ul\]/s', function ($m) {
        return '<ul>' . $m[1] . '</ul>';
    }, $texto);

    $texto = preg_replace_callback('/\[ol\](.*?)\[\/ol\]/s', function ($m) {
        return '<ol>' . $m[1] . '</ol>';
    }, $texto);


    $texto = preg_replace_callback(
        '/((?:.(?!<ul|<ol|<li|<span))*.?)/s',
        function ($matches) {
            return nl2br($matches[0]);
        },
        $texto
    );

    return $texto;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="../Css/sumario.css">
    <link rel="stylesheet" href="../Css/home.css">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

</head>

<body>
    <?php
    include_once __DIR__ . '/header.php';
    include_once __DIR__ . '/sumario.php';
    ?>

    <main>
        <h1 class="text-center mb-5">
            Cartilha de Orientações para o ensino de Programação de Computadores para estudantes cegos
        </h1>

        <?php if (!empty($agrupado)): ?>
            <?php foreach ($agrupado as $secao): ?>
                <section id="secao-<?= $secao['id'] ?>" tabindex="-1" class="mb-5">
                    <h2><?= htmlspecialchars($secao['nome']) ?></h2>
                    <hr class="linha"><br>
                    <p><?= renderTexto($secao['descricao']) ?></p><br>

                    <?php if (!empty($secao['subsecoes'])): ?>
                        <?php foreach ($secao['subsecoes'] as $sub): ?>
                            <article id="subsecao-<?= $sub['id'] ?>" class="card mb-3">
                                <div class="card-body">
                                    <h3 class="card-title"><?= htmlspecialchars($sub['titulo']) ?></h3>
                                    <p class="card-text"><?= renderTexto($sub['conteudo']) ?></p>

                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
    </main>

    <?php include_once __DIR__ . '/footer.php'; ?>
</body>

</html>