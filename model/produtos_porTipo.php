<?php
    class ProdutoTipo{
        private $resultado;
        private $conexao;

        public function __construct(){//conexão com o banco
            $this-> conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
            if ($this->conexao->connect_error) {
                die("Erro de conexão: " . $this->conexao->connect_error);
            }
        }

        //Lista os produtos do banco de dados
        public function ListarProduto(){
            $idTipo = $_GET['id_tipo'];
           
            $sql = "SELECT * FROM vw_produtos WHERE tipo_id = '$idTipo'";
            $this->resultado = $this->conexao->query($sql);
            return $this->resultado;
        }

        //Conta o numero de linhas que retornou
        public function getNumLinhas() {
            return $this->resultado ? $this->resultado->num_rows : 0;
        }
     
       
    }
?>