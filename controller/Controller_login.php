<?php
require_once  'login.php';
require_once  'connectPDO.php';  // Inclui a conexão com o banco
 
class LoginController {
    private $usuario;
 
    public function __construct($pdo) {
        // Passa a conexão ao criar a instância de Usuario
        $this->usuario = new Usuario($pdo);
    }
 
    public function login($login, $senha) {
        return $this->usuario->login($login, $senha);
    }
 
    public function handleLogin() {
        if (!empty($_POST['login']) && !empty($_POST['senha'])) {
            $login = $_POST['login'];
            $senha = $_POST['senha'];
 
            // Verificando se o login é bem-sucedido
            if ($this->login($login, $senha)) {
                if ($_SESSION['nivel'] === 'com') {
                    header("Location: ../view/cliente/index.php");
                } elseif ($_SESSION['nivel'] === 'sup') {
                    header("Location: ../view/admin/index.php");
                }
            } else {
                header("Location: ../view/admin/login.php?erro=1");
            }
        } else {
            header("Location: ../view/admin/login.php?erro=2");
        }
        exit;
    }
}
?>