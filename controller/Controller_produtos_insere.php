<?php
require_once __DIR__ . '/../model/ProdutosInsere_admin.php';  // Corrige o caminho
require_once __DIR__ . '/../model/connectPDO.php';  // Conexão com o banco

class ProdutoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obterTipos() {
        $sql = $this->pdo->query("SELECT * FROM tipos ORDER BY rotulo");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserirProduto($dados, $arquivos) {
        $nome_img = $arquivos['imagemfile']['name'];
        $tmp_img = $arquivos['imagemfile']['tmp_name'];
        $rand = rand(100001, 999999);
        $dir_img = __DIR__ . "/../images/" . $rand . $nome_img;
    
        if (move_uploaded_file($tmp_img, $dir_img)) {
            $produtoModel = new ProdutoModel($this->pdo); // Criar uma instância do modelo
            $idInserido = $produtoModel->inserirProduto(
                $dados['id_tipo'],
                $dados['descricao'],
                $dados['resumo'],
                $dados['valor'],
                $rand . $nome_img,
                $dados['destaque']
            );
    
            if ($idInserido) {
                header("Location: produtos_lista.php");
                exit;
            }
        } else {
            echo "Erro ao mover a imagem.";
        }
    }
}
