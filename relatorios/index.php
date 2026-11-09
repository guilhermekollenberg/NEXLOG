<?php
require_once '../config/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - NEXLOG</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <aside class="sidebar">
        <div class="logo">NEX<span>LOG</span></div>

        <p class="menu-titulo">Menu principal</p>

        <nav class="menu">
            <a href="../index.php">Dashboard</a>
            <a href="../produtos/index.php">Produtos</a>
            <a href="../transportadores/index.php">Transportadores</a>
            <a href="../enderecos/index.php">Endereços</a>
            <a href="../fretes/index.php">Fretes</a>
            <a href="index.php" class="ativo">Relatórios</a>
        </nav>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <h1>Relatórios</h1>
            <div class="usuario">Sistema de Gestão Logística</div>
        </div>

        <div class="painel">
            <h2>Relatório de Fretes por Data</h2>

            <p>
                Selecione uma data para gerar o relatório dos fretes cadastrados.
            </p>

            <form action="baixar.php" method="GET">

                <div class="campo">
                    <label for="data_frete">Data dos fretes:</label>
                    <input type="date" name="data_frete" id="data_frete" required>
                </div>

                <button type="submit">Baixar Relatório</button>

            </form>
        </div>

    </main>

</body>
</html>