<?php
session_name('chulettaaa');
session_start();
require_once __DIR__ . '/../../model/connectPDO.php';
require_once __DIR__ . '/../../controller/Controller_login.php';

// Proteção contra vazamento: desativa exibição de erros sensíveis
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Gera um token CSRF para proteger contra CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header('Location: login.php?erro=3'); // Erro de token
        exit();
    }
    $loginController = new LoginController($pdo);
    $loginController->verificarLogin();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30;URL=../index.php">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilo.css">
    <title>Login</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <form class="form p-4 border rounded shadow" method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

        <span class="input-span">
            <label for="email" class="label">Login</label>
            <input type="text" name="login" id="login" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu login." />
        </span>
        <span class="input-span">
            <label for="password" class="label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required autocomplete="off" placeholder="Digite sua senha." />
        </span>
        <span class="span"><a href="#">Esqueceu a Senha?</a></span>
        <input class="submit btn" type="submit" value="Acessar" />
        <span class="span">Não Tem uma conta? <a href="cadastre-se.php">Cadastre-se</a></span>
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger mt-3 text-center">
                <?php 
                switch ($_GET['erro']) {
                    case 1:
                        echo "Login ou senha inválidos!";
                        break;
                    case 2:
                        echo "Por favor, preencha todos os campos.";
                        break;
                    case 3:
                        echo "Requisição inválida. Tente novamente.";
                        break;
                }
                ?>
            </div>
        <?php endif; ?>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
