<?php 

require_once('../model/listar_produtos_destaque.php');
    
    class ProdutoDestaque{
        private $lista;

        public function __construct(){
            $this->lista = new ListaDestaque;
        }

        public function obterProdutos(){
            return $this->lista->ListarProdutos();
        }

        public function contarProdutos() {
            return $this->lista->getNumLinhas();
        }
    

        public function proximoProduto(){
            return $this->lista->fetchAssoc();
        }
    }
?>