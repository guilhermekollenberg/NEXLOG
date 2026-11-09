<?php

require_once '../config/conexao.php';

// Receber o ID do transportador

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Excluir o transportador do banco de dados

    $sql = "DELETE FROM transportadores WHERE id = :id";

    try {

        $comando = $pdo->prepare($sql);

        $comando->execute([
            ':id' => $id
        ]);

        header("Location: index.php?exclusao=sucesso");
        exit;

    } catch (PDOException $erro) {

        die("Erro ao excluir transportador: " . $erro->getMessage());

    }

} else {

    die("ID do transportador não informado.");

}