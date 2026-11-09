<?php

require_once '../config/conexao.php';

// Receber os dados enviados pelo formulário

$nome = $_POST['nome'];
$cpf_cnpj = $_POST['cpf_cnpj'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$veiculo = $_POST['veiculo'];
$placa = $_POST['placa'];

// Preparar o comando SQL

$sql = "INSERT INTO transportadores
        (nome, cpf_cnpj, telefone, email, veiculo, placa)
        VALUES
        (:nome, :cpf_cnpj, :telefone, :email, :veiculo, :placa)";

try {

	$comando = $pdo->prepare($sql);

	$comando->execute([
    ':nome' => $nome,
    ':cpf_cnpj' => $cpf_cnpj,
    ':telefone' => $telefone,
    ':email' => $email,
    ':veiculo' => $veiculo,
    ':placa' => $placa
]);

	header("Location: index.php?cadastro=sucesso");
	exit;

} catch (PDOException $erro) {

	die("Erro ao cadastrar transportador: " . $erro->getMessage());

}