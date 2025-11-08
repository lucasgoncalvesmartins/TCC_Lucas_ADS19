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

   
    <div id="avisos" aria-live="polite" style="position:absolute; left:-9999px;"></div>

    <?php include 'header.php'; ?>

    <h1>Arraste ou use as setas para reordenar as SubSeções</h1>

    <ul id="listaSub" role="listbox">
        <?php foreach($subsecoes as $sub): ?>
            <li tabindex="0"
                role="option"
                aria-grabbed="false"
                data-id="<?= $sub['id'] ?>">
                <?= htmlspecialchars($sub['titulo']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <button id="salvar">Salvar Ordem</button>
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar para página inicial</a>

    <script>
    const lista = document.getElementById('listaSub');
    const avisos = document.getElementById('avisos');

    // Arrastar com o mouse
    const sortable = new Sortable(lista, {
        animation: 150,
        onEnd: function(evt) {
            atualizarNumeros();
            const item = evt.item;
            const titulo = item.innerText.trim();
            const novaPos = evt.newIndex + 1;

            avisos.textContent = titulo + " movida para a posição " + novaPos;
        }
    });

    function atualizarNumeros() {
        // Caso você queira numerar visualmente depois
    }

    // Movimentar via teclado com feedback para leitor de tela
    lista.addEventListener('keydown', e => {
        const foco = document.activeElement;
        if (!foco || !foco.matches('li[data-id]')) return;

        const titulo = foco.innerText.trim();

        if (e.key === 'ArrowUp') {
            const anterior = foco.previousElementSibling;
            if (anterior) {
                lista.insertBefore(foco, anterior);
                foco.focus();
                foco.setAttribute('aria-grabbed', 'true');

                avisos.textContent = titulo + " movida para cima";

                foco.setAttribute('aria-grabbed', 'false');
                atualizarNumeros();
            }
            e.preventDefault();
        }

        if (e.key === 'ArrowDown') {
            const proximo = foco.nextElementSibling;
            if (proximo) {
                lista.insertBefore(proximo, foco);
                foco.focus();
                foco.setAttribute('aria-grabbed', 'true');

                avisos.textContent = titulo + " movida para baixo";

                foco.setAttribute('aria-grabbed', 'false');
                atualizarNumeros();
            }
            e.preventDefault();
        }
    });

    // Salvar ordem
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
                avisos.textContent = "Ordem salva com sucesso";
                setTimeout(() => window.location.href = 'home.php', 600);
            } else {
                alert('Erro ao salvar a ordem das subseções.');
            }
        });
    });
    </script>
</body>
</html>
