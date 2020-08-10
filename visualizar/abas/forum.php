<div class="row">
	<div class="rounded box-shadow col-md-8 blog-main">
        <h1 class="pb-3 mb-4 font-italic border-bottom" style="text-align: center;">Forum Espaço Sideral!</h1>
	    <div class="bot-padr">
	    	<div class="bot-padr2">
		        <a href="" class="" data-toggle="collapse" data-target="#criar_topico" aria-expanded="" aria-controls="criar_topico" style="display: block; color: white;">
		            Deixe aqui sua dúvida para que possamos ajuda-lo a esclarecer, ou apenas inicie um debate.
		        </a>
	    	</div>

	        <div id="criar_topico" class="collapse">
	            <form id="" action="?forum-br&publicar" method="POST">
	              <input type="hidden" name="id_materia" value="<?=$_SESSION['infopagina']['id_materia']?>">
	                <label class="label">Titulo</label>
	                <input id="texttitulo" type="text" name="titulo" placeholder=" ... um breve resumo de sua dúvida">
	                <label class="label">Descrição</label>
	                <textarea id="textmessage" name="publicacao" class="" required="" cols="" rows="" placeholder="..."></textarea>
	                <div class="labe_ferr">
	                	<label for="anexar"></label>
	                    <!-- <input id="anexar" type="file" name="upload_forum" value=""> -->
	                    <button class="bot-padr" type="submit" title="Efetue o login ou registre-se para enviar um comentário.">Criar</button>
	                </div>
	            </form>
	        </div>
	    </div>



        <h4 class="border-bottom border-gray pb-2 mb-0">Forum</h4>
        <div id="publicForum">
            <?=Exibir_Forum()?>
        </div>
        <small class="d-block mt-3" style="text-align: right;">
            <a class="mm" href="?forum-br&ver_Forum=<?=$_SESSION['ver_Forum']-3?>&#publicForum"><strong>ver menos</strong></a>
            <!-- isso tambem pode ser feito via SQL  -->
            <a class="mm" href="?forum-br&ver_Forum=<?=$_SESSION['ver_Forum']+3?>&#publicForum"><strong>ver mais</strong></a>
            <!-- isso tambem pode ser feito via SQL  -->
        </small>
    </div>
