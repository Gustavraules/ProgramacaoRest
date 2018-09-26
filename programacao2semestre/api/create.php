<?php
	header('Content-Type: application/json');

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require_once '../../config/Conexao.php';
		require_once '../../models/Categoria.php';

		$db= new Conexao();
		$db->getConexao();
		$cat= new Categoria($db);
		$cat->id=$_GET['id'];
		$cat->nome=$_POST['nome'];
		$cat->descricao=$_POST['descricao'];
		$cat->create();
	}