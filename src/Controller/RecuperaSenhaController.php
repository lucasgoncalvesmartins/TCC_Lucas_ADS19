<?php
include_once __DIR__ . '/../Conexao/Conexao.php';

// Ativa exibição de erros para teste (remova em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define header JSON
header('Content-Type: application/json');


class RecuperaSenhaController {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    // Função principal para rotear chamadas
    public function run() {
        $func = $_GET['function'] ?? '';

        if (!method_exists($this, $func)) {
            echo json_encode(['status'=>'error','message'=>"Função inválida: $func"]);
            exit;
        }

        $this->$func();
    }

    // Solicita recuperação - gera código e salva no banco
    public function solicitarRecuperacao() {
        $email = $_POST['email'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status'=>'error','message'=>'Email inválido']);
            return;
        }

        // Verifica se email existe
        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 0) {
            echo json_encode(['status'=>'error','message'=>'Email não encontrado']);
            return;
        }

        // Gera código e expiração
        $codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiracao = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Atualiza código no banco
        $upd = $this->pdo->prepare("UPDATE usuarios SET codigo_recuperacao = ?, codigo_expiracao = ? WHERE email = ?");
        $upd->execute([$codigo, $expiracao, $email]);

        // Enviar email (simulação local)
        if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
            // Simula envio
            echo json_encode([
                'status'=>'success',
                'message'=>'Código gerado (ambiente local). Verifique seu email.',
                'debug_code'=>$codigo
            ]);
        } else {
            // Aqui você deve implementar o envio real de email
            echo json_encode([
                'status'=>'success',
                'message'=>'Código enviado para seu email.'
            ]);
        }
    }

    // Verifica se código é válido
    public function verificarCodigo() {
        $email = $_POST['email'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        if (!$email || !$codigo) {
            echo json_encode(['status'=>'error','message'=>'Email ou código não enviados']);
            return;
        }

        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND codigo_recuperacao = ? AND codigo_expiracao > NOW()");
        $stmt->execute([$email, $codigo]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status'=>'success','message'=>'Código válido']);
        } else {
            echo json_encode(['status'=>'error','message'=>'Código inválido ou expirado']);
        }
    }

    // Atualiza a senha do usuário
    public function atualizarSenha() {
        $email = $_POST['email'] ?? '';
        $codigo = $_POST['codigo'] ?? '';
        $novaSenha = $_POST['nova_senha'] ?? '';

        if (!$email || !$codigo || !$novaSenha) {
            echo json_encode(['status'=>'error','message'=>'Dados incompletos']);
            return;
        }

        // Valida código
        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND codigo_recuperacao = ? AND codigo_expiracao > NOW()");
        $stmt->execute([$email, $codigo]);

        if ($stmt->rowCount() === 0) {
            echo json_encode(['status'=>'error','message'=>'Código inválido ou expirado']);
            return;
        }

        // Atualiza senha (usar password_hash para segurança!)
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $upd = $this->pdo->prepare("UPDATE usuarios SET senha = ?, codigo_recuperacao = NULL, codigo_expiracao = NULL WHERE email = ?");
        $upd->execute([$senhaHash, $email]);

        echo json_encode(['status'=>'success','message'=>'Senha atualizada com sucesso']);
    }
}

$controller = new RecuperaSenhaController();
$controller->run();
