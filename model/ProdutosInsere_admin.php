<?php
class ProdutoModel {
    private $pdo;

    public function __construct($pdo) {//conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function inserirProduto($idTipo, $descricao, $resumo, $valor, $imagem, $destaque) {//função para inserir produtos
        $sql = "INSERT INTO produtos (tipo_id, descricao, resumo, valor, imagem, destaque)
                VALUES (:tipo_id, :descricao, :resumo, :valor, :imagem, :destaque)";//comando mysql
        $sql = $this->pdo->prepare($sql);//prepare para preparar o comando para executar
        $sql->bindParam(':tipo_id', $idTipo);//bind para previnir contra injeções mysql
        $sql->bindParam(':descricao', $descricao);
        $sql->bindParam(':resumo', $resumo);
        $sql->bindParam(':valor', $valor);
        $sql->bindParam(':imagem', $imagem);
        $sql->bindParam(':destaque', $destaque);
        $sql->execute();//executa o comando mysql
        return $this->pdo->lastInsertId(); // Retorna o ID do produto inserido
    }

    public function obterTipos() {//obtém todos os tipos
        $sql = "SELECT * FROM tipos ORDER BY rotulo";
        $sql = $this->pdo->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
