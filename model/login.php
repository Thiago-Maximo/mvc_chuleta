<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; // Armazena a conexão PDO
    }

    public function login($login, $senha) {
        $sql = "SELECT id, nivel FROM usuarios WHERE login = :login AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);
        
        // Bind de parâmetros
        $stmt->bindValue(":login", $login);
        $stmt->bindValue(":senha", md5($senha)); // MD5, mas considere usar bcrypt
        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dado = $stmt->fetch();
            // Inicia a sessão se não existir
            if (session_status() == PHP_SESSION_NONE) {
                session_name('chulettaaa');
                session_start();
            }
            // Definir variáveis de sessão
            $_SESSION['login_usuario'] = $login;
            $_SESSION['nivel'] = $dado['nivel'];
            $_SESSION['id'] = $dado['id'];
            return true;
        }
        return false;
    }
}
?>
