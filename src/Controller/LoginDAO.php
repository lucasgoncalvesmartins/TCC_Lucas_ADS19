<?php
include_once __DIR__ . '/../Conexao/Conexao.php';
include_once __DIR__ . '/../Model/LoginModel.php';


class LoginDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $login = new LoginModel($_POST);
        $stmt = $this->conexao->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindValue(":email", $login->getEmail());
        $stmt->execute();
        $linha = $stmt->fetch();

        if ($linha && $linha['senha'] === $login->getSenha()) {

            session_regenerate_id();
            $_SESSION['id'] = $linha['id'];
            $_SESSION['tipo'] = $linha['tipo'];
            $_SESSION['email'] = $linha['email'];
            
            // Se quiser armazenar o session_id no DB, crie a coluna sessaoID
            // $sessaoID = session_id();
            // $stmt = $this->conexao->prepare("UPDATE usuarios SET sessaoID = :sessaoID WHERE id = :id");
            // $stmt->bindValue(":sessaoID", $sessaoID);
            // $stmt->bindValue(":id", $linha['id']);
            // $stmt->execute();

            header('Location: ./../View/Home.php');
            exit;
        } else {
            echo "E-mail ou senha incorretos!";
        }
    }

    public function checkLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Se não tiver sessaoID no DB, só verifica se a sessão existe
        if (isset($_SESSION['id'])) {
            $data['saida'] = 'login';
        } else {
            $data['saida'] = 'logout';
        }

        echo json_encode($data);
    }
}

