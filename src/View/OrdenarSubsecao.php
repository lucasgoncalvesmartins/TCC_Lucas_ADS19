<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php';

$subSecaoDAO = new SubSecaoDAO();

$id_secao = $_GET['secao'] ?? null;
if (!$id_secao) {
    echo "Seção não informada!";
    exit;
}

$subsecoes = $subSecaoDAO->buscarPorSecao((int)$id_secao);

usort($subsecoes, function ($a, $b) {
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
     <link rel="stylesheet" href="../Css/footer.css">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>

<body>


    <div id="avisos" aria-live="polite" style="position:absolute; left:-9999px;"></div>

    <?php include 'header.php'; ?>
<main> 
    <h1>Arraste ou use as setas para reordenar as SubSeções</h1>

    <ul id="listaSub" role="listbox">
        <?php foreach ($subsecoes as $sub): ?>
            <li tabindex="0"
                role="option"
                aria-grabbed="false"
                data-id="<?= $sub['id'] ?>"
                aria-label="<?= $sub['ordem'] ?>. <?= htmlspecialchars($sub['titulo']) ?>">

                <span class="numero"><?= $sub['ordem'] ?></span>
                <span class="titulo"><?= htmlspecialchars($sub['titulo']) ?></span>
            </li>

        <?php endforeach; ?>
    </ul>

    <button id="salvar">Salvar Ordem</button>
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar para página inicial</a>

    <script>
        const lista = document.getElementById('listaSub');
        const avisos = document.getElementById('avisos');

        //  atualiza números 
        function atualizarNumeros() {
            Array.from(lista.children).forEach((li, index) => {
                const pos = index + 1;

                li.querySelector('.numero').textContent = pos;

                const titulo = li.querySelector('.titulo').innerText.trim();
                li.setAttribute("aria-label", pos + ". " + titulo);
            });
        }

        // arrastar com mouse
        const sortable = new Sortable(lista, {
            animation: 150,
            onEnd: function(evt) {
                atualizarNumeros();

                const item = evt.item;
                const titulo = item.querySelector('.titulo').innerText.trim();
                const pos = evt.newIndex + 1;

                avisos.textContent = titulo + " agora é a posição " + pos;
            }
        });

        // teclado
        lista.addEventListener('keydown', e => {
            const foco = document.activeElement;
            if (!foco || !foco.matches('li[data-id]')) return;

            const titulo = foco.querySelector('.titulo').innerText.trim();

            if (e.key === 'ArrowUp') {
                const anterior = foco.previousElementSibling;
                if (anterior) {
                    lista.insertBefore(foco, anterior);
                    foco.focus();
                    atualizarNumeros();

                    const pos = Array.from(lista.children).indexOf(foco) + 1;
                    avisos.textContent = titulo + " agora é a posição " + pos;
                }
                e.preventDefault();
            }

            if (e.key === 'ArrowDown') {
                const proximo = foco.nextElementSibling;
                if (proximo) {
                    lista.insertBefore(proximo, foco);
                    foco.focus();
                    atualizarNumeros();

                    const pos = Array.from(lista.children).indexOf(foco) + 1;
                    avisos.textContent = titulo + " agora é a posição " + pos;
                }
                e.preventDefault();
            }
        });

        // salvar nova ordem
        document.getElementById('salvar').addEventListener('click', () => {
            const ordem = Array.from(lista.children).map((li, index) => ({
                id: li.dataset.id,
                ordem: index + 1
            }));

            fetch('salvarOrdemSubSecao.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(ordem)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'sucesso') {

                        avisos.textContent = "";

                        setTimeout(() => {
                            avisos.textContent = "Ordem das subseções salva com sucesso";
                        }, 30);

                        setTimeout(() => {
                            window.location.href = 'home.php';
                        }, 900);

                    } else {
                        avisos.textContent = "";
                        setTimeout(() => {
                            avisos.textContent = "Erro ao salvar a ordem das subseções";
                        }, 30);
                    }
                });
        });
    </script>
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