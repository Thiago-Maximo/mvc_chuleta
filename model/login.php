<?php

class Usuario {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function autenticar($login, $senha) {
        $senha = md5($senha);
        $query = $this->conn->query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'");
        return $query->fetch_assoc();
    }
}


?>