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
<h2>
<strong> <?php echo $_GET['cliente']; ?></strong>, Bem vindo à sua área de cliente! 
</h2>
<a href="../admin/logout.php">
    <span class="glyphicon glyphicon-log-out">sair</span>
</a>