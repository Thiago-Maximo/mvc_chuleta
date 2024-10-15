<?php
    require_once 'init.php';

    class Lista{
        protected $Mysqli;

        public function __construct(){
            $this->conexao();
        }

        private function conexao(){
            $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO , BD_SENHA, BD_BANCO);
        }

        public function getLista(){
            $result = $this->Mysqli->query("SELECT * FROM produtos");
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $array[]=$row;
            }
            return $array;
        }

        public function pesquisaLista($id){
            $result = $this->Mysqli->query("SELECT * FROM produtos WHERE id='$id'");
            return $result->fetch_array(MYSQLI_ASSOC);
        }
    }