<?php
	$listaEstado = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];
?>		

<main>
	<section>
		<a href="index.php">
			<button class="btn btn-danger">Voltar</button>
		</a>
	</section>

	<h2 class="mt-4"><?=TITLE?></h2>

	<form method="post" name="frm">
		
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" class="form-control" name="nome" value="<?=$obCadastro->nome?>" placeholder="Nome completo" id="nome"  required>
		</div><br>

		<div class="form-group">
			<label>E-mail:</label>
			<input type="text" class="form-control" name="email" value="<?=$obCadastro->email?>" placeholder="Ex: info@bruc.com.br" id="email" required>
		</div><br>

		<div class="form-group">
			<label>Telefone:</label>
			<input type="text" class="form-control" name="telefone" value="<?=$obCadastro->telefone?>" placeholder="Ex: 41 9 9999-9999" id="phone" required>
		</div><br>

		<div class="form-group">
			<label>Estado:</label>
			<select class="form-control" name="estado">
				<?php  
					$cont = 0;
					foreach ($listaEstado as $sigla => $estado) 
					{
						if ($cont == 0 && isset($obCadastro->estado)) {
							echo "<option value=".$obCadastro->estado.">".$listaEstado[$obCadastro->estado]."</option>";}
						else{
							echo "<option value='".$sigla."'>".$estado."</option>";}	
						$cont++;
					} 
				?>
			</select>
		</div><br>

		<div class="form-group">
			<label>Cidade:</label>
			<input type="text" class="form-control" name="cidade" value="<?=$obCadastro->cidade?>" id="cidade" required>
		</div><br>

		<div class="form-group">
			<label>Data de Nascimento:</label>
			<input type="date" class="form-control" name="data_nascimento" value="<?=$obCadastro->data_nascimento?>" id="data_nascimento" required>
		</div><br>

		<div class="form-group" >
			<button type="submit" onclick="return IsEmpty();" class="btn btn-success">Enviar</button>
		</div>
	</form>
</main>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.4/jquery.inputmask.min.js"></script>

<script>
	$(document).ready(function(){

		var selector = document.getElementById('phone');

	  	$(selector).inputmask("+55 (99) 9 9999-9999", {"placeholder": ""});
	  	$("#email").inputmask("email", { onUnMask: function(maskedValue, unmaskedValue) {
		    return unmaskedValue;
		}});
	});

    function IsEmpty() {
	  
    	var nome = document.getElementById('nome').value;
		var email = document.getElementById('email').value;
		var phone = document.getElementById('phone').value;
		var cidade = document.getElementById('cidade').value;
		var estado = document.getElementById('estado').value;
		var data_nascimento = document.getElementById('data_nascimento').value;
		var phoneReplace = phone.replace(/[^\w\s]/gi, '');

		if ( (nome == "") || (email == "") || (phone == "") || (cidade == "") || (estado == "") || (data_nascimento == "") || (phoneReplace.length != 16) ) {
			alert('Preencha todos os campos!');
		}
	}
</script>