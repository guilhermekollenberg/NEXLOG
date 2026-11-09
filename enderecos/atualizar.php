<?php

require_once '../config/conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = strtoupper($_POST['estado']);

$sql = "UPDATE enderecos SET
nome = :nome,
tipo = :tipo,
cep = :cep,
rua = :rua,
numero = :numero,
complemento = :complemento,
bairro = :bairro,
cidade = :cidade,
estado = :estado
WHERE id = :id";

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
        ':estado' => $estado,
        ':id' => $id
    ]);

    header("Location: index.php?edicao=sucesso");
    exit;

} catch (PDOException $erro) {

    die("Erro ao atualizar endereço: " . $erro->getMessage());

}