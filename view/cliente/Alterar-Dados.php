<?php
session_name('chulettaaa');
session_start();

// Verifique se a sessão existe
if (!isset($_SESSION['login_usuario']) || empty($_SESSION['login_usuario'])) {
    echo "<div class='alert alert-warning'>Sessão expirada. Faça login novamente.</div>";
    header("Refresh: 3; URL=../admin/login.php");
    exit;
}

require_once __DIR__ . '/../../model/connectPDO.php';
require_once __DIR__ . '/../../model/Cliente_AlterarDados.php';
require_once __DIR__ . '/../../controller/Controller_Cliente_AlterarDados.php';

$usuarioLogado = $_SESSION['login_usuario'];

$controller = new UsuariosListaController($pdo);
$mensagemErro = '';
$usuario = $controller->obterUsuarioPorLogin($usuarioLogado);

// ⚠️ Verifique se retornou um array válido
if (!$usuario || !is_array($usuario) || empty($usuario['id'])) {
    echo "<div class='alert alert-danger'>Erro: usuário não encontrado no banco de dados.</div>";
    exit;
}

// Se o formulário foi enviado, processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    if ($id && $login && $senha && $cpf) {
        $atualizou = $controller->atualizarUsuario($id, $login, $senha, $cpf);
        if ($atualizou) {
            echo "<script>
                alert('Dados atualizados com sucesso!');
                window.location.href = 'index.php';
            </script>";
            exit;
        } else {
            $mensagemErro = "Erro ao atualizar os dados.";
        }
    } else {
        $mensagemErro = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Editar Dados do Cliente</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
</head>
<body>
<div class="container">
    <h2>Editar meus dados</h2>

    <?php if ($mensagemErro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($mensagemErro) ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>" />

        <div class="form-group">
            <label>Login</label>
            <input type="text" name="login" class="form-control" required value="<?= htmlspecialchars($usuario['login']) ?>" />
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required placeholder="Digite uma nova senha" />
        </div>

        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" required value="<?= htmlspecialchars($usuario['cpf']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
