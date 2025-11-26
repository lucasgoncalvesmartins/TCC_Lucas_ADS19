<?php
/// Modelo de Usuário
class UsuarioModel {
    private $id;
    private $nome_usuario;
    private $email;
    private $senha;
    private $tipo;
   

    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
            	if(isset($valor) && property_exists(get_class($this), $atributo)){
                	$this->$atributo = $valor;                	
                }
            }
        }
    }

    function atualizar($atributos) {
    	foreach ($atributos as $atributo => $valor) {
    		if(isset($valor) && property_exists(get_class($this), $atributo)){            	
            	$this->$atributo = $valor;
            }
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome_usuario;
    }

    public function setNome($nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

        public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

        public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

  


    public function __toString(){
    	return "<br>ID: ".$this->id.
        "<br>Nome: ".$this->nome_usuario.
        "<br>Email: ".$this->email.
        "<br>Senha: ".$this->senha.
        "<br>Tipo: ".$this->tipo.
        "<br><br>";
    }
}