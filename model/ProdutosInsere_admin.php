<?php
class ProdutoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserirProduto($idTipo, $descricao, $resumo, $valor, $imagem, $destaque) {
        $sql = "INSERT INTO produtos (tipo_id, descricao, resumo, valor, imagem, destaque)
                VALUES (:tipo_id, :descricao, :resumo, :valor, :imagem, :destaque)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindParam(':tipo_id', $idTipo);
        $sql->bindParam(':descricao', $descricao);
        $sql->bindParam(':resumo', $resumo);
        $sql->bindParam(':valor', $valor);
        $sql->bindParam(':imagem', $imagem);
        $sql->bindParam(':destaque', $destaque);
        $sql->execute();
        return $this->pdo->lastInsertId(); // Retorna o ID do produto inserido
    }

    public function obterTipos() {
        $sql = "SELECT * FROM tipos ORDER BY rotulo";
        $sql = $this->pdo->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
