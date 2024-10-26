<?php
require_once __DIR__ . '/../model/connectPDO.php';

class InserirTipo {
    private $pdo;

    public function __construct($pdo) { // Conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function inserirTipo($sigla, $rotulo) { // Função para inserir tipos
        $sql = "INSERT INTO tipos (sigla, rotulo) VALUES (:sigla, :rotulo)";
        $stmt = $this->pdo->prepare($sql); // Preparação do comando SQL
        $stmt->bindParam(':sigla', $sigla); // Bind dos parâmetros
        $stmt->bindParam(':rotulo', $rotulo);
        
        $stmt->execute(); // Executa a query
        return $this->pdo->lastInsertId(); // Retorna o ID do tipo inserido
    }
}
