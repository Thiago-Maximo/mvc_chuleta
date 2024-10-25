<?php
require_once __DIR__ . '/../model/connectPDO.php';
require_once __DIR__ . '/../model/ListarProdutos_admin.php';


class ListarProdutos_admin {
    private $lista;

    public function __construct($pdo) {
        $this->lista = new ListaAdmin($pdo);
    }

    public function obterProdutos() {
        return $this->lista->listarProdutos();
    }

    public function contarProdutos() {
        return $this->lista->getNumLinhas();
    }

    public function proximoProduto() {
        return $this->lista->fetchAssoc();
    }
}
?>
