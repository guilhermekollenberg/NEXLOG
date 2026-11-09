<?php

require_once '../config/conexao.php';

// Receber os dados enviados pelo formulário

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf_cnpj = $_POST['cpf_cnpj'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$veiculo = $_POST['veiculo'];
$placa = $_POST['placa'];

// Atualizar o transportador no banco de dados

$sql = "UPDATE transportadores SET
nome = :nome,
cpf_cnpj = :cpf_cnpj,
telefone = :telefone,
email = :email,
veiculo = :veiculo,
placa = :placa
WHERE id = :id";

try {

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':cpf_cnpj' => $cpf_cnpj,
        ':telefone' => $telefone,
        ':email' => $email,
        ':veiculo' => $veiculo,
        ':placa' => $placa
    ]);

    header("Location: index.php?edicao=sucesso");
    exit;

} catch (PDOException $erro) {

    die("Erro ao atualizar transportador: " . $erro->getMessage());

}