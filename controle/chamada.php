<?php
	@include_once '../modulo/comunica.php';
	
	$aciona = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'padão' ;

	switch ($aciona) {
		case  substr($aciona, 0, 9) == 'registrar':
			Registrar($_POST['nome'], $_POST['email'], $_POST['senha1'], $_POST['senha2']);
			break;

		case substr($aciona, 0, 5) == 'logar':
			$_SESSION['sessao'] = Logar($_POST['email'], $_POST['senha']);
			break;

		case substr($aciona, 0, 4) == 'sair':
			Sair();
			break;

		case substr($aciona, 0, 7) == 'inserir':
			Inserir_Foto();
			break;

		case substr($aciona, 0, 6) == 'apagar':
			Delete($_GET['tabela'],$_GET['linha'], $_GET['id']);
			break;

		case substr($aciona, 9, 6) == 'apagar':
			Delete($_GET['tabela'],$_GET['linha'], $_GET['id']);
			break;

		case substr($aciona, 0, 8) == 'comentar':
			Comentar($_POST['txtComentarios'], $_POST['id_materia']);
			break;

		case substr($aciona, 0, 9) == 'responder':
			Responder_Comentario($_POST['txtResposta'], $_POST['id_comentario']);

			break;

		case substr($aciona, 0, 11) == 'comentarios':
			Comentarios();
			break;

		case substr($aciona, 9, 8) == 'publicar':
			Publicar_Forum($_POST['titulo'], $_POST['publicacao'], $_POST['upload_forum'], $_POST['id_materia']);
			break;

		case substr($aciona, 0, 11) == 'exibirforum':
			Exibir_Forum();
			break;

		case substr($aciona, 9, 13) == 'resforum':
			ResForum($_POST['txtAjuda'], $_POST['id_publicacao']);
			break;

		default:
			//fopen('http://localhost/espacosideral/index.php', null);
			break;
	}


?>