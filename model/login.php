<?php
class Usuario {
    private $pdo;
 
    // Recebe a conexão no construtor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
 
    public function login($login, $senha) {
        // Consulta no Banco de Dados
        $sql = "SELECT id, nivel FROM usuarios WHERE login = :login AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);
 
        // Bind de parâmetros para prevenir SQL Injection
        $stmt->bindValue(":login", $login);
        $stmt->bindValue(":senha", md5($senha));
 
        // Executa a consulta
        $stmt->execute();
 
        // Verifica se há resultados
        if ($stmt->rowCount() > 0) {
            $dado = $stmt->fetch();
 
            // Define as variáveis de sessão
            $_SESSION['login_usuario'] = $login;
            $_SESSION['nivel'] = $dado['nivel'];
            $_SESSION['id'] = $dado['id'];
            $_SESSION['nome_da_sessao'] = session_name();
 
            return true;
        }
 
        // Retorna falso se o login falhar
        return false;
    }
}
?>