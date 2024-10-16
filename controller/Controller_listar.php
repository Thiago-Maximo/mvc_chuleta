<?php

 
require_once('../model/listar_produtos.php');
 
class ProdutoController {
    private $lista;
 
    public function __construct() {
        $this->lista = new Lista();
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