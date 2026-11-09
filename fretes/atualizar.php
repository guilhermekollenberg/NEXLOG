<?php

require_once '../config/conexao.php';

$id = $_POST['id'];
$data_frete = $_POST['data_frete'];
$status = $_POST['status'];
$valor_frete = $_POST['valor_frete'];
$observacoes = $_POST['observacoes'];

$sql = "UPDATE fretes SET
        data_frete = :data_frete,
        status = :status,
        valor_frete = :valor_frete,
        observacoes = :observacoes
        WHERE id = :id";

try {

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':data_frete' => $data_frete,
        ':status' => $status,
        ':valor_frete' => $valor_frete,
        ':observacoes' => $observacoes,
        ':id' => $id
    ]);

    header("Location: index.php?edicao=sucesso");
    exit;

} catch (PDOException $erro) {

    die("Erro ao atualizar frete: " . $erro->getMessage());

}