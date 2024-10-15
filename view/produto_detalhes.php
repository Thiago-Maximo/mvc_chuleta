<!-- CONECTAR COM O BANCO E SELECIONAR AS INFORMAÇÕES -->

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
            <!-- COMEÇO DO LAÇO PARA REPETIR AS INFORMAÇÕES -->
                <div class="col-sm-12 col-md-12">
                    <div class="thumbnail ">
                        <a href="">
                            <img 
                                src="../images/ <!--CAMINHO DA IMAGEM -->" 
                                alt="<!--TEXTO ALTERNATIVO DA IMAGEM -->" 
                                class="img-responsive img-rounded" 
                                style="height: 20em ;">
                        </a>
                        <div class="caption text-center">
                            <h3 class="text-danger">
                                <strong><!--DESCRIÇÃO DA IMAGEM --></strong>
                            </h3>
                            <p class="text-warning">
                                <strong><!--RÓTULO DA IMAGEM --></strong>
                            </p>
                            <p class="text-center">
                                <strong><!--RESUMO DA IMAGEM --> ?></strong>
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
            <!-- FIM DO LAÇO PARA REPETIR AS INFORMAÇÕES    -->
        </div>
    </div>
    
</body>
</html>