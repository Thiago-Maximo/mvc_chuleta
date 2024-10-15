<!-- CONECTAR NO BANCO E SELECIONAR AS INFORMAÇÕES -->

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Chuleta Quente Churrascaria</title>
</head>

<body class="fundofixo">
    <?php include "menu_publico.php" ?>
    <div class="container">

<!-- Mostrar se a consulta retornar vazio -->

    <h2 class="breadcrumb alert-danger">
        <a href="javascript:window.history.go(-1)" class="btn btn-danger">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        Não há produtos cadastrados tipo <?php echo $rotulo; ?>
    </h2>


<!-- mostrar se a consulta retornou produtos -->

    <h2 class="breadcrumb alert-danger">
        <a href="javascript:window.history.go(-1)" class="btn btn-danger">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <strong><?php echo $rotulo; ?></strong>
    </h2>
    <div class="row">
        <!-- COMEÇO DO LAÇO -->
            <div class="col-sm-6 col-md-4 ">
                <div class="thumbnail ">
                   <a href="produto_detalhes.php?id=<!-- ID -->">
                       <img src="../images/<!-- CAMINHO DA IMAGEM -->" alt="" class="img-responsive img-rounded"> 
                   </a> 
                  <div class="caption text-right bg-success"> 
                    <h3 class="text-danger">
                        <strong><!-- DESCRIÇÃO --></strong>
                    </h3>
                    <p class="text-warning">
                        <strong><!-- RÓTULO --></strong>
                    </p>
                    <p class="text-left">
                        <!-- RESUMO -->
                    </p>
                    <p>
                        <button class="btn btn-default disabled" role="button" style="cursor: default;">
                            <!-- VALOR -->
                        </button>
                        <a href="produto_detalhes.php?id=<!-- ID -->">
                            <span class="hidden-xs">Saiba mais..</span>
                            <span class="hidden-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    </p>
                  </div>
                </div>
            </div>
        <!-- FIM DO LAÇO -->
    </div>
    
</main>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" ></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).on('ready', function(){
        $(".regular").slick({
            dots:true,
            infinity:true,
            slidesToShow:3,
            slidesToScroll:3 
        });
        
    });
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick.min.js"></script>
</html>
