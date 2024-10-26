<?php
class ListaAdmin {
    private $pdo;
    private $resultado;

    public function __construct($pdo) {// fazendo a conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function listarProdutos() {///listando todos os produtos do banco de dados
        $sql = "SELECT * FROM vw_produtos";
        $sql = $this->pdo->prepare($sql);
        $sql->execute();
        $this->resultado = $sql;
        return $this->resultado;
    }

    public function getNumLinhas() {//retornando todas as linhas do banco de dados
        return $this->resultado ? $this->resultado->rowCount() : 0;
    }

    public function fetchAssoc() {//passando por cada linha do banco 
        return $this->resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
