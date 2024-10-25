<!-- CONECTAR NO BANCO E SELECIONAR AS INFORMAÇÕES -->
<?php
require_once("../../model/connectPDO.php"); 
require_once("../../controller/Controller_produtos_lista.php");

// Cria a instância do controlador, passando a conexão PDO
$controller = new ListarProdutos_admin($pdo);

// Obtém a lista de produtos
$lista = $controller->obterProdutos();
$row = $controller->proximoProduto();
$rows = $controller->contarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Lista</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilo.css">
</head>
<body> 
    <?php include 'menu_adm.php'; ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Produtos</h2>
        <table class="table table-hover table-condensed tb-opacidade bg-warning">
            <thead>
                <th class="hidden">ID</th>
                <th>TIPO</th>
                <th>DESCRIÇÃO</th>
                <th>RESUMO</th>
                <th>VALOR</th>
                <th>IMAGEM</th>
                <th>AÇÃO</th>
            </thead>
            <tbody>
                <?php do { ?>
                    <tr>
                        <td class="hidden"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['rotulo']; ?></td>
                        <td>
                            <?php 
                            echo $row['destaque'] === 'Sim' 
                                ? '<span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span>' 
                                : '<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>';
                            echo '&nbsp;' . $row['descricao']; 
                            ?>
                        </td>
                        <td><?php echo $row['resumo']; ?></td>
                        <td><?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
                        <td>
                            <img src="../../images/<?php echo $row['imagem']; ?>" width="100px">
                        </td>
                        <td>
                            <a href="produtos_atualiza.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-warning btn-block btn-xs">
                                <span class="glyphicon glyphicon-refresh"></span> ALTERAR
                            </a>

                            <?php 
                            $regra = $pdo->query("SELECT destaque FROM vw_produtos WHERE id = " . $row['id']);
                            $regraRow = $regra->fetch(PDO::FETCH_ASSOC);
                            ?>

                            <button 
                                data-nome="<?php echo $row['descricao']; ?>"
                                data-id="<?php echo $row['id']; ?>"
                                class="delete btn btn-danger btn-block btn-xs 
                                <?php echo $regraRow['destaque'] === 'Sim' ? 'hidden' : ''; ?>">
                                <span class="glyphicon glyphicon-trash"></span> EXCLUIR
                            </button>
                        </td>
                    </tr>
                <?php } while ($row = $controller->proximoProduto()); ?>
            </tbody>
        </table>
    </main>

    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Vamos deletar?</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Deseja mesmo excluir o item?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script>
        $('.delete').on('click', function () {
            var nome = $(this).data('nome');
            var id = $(this).data('id');
            $('span.nome').text(nome);
            $('a.delete-yes').attr('href', 'produtos_excluir.php?id=' + id);
            $('#modalEdit').modal('show');
        });
    </script>
</body>
</html>
