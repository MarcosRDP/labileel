<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Cadastro de usuário</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript">
      function disableOther() {
        document.getElementById("inputOther").style.visibility = "hidden";
        document.getElementById("inputOther").setAttribute("disabled","disabled");
      }
      function enableOther() {
        document.getElementById("inputOther").style.visibility = "visible";
        document.getElementById("inputOther").removeAttribute("disabled");
      }
      function enableRegister() {
        if(document.getElementById("gridCheck").checked == true){
          document.getElementById("register").removeAttribute("disabled");
        }
        else{
          document.getElementById("register").setAttribute("disabled","disabled");
        }
      }
	    function myFunction() {
        var checkBoxbr = document.getElementById("myCheckbr");
        var checkBoxother = document.getElementById("myCheckother");
        // var text = document.getElementById("text");
        if (checkBoxbr.checked == true && checkBoxother.checked == false){
          document.getElementById("testandobr").style.visibility = "visible";
          document.getElementById("testandoother").style.visibility = "hidden";

          document.getElementById("inputAddresscpf").required = true; 
          document.getElementById("inputAddressid").required = false; 
        } else {
          document.getElementById("testandobr").style.visibility = "hidden";
          document.getElementById("testandoother").style.visibility = "visible";

          document.getElementById("inputAddresscpf").required = false; 
          document.getElementById("inputAddressid").required = true; 
        }
      }
    </script>

    <style type="text/css">
      label.disabled {color: #888;}
      label {color: #000; cursor: pointer;}
      #termos{
      	width: 800px;
      	height: 400px;
      	padding: 10px 20px;
        text-align:  justify;
      	overflow: auto;
      	border: 2px solid aaa;
      }

      .recuo {
        text-indent:4em;
        color:black;
      }
    </style>
  </head>

  <body onload="myFunction()">
    <div class="container">
      <div class="header clearfix">

        <h3 class="text-muted">LabVirtual</h3>
        <h3 class="text-muted"></h3>
      </div>

        <! -- //Corpo do formulário -->
      <form action="send.php" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome</label>
            <input name="nome" required="required" type="text" class="form-control" id="nome" placeholder="Nome">
          </div>
          <!-- <div class="form-group col-md-6">
            <label for="inputPassword4">Sobrenome</label>
            <input name="sobrenome" required="required" type="text" class="form-control" id="inputPassword4" placeholder="Sobrenome">
          </div> -->
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="exampleRadios" id="myCheckbr" value="option1" onclick="myFunction()" checked>
          <label class="form-check-label" for="exampleRadios1">
            Brasileiro
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="exampleRadios" id="myCheckother" value="option1" onclick="myFunction()">

          <label class="form-check-label" for="exampleRadios1">
            Other Countries
          </label>
        </div>
        <div class="form-group col-md-3" id="testandobr">
          <input name="cpf" type="text" class="form-control" id="inputAddresscpf" pattern=".{11,11}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="CPF">
        </div>
        <div class="form-group col-md-3" id="testandoother">
          <input name="ID" type="text" class="form-control" id="inputAddressid" placeholder="ID">
        </div>

        <div class="form-row">
          <div class="form-row">
            <label class="form-group col-md-3" for="inlineFormInputName2">Senha</label>
            <input name="senha" type="password" required="required" class="form-control" id="senha" placeholder="Password">
            <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
            <div class="input-group mb-2 mr-sm-2">
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-inline">
            <label class="sr-only" for="inlineFormInputName2"></label>
            <input name="email1" required="required" type="email" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="email">
          </div>
        </div>

        <div class="form-group">
          <label for="inputAddress2">Data de Nascimento</label>
          <input name="nascimento" required="required" type="date" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>

        <div class="form-group col-md-4">
          <label for="inputState">Sexo</label>
          <select name="sexo" id="inputState" required="required" class="form-control">
            <option selected></option>
            <option name="Feminino" onclick="disableOther()">Feminino</option>
            <option name="Masculino" onclick="disableOther()">Masculino</option>
            <option name="Outro" onclick="enableOther()">Outro</option>
            <input name="outro" type="text" class="form-control" id="inputOther" placeholder="Sexo" disabled>
              <script type="text/javascript">
                disableOther();
              </script>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputCity">Nacionalidade</label>
              <input name="nacionalidade" required="required" type="text" class="form-control" id="inputCity">
            </div>

            <div class="form-group col-md-2">
              <label for="inputZip">Cidade</label>
              <input name="cidade" type="text" required="required" class="form-control" id="inputZip">
            </div>

            <div class="form-group col-md-2">
              <label for="inputZip">UF</label>
              <input name="uf" type="text" required="required" class="form-control" id="inputZip">
            </div>
          </div>

          <div id="termos"> <!--Inicializa os termos de uso-->
	          <h1 style="font-size:large;text-align: center;">PROPOSTA DE TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO – GRUPO A</h1>
            <br>
            <p class="recuo">Você está sendo convidado(a) para participar da composição de um banco de dados de
            pronúncias em língua inglesa e de expressões faciais para pronúncia em língua inglesa.
            Esse banco de dados será utilizado para o funcionamento de um Laboratório Virtual
            para Aprendizagem de Língua Inglesa, sob a responsabilidade da Coordenadora, Profa.
            Dra. Simone Tiemi Hashiguti, e para futuras pesquisas sobre aprendizagem de língua
            inglesa como língua estrangeira e/ou inteligência artificial. O banco de dados ficará
            armazenado em um servidor próprio do projeto alocado no Instituto de Letras e
            Linguística – ILEEL/UFU. No laboratório, o banco funcionará como base para um
            sistema de Inteligência Artificial e esse sistema analisará as pronúncias e expressões
            faciais de pronúncia em língua inglesa do banco e construirá padrões de pronúncia e de
            expressões faciais que o possibilitarão analisar também as produções orais de usuários
            do Laboratório e dar-lhes retorno, de modo a auxiliar na correção e melhoria da
            pronúncia em língua inglesa. No caso de pesquisas, os dados do banco poderão ser
            utilizados por pesquisadores membros da equipe executora do projeto do Laboratório
            Virtual para Aprendizagem de Língua Inglesa somente se seus projetos de pesquisa
            forem submetidos ao Comitê de Ética e aprovados. Em ambos os casos, isto é, na
            utilização dos dados para o sistema de Inteligência Artificial ou para pesquisas, os
            dados – a saber, as pronúncias em LI e as imagens faciais – não serão expostos em
            nenhum momento. O Termo de Consentimento Livre e Esclarecido será obtido pela
            própria Coordenadora, Profa. Dra. Simone Tiemi Hashiguti. A obtenção será feita a
            partir do mês de março de 2018. Na sua participação, você gravará, em local de sua
            escolha, através de seu computador ou telefone celular, vídeos em que fala sons
            (fonemas), palavras, expressões e textos em língua inglesa. Esses conteúdos serão
            fornecidos pela equipe do projeto. Os vídeos serão utilizados exclusivamente para
            compor nosso banco de dados. Os vídeos não serão expostos no laboratório ou em
            publicações de pesquisas futuras em nenhum momento.</p>
            <p class="recuo">Cumpre salientar que todos os dados obtidos para este banco não serão utilizados de
            qualquer outra forma daquelas aqui elencadas, ou seja, todos os dados coletados não
            serão, sob hipótese alguma, divulgados e/ou comercializados e também só serão
            liberados para pesquisas futuras que sejam aprovadas pelo Comitê de Ética e que se
            comprometam a não divulgar, expor ou comercializar os dados ou a identificação dos
            participantes. Em nenhum momento você será identificado(a). Você não terá nenhum
            gasto e ganho financeiro por participar na composição deste banco de dados.</p>
            <p class="recuo">O único risco que você pode correr é o de ser identificado(a). No entanto, a
            Coordenadora, Profa. Dra. Simone Tiemi Hashiguti se compromete em proteger a
            identidade dos participantes. Os benefícios serão as próprias reflexões a serem feitas
            acerca das formas de falar inglês e sobre os processos de ensino/aprendizagem da língua
            estrangeira alvo e a melhoria da própria aprendizagem da língua, além disso, sua
            participação promoverá um benefício social, pois o Laboratório Virtual será
            disponibilizado e funcionará em cursos de LI a distância do Brasil. Você é livre para
            deixar de participar da composição deste banco de dados a qualquer momento sem
            nenhum prejuízo ou coação. Uma via deste Termo de Consentimento Livre e
            Esclarecido será encaminhada para o seu e-mail, assim que aceitá-lo. Qualquer dúvida a
            respeito da coleta de dados, você poderá entrar em contato com:</p>
            <p class="recuo">Simone Tiemi Hashiguti, professora do Instituto de Letras e Linguística da
            Universidade Federal de Uberlândia – Av. João Naves de Ávila, 2121, bloco U, Sala
            1U233, Campus Santa Mônica, Uberlândia/MG, CEP: 38408-100 Fone profissional:
            (34) 3239-6206. Você poderá também entrar em contato com o CEP - Comitê de Ética
            na Pesquisa com Seres Humanos na Universidade Federal de Uberlândia, localizado na
            Av. João Naves de Ávila, no 2121, bloco A, sala 224, campus Santa Mônica –
            Uberlândia/MG, 38408-100; telefone: 34-3239-4131. O CEP é um colegiado
            independente criado para defender os interesses dos participantes das pesquisas em sua
            integridade e dignidade e para contribuir para o desenvolvimento da pesquisa dentro de
            padrões éticos conforme resoluções do Conselho Nacional de Saúde.</p>
          </div><br />

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" onclick="enableRegister()" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">Li, entendi, e aceito todos os Termos</label>
            </div>
          </div>
          <button id="register" name="btn" type="submit" class="btn btn-outline-primary" disabled>Cadastrar</button>
      </form>

      <footer class="footer">
        <p>&copy; 2018 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->

    <div class="modal" id="siteModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Termo de Compromisso</h5>
          </div>

          <div class="modal-body">
            <p></p>
          </div>

          <div class="modal-footer">
            <button type="button" class="close" data-dismiss="modal">
              <spam>x</spam>
            </button>
          </div>

        </div>
      </div>
    </div>

    <script scr="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script scr="../js/bootstrap.min.js"></script>

  </body>
</html>
