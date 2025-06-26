<?php
require_once __DIR__ . '/../model/PedidoModel.php';

class PedidoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new PedidoModel($pdo);
    }

    public function registrarPedido($cliente_nome, $mesa, $produto_id, $quantidade) {
        $cliente_nome = trim($cliente_nome);
        $mesa = trim($mesa);
        $produto_id = intval($produto_id);
        $quantidade = intval($quantidade);

        if ($cliente_nome === '' || $mesa === '' || $produto_id <= 0 || $quantidade <= 0) {
            die('Erro: Campos inválidos.');
        }

        $cliente_id = $this->model->obterOuCriarCliente($cliente_nome);
        $sucesso = $this->model->inserirPedido($cliente_id, $produto_id, $quantidade, $mesa);

        if ($sucesso) {
            header('Location: view/pedidos_lista.php?sucesso=1');
            exit;
        } else {
            die('Erro ao registrar pedido.');
        }
    }
}
