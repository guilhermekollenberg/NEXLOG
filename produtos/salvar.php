<?php

require_once '../config/conexao.php';

// Receber os dados enviados pelo formulário

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$peso = $_POST['peso'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

// Preparar o comando SQL

$sql = "INSERT INTO produtos
(nome, descricao, peso, quantidade, valor)
VALUES
(:nome, :descricao, :peso, :quantidade, :valor)";

try {

	$comando = $pdo->prepare($sql);

	$comando->execute([
	':nome' => $nome,
	':descricao' => $descricao,
	':peso' => $peso,
	':quantidade' => $quantidade,
	':valor' => $valor
	]);

	// Voltar para a página de produtos

	header("Location: index.php?cadastro=sucesso");
	exit;

} catch (PDOException $erro) {

	die("Erro ao cadastrar produto: " . $erro->getMessage());

}