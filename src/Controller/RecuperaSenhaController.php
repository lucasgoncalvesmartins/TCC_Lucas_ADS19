<?php
namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');

$function = $_GET['function'] ?? '';

try {

    $pdo = new \PDO(
        'mysql:host=127.0.0.1;dbname=tcclucas_ads19;charset=utf8mb4',
        'root',
        ''
    );
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    if ($function === 'solicitarRecuperacao') {
        $email = $_POST['email'] ?? '';
        if (!$email) {
            echo json_encode(['status' => 'error', 'message' => 'Email não fornecido']);
            exit;
        }

        // Verificando se usuário/email existe
        $stmt = $pdo->prepare("SELECT id, nome_usuario FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'Email não encontrado']);
            exit;
        }

        // Gerando o código e expiração
        $codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiracao = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // aqui esta salvando no banco
        $stmt = $pdo->prepare("
            UPDATE usuarios
            SET codigo_recuperacao = :codigo, codigo_expiracao = :expiracao
            WHERE id = :id
        ");
        $stmt->execute([
            'codigo' => $codigo,
            'expiracao' => $expiracao,
            'id' => $user['id']
        ]);

        // aqui ele esta enviando o email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lucascamargogoncalvesmartins@gmail.com';  
        $mail->Password = 'cjpi npqk ocbh evdu';  
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('lucascamargogoncalvesmartins@gmail.com', 'Sistema'); 
        $mail->addAddress($email, $user['nome_usuario']);
        $mail->isHTML(true);
        $mail->Subject = 'Código de recuperação de senha';
        $mail->Body = "Olá {$user['nome_usuario']},<br>
                       Seu código de recuperação é: <strong>$codigo</strong>.<br>
                       Expira em 15 minutos.";

        $mail->send();

        echo json_encode(['status' => 'success', 'message' => 'Código enviado!', 'debug_code' => $codigo]);
        exit;

    } elseif ($function === 'verificarCodigo') {
        $email = $_POST['email'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        if (!$email || !$codigo) {
            echo json_encode(['status' => 'error', 'message' => 'Email ou código não fornecido']);
            exit;
        }

        // aqui ele faz a busca do codigo no banco
        $stmt = $pdo->prepare("SELECT codigo_recuperacao, codigo_expiracao FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'Email não encontrado']);
            exit;
        }

        if ($user['codigo_recuperacao'] !== $codigo) {
            echo json_encode(['status' => 'error', 'message' => 'Código inválido']);
            exit;
        }

        if (strtotime($user['codigo_expiracao']) < time()) {
            echo json_encode(['status' => 'error', 'message' => 'Código expirado']);
            exit;
        }

        echo json_encode(['status' => 'success', 'message' => 'Código válido!']);
        exit;

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Função inválida']);
        exit;
    }

} catch (\PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro no PHPMailer: ' . $e->getMessage()]);
}
