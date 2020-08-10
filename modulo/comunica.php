<?php
  /**
  * [________________espacosideral_2020______________]
  * [______________________I.F.F.C___________________]
  * [                        ...                     ]
  **/
	date_default_timezone_set('America/Sao_Paulo');
	// error_reporting(E_ALL);


	///__Conexão com Banco de Dados: Espaço Sideral.__///
	function Conecta(){
		try {
/*CASA*///	$conecta = new PDO("mysql:host=localhost;port=3306;dbname=bdespacosideral;charset=utf8", "root", "");
//==========================================================================================================================||
/*Servidor*/$conecta = new PDO("mysql:host=localhost;port=3306;dbname=1103447;charset=utf8", "1103447", "felipe2016");
//==========================================================================================================================||
			$conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	   		echo $e->getMessage();
	        die();
	    }
		return $conecta;
	}

	/*__Disponivel_No _Escopo_Global__*/$conecta = Conecta();//
	//_______________________________________________________//


	///__Registrando_Novo_Usuário.__///
	function Registrar(&$nome, &$email, $senha1, $senha)	{
		if ($senha1 <> $senha) {
			echo "<script> location.href='?mtexto=As senhas não correspondem!' </script>";
		}
		else
		{
			$insert = "INSERT INTO membros (nome, email, senha) values ('$nome', '$email', '$senha');";
			global $conecta;	//___especifica o uso no escopo local___//
			$conecta->query($insert);
			$_SESSION['sessao'] = Logar($email, $senha);
		}
	}


	///__Logando_Usuário.__///
	function Logar(&$email, $senha)	{
		global $conecta;
		$sql = "SELECT `nome`, `senha`, `id_membros`, `url_perfil`
				FROM `membros` WHERE `email` =  '$email';";

		$verifica = $conecta->query($sql);
		if($sessao = $verifica->fetch()) {
			if ($sessao['senha'] <> $senha){
				echo "<script> location.href='../index.php?mtexto=A senha esta incorreta!&aciona=Invalido' </script>";
			}
			else
			{
	 			return 	$sessao;
			}
		}
		else
		{
			echo "<script> location.href='?mtexto=Usuário invalido!&aciona=Invalido' </script>";
		}
	}


	///__Sair__///
	function Sair(){
		session_unset();	//limpando dados da sessão
		session_destroy();	//excluindo a sesão
	}


	///__Subir_Foto__///
	function Inserir_Foto(){
		if(isset($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0){
			$arquivo_tmp = $_FILES['imagem']['tmp_name'];
			$nome = $_FILES['imagem']['name'];

			$extensao = pathinfo( $nome, PATHINFO_EXTENSION );// Pegando a extensão

			$extensao = strtolower($extensao);//Muda para minuscula
			// Pesquisa a ext. permitida dentro da String //
			if(strstr ('.jpg; .jpeg; .png' , $extensao)){
				//Criando um nome unico
				$novoNome =  date("d.m.Y-H.i.s") . uniqid() . '.' . $extensao;
				//endereço e nome
				$destino = 'imagens/upload/' . $novoNome;
				//Movendo
				if(move_uploaded_file($arquivo_tmp, $destino)){
					//Salvando endereço no banco
			        $sqlInsert_imagem = "UPDATE membros SET url_perfil = '$destino' WHERE nome = '{$_SESSION['sessao']['nome']}';";
			        $sqlRetorna_imagem = "SELECT url_perfil FROM membros WHERE nome = '{$_SESSION['sessao']['nome']}';";
			        global $conecta;	//___especifica o uso no escopo local___//
				 	if(!$conecta->query($sqlInsert_imagem)){
						print("Falha ao executar a query: (" . $conecta->errno . ") " . $conecta->error);
					}
					if(!$retorna_imagem = $conecta->query($sqlRetorna_imagem)){
						print("Falha ao executar a query: (" . $conecta->errno . ") " . $conecta->error);
					}
					$exibir = $retorna_imagem->fetch();
					$_SESSION['sessao']['url_perfil'] = $exibir['url_perfil'];
				}else{
					echo "Impossivel Mover";
				}
			}else{
				echo "<script type='text/javascript'>alert('Extensão invalida')</script>";
			}
		}else{
			echo "Não fooi possivel carregar a imagem!";
			print($_FILES['imagem']['error']);
		}
	}


	///__Comentar__///
	function Comentar($txtCcomentarios, $id_materia){
		global $conecta;

		$id_membros = empty($_SESSION['sessao']['id_membros']) ? 0 : $_SESSION['sessao']['id_membros'];

		$sqlComentar = "
			INSERT INTO  comentarios (comentario, fk_id_materia, fk_cmt_id_membro)
			VALUES('$txtCcomentarios', $id_materia, $id_membros)";

		$conecta->query($sqlComentar);
	}

	///__Responder_Comentário__///
	function Responder_Comentario($txtResposta, $id_comentario){
		global $conecta;
		$id_membros = empty($_SESSION['sessao']['id_membros']) ? 0 : $_SESSION['sessao']['id_membros'];

		$sqlResponder = "
			INSERT INTO interatividade_comentario(resposta_comentario, fk_res_id_membro, fk_id_comentario)
			VALUES('$txtResposta', $id_membros, $id_comentario);";

		$conecta->query($sqlResponder);
	}

	///__Exibe_os_comentários__///
	$_SESSION['ver'] = 3;
	function Comentarios($id_materia){
		global $conecta;

		$sqlBusca = "
			SELECT id_membros, id_comentario, comentario, nome, url_perfil, data_hora
			FROM comentarios  INNER JOIN membros ON membros.id_membros = comentarios.fk_cmt_id_membro
			WHERE fk_id_materia = $id_materia ORDER BY comentarios.data_hora DESC;";

		$resultado = $conecta->query($sqlBusca);
		$count = $conecta->query("SELECT count(*) FROM comentarios WHERE fk_id_materia = $id_materia")->fetchColumn();
		printf("<p>Comentarios: ( $count )</p>");

		@$_SESSION['ver'] = isset($_GET['ver']) ? $_GET["ver"]: 3;
		$verMais = 0;
		for ($ver = $_SESSION['ver']; $verMais < $ver; $verMais++) {

			if ($comentario = $resultado->fetch()) {

?>
		<div class="divcomem">
			<div class="media text-muted pt-3">
				<img src="../<?=$comentario['url_perfil']?>" alt="avatar" class="mr-2 rounded" width="40px">
				<p class="media-body pb-3 mb-0 small lh-125">
					<strong class="d-block text-gray-dark"><?=$comentario['nome']?>
						<sup><?=$comentario['data_hora']?></sup>
					</strong>
					<?=$comentario['comentario']?>
				</p>
<?php
				if(@$_SESSION['sessao']['id_membros'] == 111){
            		echo "<a href=?apagar&tabela=comentarios&linha=id_comentario&id=$comentario[id_comentario] class='nav-link'><img src='../imagens/delete.png' alt='delete' width='20px'></a>";
            	}
?>
			</div>
<?php
			$sqlResposta = "
				SELECT id_resposta, nome, url_perfil, resposta_comentario, data_hora_resposta
				FROM membros
				INNER JOIN `interatividade_comentario`
				ON `interatividade_comentario`.`fk_res_id_membro` = `membros`.`id_membros`
				WHERE `interatividade_comentario`.`fk_id_comentario` = {$comentario['id_comentario']}
				ORDER BY `interatividade_comentario`.`data_hora_resposta` ASC ";

			$result = $conecta->query($sqlResposta);
			while($resposta = $result->fetch()) {
?>
			<div class="media text-muted pt-3 resposta" style="padding: 0px 40px">
				<img src="../<?=$resposta['url_perfil']?>" alt="avatar" class="mr-2 rounded" width="40px">
				<p class="media-body pb-3 mb-0 small lh-125">
					<strong class="d-block text-gray-dark">Resposta de <u><?=$resposta['nome']?></u>
						<sup><?=$resposta['data_hora_resposta']?></sup>
					</strong>
					<?=$resposta['resposta_comentario']?>
				</p>
<?php
				if(@$_SESSION['sessao']['id_membros'] == 111){
            		echo "<a href=?apagar&tabela=interatividade_comentario&linha=id_resposta&id=$resposta[id_resposta] class='nav-link'><img src='../imagens/delete.png' alt='delete' width='20px'></a>";
            	}
?>
			</div>
<?php
 			}
?>
			<div id="respondeComent" class="respondeComent" >
			    <a data-toggle="collapse" href="#respondercomentario<?=$comentario['id_comentario']?>" role="button" aria-expanded="false" aria-controls="respondercomentario<?=$comentario['id_comentario']?>" style="font-size: 12px">Responder Comentário</a>

			    <div id="respondercomentario<?=$comentario['id_comentario']?>" class="collapse">
					<form action="?responder<?=$comentario['id_comentario']?>" method="POST" id="formResponderComentario<?=$comentario['id_comentario']?>" class="" style="display: -webkit-box;">
						<textarea class="form-control" placeholder="Responda aqui este comentário." name="txtResposta" cols="" rows="3" required=""></textarea>
						<input type="hidden" name="aciona" value="responder">
						<input type="hidden" name="id_comentario" value="<?=$comentario['id_comentario']?>">
						<button class="enviar enviar-res" type="submit" title="Efetue o login ou registre-se para enviar um comentário.">enviar</button>
					</form>
			    </div>
			</div>
		</div>

<?php
			}#while
		}#for
	}#function


	//Deletar
	function Delete($tabela, $linha, $id){
		global $conecta;
		$conecta->query("DELETE FROM $tabela WHERE $linha = $id");
	}


	///__Faz_uma_Publição_no Forum__///
	function Publicar_Forum($titulo, $publicacao, $upload_forum, $id_materia){
		global $conecta;
		$id_membros = empty($_SESSION['id_membros']) ? 0 : $_SESSION['id_membros'];
		$sqlForum = "
			INSERT INTO  forum (titulo, publicacao, upload_forum, fk_frm_id_membro, fk_frm_id_materia)
			VALUES('$titulo', '$publicacao', '$upload_forum', $id_membros, $id_materia)";
		$conecta->query($sqlForum);
	}


	///__Responder_uma_publicação__///
	function Responder_Publicacao($txtResposta, $upload_r_forum, $id_publicacao){
		global $conecta;
		$id_membros = empty($_SESSION['sessao']['id_membros']) ? 0 : $_SESSION['sessa']['id_membros'];

		$sqlResponderF = "
			INSERT INTO interatividade_forum(resposta_f, url_upload, fk_res_id_membro, fk_interat_f)
			VALUES('$txtResposta', $upload_r_forum, $id_membros, $id_publicacao);";

		$conecta->query($sqlResponder);
	}


	///__Exibe_As_Publicação_Do_Forum__///
	function Exibir_Forum(){
		global $conecta;
		$sqlBusca = "
			SELECT nome, url_perfil, titulo, publicacao, upload_forum, data_hora, id_publicacao
			FROM membros INNER JOIN forum ON forum.fk_frm_id_membro = membros.id_membros ORDER BY data_hora DESC";

		$resultado = $conecta->query($sqlBusca);
		$count = $conecta->query("SELECT count(*) FROM forum")->fetchColumn();
		printf("<p>Publicações: (" . $count . ")</p>");

		@$_SESSION['ver_Forum'] = isset($_GET['ver_Forum']) ? $_GET["ver_Forum"]: 3;
		$verMais_Forum = 0;
		for ($ver_Forum = $_SESSION['ver_Forum']; $verMais_Forum < $ver_Forum; $verMais_Forum++) {

			if ($publicar = $resultado->fetch()) {
?>

		<div class="divcomem">
			<div class="media text-muted pt-3">
						<img src="../<?=$publicar['url_perfil']?>" alt="avatar" class="mr-2 rounded" width="40px">
						<p class="media-body pb-3 mb-0 small lh-125">
								<strong class="d-block text-gray-dark"><?=$publicar['nome']?>
								<sup><?=$publicar['data_hora']?></sup>
								</strong>
						</p>
<?php
				if(@$_SESSION['sessao']['id_membros'] == 111){
		    		echo "<a href=?forum-br&apagar&tabela=forum&linha=id_publicacao&id=$publicar[id_publicacao] class='nav-link'><img src='../imagens/delete.png' alt='delete' width='20px'></a>";
		        }
?>
			</div>
			<div class="subDiv">
				<h4 style="text-align: left;margin-top: -15px;margin-left: 50px;"><?=$publicar['titulo']?></h4>
				<p class="media-body pb-3 mb-0 small lh-125"><?=$publicar['publicacao']?></p>
				<!-- <img class="card-img-right flex-auto d-md-block imgcenter" src="" alt="imagem" width="100%"> -->
			</div>
<?php

				$sqlAjuda = "
					SELECT nome, url_perfil, resposta_ajuda, data_hora, id_ajuda
					FROM membros
					INNER JOIN `interatividade_forum`
					ON `interatividade_forum`.`fk_frm_a_id_membro` = `membros`.`id_membros`
					WHERE `interatividade_forum`.`fk_frm_id_publicacao` = {$publicar['id_publicacao']}
					ORDER BY `interatividade_forum`.`data_hora` ASC ";

				$result = $conecta->query($sqlAjuda);
				while($ajuda = $result->fetch()) {
?>
					<div class="media text-muted pt-3 resposta" style="padding: 0px 40px">
						<img src="../<?=$ajuda['url_perfil']?>" alt="avatar" class="mr-2 rounded" width="40px">
						<p class="media-body pb-3 mb-0 small lh-125">
							<strong class="d-block text-gray-dark">Resposta de <u><?=$ajuda['nome']?></u>
								<sup><?=$ajuda['data_hora']?></sup>
							</strong>
							<?=$ajuda['resposta_ajuda']?>
						</p>
<?php
					if(@$_SESSION['sessao']['id_membros'] == 111){
						echo "<a href=?forum-br&apagar&tabela=interatividade_forum&linha=id_ajuda&id=$ajuda[id_ajuda] class='nav-link'><img src='../imagens/delete.png' alt='delete' width='20px'></a>";
				    }
?>
					</div>
<?php
	 			}
				$conecta->query($sqlAjuda);
?>
			<div id="respondeForum" class="respondeForum" >

				<a data-toggle="collapse" href="#respondeForumArea<?=$publicar['id_publicacao']?>" role="button" aria-expanded="false" aria-controls="respondeForumArea<?=$publicar['id_publicacao']?>">Responder Publicação</a>
				<div id="respondeForumArea<?=$publicar['id_publicacao']?>" class="collapse">
					<form action="?forum-br&resforum#formResponderForum<?=$publicar['id_publicacao']?>" method="POST" id="formResponderForum<?=$publicar['id_publicacao']?>" class="" style="display: -webkit-box;">
						<textarea class="form-control" placeholder="Responda aqui este comentário." name="txtAjuda" cols="" rows="3" required=""></textarea>
						<input type="hidden" name="aciona" value="publicarajuda">
						<input type="hidden" name="id_publicacao" value="<?=$publicar['id_publicacao']?>">
						<button class="enviar enviar-res" type="submit" title="Efetue o login ou registre-se para enviar um comentário.">enviar</button>
					</form>
				</div>
			</div>
		</div>

<?php
			}#while
		}#for
	}#function

	///___ ___///
	function ResForum($txtAjuda, $id_publicacao){
		global $conecta;
		$id_membros = empty($_SESSION['sessao']['id_membros']) ? 0 : $_SESSION['sessao']['id_membros'];

		$sqlResponder = "
			INSERT INTO interatividade_forum(resposta_ajuda, fk_frm_a_id_membro, fk_frm_id_publicacao)
			VALUES('$txtAjuda', '$id_membros', '$id_publicacao');";
		$conecta->query($sqlResponder);
	}

	function BuscarResultado($chave){
		global $conecta;

		$sqlBuscar = "SELECT * FROM `materias` WHERE descricao LIKE '%$chave%' ORDER BY `materias`.`id_materia` DESC";

		$busca = $conecta->query($sqlBuscar);
		while($resultado = $busca->fetch()) {
?>
			<li>
				<h5><?=$resultado['mttitulo']?></h5>
				<p><?=$resultado['descricao']?></p>
				<a href="<?=$resultado['url']?>"><?=$resultado['url']?></a>
				<hr color="#fff" style="margin: 0px">
			</li>
<?php
		}

		if (!$conecta->query($sqlBuscar)) {
				print("Falha ao executar a query: linha aprox: 415 (" . $conecta->errno . ") " . $conecta->error);
		}

	}

	function InfoPagina()
	{
		global $conecta;
		if (substr($_SERVER['QUERY_STRING'], -3) == '-br') {
			$arquivo = substr($_SERVER['QUERY_STRING'], 0, -3);
			$sql = "SELECT * FROM `materias` WHERE arquivo LIKE '%$arquivo%'";
			$dados = $conecta->query($sql);
			$info = $dados->fetch();
			return $info;
		}else{
			$sql = "SELECT * FROM `materias` WHERE arquivo LIKE '%inicio-br%'";
			$dados = $conecta->query($sql);
			$info = $dados->fetch();
			return $info;
		}
	}

?>
