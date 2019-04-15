<?php
header("Content-Type:text/plain");
	
require_once "../modelo/Usuario.php";
require_once "../modelo/Video.php";
require_once "../db/db_connect.php";

session_start();

$video = new Video;
$video->conn = $conn;

$usuario = new Usuario;
$usuario->conn = $conn;
$usuario = $usuario->buscar($_SESSION['cpf']);

$resultado = $video->contarVideosFeitos($usuario->id);

echo $resultado;
?>