<?php

require_once '../config/conexao.php';

// Receber a data selecionada
$data_frete = $_GET['data_frete'] ?? '';

if (empty($data_frete)) {
    die("Selecione uma data para gerar o relatório.");
}

// Buscar os fretes da data selecionada
$sql = "SELECT
f.id,
f.data_frete,
t.nome AS transportador,
o.nome AS origem,
d.nome AS destino,
f.status,
f.valor_frete
FROM fretes f
INNER JOIN transportadores t ON f.transportador_id = t.id
INNER JOIN enderecos o ON f.origem_id = o.id
INNER JOIN enderecos d ON f.destino_id = d.id
WHERE f.data_frete = :data_frete
ORDER BY f.id ASC";

$comando = $pdo->prepare($sql);
$comando->execute([':data_frete' => $data_frete]);

$fretes = $comando->fetchAll();

// Configurar o download do arquivo CSV
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="relatorio_fretes.csv"');

$arquivo = fopen('php://output', 'w');

// Adicionar BOM para compatibilidade com Excel
fwrite($arquivo, "\xEF\xBB\xBF");

// Cabeçalho do relatório
fputcsv($arquivo, [
    'ID',
    'Data',
    'Transportador',
    'Origem',
    'Destino',
    'Status',
    'Valor do Frete'
], ';');

// Adicionar os dados dos fretes
foreach ($fretes as $frete) {
    fputcsv($arquivo, [
        $frete['id'],
        date('d/m/Y', strtotime($frete['data_frete'])),
        $frete['transportador'],
        $frete['origem'],
        $frete['destino'],
        $frete['status'],
        number_format($frete['valor_frete'], 2, ',', '.')
    ], ';');
}

fclose($arquivo);
exit;