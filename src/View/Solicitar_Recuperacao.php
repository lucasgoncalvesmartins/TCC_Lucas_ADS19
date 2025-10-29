<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../Css/RecuperarSenha.css" />
  <title>Recuperar Senha</title>
   <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
</head>

<body>

  <?php
  include_once __DIR__ . '/header.php';

  ?>
  
<main>
  <form id="formSolicitarRecuperacao">
    <h1>Recuperar Senha</h1>
    <label for="email">Email cadastrado:</label><br>
    <input type="email" id="email" name="email" required>
    <br><br>
    <button type="submit">Enviar Código</button>
  </form>

  <div id="codigoContainer" style="display:none; margin-top:20px;">
    <label for="codigo">Insira o código recebido:</label><br>
    <input type="text" id="codigo" name="codigo" maxlength="6">
    <br><br>
    <button id="btnVerificarCodigo">Verificar Código</button>
  </div>

  <div id="mensagem" style="margin-top: 20px; color: red;"></div>

  <script>
    const form = document.getElementById('formSolicitarRecuperacao');
    const codigoContainer = document.getElementById('codigoContainer');
    const btnVerificar = document.getElementById('btnVerificarCodigo');
    const mensagemDiv = document.getElementById('mensagem');

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      mensagemDiv.textContent = '';
      const formData = new FormData(this);

      fetch('../Controller/RecuperaSenhaController.php?function=solicitarRecuperacao', {
          method: 'POST',
          body: formData
        })
        .then(res => res.json())
        .then(data => {
          mensagemDiv.style.color = data.status === 'success' ? '#247f4b' : 'red';
          mensagemDiv.innerHTML = data.message;

          if (data.status === 'success') {
            codigoContainer.style.display = 'block';
          }
        })
        .catch(err => {
          mensagemDiv.style.color = 'red';
          mensagemDiv.textContent = 'Erro na requisição';
          console.error(err);
        });
    });

    btnVerificar.addEventListener('click', function(e) {
      e.preventDefault();
      const email = document.getElementById('email').value;
      const codigo = document.getElementById('codigo').value;

      if (!codigo) return alert('Informe o código recebido');

      const formData = new FormData();
      formData.append('email', email);
      formData.append('codigo', codigo);

      fetch('../Controller/RecuperaSenhaController.php?function=verificarCodigo', {
          method: 'POST',
          body: formData
        })
        .then(res => res.json())
        .then(data => {
          mensagemDiv.style.color = data.status === 'success' ? 'green' : 'red';
          mensagemDiv.textContent = data.message;

          if (data.status === 'success') {

            window.location.href = 'RedefinirSenha.php?email=' + encodeURIComponent(email);
          }
        })
        .catch(err => {
          mensagemDiv.style.color = 'red';
          mensagemDiv.textContent = 'Erro na verificação';
          console.error(err);
        });
    });
  </script>
</body>
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>
  </main>
</html>