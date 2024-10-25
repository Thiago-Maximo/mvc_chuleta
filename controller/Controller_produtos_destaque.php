<?php 

require_once('../model/listar_produtos_destaque.php');
    
    class ProdutoDestaque{
        private $lista;

        public function __construct(){//instanciando um objeto da classe
            $this->lista = new ListaDestaque;
        }

        public function obterProdutos(){//recebendo uma função da classe
            return $this->lista->ListarProdutos();
        }

        public function contarProdutos() {//recebendo uma função da classe
            return $this->lista->getNumLinhas();
        }
    

        public function proximoProduto(){//recebendo uma função da classe
            return $this->lista->fetchAssoc();
        }
    }
?>