<?php
	header('Content-Type: application/json');
	if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

		require_once '../../config/Conexao.php';
		require_once '../../models/Categoria.php';

		$dados = json_decode(file_get_contents('php://input'));

		$db = new Conexao();
		$conexao = $db->getConexao();

		$cat = new Categoria($conexao);

		$cat->id = $dados->id;

		if($cat->delete()){
			$dados = ['mensagem' => 'Categoria excluida'];

		}else{
			$dados = ['mensagem' => 'Categoria nao excluida'];

		}
		echo json_encode($dados);
	}else{
		echo json_encode(['mensagem' => 'metodo nao suportado']);
	}
	}