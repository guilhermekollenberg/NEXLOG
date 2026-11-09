<?php

require_once '../config/conexao.php';

$id = $_GET['id'];

try {

    // Excluir os produtos vinculados ao frete
    $sql = "DELETE FROM frete_produtos WHERE frete_id = :id";
    $comando = $pdo->prepare($sql);
    $comando->execute([':id' => $id]);

    // Excluir o frete
    $sql = "DELETE FROM fretes WHERE id = :id";
    $comando = $pdo->prepare($sql);
    $comando->execute([':id' => $id]);

    header("Location: index.php?exclusao=sucesso");
    exit;

} catch (PDOException $erro) {

    die("Erro ao excluir frete: " . $erro->getMessage());

}