<?php
require_once __DIR__ . '/../../controller/Controller_tipos_insere.php';
require_once __DIR__ . '/../../model/connectPDO.php'; // Conexão com banco


$controller = new InserirTipoController($pdo); // Instancia o controller

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Verificando se tem um método Post sendo chamado
    $sigla = $_POST['Sigla'];
    $rotulo = $_POST['Rotulo'];
    $idInserido = $controller->inserirTipo($sigla, $rotulo); // Insere e retorna ID

    echo "<script>
    alert('Tipo Cadastrado  com SUCESSO!!!');
    window.location.href = 'tipos_lista.php'; 
    </script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilo.css">
    <title>Tipo - Insere</title>
</head>
<body>
    <?php include "menu_adm.php"; ?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="produtos_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Tipos
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="tipos_insere.php" method="post" enctype="multipart/form-data" id="form_insere">
                            <label for="Sigla">Sigla:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="Sigla" id="Sigla" class="form-control"
                                    placeholder="Digite a Sigla do Tipo de Produto" maxlength="3" required>
                            </div>

                            <label for="Rotulo">Rótulo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="Rotulo" id="Rotulo" class="form-control"
                                    placeholder="Digite o Rótulo do Tipo" maxlength="15" required>
                            </div>

                            <br>
                            <input type="submit" name="enviar" id="enviar" class="btn btn-danger btn-block" value="Cadastrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
