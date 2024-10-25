<?php
require_once('../model/produtos_porTipo.php');

    class ProdutoPorTipo{
        private $resultado;
        private $lista;

        public function __construct(){//instanciando um objeto da classe
            $this -> lista = new ProdutoTipo();
        }

        //recebendo a função do model
        public function obterProdutosPorTipo(){//recebendo uma função da classe
            return $this->lista->ListarProduto();

        }

        //recebendo a função do model
        public function contarProdutoTipo() {//recebendo uma função da classe
            
            return $this->lista->getNumLinhas();

        }

        
    }
?>