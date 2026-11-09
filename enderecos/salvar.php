<?php

require_once '../config/conexao.php';

// Receber os dados do formulário

$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = strtoupper($_POST['estado']);

// Preparar o comando SQL

$sql = "INSERT INTO enderecos
(nome, tipo, cep, rua, numero, complemento, bairro, cidade, estado)
VALUES
(:nome, :tipo, :cep, :rua, :numero, :complemento, :bairro, :cidade, :estado)";

try {

	$comando = $pdo->prepare($sql);

	$comando->execute([
		':nome' => $nome,
		':tipo' => $tipo,
		':cep' => $cep,
		':rua' => $rua,
		':numero' => $numero,
		':complemento' => $complemento,
		':bairro' => $bairro,
		':cidade' => $cidade,
		':estado' => $estado
	]);

	header("Location: index.php?cadastro=sucesso");
	exit;

} catch (PDOException $erro) {

	die("Erro ao cadastrar endereço: " . $erro->getMessage());

}