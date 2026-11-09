<?php
require_once '../config/conexao.php';
// Buscar todos os transportadores cadastrados

$sql = "SELECT * FROM transportadores ORDER BY id DESC";

$consulta = $pdo->query($sql);

$transportadores = $consulta->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NEXLOG | Transportadores</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <aside class="sidebar">

        <div class="logo">NEX<span>LOG</span></div>

        <div class="menu">

            <p class="menu-titulo">MENU PRINCIPAL</p>

            <a href="../index.php">Dashboard</a>
            <a href="../produtos/index.php">Produtos</a>
            <a href="index.php" class="ativo">Transportadores</a>
            <a href="../enderecos/index.php">Endereços</a>
            <a href="../fretes/index.php">Fretes</a>

            <p class="menu-titulo">GERENCIAMENTO</p>

            <a href="../relatorios/index.php">Relatórios</a>

        </div>

    </aside>

    <main class="main-content">
        <?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso'): ?>

            <p class="mensagem-sucesso">
                Transportador cadastrado com sucesso!
            </p>

        <?php endif; ?>

        <header class="topbar">

            <h1>Cadastro de Transportadores</h1>

            <div class="usuario">Administrador</div>

        </header>
        <section class="painel">

            <h2>Informações do Transportador</h2>

            <form action="salvar.php" method="POST">

                <div class="campo">
                    <label>Nome do transportador</label>
                    <input type="text" name="nome" class="form-control"
                    placeholder="Digite o nome completo" required>
                </div>

                <div class="campo">
                    <label>CPF ou CNPJ</label>
                    <input type="text" name="cpf_cnpj" class="form-control"
                    placeholder="Digite o CPF ou CNPJ">
                </div>

                <div class="campo">
                    <label>Telefone</label>
                    <input type="text" name="telefone" class="form-control"
                    placeholder="Digite o telefone">
                </div>

                <div class="campo">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control"
                    placeholder="Digite o e-mail">
                </div>

                <div class="campo">
                    <label>Veículo utilizado</label>
                    <input type="text" name="veiculo" class="form-control"
                    placeholder="Ex.: Caminhão, Van, Carreta">
                </div>

                <div class="campo">
                    <label>Placa do veículo</label>
                    <input type="text" name="placa" class="form-control"
                    placeholder="Ex.: ABC1D23"
                    maxlength="10">
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Transportador</button>

            </form>

        </section>
        <section class="painel">

            <h2>Transportadores Cadastrados</h2>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Veículo</th>
                        <th>Placa</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($transportadores as $transportador): ?>

                        <tr>
                            <td><?= $transportador['id'] ?></td>
                            <td><?= htmlspecialchars($transportador['nome']) ?></td>
                            <td><?= htmlspecialchars($transportador['cpf_cnpj'] ?? '') ?></td>
                            <td><?= htmlspecialchars($transportador['telefone'] ?? '') ?></td>
                            <td><?= htmlspecialchars($transportador['email'] ?? '') ?></td>
                            <td><?= htmlspecialchars($transportador['veiculo'] ?? '') ?></td>
                            <td><?= htmlspecialchars($transportador['placa'] ?? '') ?></td>
                            
                            <td>
                                <a href="editar.php?id=<?= $transportador['id'] ?>"
                                   style="color: #2563eb; font-weight: bold;">
                                   Editar
                               </a>

                               <a href="excluir.php?id=<?= $transportador['id'] ?>"
                                   style="color: red; font-weight: bold; margin-left: 12px;"
                                   onclick="return confirm('Tem certeza que deseja excluir este transportador?');">
                                   Excluir
                               </a>
                           </td>
                       </td>
                   </tr>

               <?php endforeach; ?>

           </tbody>

       </table>

   </section>

</main>

</body>
</html>