<?php
require_once '../config/conexao.php';

// Buscar todos os produtos cadastrados

$sql = "SELECT * FROM produtos ORDER BY id DESC";

$consulta = $pdo->query($sql);

$produtos = $consulta->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXLOG | Produtos</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body> 
    <aside class="sidebar">

        <div class="logo">NEX<span>LOG</span></div>

        <div class="menu">

            <p class="menu-titulo">MENU PRINCIPAL</p>

            <a href="../index.php">Dashboard</a>
            <a href="index.php" class="ativo">Produtos</a>
            <a href="../transportadores/index.php">Transportadores</a>
            <a href="../enderecos/index.php">Endereços</a>
            <a href="../fretes/index.php">Fretes</a>

            <p class="menu-titulo">GERENCIAMENTO</p>

            <a href="../relatorios/index.php">Relatórios</a>

        </div>

    </aside>

    <main class="main-content">
        <?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso'): ?>

            <p class="mensagem-sucesso">
                Produto cadastrado com sucesso!
            </p>

        <?php endif; ?>

        <header class="topbar">

            <h1>Cadastro de Produtos</h1>

            <div class="usuario">Administrador</div>

        </header><section class="painel">

            <h2>Informações do Produto</h2>

            <form action="salvar.php" method="POST">

                <div class="campo">
                    <label for="nome">Nome do produto:</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                    placeholder="Digite o nome do produto" required>
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" placeholder="Descreva o produto"></textarea>
                </div>

                <div class="campo">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" name="peso" id="peso" class="form-control" step="0.01" placeholder="Ex.: 2.50" required>
                </div>

                <div class="campo">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Ex.: 10" required>
                </div>

                <div class="campo">
                    <label for="valor">Valor (R$)</label>
                    <input type="number" name="valor" id="valor" class="form-control" step="0.01" placeholder="Ex.: 1500.00" required>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Produto</button>

            </form>

        </section>
        <section class="painel">

            <h2>Produtos Cadastrados</h2>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Peso (kg)</th>
                        <th>Quantidade</th>
                        <th>Valor (R$)</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($produtos as $produto): ?>

                        <tr>
                            <td><?= $produto['id'] ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= $produto['peso'] ?></td>
                            <td><?= $produto['quantidade'] ?></td>
                            <td>R$ <?= number_format($produto['valor'], 2, ',', '.') ?></td>
                            <td>
                                <a href="editar.php?id=<?= $produto['id'] ?>">
                                    Editar
                                </a>

                                <a href="excluir.php?id=<?= $produto['id'] ?>"
                                 onclick="return confirm('Tem certeza que deseja excluir este produto?');">
                                 Excluir
                             </a>
                         </td>
                     </tr>

                 <?php endforeach; ?>

             </tbody>

         </table>

     </section>

 </main>
</body>
</html>