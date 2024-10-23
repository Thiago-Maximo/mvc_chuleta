<?php
require_once __DIR__ . '/../model/login.php'; // Inclui a classe Usuario

class LoginController {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function autenticar($login, $senha) {
        $usuario = new Usuario($this->conn);
        $usuario = $usuario->autenticar($login, $senha);

        if ($usuario) {
            // Iniciar sessão
            session_name('chulettaaa');
            session_start();

            // Definir variáveis de sessão
            $_SESSION['login_usuario'] = $login;
            $_SESSION['nivel_usuario'] = $usuario['nivel'];
            $_SESSION['nome_da_sessao'] = session_name();

            return $usuario['nivel'];
        }

        return false;
    }
}


