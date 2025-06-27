<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($login, $senha) {
        // Consulta com BINARY para case-sensitive e proteção contra timing attacks
        $sql = "SELECT id, nivel, senha FROM usuarios WHERE BINARY login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":login", $login);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $dado = $stmt->fetch();
            
            // Verificação segura da senha (compatível com MD5 ou password_hash)
            if ($this->verificarSenha($senha, $dado['senha'])) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_name('chulettaaa');
                    session_start();
                }
                $_SESSION['login_usuario'] = $login;
                $_SESSION['nivel'] = $dado['nivel'];
                $_SESSION['id'] = $dado['id'];
                return true;
            }
        }
        
        // Delay para prevenir timing attacks
        usleep(random_int(100000, 300000));
        return false;
    }

    private function verificarSenha($senhaDigitada, $senhaHash) {
        // Se o hash tem 32 caracteres, assume que é MD5
        if (strlen($senhaHash) === 32) {
            return md5($senhaDigitada) === $senhaHash;
        }
        // Caso contrário, usa password_verify
        return password_verify($senhaDigitada, $senhaHash);
    }
}
?>