<?php

class Usuario {
    private $conexao;
 
    public function __construct() {
        $this->conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }
 
    public function autenticar($login, $senha) {
        $senha = md5($senha);
        $query = $this->conexao->query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'");
        return $query->fetch_assoc();
    }
}
?>