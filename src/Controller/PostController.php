<?php
include_once __DIR__ . '/PostDAO.php';

$classe = new PostDAO();

if (isset($_GET['function'])) {
	$metodo = $_GET['function'];
	if(method_exists($classe, $metodo)){
		$classe->$metodo();
	}else{
		die("Método $metodo não existe.");
	}
}