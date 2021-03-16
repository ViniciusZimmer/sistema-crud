<?php  

require __DIR__. '/vendor/autoload.php';

use \App\Entity\Cadastro;

$cadastros = Cadastro::getCadastro();

include __DIR__. '/Includes/header.php';
include __DIR__. '/Includes/listagem.php';
include __DIR__. '/Includes/footer.php';
?>