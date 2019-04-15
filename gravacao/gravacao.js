$(function() {

    let next = function next() {
        upload()
            .done(carregarVideo)
            .done(atualizarContador);
    };

    let carregarVideo = function carregarVideo() {
        return $.ajax("/servico/next_video.php")
            .done(function(data) {
                $("#video_modelo")[0].src = data.caminho_video;
                $("#legenda")[0].src = data.caminho_legenda;
                $("#video_modelo")[0].textTracks[0].mode = 'showing';
                $("#video_modelo")[0].load();
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error loading ajax", textStatus, errorThrown);
            });
    };

    let atualizarContador = function atualizarContador() {
        return $.ajax("/servico/qtd_videos_enviados.php")
            .done(function(data) {
                $("#contador").html(data);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error loading ajax", textStatus, errorThrown);
            });
    };

    (function init() {
        $("#btn_enviar").click(next);

        //carregarVideo();

    })();
});