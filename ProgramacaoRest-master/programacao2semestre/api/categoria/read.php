<?php
	//verifica se foram preenchidos os dados de autenticação
	if(!isset($_SERVER['PHP_AUTH_USER'])){
		//modifica o header, informando o tipo de autenticação
		header('WWW-Authenticate: Basic realm="Página restrita"');
		//modifica o header,indicando o codigo de nao autorizado
		header('HTTP/1.0 401 Unauthorized');
		//exibe mensagem de erro em json
		echo json_encode(["mensagem"=>"Authenticacao necessaria"]);
		//para a execuçao do script
		exit;
		//se foram preenchidos, testa os valores (neste caso,admin admin)
	}elseif (!($_SERVER['PHP_AUTH_USER']=='admin' &&
		$_SERVER['PHP_AUTH_PW'] == 'admin')){
		header('HTTP/1.0 401 Unauthorized');

		echo json_encode(["mensagem" => "dados incorretos"]);
		
	}else{

		include_once '../../config/Conexao.php';
		include_once '../../models/Categoria.php';

		
		$database = new Conexao();
	//recebe a conexao feita
		$con = $database->getConexao();
		
		$categoria = new Categoria($con);
		if(isset($_GET['id'])){
			$resultado = $categoria->read($_GET['id']);
		}else{
			$resultado = $categoria->read();
		}
		echo(json_encode($resultado));
	}

