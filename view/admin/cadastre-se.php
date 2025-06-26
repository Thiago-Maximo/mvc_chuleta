<?php
session_name('chulettaaa');
session_start();
require_once __DIR__ . '/../../model/connectPDO.php';

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header('Location: cadastro.php?erro=3');
        exit();
    }

    if (!empty($_POST['login']) && !empty($_POST['senha'])) {
        $login = trim($_POST['login']);
        $senha = trim($_POST['senha']);
        $senhaHash = md5($senha); // Substituível por password_hash()

        try {
            // Verifica se o login já existe
            $verifica = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE login = :login");
            $verifica->bindParam(':login', $login);
            $verifica->execute();

            if ($verifica->fetchColumn() > 0) {
                header('Location: cadastro.php?erro=5');
                exit();
            }

            // Cadastra novo usuário com nível 'com'
            $stmt = $pdo->prepare("INSERT INTO usuarios (login, senha, nivel) VALUES (:login, :senha, 'com')");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':senha', $senhaHash);
            $stmt->execute();

            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            header('Location: cadastro.php?erro=4');
            exit();
        }
    } else {
        header('Location: cadastro.php?erro=2');
        exit();
    }
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
    <title>Cadastro</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <form class="form p-4 border rounded shadow" method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

        <span class="input-span">
            <label for="login" class="label">Login</label>
            <input type="text" name="login" id="login" class="form-control" required autocomplete="off" placeholder="Digite seu login." />
        </span>
        <span class="input-span">
            <label for="senha" class="label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required autocomplete="off" placeholder="Digite sua senha." />
        </span>
        <input class="submit btn btn-primary btn-block mt-3" type="submit" value="Cadastrar" />
        <span class="span d-block text-center mt-2">Já tem uma conta? <a href="login.php">Entrar</a></span>

        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger mt-3 text-center">
                <?php 
                switch ($_GET['erro']) {
                    case 2:
                        echo "Por favor, preencha todos os campos.";
                        break;
                    case 3:
                        echo "Requisição inválida. Tente novamente.";
                        break;
                    case 4:
                        echo "Erro ao cadastrar. Problema no banco de dados.";
                        break;
                    case 5:
                        echo "Login já existente. Escolha outro.";
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
