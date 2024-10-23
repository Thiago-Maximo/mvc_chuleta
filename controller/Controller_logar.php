<?php
require_once '../model/connect.php';
require_once 'Controller_login.php';

$conexao = conectar();
$loginController = new LoginController($conexao);

if (isset($_POST['Login']) && isset($_POST['Senha'])) {
    $login = $_POST['Login'];
    $senha = $_POST['Senha'];

    // Verificar autenticação
    $nivel = $loginController->autenticar($login, $senha);

    if ($nivel) {
        // Redirecionar para página administrativa
        header('Location: ../view/admin/index.php');
        die();
    } else {
        // Redirecionar para página de erro
        header('Location: invasor.php');
        die();
    }
} else {
    echo "Erro: Login ou senha não enviados.";
}

?>
