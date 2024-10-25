<?php
require_once __DIR__ . '/../model/login.php'; // Inclua o arquivo da classe Usuario
require_once __DIR__ . '/../model/connectPDO.php'; // Inclui a conexão com o banco

class LoginController {
    private $usuario;

    public function __construct($pdo) {
        $this->usuario = new Usuario($pdo);
    }

    public function verificarLogin() {
        if (!empty($_POST['login']) && !empty($_POST['senha'])) {
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            // Verificando se o login é bem-sucedido
            if ($this->usuario->login($login, $senha)) {
                // Redireciona conforme o nível do usuário
                switch ($_SESSION['nivel']) {
                    case 'com':
                        header("Location: ../cliente/index.php");
                        break;
                    case 'sup':
                        header("Location: ../admin/index.php");
                        break;
                    default:
                        header("Location: ../admin/login.php?erro=3"); // Nível desconhecido
                        break;
                }
                exit; 
            } else {
                header("Location: ../admin/login.php?erro=1"); // Login ou senha inválidos
            }
        } else {
            header("Location: ../admin/login.php?erro=2"); // Campos vazios
        }
        exit;
    }
}
?>
