<?php
require_once __DIR__ . '/../model/connectPDO.php';

class Usuarios {
    private $pdo;

    public function __construct($pdo) { // Conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function listar() { // Função para listar os usuários
        $sql = "SELECT * FROM usuarios"; // Comando SQL
        $sql = $this->pdo->prepare($sql); // Prepara o comando
        $sql->execute(); // Executa o comando
        return $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os usuários
    }
}
