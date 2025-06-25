<?php

 
require_once('../controller/Controller_produtos_destaque.php');
 
$controller = new ProdutoDestaque();
$resultado = $controller->obterProdutos();
$num_linhas = $controller->contarProdutos();
 
// Mostrar se a consulta retornar vazio
if ($num_linhas == 0) {
?>
    <h2 class="breadcrumb alert-danger"> Não há produtos cadastrados! </h2>
<?php
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos em Destaque</title>
    <style>
        /* ==================== */
        /* ====== GERAL ====== */
        /* ==================== */
    
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .breadcrumb {
            padding: 15px;
            text-align: center;
            font-size: 24px;
            color: black;
            background-color:rgb(241, 241, 241);
            margin: 20px 0;
            border-radius: 5px;
        }

        /* ==================== */
        /* ====== CARDS ====== */
        /* ==================== */
        .cards {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .cards-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .card-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        .card-item h3 {
            padding: 15px 15px 0;
            font-size: 18px;
            margin: 0;
            color: #333;
        }

        .card-item .Descricao {
            padding: 0 15px;
            color: #666;
            font-size: 14px;
            flex-grow: 1;
            margin: 10px 0;
        }

        .card-item p {
            padding: 0 15px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-item button {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            color: #333;
            font-weight: bold;
        }

        .card-item a {
            color: #28a745;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-item a:hover {
            text-decoration: underline;
        }

        .hidden-xs {
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php
    // Mostrar se a consulta retornou produtos
    if ($num_linhas > 0) {
    ?>
        <div class="cards">
            <h2 class="breadcrumb">Destaques</h2>
            <div class="cards-list">
                <?php
                while ($row_produtos = $controller->proximoProduto()) {
                ?>
                    <div class="card-item">
                        <a href="produto_detalhes.php?id=<?php echo $row_produtos['id']; ?>">
                            <img src="../images/<?php echo $row_produtos['imagem']; ?>" alt="<?php echo $row_produtos['descricao']; ?>">
                        </a>
                        <h3><?php echo $row_produtos['descricao']; ?></h3>
                        <p class="Descricao"><?php echo mb_strimwidth($row_produtos['resumo'], 0, 42, '...'); ?></p>
                        <p>
                            <button class="btn btn-default disabled" role="button">
                                <?php echo "R$ " . number_format($row_produtos['valor'], 2, ',', '.'); ?>
                            </button>
                            <a href="produto_detalhes.php?id=<?php echo $row_produtos['id']; ?>">
                                <span class="hidden-xs">Saiba mais</span>
                                <span class="hidden-xs glyphicon glyphicon-eye-open" aria-hidden="true">👁️</span>
                            </a>
                        </p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</body>
</html>
