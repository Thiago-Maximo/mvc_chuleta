<?php
class PedidoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obterOuCriarCliente($nome) {
        $stmt = $this->pdo->prepare("SELECT id FROM clientes WHERE nome = :nome LIMIT 1");
        $stmt->execute([':nome' => $nome]);
        $cliente = $stmt->fetch();

        if ($cliente) {
            return $cliente['id'];
        }

        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome) VALUES (:nome)");
        $stmt->execute([':nome' => $nome]);
        return $this->pdo->lastInsertId();
    }

    public function inserirPedido($cliente_id, $produto_id, $quantidade, $mesa) {
        $stmt = $this->pdo->prepare("INSERT INTO vendas (cliente_id, produto_id, quantidade, mesa, data_venda) VALUES (:cliente_id, :produto_id, :quantidade, :mesa, NOW())");
        return $stmt->execute([
            ':cliente_id' => $cliente_id,
            ':produto_id' => $produto_id,
            ':quantidade' => $quantidade,
            ':mesa' => $mesa
        ]);
    }
}
