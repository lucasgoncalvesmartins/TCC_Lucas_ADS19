<?php

include_once  __DIR__ . '/../Model/UsuarioModel.php';
include_once __DIR__ . '/../Conexao/Conexao.php';

class UsuarioDAO
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    // Cadastrar novo usuário
    public function cadastrar()
    {

        $Usuario = new UsuarioModel($_POST);

        // verifica se já existe algum usuário no banco
        $check = $this->conexao->query("SELECT COUNT(*) as total FROM usuarios");
        $count = $check->fetch(PDO::FETCH_ASSOC)['total'];

        // se for o primeiro dá adm pra ele
        if ($count == 0) {
            $Usuario->setTipo('admin');
        } else {
            $Usuario->setTipo('comum');
        }


        $stmt = $this->conexao->prepare(
            'INSERT INTO usuarios (nome_usuario, email, senha, tipo) 
         VALUES (:nome_usuario, :email, :senha, :tipo)'
        );

        $stmt->bindValue(":nome_usuario", $Usuario->getNome());
        $stmt->bindValue(":email", $Usuario->getEmail());
        $stmt->bindValue(":senha", $Usuario->getSenha());
        $stmt->bindValue(":tipo", $Usuario->getTipo());

        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
            exit;
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }



    // Buscar usuário por ID
    public function buscarPorId($id)
    {
        $stmt = $this->conexao->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    //buscar usuário por email 
    public function buscarPorEmail($email)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ? $usuario : null;
    }

    // Atualizar email e senha do usuário
    public function atualizar($id, $email, $senha)
    {
        $stmt = $this->conexao->prepare('UPDATE usuarios SET email = :email, senha = :senha WHERE id = :id');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function remover($id)
    {
        $stmt = $this->conexao->prepare('delete from usuarios where id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // Listar todos os usuários
    public function listarTodos()
    {
        $stmt = $this->conexao->prepare("SELECT * FROM usuarios ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar role do usuário
    public function atualizarRole($idUsuario, $novaRole)
    {
        $sql = "UPDATE usuarios SET tipo = :tipo WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':tipo', $novaRole);
        $stmt->bindValue(':id', $idUsuario);
        return $stmt->execute();
    }
}
