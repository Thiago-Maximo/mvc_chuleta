<?php
require_once __DIR__ . '../../model/login.php'; // Inclui a classe Usuario

class LoginController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function login($login, $senha) {
        return $this->usuario->login($login, $senha);
    }
}
?>
