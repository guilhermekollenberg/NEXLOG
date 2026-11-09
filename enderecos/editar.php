<?php

require_once '../config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM enderecos WHERE id = :id";

$comando = $pdo->prepare($sql);
$comando->execute([':id' => $id]);

$endereco = $comando->fetch();

if (!$endereco) {
    die("Endereço não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXLOG | Editar Endereço</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <main class="main-content">

        <section class="painel">

            <h2>Editar Endereço</h2>

            <form action="atualizar.php" method="POST">

                <input type="hidden" name="id" value="<?= $endereco['id'] ?>">

                <div class="campo">
                    <label>Identificação do endereço</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($endereco['nome']) ?>" required>
                </div>

                <div class="campo">
                    <label>Tipo de endereço</label>
                    <select name="tipo" required>
                        <option value="Origem" <?= $endereco['tipo'] == 'Origem' ? 'selected' : '' ?>>Origem</option>
                        <option value="Destino" <?= $endereco['tipo'] == 'Destino' ? 'selected' : '' ?>>Destino</option>
                    </select>
                </div>

                <div class="campo">
                    <label>CEP</label>
                    <input type="text" name="cep" value="<?= htmlspecialchars($endereco['cep']) ?>">
                </div>

                <div class="campo">
                    <label>Rua</label>
                    <input type="text" name="rua" value="<?= htmlspecialchars($endereco['rua']) ?>" required>
                </div>

                <div class="campo">
                    <label>Número</label>
                    <input type="text" name="numero" value="<?= htmlspecialchars($endereco['numero']) ?>">
                </div>

                <div class="campo">
                    <label>Complemento</label>
                    <input type="text" name="complemento" value="<?= htmlspecialchars($endereco['complemento']) ?>">
                </div>

                <div class="campo">
                    <label>Bairro</label>
                    <input type="text" name="bairro" value="<?= htmlspecialchars($endereco['bairro']) ?>">
                </div>

                <div class="campo">
                    <label>Cidade</label>
                    <input type="text" name="cidade" value="<?= htmlspecialchars($endereco['cidade']) ?>" required>
                </div>

                <div class="campo">
                    <label>Estado (UF)</label>
                    <input type="text" name="estado" maxlength="2" value="<?= htmlspecialchars($endereco['estado']) ?>" required>
                </div>

                <button type="submit">Salvar Alterações</button>

                <a href="index.php">Voltar</a>

            </form>

        </section>

    </main>

</body>
</html>