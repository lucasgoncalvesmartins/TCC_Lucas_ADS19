<?php
include_once  __DIR__ . '/../Model/PostModel.php';
include_once __DIR__ . '/../Conexao/Conexao.php';

class PostDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    public function cadastrar()
    {
        $post = new PostModel($_POST);

        $stmt = $this->conexao->prepare('
            INSERT INTO posts (titulo, conteudo, id_autor, id_categoria, data_publicacao)
            VALUES (:titulo, :conteudo, :id_autor, :id_categoria, :data_publicacao)
        ');

        $stmt->bindValue(":titulo", $post->getTitulo());
        $stmt->bindValue(":conteudo", $post->getConteudo());
        $stmt->bindValue(":id_autor", $post->getId_Autor());
        $stmt->bindValue(":id_categoria", $post->getId_Categoria());
        $stmt->bindValue(":data_publicacao", date('Y-m-d H:i:s'));

        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            echo "Erro ao cadastrar post";
        }
    }

    public function listarTodos()
    {
        $stmt = $this->conexao->prepare("
            SELECT 
                p.id,
                p.titulo,
                p.conteudo,
                u.nome_usuario AS autor,
                c.nome AS categoria,
                p.data_publicacao
            FROM posts p
            JOIN usuarios u ON p.id_autor = u.id
            JOIN categorias c ON p.id_categoria = c.id
            ORDER BY p.data_publicacao DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaAutor()
    {
        $stmt = $this->conexao->prepare("SELECT id, nome_usuario FROM usuarios WHERE tipo = 'autor'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaCategoria()
    {
        $stmt = $this->conexao->prepare("SELECT id, nome FROM categorias");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPostPorTitulo($titulo)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM posts WHERE titulo LIKE :titulo LIMIT 1");
        $stmt->bindValue(':titulo', "%$titulo%");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar()
    {
        $post = new PostModel($_POST);

        $stmt = $this->conexao->prepare('
            UPDATE posts
            SET titulo = :titulo,
                conteudo = :conteudo,
                id_categoria = :id_categoria,
                data_publicacao = :data_publicacao
            WHERE id = :id
        ');

        $stmt->bindValue(':titulo', $post->getTitulo());
        $stmt->bindValue(':conteudo', $post->getConteudo());
        $stmt->bindValue(':id_categoria', $post->getId_Categoria());
        $stmt->bindValue(':data_publicacao', date('Y-m-d H:i:s'));
        $stmt->bindValue(':id', $post->getId());

        if ($stmt->execute()) {
            header('Location: ./../View/home.php');
            exit();
        } else {
            echo "Erro ao editar post";
        }
    }

    public function buscarPorCategoria($id_categoria)
    {
        $stmt = $this->conexao->prepare('
            SELECT 
                p.*, 
                u.nome_usuario AS autor, 
                c.nome AS categoria
            FROM posts p
            INNER JOIN usuarios u ON p.id_autor = u.id
            INNER JOIN categorias c ON p.id_categoria = c.id
            WHERE p.id_categoria = :id_categoria
            ORDER BY p.data_publicacao DESC
        ');

        $stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id)
    {
        $stmt = $this->conexao->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
