<?php
session_name('chulettaaa');
session_start();

require_once __DIR__ . '/../../model/connectPDO.php';

if (!isset($_SESSION['cliente_id'])) {
    header("Location: ../admin/login.php");
    exit;
}

$cliente_id = $_SESSION['cliente_id'];

$sql = "
    SELECT v.id AS pedido_id, v.data_venda, v.quantidade, 
           p.descricao AS produto, p.valor, (p.valor * v.quantidade) AS total
    FROM vendas v
    INNER JOIN produtos p ON v.produto_id = p.id
    WHERE v.cliente_id = :cliente_id
    ORDER BY v.data_venda DESC
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT);
$stmt->execute();
$pedidos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="fundofixo">
    <div class="container">
        <h2 class="breadcrumb alert-info">Meus Pedidos</h2>

        <?php if (count($pedidos) === 0): ?>
            <div class="alert alert-warning">Você ainda não fez nenhum pedido.</div>
        <?php else: ?>
            <table class="table table-bordered table-hover">
                <thead class="alert-info">
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Produto</th>
                        <th>Qtd</th>
                        <th>Valor Unitário</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?php echo $pedido['pedido_id']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_venda'])); ?></td>
                            <td><?php echo $pedido['produto']; ?></td>
                            <td><?php echo $pedido['quantidade']; ?></td>
                            <td>R$ <?php echo number_format($pedido['valor'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="area_cliente.php" class="btn btn-primary">Voltar para Área do Cliente</a>
    </div>
</body>
</html>
