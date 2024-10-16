<?php

 
require_once('../controller/Controller_listar.php');
 
$controller = new ProdutoController();
$resultado = $controller->obterProdutos();
$num_linhas = $controller->contarProdutos();
 
// Mostrar se a consulta retornar vazio
if ($num_linhas == 0) {
?>
    <h2 class="breadcrumb alert-danger"> Não há produtos cadastrados! </h2>
<?php
}
 
// Mostrar se a consulta retornou produtos
if ($num_linhas > 0) {
?>
    <h2 class="breadcrumb alert-success"> Produtos </h2>
    <div class="row">
    <?php
    while ($row_produtos = $controller->proximoProduto()) {
    ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <a href="produto_detalhes.php?id=<?php echo $row_produtos['id']; ?>">
                    <img src="../images/<?php echo $row_produtos['imagem']; ?>"
                         alt="" class="img-responsive img-rounded">
                </a>
                <div class="caption text-right bg-success">
                    <h3 class="text-danger">
                        <strong><?php echo $row_produtos['descricao']; ?></strong>
                    </h3>
                    <p class="text-warning">
                        <strong><?php echo $row_produtos['rotulo']; ?></strong>
                    </p>
                    <p class="text-left">
                        <?php echo mb_strimwidth($row_produtos['resumo'], 0, 42, '...'); ?>
                    </p>
                    <p>
                        <button class="btn btn-default disabled" role="button" style="cursor: default;">
                            <?php echo "R$ " . number_format($row_produtos['valor'], 2, ',', '.'); ?>
                        </button>
                        <a href="produto_detalhes.php?id=<?php echo $row_produtos['id']; ?>">
                            <span class="hidden-xs">Saiba mais..</span>
                            <span class="hidden-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
<?php
}
?>