<?php
// Inicia a sessão
session_start();

// Verificação dos campos do formulário
if (!empty($_POST['login']) && !empty($_POST['senha'])) {
    require '../model/connectPDO.php';
    require 'Controller_login.php';

    $usuario = new LoginController();
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Verificando se o login é bem-sucedido
    if ($usuario->login($login, $senha)) {
        if ($_SESSION['nivel'] === 'com') {
            header("Location: ../view/cliente/index.php");
        } elseif ($_SESSION['nivel'] === 'sup') {
            header("Location: ../view/admin/index.php");
        }
    } else {
        // Exibe mensagem de erro ou redireciona para a página de login
        header("Location: ../view/admin/login.php?erro=1");
    }
} else {
    // Redireciona para a página de login se os campos estiverem vazios
    header("Location: ../view/admin/login.php?erro=2");
}
exit;
?>
