<?php 
// arquivo de conexão de banco
require_once('../controller/Controller_produto_detalhe.php');

// consulta para trazer os dados se filtrar
$controller = new ProdutoDetalhe(); // instanciando objeto da classe
$id  = $_GET['id'];
$listaDestaque = $controller->obterProdutosPorDetalhe(); //fazendo a variavel receber uma função do controller
$linhaDestaque = $controller->proximoProdutoDetalheFetchAssoc(); //fazendo a variavel receber uma função do controller
$numLinhasDestaque = $listaDestaque->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Detalhes Produto</title>
</head>
<body class="fundofixo">
    <?php include 'menu_publico.php'; ?>
    <div class="container">
        <h2 class="breadcrumb alert-danger">
            <a href="index.php">
                <button class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </button>
                <!-- use a tag ROGER -->
                <strong>Detalhes do Produto</strong>
            </a>
        </h2>
        <div class="row">
            <?php do{ ?>
                <div class="col-sm-12 col-md-12">
                    <div class="thumbnail ">
                        <a href="">
                            <img 
                                src="../images/<?php echo $linhaDestaque['imagem'] ?>" 
                                alt="<?php echo $linhaDestaque['descricao'] ?>" 
                                class="img-responsive img-rounded" 
                                style="height: 20em ;">
                        </a>
                        <div class="caption text-center">
                            <h3 class="text-danger">
                                <strong><?php echo $linhaDestaque['descricao'] ?></strong>
                            </h3>
                            <p class="text-warning">
                                <strong><?php echo $linhaDestaque['rotulo'] ?></strong>
                            </p>
                            <p class="text-center">
                                <strong><?php echo $linhaDestaque['resumo'] ?></strong>
                            </p>
                            <p>
                                <a href="index.php" class="btn btn-danger" role="button">
                                    <span class="hidden-xs">Retornar</span>
                                    <span class="visible-xs glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>    
            <?php } while($linhaDestaque = $listaDestaque->fetch_assoc()); ?>  
        </div>
    </div>
    
</body>
</html>