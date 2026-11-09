<?php

require_once '../config/conexao.php';

// Buscar os endereços cadastrados

$sql = "SELECT * FROM enderecos ORDER BY id DESC";

$consulta = $pdo->query($sql);

$enderecos = $consulta->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>NEXLOG | Endereços</title>

	<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

	<aside class="sidebar">

		<div class="logo">NEX<span>LOG</span></div>

		<div class="menu">

			<p class="menu-titulo">MENU PRINCIPAL</p>

			<a href="../index.php">Dashboard</a>
			<a href="../produtos/index.php">Produtos</a>
			<a href="../transportadores/index.php">Transportadores</a>
			<a href="index.php" class="ativo">Endereços</a>
			<a href="../fretes/index.php">Fretes</a>

			<p class="menu-titulo">GERENCIAMENTO</p>

			<a href="../relatorios/index.php">Relatórios</a>

		</div>

	</aside>

	<main class="main-content">
		<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso'): ?>

			<p class="mensagem-sucesso">
				Endereço cadastrado com sucesso!
			</p>

		<?php endif; ?>
		
		<?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'sucesso'): ?>
			<p class="mensagem-sucesso">
				Endereço excluído com sucesso!
			</p>
		<?php endif; ?>

		<header class="topbar">

			<h1>Cadastro de Endereços</h1>

			<div class="usuario">Administrador</div>

		</header>

		<section class="painel">

			<h2>Informações do Endereço</h2>

			<form action="salvar.php" method="POST">

				<div class="campo">
					<label>Identificação do endereço</label>
					<input type="text" name="nome" class="form-control"
					placeholder="Ex.: Matriz, Depósito, Cliente" required>
				</div>

				<div class="campo">
					<label>Tipo de endereço</label>
					<select name="tipo" class="form-select" required>
						<option value="">Selecione</option>
						<option value="Origem">Origem</option>
						<option value="Destino">Destino</option>
					</select>
				</div>

				<div class="campo">
					<label>CEP</label>
					<input type="text" name="cep" class="form-control" placeholder="Digite o CEP">
				</div>

				<div class="campo">
					<label>Rua</label>
					<input type="text" name="rua" class="form-control"
					placeholder="Digite o nome da rua" required>
				</div>

				<div class="campo">
					<label>Número</label>
					<input type="text" name="numero" class="form-control"
					placeholder="Número do endereço">
				</div>

				<div class="campo">
					<label>Complemento</label>
					<input type="text" name="complemento" class="form-control"
					placeholder="Ex.: Sala 2, Bloco A">
				</div>

				<div class="campo">
					<label>Bairro</label>
					<input type="text" name="bairro" class="form-control"
					placeholder="Digite o bairro">
				</div>

				<div class="campo">
					<label>Cidade</label>
					<input type="text" name="cidade" class="form-control"
					placeholder="Digite a cidade" required>
				</div>

				<div class="campo">
					<label>Estado (UF)</label>
					<input type="text" name="estado" class="form-control" maxlength="2"
					placeholder="Ex.: PR" required>
				</div>

				<button type="submit" class="btn btn-primary">Cadastrar Endereço</button>

			</form>

		</section>

		<section class="painel">

			<h2>Endereços Cadastrados</h2>

			<table>

				<thead>
					<tr>
						<th>ID</th>
						<th>Identificação</th>
						<th>Tipo</th>
						<th>CEP</th>
						<th>Rua</th>
						<th>Número</th>
						<th>Bairro</th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>

					<?php foreach ($enderecos as $endereco): ?>

						<tr>
							<td><?= $endereco['id'] ?></td>
							<td><?= htmlspecialchars($endereco['nome']) ?></td>
							<td><?= htmlspecialchars($endereco['tipo']) ?></td>
							<td><?= htmlspecialchars($endereco['cep']) ?></td>
							<td><?= htmlspecialchars($endereco['rua']) ?></td>
							<td><?= htmlspecialchars($endereco['numero']) ?></td>
							<td><?= htmlspecialchars($endereco['bairro']) ?></td>
							<td><?= htmlspecialchars($endereco['cidade']) ?></td>
							<td><?= htmlspecialchars($endereco['estado']) ?></td>
							<td>
								<a href="editar.php?id=<?= $endereco['id'] ?>" style="color: #2563eb;">
									Editar
								</a>

								<a href="excluir.php?id=<?= $endereco['id'] ?>"
									style="color: #dc2626;"
									onclick="return confirm('Tem certeza que deseja excluir este endereço?')">
									Excluir
								</a>
							</td>
						</tr>

					<?php endforeach; ?>

				</tbody>

			</table>

		</section>