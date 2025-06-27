<?php
session_name('chulettaaa');
session_start();

require_once __DIR__ . '/../../model/connectPDO.php';
require_once __DIR__ . '/../../model/login.php';
require_once __DIR__ . '/../../controller/Controller_login.php';

$loginController = new LoginController($pdo);

if (!isset($_SESSION['login_usuario'])) {
    header("Location: ../admin/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Cliente</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="fundofixo">
    <div class="container">
        <h2 class="breadcrumb alert-success">
            <strong><?php echo $_SESSION['login_usuario']; ?></strong>, bem-vindo à sua área de cliente!
        </h2>
        <p>
            Aqui você poderá ver seus pedidos, atualizar seus dados ou simplesmente sair.
        </p>
        <a href="../index.php" class="btn btn-danger">
            <span class="glyphicon glyphicon-log-out"></span> Sair
        </a>
        <a href="area_cliente_pedidos.php" class="btn btn-info">Ver meus pedidos</a>
        <a href="Alterar-Dados.php" class="btn btn-warning">Alterar Meus Dados</a>
    </div>
</body>
</html>