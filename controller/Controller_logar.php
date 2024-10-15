<?php
    // Inicia a sessão
    session_start();

    // Verificação dos campos do formulário
    if (isset($_POST['Login']) && !empty($_POST['Login']) && isset($_POST['Senha']) && !empty($_POST['Senha'])) {
        require '../model/connect.php';
        require 'Controller_login.php';

        $usuario = new Usuario();

        $login = addslashes($_POST['Login']);
        $senha = addslashes($_POST['Senha']); // addslashes é para prevenção contra injeções de código

        // Verificando se o login é bem-sucedido
        if ($usuario->login($login, $senha) == true) {
            
                header("Location: ../view/admin/index.php");
                exit; // Garante que o script seja interrompido após o redirecionamento
            } else {
            header("Location: ../view/login.php");
            exit; // Garante que o script seja interrompido após o redirecionamento
        }
    } else {
        header("Location: ../view/login.php");
        exit; // Garante que o script seja interrompido após o redirecionamento
    }
?>