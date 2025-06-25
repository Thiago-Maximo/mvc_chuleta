<?php
include_once("../model/connectPDO.php"); // garante que $pdo está disponível

$busca = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

try {
    $sql = "SELECT * FROM vw_produtos 
            WHERE descricao LIKE :busca 
            OR resumo LIKE :busca 
            OR rotulo LIKE :busca";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':busca', '%' . $busca . '%');
    $stmt->execute();

    $produtos = $stmt->fetchAll();
    $total = count($produtos);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Busca: <?php echo htmlspecialchars($busca); ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="fundofixo">

<?php include "menu_publico.php"; ?>

<div class="container">

    <?php if ($total == 0) { ?>
        <h2 class="breadcrumb alert-danger">
            <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            Nenhum produto encontrado para: <strong> "<?php echo htmlspecialchars($busca); ?>"</strong>
        </h2>

    <?php } else { ?>
        <h2 class="breadcrumb alert-success">
            <a href="javascript:window.history.go(-1)" class="btn btn-success">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            Resultado da busca por: <strong><?php echo htmlspecialchars($busca); ?></strong>
        </h2>

        <div class="row">
            <?php foreach ($produtos as $row) { ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="produto_detalhes.php?id=<?php echo $row['id']; ?>">
                            <img src="../images/<?php echo $row['imagem']; ?>" class="img-responsive img-rounded">
                        </a>
                        <div class="caption text-right">
                            <h3 class="text-danger"><?php echo $row['descricao']; ?></h3>
                            <p class="text-warning"><strong><?php echo $row['rotulo']; ?></strong></p>
                            <p class="text-left"><?php echo $row['resumo']; ?></p>
                            <p>
                                <button class="btn btn-default disabled" role="button">
                                    <?php echo "R$ " . number_format($row['valor'], 2, ',', '.'); ?>
                                </button>
                                <a href="produto_detalhes.php?id=<?php echo $row['id']; ?>">
                                    <span class="hidden-xs">Saiba mais...</span>
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </p>
                        </div> 
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

</body>
</html>
