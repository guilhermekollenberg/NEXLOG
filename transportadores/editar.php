<?php

require_once '../config/conexao.php';

// Verificar se o ID foi informado

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Buscar o transportador pelo ID

    $sql = "SELECT * FROM transportadores WHERE id = :id";

    $consulta = $pdo->prepare($sql);

    $consulta->execute([':id' => $id]);

    $transportador = $consulta->fetch();

    if (!$transportador) {
        die("Transportador não encontrado.");
    }

} else {

    die("ID do transportador não informado.");

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NEXLOG | Editar Transportador</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <main class="main-content">

        <header class="topbar">
            <h1>Editar Transportador</h1>
            <div class="usuario">Administrador</div>
        </header>

        <section class="painel">

            <h2>Alterar Informações do Transportador</h2>

            <form action="atualizar.php" method="POST">

                <input type="hidden" name="id"
                value="<?= $transportador['id'] ?>">

                <div class="campo">
                    <label>Nome do transportador</label>
                    <input type="text" name="nome"
                    value="<?= htmlspecialchars($transportador['nome']) ?>"
                    required>
                </div>

                <div class="campo">
                    <label>CPF ou CNPJ</label>
                    <input type="text" name="cpf_cnpj"
                    value="<?= htmlspecialchars($transportador['cpf_cnpj'] ?? '') ?>">
                </div>

                <div class="campo">
                    <label>Telefone</label>
                    <input type="text" name="telefone"
                    value="<?= htmlspecialchars($transportador['telefone'] ?? '') ?>">
                </div>

                <div class="campo">
                    <label>E-mail</label>
                    <input type="email" name="email"
                    value="<?= htmlspecialchars($transportador['email'] ?? '') ?>">
                </div>

                <div class="campo">
                    <label>Veículo utilizado</label>
                    <input type="text" name="veiculo"
                    value="<?= htmlspecialchars($transportador['veiculo'] ?? '') ?>">
                </div>

                <div class="campo">
                    <label>Placa do veículo</label>
                    <input type="text" name="placa"
                    value="<?= htmlspecialchars($transportador['placa'] ?? '') ?>"
                    maxlength="10">
                </div>

                <button type="submit">Salvar Alterações</button>

                <a href="index.php">Voltar</a>

            </form>

        </section>

    </main>

</body>
</html>