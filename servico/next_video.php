<?php
	header("Content-Type:text/json");
	
	require_once "../modelo/Usuario.php";
	require_once "../modelo/Video.php";
	require_once "../db/db_connect.php";
	
	session_start();
	
	$video = new Video;
	$video->conn = $conn;
	
	$resultado = new Video;
	
	if (isset($_SESSION['video_id'])) {
		$resultado = $video->buscar($_SESSION['video_id']);
	} else {
		$usuario = new Usuario;
		$usuario->conn = $conn;
		$usuario = $usuario->buscar($_SESSION['cpf']);
	
		$resultado = $video->video_atual($usuario);
		$resultado->conn = null;

		$_SESSION["video_id"] = $resultado->id;
		$_SESSION["num_video"] = $resultado->num_video;
	}
	
	echo json_encode($resultado, JSON_PRETTY_PRINT);