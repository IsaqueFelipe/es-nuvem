<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    include_once '../controle/chamada.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Em Desenvolvimento  -->
        <meta charset="UTF-8">
        <meta name="keywords" content="Astronomia, Espaço, Sideral">
        <meta name="description" content="Blog de Astronomia e divulgação ciêntifica em geral EspaçoSideral">
        <meta name="author" content="I. F. F. C">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Espaço Sideral</title>

        <link rel="icon" href="Imagens/Logo.png">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../css/movel.css" media="(max-width:360px)">
        <style type="text/css">
            img[src*="https://www.freewebhostingarea.com/images/poweredby.png"]{
                display: none;
            }
        </style>
        <script type="text/javascript">
            function Responder(){
                var visual = document.getElementById('respondeComent');
                //visual.style.display='inline-block';
                visual.text
            }
        </script>
        <!---=============================Codigos_JavaScript_Importados===================================-->
        <script>window.jQuery || document.write('<script src="../jscripts/jquery-3.3.1.js"><\/script>')</script>
        <script src="../jscripts/bootstrap.js"></script>
        <script src="../jscripts/popper.min.js"></script>
        <script src="../jscripts/holder.min.js"></script>
        <script src="../jscripts/mFuncoes.js"></script>
        <!-- <script src="Scripts/qunit.js"></script> -->
        <!---#############################################################################################-->
    </head>
    <body style="padding-top: 1rem;">

        <section class="container">
        <!--==================================================================================================-->
            <div class="comentario-area my-3 p-3 bg-white rounded box-shadow">
        <!--====ÁREA====DE====COMENTÁRIOS====-->
                <form action="?comentar/#formComentar" method="POST" id="formComentar">
                    <textarea class="form-control" placeholder="Deixe aqui seu comentário sobre a mátéria." name="txtComentarios" cols="" rows="3" required=""></textarea>
                    <input type="hidden" name="aciona" value="comentar">
                    <input type="hidden" name="id_materia" value="<?=$_SESSION['infopagina']['id_materia']?>">
                    <button class="enviar" type="submit" title="Efetue o login ou registre-se para enviar um comentário.">enviar</button>
                </form>

        <!--====ÉSTA=FUNÇÃO=EXIBE=OS=COMENTÁRIOS======================-->
                <div id="comentarios">
                    <?php
                        $_SESSION['infopagina']['id_materia'];
                        Comentarios($_SESSION['infopagina']['id_materia']);
                    ?>
                </div>
        <!--========================================================= -->
                    <small class="d-block mt-3" style="text-align: right;">
                        <a class="mm" href="?ver=<?=$_SESSION['ver']-3?>#comentarios"><b>ver menos</b></a>
                        <!-- isso tambem pode ser feito via SQL  -->
                        <a class="mm" href="?ver=<?=$_SESSION['ver']+3?>#comentarios"><b>ver mais</b></a>
                        <!-- isso tambem pode ser feito via SQL  -->
                    </small>

            </div>


        </section>
    </body>
</html>
