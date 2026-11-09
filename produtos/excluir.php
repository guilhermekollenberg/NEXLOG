<?php

require_once '../config/conexao.php';

// Verificar se o ID foi informado

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Excluir o produto do banco de dados

    $sql = "DELETE FROM produtos WHERE id = :id";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':id' => $id
    ]);

    header("Location: index.php?exclusao=sucesso");
    exit;

} else {

    die("ID do produto não informado.");

}

?>