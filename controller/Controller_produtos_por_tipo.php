<?php
require_once('../model/produtos_porTipo.php');

    class ProdutoPorTipo{
        private $resultado;
        private $lista;

        public function __construct(){
            $this -> lista = new ProdutoTipo();
        }

        public function obterProdutosPorTipo(){
            return $this->lista->ListarProduto();

        }

        public function contarProdutoTipo() {
            
            return $this->lista->getNumLinhas();

        }
    
        public function proximoProdutoTipo() {
            return $this->lista->fetchAll();

        }

        public function proximoProdutoTipoFetchAssoc(){
            return $this->lista->fetchAssoc();

        }

        public function ListarProduto(){
            return $this->lista->InnerJoin();
        }

        
    }
?>