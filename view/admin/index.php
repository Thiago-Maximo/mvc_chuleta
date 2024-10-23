<?php 
   include "../../controller/Controller_acesso_com.php";

    require_once '../controller/Controller_login.php';
    $conexao = conectar(); // função para conectar ao banco de dados
    $loginController = new LoginController();
    $loginController->autenticar();
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