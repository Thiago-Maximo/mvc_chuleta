<?php
session_name('chulettaaa');
session_start();

require_once __DIR__ . '/../../model/connectPDO.php';
require_once __DIR__ . '/../../model/Cliente_AlterarDados.php'; // corrigido o nome aqui
require_once __DIR__ . '/../../controller/Controller_Cliente_AlterarDados.php'; // verifique se está correto o nome e caminho

if (!isset($_SESSION['login_usuario'])) {
    header('Location: ../admin/login.php');
    exit;
}

$usuarioLogado = $_SESSION['login_usuario'];

$controller = new UsuariosListaController($pdo);

// Se o formulário foi enviado, processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    if ($id) {
        // Atualiza os dados do usuário
        $atualizou = $controller->atualizarUsuario($id, $login, $senha, $cpf);

        if ($atualizou) {
            echo "<p class='alert alert-success'>Dados atualizados com sucesso!</p>";
        } else {
            echo "<p class='alert alert-danger'>Erro ao atualizar os dados.</p>";
        }
    }
}

// Busca os dados atuais do usuário para mostrar no formulário
$usuario = $controller->obterUsuarioPorLogin($usuarioLogado);

if (!$usuario) {
    echo "Usuário não encontrado!";
    exit;
}
?>
