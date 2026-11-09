<?php

require_once '../config/conexao.php';

// Buscar transportadores cadastrados
$sql = "SELECT * FROM transportadores ORDER BY nome ASC";
$consulta = $pdo->query($sql);
$transportadores = $consulta->fetchAll();

// Buscar endereços de origem
$sql = "SELECT * FROM enderecos WHERE tipo = 'Origem' ORDER BY nome ASC";
$consulta = $pdo->query($sql);
$origens = $consulta->fetchAll();

// Buscar endereços de destino
$sql = "SELECT * FROM enderecos WHERE tipo = 'Destino' ORDER BY nome ASC";
$consulta = $pdo->query($sql);
$destinos = $consulta->fetchAll();

// Buscar produtos cadastrados
$sql = "SELECT * FROM produtos ORDER BY nome ASC";
$consulta = $pdo->query($sql);
$produtos = $consulta->fetchAll();

// Buscar fretes cadastrados
$sql = "SELECT
f.*,
t.nome AS transportador,
o.nome AS origem,
d.nome AS destino
FROM fretes f
INNER JOIN transportadores t ON f.transportador_id = t.id
INNER JOIN enderecos o ON f.origem_id = o.id
INNER JOIN enderecos d ON f.destino_id = d.id
ORDER BY f.id DESC";

$consulta = $pdo->query($sql);
$fretes = $consulta->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NEXLOG | Cadastro de Fretes</title>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

	<aside class="sidebar">

		<div class="logo">NEX<span>LOG</span></div>

		<nav class="menu">

			<p class="menu-titulo">Principal</p>

			<a href="../index.php">Dashboard</a>

			<p class="menu-titulo">Gerenciamento</p>

			<a href="../produtos/index.php">Produtos</a>
			<a href="../transportadores/index.php">Transportadores</a>
			<a href="../enderecos/index.php">Endereços</a>
			<a href="index.php" class="ativo">Fretes</a>

			<p class="menu-titulo">Relatórios</p>

			<a href="../relatorios/index.php">Relatórios</a>

		</nav>

	</aside>

	<main class="main-content">

		<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso'): ?>
			<p class="mensagem-sucesso">
				Frete cadastrado com sucesso!
			</p>
		<?php endif; ?>

		<?php if (isset($_GET['edicao']) && $_GET['edicao'] == 'sucesso'): ?>
			<p class="mensagem-sucesso">
				Frete atualizado com sucesso!
			</p>
		<?php endif; ?>

		<?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'sucesso'): ?>
			<p class="mensagem-sucesso">
				Frete excluído com sucesso!
			</p>
		<?php endif; ?>

		<header class="topbar">

			<h1>Cadastro de Fretes</h1>

			<div class="usuario">Administrador</div>

		</header>

		<section class="painel">

			<h2>Informações do Frete</h2>

			<form action="salvar.php" method="POST">

				<div class="campo">

					<label>Transportador</label>

					<select name="transportador_id" class="form-select" required>

						<option value="">Selecione um transportador</option>

						<?php foreach ($transportadores as $transportador): ?>

							<option value="<?= $transportador['id'] ?>">
								<?= htmlspecialchars($transportador['nome']) ?>
							</option>

						<?php endforeach; ?>

					</select>

				</div>

				<div class="campo">

					<label>Endereço de Origem</label>

					<select name="origem_id" class="form-select" required>

						<option value="">Escolha o local de origem</option>

						<?php foreach ($origens as $origem): ?>

							<option value="<?= $origem['id'] ?>">
								<?= htmlspecialchars($origem['nome']) ?> -
								<?= htmlspecialchars($origem['cidade']) ?>/<?= htmlspecialchars($origem['estado']) ?>
							</option>

						<?php endforeach; ?>

					</select>

				</div>

				<div class="campo">

					<label>Endereço de Destino</label>

					<select name="destino_id" class="form-select" required>

						<option value="">Escolha o local de destino</option>

						<?php foreach ($destinos as $destino): ?>

							<option value="<?= $destino['id'] ?>">
								<?= htmlspecialchars($destino['nome']) ?> -
								<?= htmlspecialchars($destino['cidade']) ?>/<?= htmlspecialchars($destino['estado']) ?>
							</option>

						<?php endforeach; ?>

						<!-- DATA DO FRETE -->
						<div class="campo">
							<label>Data do Frete</label>
							<input type="date" name="data_frete" class="form-control" required>
						</div>

						<!-- STATUS DO FRETE -->
						<div class="campo">
							<label>Status do Frete</label>

							<select name="status" class="form-select" required>
								<option value="Pendente">Pendente</option>
								<option value="Em andamento">Em andamento</option>
								<option value="Concluido">Concluído</option>
								<option value="Cancelado">Cancelado</option>
							</select>
						</div>

						<!-- VALOR DO FRETE -->
						<div class="campo">
							<label>Valor do Frete (R$)</label>

							<input type="number" class="form-control"
							name="valor_frete"
							step="0.01"
							min="0.01"
							placeholder="Ex.: 350.00"
							required>
						</div>

						<div class="campo">
							<label>Observações</label>

							<textarea name="observacoes" class="form-control"
							placeholder="Informações adicionais sobre o frete"></textarea>
						</div>

						<div class="painel">

							<h2>Produtos do Frete</h2>

							<div id="lista-produtos">

								<div class="produto-item">

									<div class="campo">
										<label>Produto</label>

										<select name="produto_id[]" class="form-select" required>

											<option value="">Selecione um produto</option>

											<?php foreach ($produtos as $produto): ?>

												<option value="<?= $produto['id'] ?>">
													<?= htmlspecialchars($produto['nome']) ?>
												</option>

											<?php endforeach; ?>

										</select>
									</div>

									<div class="campo">
										<label>Quantidade</label>

										<input type="number" name="quantidade[]" class="form-control" placeholder="Ex.: 2" required>
									</div>

								</div>

							</div>

							<button type="button" id="adicionar-produto" class="btn btn-secondary">
								+ Adicionar outro produto
							</button>

						</div>

						<div class="campo">
							<button type="submit" class="btn btn-primary">Cadastrar Frete</button>
						</div>

					</form>

				</section>

				<section class="painel">

					<h2>Fretes Cadastrados</h2>

					<table>

						<thead>
							<tr>
								<th>ID</th>
								<th>Transportador</th>
								<th>Origem</th>
								<th>Destino</th>
								<th>Data</th>
								<th>Status</th>
								<th>Valor</th>
								<th>Ações</th>
							</tr>
						</thead>

						<tbody>

							<?php foreach ($fretes as $frete): ?>

								<tr>
									<td><?= $frete['id'] ?></td>
									<td><?= htmlspecialchars($frete['transportador']) ?></td>
									<td><?= htmlspecialchars($frete['origem']) ?></td>
									<td><?= htmlspecialchars($frete['destino']) ?></td>
									<td><?= date('d/m/Y', strtotime($frete['data_frete'])) ?></td>
									<td><?= htmlspecialchars($frete['status']) ?></td>
									<td>R$ <?= number_format($frete['valor_frete'], 2, ',', '.') ?></td>
									<td>
										<a href="editar.php?id=<?= $frete['id'] ?>">Editar</a>

										<a href="excluir.php?id=<?= $frete['id'] ?>"
											onclick="return confirm('Deseja realmente excluir este frete?')"
											style="color: #dc2626;">
											Excluir
										</a>
									</td>
								</tr>

							<?php endforeach; ?>

						</tbody>

					</table>

				</section>

			</main>

			<script src="../assets/js/fretes.js"></script>

		</body>

		</html>