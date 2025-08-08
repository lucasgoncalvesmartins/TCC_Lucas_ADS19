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

    public function selectTodos() {
        $stmt = $this->conexao->prepare('SELECT * FROM categoria');
        $response = '<div class="col s2"></div><div class="col s10 center-align"><table><thead><tr><th class="center-align">Id</th><th class="center-align">Nome</th><th class="center-align">Descricao</th><th class="center-align">Editar</th><th class="center-align">Excluir</th></tr></thead><tbody>';
        if ($stmt->execute()) {
            while ($linha = $stmt->fetch()) {
                $Categoria = new CategoriaModel($linha);
                $response .= "<tr><td class='center-align'>" . $Categoria->getId() . "</td><td class='center-align'>" . 
                $Categoria->getNome() . "</td><td class='center-align'>" . 
                $Categoria->getDescricao() . "</td>
                <td class='center-align'><a href='#!' class='blue-text editar' id='" .
                $Categoria->getId() . "' onclick='editar(this.id)'><span class='material-icons'>mode_edit</span></a></td><td class='center-align'><a href='#!' class='blue-text excluir' id='" . 
                $Categoria->getId() . "' onclick='excluir(this.id)'><span class='material-icons'>delete</span></a></td></tr>";
            }
            $response .= "</tbody></table></div>";
            echo $response;
        } else {
            echo "Erro ao buscar categorias";
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
            UPDATE categoria
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
        $stmt = $this->conexao->prepare("SELECT * FROM categoria WHERE nome = :nome LIMIT 1");
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM categoria WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
