<?php

require_once '../config/conexao.php';

// Receber os dados enviados pelo formulário

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$peso = $_POST['peso'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

// Atualizar o produto no banco de dados

$sql = "UPDATE produtos SET
nome = :nome,
descricao = :descricao,
peso = :peso,
quantidade = :quantidade,
valor = :valor
WHERE id = :id";

try {

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':peso' => $peso,
        ':quantidade' => $quantidade,
        ':valor' => $valor
    ]);

    header("Location: index.php?edicao=sucesso");
    exit;

} catch (PDOException $erro) {

    die("Erro ao atualizar produto: " . $erro->getMessage());

}

?>