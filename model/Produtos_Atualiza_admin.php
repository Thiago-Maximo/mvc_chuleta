<?php
class Produto_AtualizaModel {
    private $pdo;

    public function __construct($pdo) {//conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function AtualizarProduto($idTipo, $descricao, $resumo, $valor, $imagem, $destaque) {//função para inserir produtos
        $id = $_GET['id'];
        $sql = "UPDATE produtos set tipo_id=:tipo_id, descricao = :descricao, resumo=:resumo, valor=:valor, imagem=:imagem, destaque=:destaque WHERE id = $id";//comando mysql
        $sql = $this->pdo->prepare($sql);//prepare para preparar o comando para executar
        $sql->bindParam(':tipo_id', $idTipo);//bind para previnir contra injeções mysql
        $sql->bindParam(':descricao', $descricao);
        $sql->bindParam(':resumo', $resumo);
        $sql->bindParam(':valor', $valor);
        $sql->bindParam(':imagem', $imagem);
        $sql->bindParam(':destaque', $destaque);
        $sql->execute();//executa o comando mysql
    }

    public function obterTipos() {//obtém todos os tipos
        $sql = "SELECT * FROM tipos ORDER BY rotulo";
        $sql = $this->pdo->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelecionarProduto(){
        $id= $_GET['id'];
        $sql = "SELECT * FROM vw_produtos WHERE id = $id";
        $sql = $this->pdo->prepare($sql);
        $sql->execute();
    }
}
