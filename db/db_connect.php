<?php

// Conexão com banco de dados
$servername = "localhost";
$username = "sudo";
$password = "#NeoLords2";
$dbname = "dataset";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_error()) {
	echo "Connection failed: " . mysqli_connect_error();
}

/*
$dbcon = "host=localhost port=5432 dbname=dataset user=postgres password=victor123";
if(!$conn = pg_connect($dbcon)) die ("Erro ao conectar ao banco<br>".pg_last_error($conn));

//Aqui criamos a conexão utilizando o servidor, usuario e senha, caso dê erro, retorna um erro ao usuário.
//$conexao = pg_connect($servidor, $usuario, $senha) or die ("Não foi possível conectar ao servidor PostGreSQL");
//caso a conexão seja efetuada com sucesso, exibe uma mensagem ao usuário
 */

?>
