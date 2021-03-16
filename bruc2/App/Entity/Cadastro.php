<?php
	
	namespace App\Entity;

	require_once('phpMailer/PHPMailer.php');
	require_once('phpMailer/SMTP.php');
	require_once('phpMailer/Exception.php');

	use \App\Db\Database;
	use \PDO;

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	Class Cadastro
	{

		/**
	   	* @var string
	   	*/
	  	public $nome;

		/**
	   	* @var string
	   	*/
	  	public $email;

		/**
	   	* @var string
	   	*/
	  	public $telefone;

		/**
	   	* @var string
	   	*/
	  	public $cidade;

		/**
	   	* @var string
	   	*/
	  	public $estado;

		/**
	   	* @var string
	   	*/
	  	public $data_nascimento;

	  	public function enviarEmail($aux, $emailArray)
	  	{
	  		
	  		if ($aux == 'create') {
	  			$subject = 'Usuario Cadastrado';
	  		}
	  		if ($aux == 'update') {
	  			$subject = 'Usuario Atualizado';
	  		}

	  		$htmlBody = '<h1>'.$subject.'</h1><p>Nome: '.$emailArray['nome'].'</p><p>Email: '.$emailArray['email'].'</p><p>Telefone: '.$emailArray['telefone'].'</p><p>Cidade: '.$emailArray['cidade'].'</p><p>Estado: '.$emailArray['estado'].'</p><p>Data de Nascimento: '.$emailArray['data_nascimento'].'</p>';

	  		$mail = new PHPMailer(true);

			try{
			    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
			    $mail->isSMTP();
			    $mail->Host = 'smtp.live.com';
			    $mail->SMTPSecure = 'tls';
			    $mail->SMTPAuth = true;
			    $mail->Username = '';
			    $mail->Password = '';
			    $mail->Port = 587;

			    $mail->setFrom('');
			    $mail->addAddress('');

			    $mail->isHTML(true);
			    $mail->Subject = $subject;
			    $mail->Body = $htmlBody;
			    $mail->AltBody = "Email enviado";

			    if ($mail->send()) {
			        echo "Email enviado";
			    }else{
			        echo "Email não enviado";
			    }

			}catch(Exception $e){
			    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
			}
	  	}

		/**
	   	* @return boolean
	   	*/
	  	public function cadastrar()
	  		{
	  			if (($this->nome == "") || ($this->email == "") || ($this->telefone == "") || ($this->cidade == "") || ($this->estado == "") || ($this->data_nascimento == "")) {
	  				header("Location: ".$_SERVER["REQUEST_URI"]."?invalid=1");
	  			}

	  			$obDatabase = new Database('cadastros');
				$this->id = $obDatabase->insert
		  			([
		  				'nome' 				=> $this->nome,
		  				'email'				=> $this->email,
		  				'telefone' 			=> $this->telefone,
		  				'cidade' 			=> $this->cidade,
		  				'estado' 			=> $this->estado,
		  				'data_nascimento' 	=> $this->data_nascimento
		  			]);

		  		$emailArray = [
		  			'nome' => $this->nome,
		  			'email' => $this->email,
					'telefone' => $this->telefone,
					'cidade' => $this->cidade,
					'estado' => $this->estado,
					'data_nascimento' => $this->data_nascimento,
		  		];

		  		$this->enviarEmail('create', $emailArray);

		  		return true;
	  		}

	  		/**
	   		* @param string $where
	   		* @param string $order
	   		* @param string $limit
	   		* @return array
	   		*/

  			public static function getCadastro($where = null, $order = 'nome ASC', $limit = null){
    			return (new Database('cadastros'))	->select($where,$order,$limit)
                                  				->fetchAll(PDO::FETCH_CLASS,self::class);
	  		}
	  		/**
	  		* @param integer $id
	   		* @return Cadastro
			*/
			
	  		public static function getCadastroEditar($id){
	  			return (new Database('cadastros'))	->select('id = '.$id)
	  												->fetchObject(self::class);
	  		}

	  		/**
	   		* @return boolean
			*/
			public function atualizar(){

				$emailArray = [
		  			'nome' => $this->nome,
		  			'email' => $this->email,
					'telefone' => $this->telefone,
					'cidade' => $this->cidade,
					'estado' => $this->estado,
					'data_nascimento' => $this->data_nascimento,
		  		];

		  		$this->enviarEmail('update', $emailArray);

	  			return (new Database('cadastros'))	->update('id = '.$this->id, [
	  							  													'nome' 				=> $this->nome,
		  																			'email'				=> $this->email,
		  																			'telefone' 			=> $this->telefone,
		  																			'cidade' 			=> $this->cidade,
		  																			'estado' 			=> $this->estado,
		  																			'data_nascimento' 	=> $this->data_nascimento
																				]);
										}

		/**
   		* @return boolean
   		*/
  		public function excluir(){
    		return (new Database('cadastros'))->delete('id = '.$this->id);
  		}
  	}
?>