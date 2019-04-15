<?php
    session_start();
    require_once './db/db_connect.php';
    require_once './modelo/Usuario.php';
    require_once './modelo/Video.php';

    if (!isset($_SESSION['cpf'])) {
    	header('Location: ../login/login.php?erro=1');
    }

    header("Access-Control-Allow-Origim: *");
    $cpf = $_SESSION['cpf'];
    $modulo = $_SESSION['modulo'];
    $video = $_SESSION['num_video'];
    $video_id = $_SESSION['video_id'];

    unset($_SESSION['num_video']);
    unset($_SESSION['video_id']);

    $usuario = new Usuario;
    $usuario->conn = $conn;
    $usuario = $usuario->buscar($cpf);

    $caminho = "videos/" . $cpf . "_" . $modulo . "_" . $video . ".webm";
    $status = Video::ENVIO_STATUS_CONCLUIDO;
    file_put_contents($caminho, file_get_contents($_FILES['blob']['tmp_name']));
    $sql = "UPDATE dataset.tb_envio
            SET caminho_envio = '$caminho',
                status = $status
            WHERE id_usuario = {$usuario->id} AND id_video = {$video_id}";
    mysqli_query($conn, $sql);
?>
