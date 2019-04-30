<?php

    class Usuario {
    
        public $id;
        public $cpf;
        public $nome;
        public $sobrenome;
        public $senha;
        public $email;
        public $dt_nascimento;
        public $sexo;
        public $nacionalidade;
        public $cidade;
        public $estado;
        public $estrangeiro;
        public $video_atual;
    
        public $conn;
    
        public function save() {
            if($this->estrangeiro == 1){
                $chave = 'true';
            } else {
                $chave = 'false';
            }

            /*$sql = "INSERT INTO dataset.tb_usuario(nome, sobrenome, cpf, senha, email, dt_nascimento, sexo, nacionalidade, cidade, estado, estrangeiro)
                    VALUES('$this->nome','$this->sobrenome','$this->cpf','$this->senha','$this->email','$this->dt_nascimento','$this->sexo','$this->nacionalidade','$this->cidade','$this->estado', '$this->estrangeiro');";*/
            $sql = "INSERT INTO dataset.tb_usuario(nome, cpf, senha, email, dt_nascimento, sexo, nacionalidade, cidade, estado, estrangeiro)
                    VALUES('$this->nome','$this->cpf','$this->senha','$this->email','$this->dt_nascimento','$this->sexo','$this->nacionalidade','$this->cidade','$this->estado', $chave);";
            $resultado = mysqli_query($this->conn, $sql);
            return $resultado;
        }
    
        private function validar_usuario($usuario) {
            $sql = " select * from dataset.tb_usuario where cpf = '$usuario->cpf' ";
            $resultado = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                return ' CPF ou ID já cadastrado, por favor verifique seu acesso!';
            }
        
            $sql = " select * from dataset.tb_usuario where email = '$usuario->email' ";
            $resultado = mysqli_query($conn, $sql);
            if(mysqli_num_rows($resultado) > 0){
                    return ' e-mail já cadastrado, por favor verifique seu acesso!';
            }
        
            if($usuario->idade < 18){ //Verifica se o usuário tem 18 anos ou mais
                    return 'Sua idade é inadequada, é necessário ter 18 anos completos! Sinto muito!';
            }
        
            return true;
        }
    
        function validar_senha($cpf, $senha) {
            $sql = "SELECT senha FROM dataset.tb_usuario WHERE cpf = '$cpf'";
            $res = mysqli_query($this->conn, $sql);
        
            if (mysqli_num_rows($res) > 0) {
                $res->data_seek(0);
                $row = $res->fetch_assoc();
                if (password_verify($senha, $row['senha'])) {
                    return true;
                }
            }
            return false;
        }
    
        function buscar($cpf) {
            $sql = "SELECT id, cpf, nome, email, dt_nascimento, sexo, nacionalidade, cidade, estado, estrangeiro
                    FROM dataset.tb_usuario
                    WHERE cpf = '{$cpf}'";
            $res = mysqli_query($this->conn, $sql);
        
            $resultado = new Usuario;
        
            if (mysqli_num_rows($res) > 0) {
                $res->data_seek(0);
                if ($row = $res->fetch_assoc()) {
                    $resultado->id = $row['id'];
                    $resultado->cpf = $row['cpf'];
                    $resultado->nome = $row['nome'];
                    //$resultado->sobrenome = $row['sobrenome'];
                    $resultado->email = $row['email'];
                    $resultado->sexo = $row['sexo'];
                    $resultado->dt_nascimento = $row['dt_nascimento'];
                    $resultado->nacionalidade = $row['nacionalidade'];
                    $resultado->cidade = $row['cidade'];
                    $resultado->estado = $row['estado'];
                    $resultado->estrangeiro = $row['estrangeiro'];
                    $resultado->conn = $this->conn;
                }
            }
            return $resultado;
        }
        
$assunto = "Encaminhamento TCLE-ILEEL";
$mensagem = "PROPOSTA DE TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO – GRUPO A.

Você está sendo convidado(a) para participar da composição de um banco de dados de pronúncias em língua inglesa e de expressões faciais para pronúncia em língua inglesa. Esse banco de dados será utilizado para o funcionamento de um Laboratório Virtual para Aprendizagem de Língua Inglesa, sob a responsabilidade da Coordenadora, Profa. Dra. Simone Tiemi Hashiguti, e para futuras pesquisas sobre aprendizagem de língua inglesa como língua estrangeira e/ou inteligência artificial. O banco de dados ficará armazenado em um servidor próprio do projeto alocado no Instituto de Letras e Linguística – ILEEL/UFU. No laboratório, o banco funcionará como base para um sistema de Inteligência Artificial e esse sistema analisará as pronúncias e expressões faciais de pronúncia em língua inglesa do banco e construirá padrões de pronúncia e de expressões faciais que o possibilitarão analisar também as produções orais de usuários do Laboratório e dar-lhes retorno, de modo a auxiliar na correção e melhoria da pronúncia em língua inglesa. No caso de pesquisas, os dados do banco poderão ser utilizados por pesquisadores membros da equipe executora do projeto do Laboratório Virtual para Aprendizagem de Língua Inglesa somente se seus projetos de pesquisa forem submetidos ao Comitê de Ética e aprovados. Em ambos os casos, isto é, na utilização dos dados para o sistema de Inteligência Artificial ou para pesquisas, os dados – a saber, as pronúncias em LI e as imagens faciais – não serão expostos em nenhum momento. O Termo de Consentimento Livre e Esclarecido será obtido pela própria Coordenadora, Profa. Dra. Simone Tiemi Hashiguti. A obtenção será feita a partir do mês de março de 2018. Na sua participação, você gravará, em local de sua escolha, através de seu computador ou telefone celular, vídeos em que fala sons (fonemas), palavras, expressões e textos em língua inglesa. Esses conteúdos serão fornecidos pela equipe do projeto. Os vídeos serão utilizados exclusivamente para compor nosso banco de dados. Os vídeos não serão expostos no laboratório ou em publicações de pesquisas futuras em nenhum momento.

Cumpre salientar que todos os dados obtidos para este banco não serão utilizados de qualquer outra forma daquelas aqui elencadas, ou seja, todos os dados coletados não serão, sob hipótese alguma, divulgados e/ou comercializados e também só serão liberados para pesquisas futuras que sejam aprovadas pelo Comitê de Ética e que se comprometam a não divulgar, expor ou comercializar os dados ou a identificação dos participantes. Em nenhum momento você será identificado(a). Você não terá nenhum gasto e ganho financeiro por participar na composição deste banco de dados.

O único risco que você pode correr é o de ser identificado(a). No entanto, a Coordenadora, Profa. Dra. Simone Tiemi Hashiguti se compromete em proteger a identidade dos participantes. Os benefícios serão as próprias reflexões a serem feitas acerca das formas de falar inglês e sobre os processos de ensino/aprendizagem da língua estrangeira alvo e a melhoria da própria aprendizagem da língua, além disso, sua participação promoverá um benefício social, pois o Laboratório Virtual será disponibilizado e funcionará em cursos de LI a distância do Brasil. Você é livre para deixar de participar da composição deste banco de dados a qualquer momento sem nenhum prejuízo ou coação. Uma via deste Termo de Consentimento Livre e Esclarecido será encaminhada para o seu e-mail, assim que aceitá-lo. Qualquer dúvida a respeito da coleta de dados, você poderá entrar em contato com:

Simone Tiemi Hashiguti, professora do Instituto de Letras e Linguística da Universidade Federal de Uberlândia – Av. João Naves de Ávila, 2121, bloco U, Sala 1U233, Campus Santa Mônica, Uberlândia/MG, CEP: 38408-100 Fone profissional: (34) 3239-6206. Você poderá também entrar em contato com o CEP - Comitê de Ética na Pesquisa com Seres Humanos na Universidade Federal de Uberlândia, localizado na Av. João Naves de Ávila, no 2121, bloco A, sala 224, campus Santa Mônica – Uberlândia/MG, 38408-100; telefone: 34-3239-4131. O CEP é um colegiado independente criado para defender os interesses dos participantes das pesquisas em sua integridade e dignidade e para contribuir para o desenvolvimento da pesquisa dentro de padrões éticos conforme resoluções do Conselho Nacional de Saúde.";
require './PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = 'smtp@ufu.br';

$mail->SMTPAuth = true;

$mail->SMTPSecure = 'ssl';

$mail->USername = 'labvirtual@ileel.ufu.br';
$mail->Password = 'senhadoemail';
$mail->Port = 587;

$mail->setFrom($email); // destinatario
$mail->addAddress('labvirtual@ileel.ufu.br');  //remetente

$mail->isHTML(true);
$mail->Subject = utf8_decode($assunto);
$mail->Body = utf8_decode($mensagem);
$mail->AltBody = utf8_decode(strip_tags($mensagem));

/*if(!$mail->send()){
    echo ' Nao foi possivel enviar o email. <br>';
    echo 'Erro: '.$mail->ErrorInfo;
} else {
    echo 'Email enviado com sucesso!';
}*/

        }
