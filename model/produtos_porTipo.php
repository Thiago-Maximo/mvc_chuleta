<?php
    class ProdutoTipo{
        private $resultado;
        private $conexao;

        public function __construct(){
            $this-> conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
            if ($this->conexao->connect_error) {
                die("Erro de conexão: " . $this->conexao->connect_error);
            }
        }

        public function ListarProduto(){
            $sql = 'SELECT * FROM vw_produtos ';
            $this->resultado = $this->conexao->query($sql);
            return $this->resultado;
        }

        public function getNumLinhas() {
            return $this->resultado->num_rows;
        }
     
        public function fetchAll() {
            return $this->resultado->fetch_all();
        }

        public function fetchAssoc(){
            return $this->resultado->fetch_assoc();
        }

        public function InnerJoin(){
            $idTipo = $_GET['id_tipo'];
            $sql = "SELECT * FROM vw_produtos INNER JOIN tipos ON vw_produtos.tipo_id = '$idTipo'";
            $this->resultado = $this->conexao->query($sql);
            return $this->resultado;
        }
    }
?>