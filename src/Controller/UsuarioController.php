<?php

include_once 'UsuarioDAO.php';

$classe = new UsuarioDAO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    if(method_exists($classe, $metodo)){
    	$classe->$metodo();
    }else{
    	die("Método $metodo não existe.");
    }
}