<?php  

require __DIR__. '/vendor/autoload.php';

define ('TITLE','Cadastrar');

use \App\Entity\Cadastro;
$obCadastro 					= new Cadastro;		
	if(isset($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['cidade'],$_POST['estado'],$_POST['data_nascimento']))

		{
			$obCadastro->nome 				= $_POST['nome'];
			$obCadastro->email 				= $_POST['email'];
			$obCadastro->telefone 			= $_POST['telefone'];
			$obCadastro->cidade 			= $_POST['cidade'];
			$obCadastro->estado 			= $_POST['estado'];
			$obCadastro->data_nascimento 	= $_POST['data_nascimento'];
			$obCadastro->cadastrar();

			echo "<script>window.location.href='index.php?status=success';</script>";
    		exit;
		}


	if (isset($_GET['invalid'])) {
		echo "<script>alert('Preencha todos os campos!')</script>";
	}

include __DIR__. '/Includes/header.php';
include __DIR__. '/Includes/formulario.php';
include __DIR__. '/Includes/footer.php';
?>