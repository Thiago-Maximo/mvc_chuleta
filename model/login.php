<?php
class Usuario {
    public function login($login, $senha) {
        global $pdo;

        // Inicia a sessão se ainda não estiver ativa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Consulta no Banco de Dados
        $sql = "SELECT id, nivel FROM usuarios WHERE login = :login AND senha = :senha";
        $stmt = $pdo->prepare($sql);

        // Bind de parâmetros para prevenir SQL Injection
        $stmt->bindValue(":login", $login);
        $stmt->bindValue(":senha", md5($senha));

        // Executa a consulta
        $stmt->execute();

        // Verifica se há resultados
        if ($stmt->rowCount() > 0) {
            $dado = $stmt->fetch();

            // Define as variáveis de sessão
            $_SESSION['id'] = $dado['id'];
            $_SESSION['nivel'] = $dado['nivel'];

            return true;
        }

        // Retorna falso se o login falhar
        return false;
    }
}
?>
