<?php
session_name('chulettaaa');
session_start();
require_once __DIR__ . '/../../model/connectPDO.php';

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Gera token CSRF se não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$erro = null;
$login_val = '';
$cpf_val = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $erro = 3;
    } elseif (empty($_POST['login']) || empty($_POST['senha']) || empty($_POST['cpf'])) {
        $erro = 2;
    } else {
        $login_val = trim($_POST['login']);
        $senha = trim($_POST['senha']);
        $cpf_val = trim($_POST['cpf']);

        // Remove máscara do CPF (deixa só números)
        $cpf_limpo = preg_replace('/\D/', '', $cpf_val);

        if (strlen($senha) > 32) {
            $erro = 6;
        } else {
            $senhaCripto = md5($senha);

            try {
                // Chama a procedure que cadastra cliente e usuário
                $stmt = $pdo->prepare("CALL sp_cadastrar_cliente_usuario(:login, :senha, :cpf)");
                $stmt->bindParam(':login', $login_val);
                $stmt->bindParam(':senha', $senhaCripto);
                $stmt->bindParam(':cpf', $cpf_limpo);
                $stmt->execute();

                // Cadastro ok, redireciona para login
                header('Location: login.php');
                exit();
            } catch (PDOException $e) {
                if (str_contains($e->getMessage(), 'usuário com esse login')) {
                    $erro = 5; // usuário já existe
                } else {
                    $erro = 4; // erro genérico
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/estilo.css" />
    <title>Cadastro</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <form class="form p-4 border rounded shadow" method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>" />

        <span class="input-span">
            <label for="login" class="label">Login</label>
            <input
                type="text"
                name="login"
                id="login"
                class="form-control"
                required
                autocomplete="off"
                placeholder="Digite seu login."
                value="<?php echo htmlspecialchars($login_val); ?>"
            />
            <small class="form-text text-muted">Se o Nome de Usuario estiver Indisponivel Utilize seu Sobrenome Junto Ao Nome</small>
        </span>

        <span class="input-span">
            <label for="senha" class="label">Senha</label>
            <input
                type="password"
                name="senha"
                id="senha"
                class="form-control"
                required
                maxlength="32"
                autocomplete="off"
                placeholder="Digite sua senha (máx. 32 caracteres)"
            />
            <small class="form-text text-muted">A senha deve ter no máximo 32 caracteres.</small>
        </span>

        <span class="input-span">
            <label for="cpf" class="label">CPF</label>
            <input
                type="text"
                name="cpf"
                id="cpf"
                class="form-control"
                required
                placeholder="Digite seu CPF"
                maxlength="14"
                oninput="formatarCPF(this)"
                value="<?php echo htmlspecialchars($cpf_val); ?>"
            />
        </span>

        <input class="submit btn btn-primary btn-block mt-3" type="submit" value="Cadastrar" />
        <span class="span d-block text-center mt-2"
            >Já tem uma conta? <a href="login.php">Entrar</a></span
        >

        <?php if ($erro !== null) : ?>
            <div class="alert alert-danger mt-3 text-center">
                <?php
                switch ($erro) {
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
                        echo "Já existe um usuário com esse login.";
                        break;
                    case 6:
                        echo "A senha ultrapassa o limite de 32 caracteres.";
                        break;
                }
                ?>
            </div>
        <?php endif; ?>
    </form>

    <script>
        function formatarCPF(campo) {
            let valor = campo.value;

            // Remove tudo que não for número
            valor = valor.replace(/\D/g, '');

            // Limita a 11 dígitos (CPF sem máscara)
            if (valor.length > 11) {
                valor = valor.slice(0, 11);
            }

            // Aplica a máscara 000.000.000-00
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            campo.value = valor;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
