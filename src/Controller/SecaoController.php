<?php
include_once __DIR__ . '/SecaoDAO.php';

$classe = new SecaoDAO();

if (isset($_GET['function'])) {
	$metodo = $_GET['function'];
	if(method_exists($classe, $metodo)){
		$classe->$metodo();
	}else{
		die("Método $metodo não existe.");
	}
}