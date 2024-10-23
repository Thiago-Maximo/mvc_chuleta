<?php 

require_once '../../Controller/Controller_acesso_com.php';
$sessaoController = new Sessao();
$sessaoController->verificarSessao();


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>Área Administrativa - Chuleta Quente</title>
</head>
<body>
    <?php include 'menu_adm.php'; ?>
    <?php include 'adm_options.php'; ?>
</body>
</html>
