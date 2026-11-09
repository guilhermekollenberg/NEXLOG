<?php

require_once '../config/conexao.php';

// Verificar se foi enviado um ID

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Buscar o produto pelo ID

    $sql = "SELECT * FROM produtos WHERE id = :id";

    $consulta = $pdo->prepare($sql);

    $consulta->execute([':id' => $id]);

    $produto = $consulta->fetch();

    if (!$produto) {
        die("Produto não encontrado.");
    }

} else {

    die("ID do produto não informado.");

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NEXLOG | Editar Produto</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <main class="main-content">

        <header class="topbar">
            <h1>Editar Produto</h1>
            <div class="usuario">Administrador</div>
        </header>

        <section class="painel">

            <h2>Alterar Informações do Produto</h2>

            <form action="atualizar.php" method="POST">

                <input type="hidden" name="id"
                       value="<?= $produto['id'] ?>">

                <div class="campo">
                    <label>Nome do produto</label>
                    <input type="text" name="nome"
                           value="<?= htmlspecialchars($produto['nome']) ?>"
                           required>
                </div>

                <div class="campo">
                    <label>Descrição</label>
                    <textarea name="descricao"><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>
                </div>

                <div class="campo">
                    <label>Peso (kg)</label>
                    <input type="number" name="peso" step="0.01"
                           value="<?= $produto['peso'] ?>" required>
                </div>

                <div class="campo">
                    <label>Quantidade</label>
                    <input type="number" name="quantidade"
                           value="<?= $produto['quantidade'] ?>" required>
                </div>

                <div class="campo">
                    <label>Valor (R$)</label>
                    <input type="number" name="valor" step="0.01"
                           value="<?= $produto['valor'] ?>" required>
                </div>

                <button type="submit">Salvar Alterações</button>

                <a href="index.php">Voltar</a>

            </form>

        </section>

    </main>

</body>
</html>