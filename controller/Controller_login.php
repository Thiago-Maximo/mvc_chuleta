<?php

require_once '../model/login.php';
class LoginController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }
 
    public function autenticar($login, $senha) {
        $usuario = $this->usuario->autenticar($login, $senha);
 
        if ($usuario) {
            $_SESSION['login_usuario'] = $login;
            $_SESSION['nivel_usuario'] = $usuario['nivel'];
            $_SESSION['nome_da_sessao'] = session_name();
 
            if ($usuario['nivel'] == 'sup') {
                header('Location: ../view/admin/index.php');
            } else {
                header('Location: ../view/cliente/index.php?cliente=' . $login);
            }
        } else {
            header('Location: invasor.php');
        }
    }
}
?>