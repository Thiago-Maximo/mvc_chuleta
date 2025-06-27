<?php
function connectPDO() {
    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=seu_banco;charset=utf8',
            'seu_usuario',
            'sua_senha',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        error_log("Erro de conexão PDO: " . $e->getMessage());
        die("Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.");
    }
}