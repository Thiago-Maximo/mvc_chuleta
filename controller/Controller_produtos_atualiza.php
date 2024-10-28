<?php
require_once __DIR__ . '/../model/Produtos_Atualiza_admin.php';  // Caminho correto
require_once __DIR__ . '/../model/connectPDO.php';  // Conexão com o banco

class ProdutoAtualizaController {
    private $pdo;
    private $lista;  // Instância do modelo ProdutoModel

    // Construtor que inicializa a conexão e a lista de produtos
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->lista = new Produto_AtualizaModel($pdo);  // Inicializando a lista com ProdutoModel
    }

    // Obter tipos de produtos cadastrados
    public function obterTipos() {
        $sql = $this->pdo->query("SELECT * FROM tipos ORDER BY rotulo");
        return $sql->fetchAll();
    }

    // Atualizar produto e mover imagem para o diretório
    public function AtualizarProduto($dados, $arquivos) {
        $nome_img = $arquivos['imagemfile']['name'];
        $tmp_img = $arquivos['imagemfile']['tmp_name'];
        $rand = rand(100001, 999999);
        $dir_img = __DIR__ . "/../images/" . $rand . $nome_img;

        if (move_uploaded_file($tmp_img, $dir_img)) {
            $produtoModel = new Produto_AtualizaModel($this->pdo);  // Nova instância do modelo
            $idInserido = $produtoModel->AtualizarProduto(
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

    // Selecionar produto pelo ID
    public function SelecionarProduto($id) {
        // Prepare a consulta para selecionar o produto pelo ID
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Verifica se o produto foi encontrado
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna o produto
        } else {
            return null; // Retorna null se não encontrar
        }
    }
    
}
