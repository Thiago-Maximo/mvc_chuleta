<?php

    class Login{
        
        private $resultado;
        private $conexao;

        public function __construct(){
            $this->conexao = new mysqli('localhost','root','','tincphpdb01');
            if($this->conexao->connect_error){
                die("Erro de Conexão: ". $this->conexao->connect_error);
            }
        }

        public function realizarLogin($login,$senha){
            public $login = $_GET['Login'];
            public $senha = md5($_POST['senha']);

            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
            $this->resultado = $this->conexao->query($sql);
            return $this->resultado;
        }

        public function NumLinhas(){
            return $this->resultado ? $this->resultado->num_rows : 0;
        }

        public function fetchAll(){
            return $this-> resultado->fetch_all();
        }

        public function fetchAssoc(){
            return $this->resultado->fetch_assoc();
        }
    }
?>