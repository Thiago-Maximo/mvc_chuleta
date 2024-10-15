<!-- CONECTAR COM O BANCO E SELECIONAR AS INFORMAÇÕES -->

<!-- Mostrar se a consulta retornar vazio -->



<!-- mostrar se a consulta retornou produtos -->

    <h2 class="breadcrumb alert-danger">
       Destaques
    </h2>
    <div class="row">
        <!-- COMEÇO DO LAÇO -->
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail ">
                   <a href="produto_detalhes.php?id=<!-- ID -->">
                       <img src="../images/<!-- CAMINHO DA IMAGEM -->" alt="" class="img-responsive img-rounded"> 
                   </a> 
                  <div class="caption text-right bg-danger"> 
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