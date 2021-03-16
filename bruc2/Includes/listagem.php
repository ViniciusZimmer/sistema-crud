<?php

  $mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success':
        $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        break;

      case 'error':
        $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
        break;
    }
  }

  $resultados = '';
  foreach($cadastros as $cadastro){
    $resultados .= '<tr>
                            	<td>'.$cadastro->id.'</td>
                            	<td>'.$cadastro->nome.'</td>
                            	<td>'.$cadastro->email.'</td>
                            	<td>'.$cadastro->telefone.'</td>
                           		<td>'.$cadastro->cidade.'</td>
                            	<td>'.$cadastro->estado.'</td>
                            	<td>'.$cadastro->data_nascimento.'</td>
                            	<td>
                                    <a href="editar.php?id='.$cadastro->id.'">
                                    <button type="button" class="btn btn-primary">Editar</button>
                            	</a>
                                    <a href="excluir.php?id='.$cadastro->id.'">
                                  	<button type="button" class="btn btn-danger">Excluir</button>
                            	</a>
                              </td>
                        </tr>';
  }

  $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td    colspan="8" class="text-center">
                                                              Nenhum cadastro encontrado
                                                       </td>
                                                    </tr>';
?>

<main>

<?=$mensagem?>

	<section>
		<a href="cadastrar.php">
			<button class="btn btn-success btn-lg">Iniciar</button>  
		</a>
	</section>

	<section>
		<table class="table table-striped table-dark" bg-light mt-4>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Telefone</th>
					<th>Cidade</th>
					<th>Estado</th>
					<th>Data de Nascimento</th>
					<th></th>
				</tr>	
			</thead>
			<tbody>
 				<?=$resultados?>
			</tbody>
		</table>
	</section>

</main>