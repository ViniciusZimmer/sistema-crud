<?php  

require __DIR__. '/vendor/autoload.php';

define ('TITLE','Excluir Cadastro');

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

	if(isset($_POST['excluir']))

		{	
			$obCadastro->excluir();

			header('location: index.php?status=sucess');
    		exit;
		}

include __DIR__. '/Includes/header.php';
include __DIR__. '/Includes/confirmar-exclusao.php';
include __DIR__. '/Includes/footer.php';
?>