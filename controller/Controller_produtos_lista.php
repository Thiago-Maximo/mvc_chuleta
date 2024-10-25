<?php
require_once __DIR__ . '/../model/connectPDO.php';
require_once __DIR__ . '/../model/ListarProdutos_admin.php';


class ListarProdutos_admin {
    private $lista;

    public function __construct($pdo) {//conexão com o banco de dados
        $this->lista = new ListaAdmin($pdo);
    }

    public function obterProdutos() {//recebendo uma função da classe
        return $this->lista->listarProdutos();
    }

    public function contarProdutos() {//recebendo uma função da classe
        return $this->lista->getNumLinhas();
    }

    public function proximoProduto() {//recebendo uma função da classe
        return $this->lista->fetchAssoc();
    }
}
?>
