<?php
require_once 'config/conexao.php';

// Contar produtos cadastrados
$sql = "SELECT COUNT(*) FROM produtos";
$total_produtos = $pdo->query($sql)->fetchColumn();

// Contar transportadores cadastrados
$sql = "SELECT COUNT(*) FROM transportadores";
$total_transportadores = $pdo->query($sql)->fetchColumn();

// Contar fretes realizados
$sql = "SELECT COUNT(*) FROM fretes";
$total_fretes = $pdo->query($sql)->fetchColumn();

// Contar fretes pendentes
$sql = "SELECT COUNT(*) FROM fretes WHERE status = 'Pendente'";
$total_pendentes = $pdo->query($sql)->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NEXLOG | Gerenciamento Logístico</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- MENU LATERAL -->

    <aside class="sidebar">

        <div class="logo">
            NEX<span>LOG</span>
        </div>

        <div class="menu">

            <p class="menu-titulo">MENU PRINCIPAL</p>

            <a href="index.php" class="ativo">Dashboard</a>

            <a href="produtos/index.php">Produtos</a>

            <a href="transportadores/index.php">Transportadores</a>

            <a href="enderecos/index.php">Endereços</a>

            <a href="fretes/index.php">Fretes</a>

            <p class="menu-titulo">GERENCIAMENTO</p>

            <a href="relatorios/index.php">Relatórios</a>

        </div>

    </aside>


    <!-- CONTEÚDO PRINCIPAL -->

    <main class="main-content">

        <header class="topbar">

            <h1>Painel Administrativo</h1>

            <div class="usuario">
                Administrador
            </div>

        </header>


        <!-- INDICADORES -->

        <section class="cards">

            <div class="card">
                <h3>Produtos cadastrados</h3>
                <div class="numero"><?= $total_produtos ?></div>
            </div>

            <div class="card">
                <h3>Transportadores</h3>
                <div class="numero"><?= $total_transportadores ?></div>
            </div>

            <div class="card">
                <h3>Fretes realizados</h3>
                <div class="numero"><?= $total_fretes ?></div>
            </div>

            <div class="card">
                <h3>Fretes pendentes</h3>
                <div class="numero"><?= $total_pendentes ?></div>
            </div>

        </section>


        <!-- APRESENTAÇÃO -->

        <section class="painel">

            <h2>Bem-vindo ao NEXLOG!</h2>

            <p>
                Sistema de gerenciamento logístico desenvolvido
                para organizar produtos, transportadores,
                endereços e operações de frete.
            </p>

        </section>

    </main>

</body>
</html>