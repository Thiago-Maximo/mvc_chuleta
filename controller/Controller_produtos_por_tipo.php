<?php
require_once('../model/produtos_porTipo.php');

    class ProdutoPorTipo{
        private $resultado;
        private $lista;

        public function __construct(){
            $this -> lista = new ProdutoTipo();
        }

        //recebendo a função do model
        public function obterProdutosPorTipo(){
            return $this->lista->ListarProduto();

        }

        //recebendo a função do model
        public function contarProdutoTipo() {
            
            return $this->lista->getNumLinhas();

        }

        
    }
?>