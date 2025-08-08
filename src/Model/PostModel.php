<?php


class PostModel
{
    private $id;
    private $titulo;
    private $conteudo;
    private $id_autor;
    private $id_categoria;
    private $data_publicacao;

    public function __construct()
    {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor) && property_exists(get_class($this), $atributo)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }


    function atualizar($atributos)
    {
        foreach ($atributos as $atributo => $valor) {
            if (isset($valor) && property_exists(get_class($this), $atributo)) {
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

    public function getId_Categoria()
    {
        return $this->id_categoria;
    }

    public function setId_Categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

        public function getData_publicacao() {
        return $this->data_publicacao;
    }

    public function setData_publicacao($data_publicacao) {
        $this->data_publicacao = $data_publicacao;
    }
}
