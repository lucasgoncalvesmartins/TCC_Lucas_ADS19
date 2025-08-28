<?php 

include_once  __DIR__ . '/../Model/CategoriaModel.php';
include_once __DIR__ . '/../Conexao/Conexao.php';

class CategoriaDAO {
    
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function cadastrar() {
        $Categoria = new CategoriaModel($_POST);
        $stmt = $this->conexao->prepare('INSERT INTO categoria (nome, descricao) VALUES (:nome, :descricao)');
        $stmt->bindValue(":nome", $Categoria->getNome());
        $stmt->bindValue(":descricao", $Categoria->getDescricao());
        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
        } else {
            echo "Erro ao cadastrar categoria";
        }
    }


    
    public function listarTodas() {
        $stmt = $this->conexao->prepare('SELECT * FROM categorias ORDER BY nome ASC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar() {
        $Categoria = new CategoriaModel($_POST);

        $stmt = $this->conexao->prepare('
            UPDATE categorias
            SET nome = :nome,
                descricao = :descricao
            WHERE id = :id
        ');

        $stmt->bindValue(':nome', $Categoria->getNome());
        $stmt->bindValue(':descricao', $Categoria->getDescricao());
        $stmt->bindValue(':id', $Categoria->getId());

        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            echo "Erro ao editar categoria";
        }
    }

    
    public function buscarPorNome($nome) {
        $stmt = $this->conexao->prepare("SELECT * FROM categorias WHERE nome = :nome LIMIT 1");
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM categorias WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
