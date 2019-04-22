<?php

	// Conexão
	require_once '../db/db_connect.php';
	require_once '../modelo/Usuario.php';

	// Sessão
	session_start();

	if (isset($_POST['btn'])) {

		$erros = array();
		$usr = new Usuario;

		$usr->nome = mysqli_escape_string($conn, $_POST['nome']);
		// $usr->sobrenome = mysqli_escape_string($conn, $_POST['sobrenome']);
		if(($_POST['cpf']) != ""? $cpf = $_POST['cpf'] : $cpf = $_POST['ID']);
		$usr->cpf = $cpf; 
		$usr->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
		$usr->email = mysqli_escape_string($conn, $_POST['email1']);
		$usr->dt_nascimento = mysqli_escape_string($conn, $_POST['nascimento']);
		if (mysqli_escape_string($conn, $_POST['sexo']) == 'Masculino') {
			$usr->sexo = 'Masculino';
		} else {
			if (mysqli_escape_string($conn, $_POST['sexo']) == 'Feminino') {
				$usr->sexo = 'Feminino';
			} else {
				$usr->sexo = mysqli_escape_string($conn, $_POST['outro']);
			}
		}

		$usr->nacionalidade = mysqli_escape_string($conn, $_POST['nacionalidade']);
		$usr->cidade = mysqli_escape_string($conn, $_POST['cidade']);
		$usr->estado = mysqli_escape_string($conn, $_POST['uf']);
		if(($_POST['cpf']) == ""? $estrangeiro = 1 : $estrangeiro = 0);
		$usr->estrangeiro = $estrangeiro;

		$atual = date('Y/m/d'); //Recebe a data atual
    	$data1 = explode("/","$atual"); //Divide a data atual em dia, mês e ano
		$dAtual = $data1[2];
		$mAtual = $data1[1];
    	$yAtual = $data1[0];
    
    	$data2 = explode("-","$usr->dt_nascimento"); //Divide a data de nascimento em dia, mês e ano
		$dNascimento = $data2[2];
		$mNascimento = $data2[1];
		$yNascimento = $data2[0];

    	$idade = $yAtual - $yNascimento - 1; //Calcula a idade, subtraindo o ano atual do ano de nascimento da pessoa
    	//Subtrai um da idade, pois esse será recebido apenas se a pessoa já fez seu aniversário esse ano

    	if($mAtual > $mNascimento){ //Verifica se já passou o dia do aniversário
        	$idade = $idade + 1;
    	}
    	else{
        	if($mAtual == $mNascimento && $dAtual >= $dNascimento){ //Verifica se está no mês do aniversário, e se estiver verifica se já passou o dia
           			$idade = $idade + 1;
        	}
    	}
    	//verificar se o cpf ja existe
    	$sql1 = " select * from dataset.tb_usuario where cpf = '$cpf' ";
    	$resultado = mysqli_query($conn, $sql1);
    	if(mysqli_num_rows($resultado) > 0){
    	   echo ' CPF já cadastrado, por favor acesse sua conta ou recupere sua senha!';
    	}
    	else{
    	    //verificar se o e-mail ja existe
    		$sql1 = " select * from dataset.tb_usuario where email = '$usr->email' ";
    		$resultado = mysqli_query($conn, $sql1);
			if(mysqli_num_rows($resultado) > 0){
				echo 'Esse Email já está em uso, por favor utilize outro!';
			}
			else{
				if($idade < 18){
					echo 'Idade insuficiente!';
				}
				else{
					$usr->conn = $conn;
					$res = $usr->save();
					if (gettype($res) == 'string') {
						echo $res;
					} else if ($res) {
						$_SESSION['cpf'] = $_POST['cpf'];
						$_SESSION['senha'] = $_POST['senha'];
						header('Location: ../gravacao/');
					} else {
						echo "Erro: Por favor, insira novamente os dados cadastrais! Caso o erro persista contate o ILEEL.";
					}
				}
			}
		} 
	}
?>
