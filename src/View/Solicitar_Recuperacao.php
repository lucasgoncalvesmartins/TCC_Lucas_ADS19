<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Recuperar Senha</title>
</head>
<body>
  <h1>Recuperar Senha</h1>

  <form id="formSolicitarRecuperacao">
      <label for="email">Email cadastrado:</label><br>
      <input type="email" id="email" name="email" required>
      <br><br>
      <button type="submit">Enviar Código</button>
  </form>

  <div id="mensagem" style="margin-top: 20px; color: red;"></div>

  <script>
    document.getElementById('formSolicitarRecuperacao').addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch('../Controller/RecuperaSenhaController.php?function=solicitarRecuperacao', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        const mensagemDiv = document.getElementById('mensagem');
        mensagemDiv.style.color = data.status === 'success' ? 'green' : 'red';
        mensagemDiv.innerHTML = data.message + (data.debug_code ? `<br><strong>Código (DEBUG): ${data.debug_code}</strong>` : '');

        if (data.status === 'success') {
          setTimeout(() => {
            window.location.href = `inserir_codigo.php?email=${encodeURIComponent(formData.get('email'))}`;
          }, 2000);
        }
      })
      .catch(error => {
        const mensagemDiv = document.getElementById('mensagem');
        mensagemDiv.style.color = 'red';
        mensagemDiv.textContent = 'Erro na requisição. Tente novamente.';
        console.error('Erro no fetch:', error);
      });
    });
  </script>
</body>
</html>
