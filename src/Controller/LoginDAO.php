<?php
include_once __DIR__ . '/../Conexao/Conexao.php';
include_once __DIR__ . '/../Model/LoginModel.php';


class LoginDAO
{
	private $conexao;

	public function __construct()
	{
		$this->conexao = Conexao::getConexao();
	}

	public function login()
	{
		$login = new LoginModel($_POST);
		$stmt = $this->conexao->prepare("SELECT * FROM usuarios WHERE email = :email");
		$stmt->bindValue(":email", $login->getEmail());
		$stmt->execute();

		$linha = $stmt->fetch();

		if ($linha != null) {
			if ($linha['senha'] == $login->getSenha()) {
				$login->atualizar($linha);
				session_start();
				session_regenerate_id();

				$sessaoID = session_id();

				$stmt = $this->conexao->prepare("UPDATE usuarios SET sessaoID = :sessaoID WHERE id = :id");
				$stmt->bindValue(":sessaoID", $sessaoID);
				$stmt->bindValue(":id", $login->getId());
				$stmt->execute();

				
				$_SESSION['id'] = $linha['id'];
				$_SESSION['sessaoID'] = $sessaoID;
				$_SESSION['tipo'] = $linha['tipo']; 

				header('Location: ./../View/Home.php');
				exit;
			} else {
			echo "erro";
			}
		} else {
		echo "erro AQUI";
		}
	}

	public function checkLogin()
	{
		session_start();
		$stmt = $this->conexao->prepare("SELECT sessaoID FROM usuarios WHERE id = :id");
		$stmt->bindValue(":id", $_SESSION['id']);
		$stmt->execute();
		$linha = $stmt->fetch();
		if ($linha != null) {
			if ($_SESSION['sessaoID'] != $linha['sessaoID']) {
				$data['saida'] = 'logout';
			} else {
				$data['saida'] = 'login';
			}
			echo json_encode($data);
		}
	}
}
