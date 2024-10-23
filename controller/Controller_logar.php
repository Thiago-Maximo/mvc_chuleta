<?php
    require_once 'Controller_login.php';
    //inicia a verificação do login
    if($_POST){
        $login = $_POST['login'];
        $senha = md5($_POST['senha']);

        // $loginRes = $conn->query("Select * from usuarios where login = '$login' and senha = '$senha'");
        
        $controller = new LoginController();
        $rowLogin = $controller->fetch_assoc();
        $numRow = $controller->NumLinhas();
        //se a sessão não existir
        if(!isset($_SESSION)){
            $sessaoAntiga = session_name('chulettaaa');
            session_start();
            $session_name_new = session_name();
        }
        if ($numRow > 0) {
            $_SESSION['login_usuario'] = $login;
            $_SESSION['nivel_usuario'] = $rowLogin['nivel'];
            $_SESSION['nome_da_sessao'] = session_name();
            if ($rowLogin['nivel'] == 'sup') {
                echo "<script>window.open('../view/index.php','_self')</script>";
            } else {
                echo "<script>window.open('../view/cliente/index.php?cliente=" . $login . "','_self')</script>"; // Corrigido aqui
            }
        } else {
            echo "<script>window.open('../view/invasor.php','_self')</script>";
        }
        
    }
?>