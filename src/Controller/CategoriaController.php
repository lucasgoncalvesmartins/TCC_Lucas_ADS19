<?php
include_once __DIR__ . '/CategoriaDAO.php';

$classe = new CategoriaDAO();

if (isset($_GET['function'])) {
	$metodo = $_GET['function'];
	if(method_exists($classe, $metodo)){
		$classe->$metodo();
	}else{
		die("Método $metodo não existe.");
	}
}