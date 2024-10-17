<?php
    class ProdutoDetalheClasse{
        private $resultado;
        private $conexao;
        
        public function __construct(){//Método Construtor da Classe, realiza a conexão do banco de dados
            $this-> conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
            if ($this->conexao->connect_error) {
                die("Erro de conexão: " . $this->conexao->connect_error);
            }
        }

        public function ListarProdutoDetalhe(){//obtém todos os dados da tabela de vw_produtos
            $id  = $_GET['id'];
            $sql = "SELECT * FROM vw_produtos WHERE id = '$id'";
            $this->resultado = $this->conexao->query($sql);
            return $this->resultado;
        }

        
        public function fetchAssoc(){//Passa por cada Linha da tabela do banco de dados
            return $this->resultado->fetch_assoc();
        }
    }
?>