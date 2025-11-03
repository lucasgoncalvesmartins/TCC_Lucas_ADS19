<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php';

$subSecaoDAO = new SubSecaoDAO();

$id_secao = $_GET['secao'] ?? null;
if (!$id_secao) {
    echo "Seção não informada!";
    exit;
}

$subsecoes = $subSecaoDAO->buscarPorSecao((int)$id_secao);

usort($subsecoes, function($a, $b) {
    return $a['ordem'] <=> $b['ordem'];
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Ordenar SubSeções</title>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<link rel="stylesheet" href="../Css/ordenarsubsecao.css">
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Arraste ou use as setas para reordenar as SubSeções</h1>

    <ul id="listaSub">
        <?php foreach($subsecoes as $sub): ?>
            <li tabindex="0" data-id="<?= $sub['id'] ?>">
                <?= htmlspecialchars($sub['titulo']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <button id="salvar">Salvar Ordem</button>
    <a href="home.php" class="btn btn-link" tabindex="0">Voltar</a>

    <script>
    const lista = document.getElementById('listaSub');

    // --- Ativa o arrastar com o mouse ---
    const sortable = new Sortable(lista, {
        animation: 150,
        onEnd: atualizarNumeros
    });

    // Atualiza visualmente se quiser mostrar números futuramente
    function atualizarNumeros() {
        // Exemplo: poderia atualizar índices visuais se houver número
    }

    // --- Permite movimentar via teclado ---
    lista.addEventListener('keydown', e => {
        const foco = document.activeElement;
        if (!foco || !foco.matches('li[data-id]')) return;

        if (e.key === 'ArrowUp') {
            const anterior = foco.previousElementSibling;
            if (anterior) {
                lista.insertBefore(foco, anterior);
                foco.focus();
                atualizarNumeros();
            }
            e.preventDefault();
        }

        if (e.key === 'ArrowDown') {
            const proximo = foco.nextElementSibling;
            if (proximo) {
                lista.insertBefore(proximo, foco);
                foco.focus();
                atualizarNumeros();
            }
            e.preventDefault();
        }
    });

    // --- Envia a nova ordem pro backend ---
    document.getElementById('salvar').addEventListener('click', () => {
        const ordem = Array.from(lista.children).map((li, index) => ({
            id: li.dataset.id,
            ordem: index + 1
        }));

        fetch('salvarOrdemSubSecao.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(ordem)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'sucesso') {
                window.location.href = 'home.php';
            } else {
                alert('Erro ao salvar a ordem das subseções.');
            }
        });
    });
    </script>
</body>
</html>
