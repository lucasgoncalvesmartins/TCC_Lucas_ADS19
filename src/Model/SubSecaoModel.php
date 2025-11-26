<?php
/// Modelo de SubSeção
class SubSecaoModel
{
    private $id;             
    private $titulo;
    private $conteudo;
    private $id_autor;       
    private $id_secao;       
    private $data_publicacao;

    public function __construct($data = [])
    {
        $this->titulo = $data['titulo'] ?? '';
        $this->conteudo = $data['conteudo'] ?? '';
        $this->id_secao = $data['id_secao'] ?? null; 
        // n esquecer q id_autor ta sendo setado manualmente pelo DAO
    }

    public function atualizar($atributos)
    {
        foreach ($atributos as $atributo => $valor) {
            if (isset($valor) && property_exists($this, $atributo)) {
                $this->$atributo = $valor;
            }
        }
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getConteudo()
    {
        return $this->conteudo;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function getId_Autor()
    {
        return $this->id_autor;
    }

    public function setId_Autor($id_autor)
    {
        $this->id_autor = $id_autor;
    }

    public function getId_Secao()
    {
        return $this->id_secao;
    }

    public function setId_Secao($id_secao)
    {
        $this->id_secao = $id_secao;
    }

    public function getData_publicacao()
    {
        return $this->data_publicacao;
    }

    public function setData_publicacao($data_publicacao)
    {
        $this->data_publicacao = $data_publicacao;
    }
}
