<?php

class Sessao{
    public function __construct() {
        session_name('chulettaaa');
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function verificarSessao() {
        echo "Verificando sessão...";
        if (!isset($_SESSION['login_usuario'])) {
            echo "Sessão não iniciada.";
            header("Location: ../view/admin/login.php");
            exit;
        }
        if ($_SESSION['nome_da_sessao'] !== session_name()) {
            session_destroy();
            header("Location: ../view/admin/login.php");
            exit;
        }
    }
}

?>