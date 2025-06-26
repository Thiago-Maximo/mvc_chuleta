<?php
require_once __DIR__ . '/model/connectPDO.php';
require_once __DIR__ . '/controller/PedidoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PedidoController($pdo);
    $controller->registrarPedido(
        $_POST['cliente'] ?? '',
        $_POST['mesa'] ?? '',
        $_POST['pedido'] ?? 0,
        $_POST['quantidade'] ?? 0
    );
} else {
    header('Location: view/pedido_form.php');
    exit;
}
