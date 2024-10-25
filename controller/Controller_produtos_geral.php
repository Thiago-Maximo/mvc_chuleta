<?php

 
require_once('../model/listar_produtos.php');
 
    class ProdutoController {
        private $lista;
    
        public function __construct() {//instanciando um objeto da classe
            $this->lista = new Lista();
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