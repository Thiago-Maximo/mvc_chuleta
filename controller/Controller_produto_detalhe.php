<?php
require_once('../model/produto_detalhes.php');

    class ProdutoDetalhe{
        private $resultado;
        private $lista;

        public function __construct(){//instanciando um objeto da classe
            $this -> lista = new ProdutoDetalheClasse();
        }

        //função para listar/exibir o conteudo da tabela
        public function obterProdutosPorDetalhe(){//recebendo uma função da classe
            return $this->lista->ListarProdutoDetalhe();

        }

        //Função para passar por cada linha da tabela
        public function proximoProdutoDetalheFetchAssoc(){
            return $this->lista->fetchAssoc();

        }

    }
?>