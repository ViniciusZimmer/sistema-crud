<?php  

require __DIR__. '/vendor/autoload.php';

define ('TITLE','Editar Cadastro');

use \App\Entity\Cadastro;

if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
	header('location: index.php?status=error');
	exit;
}

$obCadastro = Cadastro::getCadastroEditar($_GET['id']);

if(!$obCadastro instanceof Cadastro){
	header('location: index.php?status=error');
	exit;
}
		
	if(isset($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['cidade'],$_POST['estado'],$_POST['data_nascimento']))

		{
			$obCadastro->nome 				= $_POST['nome'];
			$obCadastro->email 				= $_POST['email'];
			$obCadastro->telefone 			= $_POST['telefone'];
			$obCadastro->cidade 			= $_POST['cidade'];
			$obCadastro->estado 			= $_POST['estado'];
			$obCadastro->data_nascimento 	= $_POST['data_nascimento'];
			$obCadastro->atualizar();

			echo "<script>window.location.href='index.php?status=success';</script>";
    		exit;
		}

include __DIR__. '/Includes/header.php';
include __DIR__. '/Includes/formulario.php';
include __DIR__. '/Includes/footer.php';
?>

