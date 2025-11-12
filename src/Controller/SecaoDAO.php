<?php 

include_once  __DIR__ . '/../Model/SecaoModel.php';
include_once __DIR__ . '/../Conexao/Conexao.php';

class SecaoDAO {
    
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

   // Cadastrar nova seção
public function cadastrar() {

    $Secao = new SecaoModel($_POST);

    if (!isset($_POST['ordem']) || empty($_POST['ordem'])) {
        $stmtMax = $this->conexao->query("SELECT MAX(ordem) AS max_ordem FROM secoes");
        $max = $stmtMax->fetch(PDO::FETCH_ASSOC)['max_ordem'];
        $ordem = $max + 1;
    } else {
        $ordem = (int) $_POST['ordem'];
        
        $stmtShift = $this->conexao->prepare("UPDATE secoes SET ordem = ordem + 1 WHERE ordem >= :ordem");
        $stmtShift->execute([':ordem' => $ordem]);
    }

    
    $stmt = $this->conexao->prepare('INSERT INTO secoes (nome, descricao, ordem) VALUES (:nome, :descricao, :ordem)');
    $stmt->bindValue(":nome", $Secao->getNome());
    $stmt->bindValue(":descricao", $Secao->getDescricao());
    $stmt->bindValue(":ordem", $ordem, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ./../View/home.php');
        exit;
    } else {
        echo "Erro ao cadastrar seção";
    }
}



    // Listar todas as seções
    public function listarTodas() {
        $stmt = $this->conexao->prepare('SELECT * FROM secoes ORDER BY nome ASC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Editar seção existente
    public function editar() {
        $Secao = new SecaoModel($_POST);

        $stmt = $this->conexao->prepare('
            UPDATE secoes
            SET nome = :nome,
                descricao = :descricao
            WHERE id = :id
        ');

        $stmt->bindValue(':nome', $Secao->getNome());
        $stmt->bindValue(':descricao', $Secao->getDescricao());
        $stmt->bindValue(':id', $Secao->getId());

        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            echo "Erro ao editar seção";
        }
    }

    // Buscar seção por nome
    public function buscarPorNome($nome) {
        $stmt = $this->conexao->prepare("SELECT * FROM secoes WHERE nome = :nome LIMIT 1");
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    // Excluir seção
    public function excluir($id) {
        $stmt = $this->conexao->prepare("DELETE FROM secoes WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    // Listar seções com seus posts
    public function listarSecaoComPosts() {
        $sql = "SELECT s.id AS secao_id, s.nome AS secao_nome, p.id AS post_id, p.titulo AS post_titulo
                FROM secoes s
                LEFT JOIN subsecoes p ON s.id = p.id_secao
                ORDER BY s.nome, p.data_publicacao DESC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $secoes = [];
        foreach ($result as $row) {
            $secaoId = $row['secao_id'];
            if (!isset($secoes[$secaoId])) {
                $secoes[$secaoId] = [
                    'id' => $secaoId,
                    'nome' => $row['secao_nome'],
                    'posts' => []
                ];
            }
            if ($row['post_id']) {
                $secoes[$secaoId]['posts'][] = [
                    'id' => $row['post_id'],
                    'titulo' => $row['post_titulo']
                ];
            }
        }

        return $secoes;
    }


    //buascar seção por id 
    public function buscarPorId($id) {
    $stmt = $this->conexao->prepare("SELECT * FROM secoes WHERE id = :id LIMIT 1");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado ?: null;
}


    // Editar ordem da seção, primeiramente busca a ordem antiga, depois sobe ou desce as outras seções conforme a nova ordem, e por fim atualiza a seção
public function editarOrdem($dados) {
    $id = $dados['id'];
    $nova_ordem = $dados['ordem'];

    $stmt = $this->conexao->prepare("SELECT ordem FROM secoes WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $ordem_antiga = $stmt->fetch(PDO::FETCH_ASSOC)['ordem'];

    if ($nova_ordem != $ordem_antiga) {
        if ($nova_ordem < $ordem_antiga) {
            
            $stmt = $this->conexao->prepare("UPDATE secoes SET ordem = ordem + 1 WHERE ordem >= :nova AND ordem < :antiga");
            $stmt->execute([':nova' => $nova_ordem, ':antiga' => $ordem_antiga]);
        } else {
            
            $stmt = $this->conexao->prepare("UPDATE secoes SET ordem = ordem - 1 WHERE ordem <= :nova AND ordem > :antiga");
            $stmt->execute([':nova' => $nova_ordem, ':antiga' => $ordem_antiga]);
        }
    }

    $stmt = $this->conexao->prepare("UPDATE secoes SET nome = :nome, descricao = :descricao, ordem = :ordem WHERE id = :id");
    $stmt->execute([
        ':nome' => $dados['nome'],
        ':descricao' => $dados['descricao'],
        ':ordem' => $nova_ordem,
        ':id' => $id
    ]);

    return $stmt->rowCount() > 0;
}

}
