<?php
class ListaAdmin {
    private $pdo;
    private $resultado;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarProdutos() {
        $sql = "SELECT * FROM vw_produtos";
        $sql = $this->pdo->prepare($sql);
        $sql->execute();
        $this->resultado = $sql;
        return $this->resultado;
    }

    public function getNumLinhas() {
        return $this->resultado ? $this->resultado->rowCount() : 0;
    }

    public function fetchAssoc() {
        return $this->resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
