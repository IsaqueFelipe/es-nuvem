<?php
    //Definiões de Cookies
    #       Set-Cookie: flavor=choco; SameSite=Lax
    #       Set-Cookie: flavor=choco; SameSite=None; Secure

    #header('Set-Cookie: cross-site-cookie=bar; SameSite=None; Secure', false);
    #header('Set-Cookie: same-site-cookie=foo; SameSite=Lax', true);
    setcookie('cross-site-cookie', 'name', ['samesite' => 'None', 'secure' => true]);

    if (session_status() <> PHP_SESSION_ACTIVE) {
        session_start();
    }

    include_once 'modulo/comunica.php';

    $mtInfo = InfoPagina();
    $_SESSION['infopagina'] = $mtInfo;

    $dados = $conecta->query($sql = "SELECT id_materia, arquivo FROM `materias`");
    for ($arquivos; $string = $dados->fetch() ; $arquivos[] = $string['arquivo']);

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155847314-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-155847314-1');
        </script>
        <script data-ad-client="pub-8679362130678434" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

        <!-- Em Desenvolvimento  -->
        <meta charset="UTF-8" />
        <meta name="keywords" content="Astronomia, Espaço, Sideral" />
        <meta name="description" content="Blog de Astronomia e divulgação ciêntifica em geral sobre o  Espaço Sideral" />
        <meta name="author" content="I. F. F. C" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="google-site-verification" content="OGKTb014TC_W69bSYwUf2qQuiolXupET7OI_jbmq4Fc" />
        <meta name="msvalidate.01" content="597F1518CD3085343E76C09072F120F2" />

<?php
        $url      = $mtInfo['url'] ?? $_SERVER['HTTP_HOST'] ."/?". $_SERVER['QUERY_STRING'];
        $type     = $mtInfo['']            ?? "website";
        $title    = $mtInfo['mttitulo']    ?? "Bem Vindos ao Espaço Sideral";
        $descript = $mtInfo['descricao']   ?? "Descubra mais sobre o Espaço Sideral aqui";
        $imagem   = $mtInfo['imagem']      ?? "https://www.espacosideral.cf/imagens/logo.png";
        $mttcard  = $mtInfo['mttcard']	   ?? "summary"
?>
        <link rel="canonical" href="<?=@$mtInfo['url']?>" />
        <meta name="twitter:card"            content="<?=$mttcard   ?>" />
        <meta name="twitter:site"            content="@espacosideral7"  />
        <meta name="twitter:creator"         content="@espacosideral7"  />
        <meta name="twitter:title"           content="<?= $title    ?>" />
        <meta name="twitter:description"     content="<?= $descript ?>" />
        <meta name="twitter:image"           content="<?= $imagem   ?>" />
        <meta property="og:locale"           content="pt_BR" />
        <meta property="og:url"              content="<?= $url      ?>" />
        <meta property="og:type"             content="<?= $type     ?>" />
        <meta property="og:title"            content="<?= $title    ?>" />
        <meta property="og:site_name" 		 content="Espaço Sideral"	/>
        <meta property="og:description"      content="<?= $descript ?>" />
		<!-- <meta property="og:image:width" 	 content="800" /> -->
        <!-- <meta property="og:image:height" 	 content="600" /> -->
        <meta property="og:image"            content="<?= $imagem  ?>" />
        <meta property="og:image:secure_url" content="<?= $imagem  ?>" />
        <meta property="og:image:alt"        content="Logotipo do site"/>

        <title><?=@$mtInfo['brtitulo']?>Espaço Sideral</title>

        <link rel="icon" href="imagens/logo.png"><!--[[estilos-abaixo]]-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/movel.css" media="(max-width:360px)">
        <style type="text/css">
            img[src*="https://www.freewebhostingarea.com/images/poweredby.png"]{    display: none;  }
        </style>

<?php
       if(substr($_SERVER['QUERY_STRING'], 0, 7) == "galeria") {?>
        <script type='text/javascript' src='jscripts/jquery-1.11.0.js'></script>
        <script type='text/javascript' src='jscripts/unitegallery.js'></script>
        <link rel='stylesheet' href='css/unite-gallery.css' type='text/css' />
        <link rel='stylesheet' href='css/galeria.css' type='text/css' />
        <script type='text/javascript' src='jscripts/ug-theme-tiles.js'></script>
<?php } ?>
        <script type="text/javascript">

            function Remove_modal(){
              $("#mmodal").css('display', 'none')
              }

            setTimeout(Remove_modal, 5000)

        </script>

    </head>
    <body>
    <?php if (!empty($_GET['mtexto'])) { ?>
        <div id='mmodal'>
            <div class='alerta'>
                <p class='mtexto'><b><?=@$_GET['mtexto']?></b></p>
                <span class='fechar' onclick='Remove_modal()'>x</span>
            </div>
        </div>
    <?php } ?>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top cabecalho">
                <a class="navbar-brand" href="/"><img src="imagens/logo.png" alt="Espaço Sideral" width="95px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link lis" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lis" href="?forum-br">Forum</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link lis" href="http://www.espacosideral.cf/quiz/index.php" target="_Blank">Quiz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lis" href="?galeria-br" id="">Galeria</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link lis dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trabalhos</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <!-- <a class="dropdown-item" href="orion/" target="_Blank" title="O orion é lugar para voc~e conversar com segurança com seu amigos.">Orion</a> -->
                                <a class="dropdown-item" href="?galeria-br" id="">Galeria</a>
                                <a class="dropdown-item" href="quiz/" target="">Quiz</a>
                            </div>
                        </li>
                    </ul>

                    <form id="form_pesquisa" class="form-inline my-2 my-lg-0" method="GET">
                        <input id="pesquisar" name="buscar" class="form-control mr-sm-2" type="search" placeholder="Pesquisar..." aria-label="Search" results="5" required>
                        <input id="pesq_exter" name="pesq_exter" type="checkbox" name="tipo" title="Marque esta opção para exibir resultados de pesquisa de fontes externas ao site espaço sideral.">
                        <input type="image" src="imagens/busca.png" style="width:36px; margin-right: 10px; alt" alt="Pesquisar" title="Pesquisar">
                    </form>
<?php
/*[=============================================*/
    include_once 'controle/chamada.php';

    if(empty($_SESSION['sessao'])){
?>
    <button id="Registre_se" type='button' class='btn btn-outline-success my-2 my-sm-0 registro' data-toggle='modal' data-target
            ='#firefoxModal' title='Efetue o login ou registre-se para se tornar um membro'>Registre-se</button>
<?php
    }else{
?>

                    <div class="btn-group dropleft configurar" style=''>
                        <div class="perfil">
                            <img src="<?=$_SESSION['sessao']['url_perfil']?>" width="30px" alt="usuario">
                        </div>
                       <button class='btn btn-secondary dropdown-toggle bMenu' type='button' id='dropleftMenu1' data-toggle='dropdown' aria-haspopup='true'aria-expanded='false'><?=$_SESSION['sessao']['nome']?></button>

                       <div class='dropdown-menu' aria-labelledby='dropleftMenu1' style='position: absolute;transform: translate3d(-120px, 35px, 0px);top: 0px;left: 0px;will-change: transform;'>
              <!--================================================================================================================================ -->
                          <a href='orion/orion.php'><button class='dropdown-item' type='button'>Conversar</button></a>
              <!--================================================================================================================================ -->
                          <button class='dropdown-item' type='button'> Alterar senha   </button>
              <!--================================================================================================================================ -->
                          <button class='dropdown-item' type='button' id='dropleftMenu3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>   Inserir foto de perfil  </button>
                          <div class='dropdown-menu' aria-labelledby='dropleftMenu3' style='position: absolute;transform: translate3d(-120px, 35px, 0px);top: 0px;left: 0px;will-change: transform;'>
                             <form method='POST' enctype='multipart/form-data' action='?Inserir' >
                                <input type='file' name='imagem'>
                                <input type='hidden' name='aciona' value='Inserir'>
                                <!--O valor Inserir é processador por carregar.php-->
                                <input type='submit' value='Alterar'>
                             </form>
                          </div>
              <!--================================================================================================================================= -->
                          <a href="?sair">
                             <button class='dropdown-item' type='button'>Sair</button>
                          </a>
                       </div>
                    </div>
        <?php  }

                /*=============================================]*/
                                ?>
                </div>
            </nav>
            <div class="nav-scroller py-1 mb-2">
                <span class="seta" style="float: left;">&#10094;</span>
                <span class="seta" style="float: right;">&#10095;</span>
                <nav class="nav d-flex justify-content-between">
                    <a class="p-2 text-muted" href="?galeria-br">Astronomia</a>
                    <a class="p-2 text-muted" href="?galeria-br">Galaxias</a>
                    <a class="p-2 text-muted" href="?galeria-br">Estrelas</a>
                    <a class="p-2 text-muted" href="?galeria-br">Planetas</a>
                    <a class="p-2 text-muted" href="?galeria-br">Satélites Naturais</a>
                    <a class="p-2 text-muted" href="?galeria-br">Sistema Solar</a>
                    <a class="p-2 text-muted" href="?galeria-br">Asteróides</a>
                    <a class="p-2 text-muted" href="?galeria-br">Meteoros</a>
                    <a class="p-2 text-muted" href="?galeria-br">Telescópios</a>
                    <a class="p-2 text-muted" href="?galeria-br">Projetos</a>
                </nav>
            </div>
        </header>
        <main role="main" class="container">
            <div class="row">
        <!--========================INSERÇÃO-DE-FUNÇÕES-E-CONTEÚDO================================-->
        <?php
            include_once 'visualizar/registrar.php';

            $carregar = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "padrão";

            switch ($carregar) {

                case substr($carregar, 0, 8) == 'forum-br':
                    include "visualizar/abas/forum.php";
                    break;

                case substr($carregar, 0, 10) == 'galeria-br':
                    include 'visualizar/abas/galeria.php';
                    break;

                case substr($carregar, 0, 6) == 'buscar':
                    include 'visualizar/busca.php';
                    break;

                case substr($carregar, -3) == '-br':
                    $materia = substr($_SERVER['QUERY_STRING'], 0, -3);
                    if(!(@include "visualizar/materias/" . $materia . ".php")){
                        include "visualizar/erro.php";
                    }
                    break;

                default:
                    include "visualizar/materias/inicio-br.php";
                    break;
            }

        ?>
        <!-- ====================================================================================== -->
                <aside class="col-md-4 blog-sidebar">
                    <!--Anúncio Lateral 1-->
                    <?php include 'visualizar/anuncio-1-coluna.html';?>

                    <div class="p-3" style="text-align: right;">
                        <h5 id="Relacionados" class="font-italic">Relacionados</h5>
                        <ol class="list-unstyled mb-0" >
                            <li><a href="?galeria-br">...</a></li>
                            <li><a href="?forum-br">...</a></li>
                        </ol>
                        <h5 class="font-italic">Arquivos</h5>
                        <ul class="list-unstyled mb-0" style="list-style: square;">
                            <li><a href="?missoes-a-marte-2020-br">Três sondas foram enviadas a Marte em 2020</a></li>
                            <li><a href="?cometa-neowise-br">Cometa visivel C/2020 F3</a></li>
                            <li><a href="?lancamento-em-alcantara-br">Lançamento em Alcântara</a></li>
                            <li><a href="?stellarium-planetario-3d-br">Simulação do céu 3D</a></li>
                            <li><a href="quiz/">Teste seus conhecimentos, Quiz</a></li>
                            <li><a href="?apresentacao-do-blog-br">Apresentação do site</a></li>
                        </ul>
                    </div>
                    <div class="p-3 mb-3 bg-light rounded">
                        <h6 class="font-italic">Sobre</h6>
                        <p class="mb-0" style="font-size: 16px">Este Blog começou a ser desenvolvido em 2019, por <em>Isaque Felipe,</em> apaixonado por astronomia desde pequeno, procurou aliar algumas de suas habilidades para divulgar conteúdos relacionados a ciência em geral e principalmente a astronomia no Brasil e no mundo.</p>
                    </div>

        			<!-- Anúncio Lateral 2-->
                    <?php include 'visualizar/anuncio-2-coluna.html';?>

                </aside>

            </div><!-- fim/.row -->

            <!-- Midias Sociais -->
            <div class="" style="padding: 5px; text-align: ;">
                <h5><i style="color: #fff">Compartilhe suas descobertas</i></h5>

                <ul class="compartilhar" style="display:;">
                    <li>
                        <a class="fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=" target="_blank" title="Compartilhar com LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' + encodeURIComponent(document.title)); return false;"><img src="imagens/logo-linkedin-icon-512.png" width="30px" alt="linkedin"></a>
                    </li>
                    <li>
                        <a class="fa fa-whatsapp" title="WhatsApp" href="whatsapp://send?text=<?= $url?>" target="_blank" title="Compartilhar com WhatsApp"><img src="imagens/whatsapp.png" width="30px" alt="whatsapp"></a>
                    </li>
                    <li>
                        <a class="fa fa-reddit" href="http://www.reddit.com/submit?url=&title=" target="_blank" title="Enviar para Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' + encodeURIComponent(document.title)); return false;">
                            <img src="imagens/reddit.png" width="30px" alt="reddit">
                        </a>
                    </li>
                    <li>
                        <a class="fa fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=&t=" title="Compartilhar com Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><img src="imagens/face.png" height="31px" alt="facebook"></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="true">Tweet</a>
                    </li>
                    <li>
                        <a href="https://twitter.com/espacosideral7" class="twitter-follow-button" data-size="large" data-lang="pt-br" data-show-count="false" data-show-screen-name="true">Siga @espacosideral7</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </li>
                </ul>
                <center style="text-align: center !important;color: #a9a9a9db;margin: 6px; font-size: 12px;">
                    << continua após a publicidade. >>
                </center>
            </div>
            <?php include 'visualizar/anuncio-final.html';?>
        </main>

        <!--====================================Área_De_Comentário=========================================-->
        <iframe id="framecomentario" src="visualizar/comentarios.php" style="border: none; width: 100%; min-height: 440px; height:;"></iframe>

        <!--==========================================Rodapé===============================================-->
        <footer class="footer" name="" id="rodape">
            <div class="container" style="text-align: center; padding: 5px">
                <span class="text-muted">© Espaço Sideral <span class="direitos">2020</span></span><br>
                <span class="direitos">Este website é um projéto de apoio a divulgação cientifica, em desenvolvimento por I. F. F. C.</span>
            </div>
        </footer>
        <script type="text/javascript">
                // var url_atual = window.location.href;
                // var plgFcbk = document.getElementById('plgFcbk');
                // var plgBotF = document.getElementById('plgBotF');
                // plgFcbk.setAttribute("data-href", url_atual);
                // plgBotF.setAttribute("data-href", url_atual);
        </script>
        <!---=============================Codigos_JavaScript_Importados===================================-->
        <script>window.jQuery || document.write('<script src="jscripts/jquery-3.3.1.js"><\/script>')</script>
        <script src="jscripts/bootstrap.js"></script>
        <script src="jscripts/popper.min.js"></script>
        <script src="jscripts/holder.min.js"></script>
        <script src="jscripts/mFuncoes.js"></script>
        <!-- <script src="jscripts/qunit.js"></script> -->
        <!---#############################################################################################-->
    </body>
</html>
