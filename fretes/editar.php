<?php

require_once '../config/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Buscar os dados do frete
$sql = "SELECT * FROM fretes WHERE id = :id";
$comando = $pdo->prepare($sql);
$comando->execute([':id' => $id]);

$frete = $comando->fetch();

if (!$frete) {
    header("Location: index.php");
    exit;
}

// Buscar produtos vinculados ao frete
$sql = "SELECT produto_id, quantidade
FROM frete_produtos
WHERE frete_id = :id";

$comando = $pdo->prepare($sql);
$comando->execute([':id' => $id]);

$produtos_frete = $comando->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXLOG | Editar Frete</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <aside class="sidebar">
        <div class="logo">NEX<span>LOG</span></div>

        <div class="menu-titulo">Menu Principal</div>

        <nav class="menu">
            <a href="../index.php">Dashboard</a>
            <a href="../produtos/index.php">Produtos</a>
            <a href="../transportadores/index.php">Transportadores</a>
            <a href="../enderecos/index.php">Endereços</a>
            <a href="index.php" class="ativo">Fretes</a>
            <a href="../relatorios/index.php">Relatórios</a>
        </nav>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <h1>Editar Frete</h1>
            <div class="usuario">Administrador</div>
        </header>

        <section class="painel">

            <h2>Informações do Frete</h2>

            <form action="atualizar.php" method="POST">

                <input type="hidden" name="id" value="<?= $frete['id'] ?>">

                <div class="campo">
                    <label>Data do Frete</label>
                    <input type="date" name="data_frete"
                    value="<?= $frete['data_frete'] ?>" required>
                </div>

                <div class="campo">
                    <label>Status do Frete</label>
                    <select name="status" required>
                        <option value="Pendente" <?= $frete['status'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="Em andamento" <?= $frete['status'] == 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                        <option value="Concluido" <?= $frete['status'] == 'Concluido' ? 'selected' : '' ?>>Concluído</option>
                        <option value="Cancelado" <?= $frete['status'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                </div>

                <div class="campo">
                    <label>Valor do Frete (R$)</label>
                    <input type="number" name="valor_frete"
                    step="0.01" min="0.01"
                    value="<?= $frete['valor_frete'] ?>" required>
                </div>

                <div class="campo">
                    <label>Observações</label>
                    <textarea name="observacoes"><?= htmlspecialchars($frete['observacoes'] ?? '') ?></textarea>
                </div>

                <button type="submit">Salvar Alterações</button>

            </form>

        </section>

    </main>

</body>
</html>