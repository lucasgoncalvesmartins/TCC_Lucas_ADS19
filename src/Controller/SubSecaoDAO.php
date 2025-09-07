<?php
include_once __DIR__ . '/../Model/SubSecaoModel.php';
include_once __DIR__ . '/../Conexao/Conexao.php';

class SubSecaoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    public function cadastrar($postData)
{
    session_start(); 
    $subSecao = new SubSecaoModel($postData);

    if (!isset($_SESSION['id'])) {
        echo "Usuário não logado!";
        exit();
    }

    $subSecao->setId_Autor($_SESSION['id']); // autor logado

    if (empty($subSecao->getId_Secao())) {
        echo "Selecione uma seção!";
        exit();
    }

    $stmt = $this->conexao->prepare('
        INSERT INTO subsecoes (titulo, conteudo, id_autor, id_secao, data_publicacao)
        VALUES (:titulo, :conteudo, :id_autor, :id_secao, :data_publicacao)
    ');

    $stmt->bindValue(":titulo", $subSecao->getTitulo());
    $stmt->bindValue(":conteudo", $subSecao->getConteudo());
    $stmt->bindValue(":id_autor", $subSecao->getId_Autor());
    $stmt->bindValue(":id_secao", $subSecao->getId_Secao());
    $stmt->bindValue(":data_publicacao", date('Y-m-d H:i:s'));

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}




    public function listarTodas()
{
    $sql = "
        SELECT
            sec.id                 AS secao_id,
            sec.nome               AS secao_nome,
            sec.descricao          AS secao_descricao,
            sub.id                 AS sub_id,
            sub.titulo             AS sub_titulo,
            sub.conteudo           AS sub_conteudo,
            sub.data_publicacao    AS sub_data_publicacao,
            u.nome_usuario         AS autor
        FROM subsecoes sub
        JOIN secoes sec   ON sub.id_secao = sec.id
        JOIN usuarios u   ON sub.id_autor = u.id
        ORDER BY sec.id ASC, sub.id ASC
    ";

    $stmt = $this->conexao->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



  
    public function buscaAutor()
    {
        $stmt = $this->conexao->prepare("SELECT id, nome_usuario FROM usuarios WHERE tipo = 'autor'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function buscaSecao()
    {
        $stmt = $this->conexao->prepare("SELECT id, nome FROM secoes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarSubSecaoPorTitulo($titulo)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM subsecoes WHERE titulo LIKE :titulo LIMIT 1");
        $stmt->bindValue(':titulo', "%$titulo%");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar()
    {
        $subSecao = new SubSecaoModel($_POST);

        $stmt = $this->conexao->prepare('
            UPDATE subsecoes
            SET titulo = :titulo,
                conteudo = :conteudo,
                id_secao = :id_secao,
                data_publicacao = :data_publicacao
            WHERE id = :id
        ');

        $stmt->bindValue(':titulo', $subSecao->getTitulo());
        $stmt->bindValue(':conteudo', $subSecao->getConteudo());
        $stmt->bindValue(':id_secao', $subSecao->getId_Secao());
        $stmt->bindValue(':data_publicacao', date('Y-m-d H:i:s'));
        $stmt->bindValue(':id', $subSecao->getId_Secao());

        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            echo "Erro ao editar subseção";
        }
    }

    public function buscarPorSecao($id_secao)
    {
        $stmt = $this->conexao->prepare('
            SELECT 
                s.*, 
                u.nome_usuario AS autor, 
                sec.nome AS secao
            FROM subsecoes s
            INNER JOIN usuarios u ON s.id_autor = u.id
            INNER JOIN secoes sec ON s.id_secao = sec.id
            WHERE s.id_secao = :id_secao
            ORDER BY s.data_publicacao DESC
        ');

        $stmt->bindValue(':id_secao', $id_secao, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function excluir($id)
    {
        $stmt = $this->conexao->prepare("DELETE FROM subsecoes WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
