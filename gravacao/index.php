<?php
// Conexão
require_once '../db/db_connect.php';
require_once '../modelo/Usuario.php';
require_once '../modelo/Video.php';
require_once '../modelo/Modulo.php';

// Sessão
session_start();
$usuario = new Usuario;
$usuario->conn = $conn;
$usuario = $usuario->buscar($_SESSION['cpf']);

$modulo = new Modulo;
$modulo->conn = $conn;
$modulo = $modulo->modulo_atual($usuario);

$_SESSION["modulo"] = $modulo->id;

$video = new Video;
$video->conn = $conn;
$video_atual = $video->video_atual($usuario);

$_SESSION["video_id"] = $video_atual->id;
$_SESSION["num_video"] = $video_atual->num_video;

$total = $video->contarVideos();
$totalFeito = $video->contarVideosFeitos($usuario->id);
?>
<!doctype html>
<html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="mobile-web-app-capable" content="yes" />

        <base target="_blank" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.css" />
        <link rel="stylesheet" href="../css/estilos.css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />

        <title>LabVirtual - ILEEL</title>
        <script>
            function funcaoSair(){
                alert("Parabéns pela sua participação.\nAgradecemos muitíssimo pela sua contribuição.\nEquipe ELLA.");
            }
        </script>
    </head>

    <body>

        <div class="container-fluid">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary" class="card-panel teal lighten-2">

                <a class="navbar-brand" href="login.html">LabVirtual - ILEEL</a>
                <span class="navbar-brand" id="video_name"></span>
                <div class="collapse navbar-collapse" id="navbarSite">

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="../contato" target="_self">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../sair/sair.php" target="_self" onclick="funcaoSair()">Sair</a>
                        </li>

                    </ul>

                </div>

            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div>
                        <div id="lbl_video">

                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <div style="font-size: small;">
                            Atenção: Este site tem um total de <?php echo $total; ?> dados para coleta.
                            Não é obrigatório coletar todos eles, mas quanto mais itens puder coletar, mais você nos ajuda!
                            Você pode acompanhar quantos dados, deste total, já coletou, com o contador abaixo:
                        </div>
                        <div class=borda>
                            Total: <?php echo $total; ?>
                            <br />
                            Enviados: <span id="contador"> <?php echo $totalFeito; ?> </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <video id="video_modelo" width="426" height="290" src="<?php echo $video_atual->caminho_video; ?>" controls >
                            <track id="legenda" label="English" kind="subtitles" src="<?php echo $video_atual->caminho_legenda; ?>" srclang="en" default>
                        </video>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <video id="video_tutorial" width="255" height="144" src='../../grupos/tutorial/tutorial.mp4' controls ></video>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4"></div>
                    <div class="col-md-5 align-self-center">
                        <video id="gum" width="426" height="240" autoplay muted></video>
                    </div>
                    <div class="col-md-3">
                        <video id="recorded" width="255" height="144" controls></video>
                        <div class="btn-group btn-group-justified d-flex">
                            <button id="play" class="btn btn-primary" type="button">Checar Gravação</button>
                            <button id="btn_enviar" class="btn btn-primary ml-auto" type="button">Enviar</button>
                        </div>
                        <button id="download" class="btn btn-outline-primary" type="submit" disabled>
                            <script type="text/javascript">
                                document.getElementById("download").style.visibility = "hidden"; 
                            </script>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-4">
                        <button id="record"class="record-button" type="submit">Gravar</button>
                    </div>
                </div>

            </div>


            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="../js/jquery.min.js"></script>
            <script src="../js/node_modules/popper.js/dist/popper.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/main2.js"></script>
            <script src="../js/auxiliar.js"></script>
            <script src="./gravacao.js"></script>


        </div>
    </body>
</html>
