var mediaSource = new MediaSource();
mediaSource.addEventListener('sourceopen', handleSourceOpen, false);
var mediaRecorder;
var recordedBlobs;
var sourceBuffer;

var gumVideo = document.querySelector('video#gum');
var recordedVideo = document.querySelector('video#recorded');

var recordButton = document.querySelector('button#record');
var playButton = document.querySelector('button#play');
var downloadButton = document.querySelector('button#download');

recordButton.onclick = toggleRecording;
playButton.onclick = play;
downloadButton.onclick = download;

// window.isSecureContext could be used for Chrome
var isSecureOrigin = location.protocol === 'https:' ||
    location.hostname === 'localhost';
if (!isSecureOrigin) {
    alert('getUserMedia() must be run from a secure origin: HTTPS or localhost.' +
        '\n\nChanging protocol to HTTPS');
    location.protocol = 'HTTPS';
}

var constraints = {
    audio: true,
    video: true
};

function handleSuccess(stream) {
    recordButton.disabled = false;
    console.log('getUserMedia() got stream: ', stream);
    window.stream = stream;
    gumVideo.srcObject = stream;
}

function handleError(error) {
    console.log('navigator.getUserMedia error: ', error);
}

navigator.mediaDevices.getUserMedia(constraints).
then(handleSuccess).catch(handleError);

function handleSourceOpen(event) {
    console.log('MediaSource opened');
    sourceBuffer = mediaSource.addSourceBuffer('video/webm; codecs="vp8"');
    console.log('Source buffer: ', sourceBuffer);
}

recordedVideo.addEventListener('error', function(ev) {
    console.error('MediaRecording.recordedMedia.error()');
    alert('Your browser can not play\n\n' + recordedVideo.src
        + '\n\n media clip. event: ' + JSON.stringify(ev));
}, true);

function handleDataAvailable(event) {
    if (event.data && event.data.size > 0) {
        recordedBlobs.push(event.data);
    }
}

function handleStop(event) {
    console.log('Recorder stopped: ', event);
}

function toggleRecording() {
    if (recordButton.textContent === 'Gravar') { //Start Recording
        startRecording();
    } else {
        stopRecording();
        recordButton.textContent = 'Gravar'; //Start Recording
        playButton.disabled = false;
        downloadButton.disabled = false;
    }
}

function startRecording() {
    recordedBlobs = [];
    var options = {mimeType: 'video/webm;codecs=vp9'};
    if (!MediaRecorder.isTypeSupported(options.mimeType)) {
        console.log(options.mimeType + ' is not Supported');
        options = {mimeType: 'video/webm;codecs=vp8'};
        if (!MediaRecorder.isTypeSupported(options.mimeType)) {
            console.log(options.mimeType + ' is not Supported');
            options = {mimeType: 'video/webm'};
            if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                console.log(options.mimeType + ' is not Supported');
                options = {mimeType: ''};
            }
        }
    }
    try {
        mediaRecorder = new MediaRecorder(window.stream, options);
    } catch (e) {
        console.error('Exception while creating MediaRecorder: ' + e);
        alert('Exception while creating MediaRecorder: '
            + e + '. mimeType: ' + options.mimeType);
        return;
    }
    console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
    recordButton.textContent = 'Parar'; //Stop recording
    playButton.disabled = true;
    downloadButton.disabled = true;
    mediaRecorder.onstop = handleStop;
    mediaRecorder.ondataavailable = handleDataAvailable;
    mediaRecorder.start(10); // collect 10ms of data
    console.log('MediaRecorder started', mediaRecorder);
}

function stopRecording() {
    mediaRecorder.stop();
    console.log('Recorded Blobs: ', recordedBlobs);
    recordedVideo.controls = true;
}

//O usuário inicializa na tela o vídeo que ele gravou
function play() {
    let blob = new Blob(recordedBlobs, { 'type' : 'video/mp4;'});//Cria uma váriavel do tipo blob para armazenar o vídeo gravado
    let videoURL = window.URL.createObjectURL(blob); //Cria uma url com o vídeo gravado
    recordedVideo.src = videoURL; //Coloca na tela de reprodução a url do vídeo gravado pelo usuário
}

//Função que faz o download do vídeo para o servidor
function upload() {
    var blob = new Blob(recordedBlobs, {type: 'video/webm'}); //Cria uma váriavel do tipo blob para armazenar o vídeo gravado
    form = new FormData(), //Cria um form para armazenar o vídeo
    request = new XMLHttpRequest(); //Cria uma requisição
    form.append("blob",blob,"video.webm"); //Armazena o vídeo no form
    
    return $.ajax({
        url: '/upload.php',
        data: form,
        processData: false,
        contentType: false,
        type: 'POST',
    });
}