<?php
require_once __DIR__ . '/../model/connectPDO.php';

class InserirTipo {
    private $pdo;

    public function __construct($pdo) { // Conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function inserirTipo($sigla, $rotulo) { // Função para inserir tipos
        $sql = "INSERT INTO tipos (sigla, rotulo) VALUES (:sigla, :rotulo)";
        $sql = $this->pdo->prepare($sql); // Preparação do comando SQL
        $sql->bindParam(':sigla', $sigla); // Bind dos parâmetros
        $sql->bindParam(':rotulo', $rotulo);
        
        $sql->execute(); // Executa a query
        return $this->pdo->lastInsertId(); // Retorna o ID do tipo inserido
    }
}
