<?php
require_once __DIR__ . '/../model/login.php';
require_once __DIR__ . '/../model/connectPDO.php';

class LoginController {
    private $usuario;

    public function __construct($pdo) {
        $this->usuario = new Usuario($pdo);
    }

    public function verificarLogin() {
        if (!empty($_POST['login']) && !empty($_POST['senha'])) {
            $login = trim($_POST['login']);
            $senha = $_POST['senha'];

            // Verificação adicional de formato
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $login)) {
                header("Location: ../admin/login.php?erro=4"); // Login inválido
                exit;
            }

            if ($this->usuario->login($login, $senha)) {
                switch ($_SESSION['nivel']) {
                    case 'com':
                        header("Location: ../cliente/index.php");
                        break;
                    case 'sup':
                        header("Location: ../admin/index.php");
                        break;
                    case 'ate':
                        header("Location: ../admin/atendente.php");
                        break;
                    default:
                        header("Location: ../admin/login.php?erro=3");
                        break;
                }
                exit; 
            } else {
                header("Location: ../admin/login.php?erro=1");
            }
        } else {
            header("Location: ../admin/login.php?erro=2");
        }
        exit;
    }
}
?>