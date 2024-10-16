<?php

    class Login{
        private $login;
        private $senha;
        private $resultado;
        private $conexao;

        public function __construct(){
            $this->conexao = new mysqli('localhost','root','','tincphpdb01');
            if($this->conexao->connect_error){
                die("Erro de Conexão: ". $this->conexao->connect_error);
            }
        }

        public function realizarLogin(){
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
            $this->resultado = $this->conexao->query($sql);
            return $this->resultado;
        }

        public function 
    }