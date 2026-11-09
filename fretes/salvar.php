<?php

require_once '../config/conexao.php';

// Receber informações do frete
$transportador_id = $_POST['transportador_id'];
$origem_id = $_POST['origem_id'];
$destino_id = $_POST['destino_id'];
$data_frete = $_POST['data_frete'];
$status = $_POST['status'];
$valor_frete = $_POST['valor_frete'];
$observacoes = $_POST['observacoes'];

// Receber produtos e quantidades
$produtos = $_POST['produto_id'];
$quantidades = $_POST['quantidade'];

try {

    // Iniciar transação no banco de dados
	$pdo->beginTransaction();

    // Inserir os dados principais do frete
	$sql = "INSERT INTO fretes
	(transportador_id, origem_id, destino_id, data_frete, status, valor_frete, observacoes)
	VALUES
	(:transportador_id, :origem_id, :destino_id, :data_frete, :status, :valor_frete, :observacoes)";

	$comando = $pdo->prepare($sql);

	$comando->execute([
		':transportador_id' => $transportador_id,
		':origem_id' => $origem_id,
		':destino_id' => $destino_id,
		':data_frete' => $data_frete,
		':status' => $status,
		':valor_frete' => $valor_frete,
		':observacoes' => $observacoes
	]);

    // Recuperar o ID do frete cadastrado
	$frete_id = $pdo->lastInsertId();

        // Inserir os produtos relacionados ao frete
	$sql_produto = "INSERT INTO frete_produtos
	(frete_id, produto_id, quantidade)
	VALUES
	(:frete_id, :produto_id, :quantidade)";

	$comando_produto = $pdo->prepare($sql_produto);

	foreach ($produtos as $indice => $produto_id) {

		$comando_produto->execute([
			':frete_id' => $frete_id,
			':produto_id' => $produto_id,
			':quantidade' => $quantidades[$indice]
		]);

	}

	    // Confirmar todas as operações
	$pdo->commit();

    // Redirecionar após o cadastro
	header("Location: index.php?cadastro=sucesso");
	exit;

} catch (PDOException $erro) {

    // Desfazer operações caso ocorra algum erro
	if ($pdo->inTransaction()) {
		$pdo->rollBack();
	}

	die("Erro ao cadastrar frete: " . $erro->getMessage());

}