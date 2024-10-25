<?php
session_name('chulettaaa');
session_start();

require_once __DIR__ . '/../../model/connectPDO.php'; // Inclui a conexão
require_once __DIR__ . '/../../model/login.php'; // Inclua o arquivo da classe Usuario
require_once __DIR__ . '/../../controller/Controller_login.php'; // Inclui o controlador

$loginController = new LoginController($pdo); // Passando a conexão PDO

// Verifique se o usuário está logado, redirecione para o login se não estiver
if (!isset($_SESSION['login_usuario'])) {
    header("Location: ../admin/login.php"); // Redireciona para a página de login
    exit;
}

// O restante do seu código HTML...
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilo.css">
    <title>Área Administrativa - Chuleta Quente</title>
</head>
<body>
    <?php include 'menu_adm.php'; ?>
    <?php include 'adm_options.php'; ?>
</body>
</html>
