<?php
    require_once 'Controller_login.php';
    
    
    $loginController = new LoginController();
    $loginController->autenticar($_POST['login'], $_POST['senha']);
?>