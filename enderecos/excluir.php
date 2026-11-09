<?php

require_once '../config/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM enderecos WHERE id = :id";

try {

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':id' => $id
    ]);

    header("Location: index.php?exclusao=sucesso");
    exit;

} catch (PDOException $erro) {

    if ($erro->getCode() == '23000') {
        die("Não foi possível excluir este endereço porque ele está vinculado a um ou mais fretes cadastrados.");
    }

    die("Ocorreu um erro ao excluir o endereço.");

}