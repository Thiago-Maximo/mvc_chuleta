<?php
require_once '../../controller/Controller_produtos_atualiza.php';
require_once '../../model/connectPDO.php';

$produtoController = new ProdutoAtualizaController($pdo);
$id = $_GET['id']; // Garante que $id seja definido
$produto = $produtoController->SelecionarProduto($id); // Seleciona o produto, se o ID estiver definido
$tipos = $produtoController->obterTipos();

if ($_POST) {
    $produtoController->AtualizarProduto($_POST, $_FILES);
    echo "<script>
        alert('Produto Atualizado com sucesso!');
        window.location.href = 'produtos_lista.php'; 
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
    <title>Produto - Atualiza</title>
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
                Atualizando Produtos
            </h2>
            <div class="thumbnail">
                <div class="alert alert-danger" role="alert">
                    <form action="" method="post" enctype="multipart/form-data" id="form_insere"> <!-- Ação foi atualizada para a própria página -->
                        <label for="id_tipo">Tipo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                            </span>
                            <select name="id_tipo" id="id_tipo" class="form-control" required>
                                <?php foreach ($tipos as $tipo) { ?>
                                    <option value="<?= $tipo['id'] ?>">
                                        <?= $tipo['rotulo'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <label for="destaque">Destaque:</label>
                        <div class="input-group">
                            <label for="destaque_s" class="radio-inline">
                                <input type="radio" name="destaque" value="Sim" <?= $produto['destaque'] ?>>Sim
                            </label>
                            <label for="destaque_n" class="radio-inline">
                                <input type="radio" name="destaque" value="Não" <?= $produto['destaque'] ?>>Não
                            </label>
                        </div>

                        <label for="descricao">Descrição:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="descricao" id="descricao" class="form-control" 
                                   placeholder="Digite a descrição do Produto" maxlength="100" required
                                   value="<?=  $produto['descricao'] ?>"> <!-- Preenche com a descrição do produto -->
                        </div>

                        <label for="resumo">Resumo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                            </span>
                            <textarea name="resumo" id="resumo" cols="30" rows="8" 
                                      class="form-control" placeholder="Digite os detalhes do Produto" required><?=  ($produto['resumo']) ?></textarea> <!-- Preenche com o resumo do produto -->
                        </div>

                        <label for="valor">Valor:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                            </span>
                            <input type="number" name="valor" id="valor" class="form-control" 
                                   min="0" step="0.01" required
                                   value="<?=  $produto['valor'] ?>"> <!-- Preenche com o valor do produto -->
                        </div>

                        <label for="imagem">Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                            </span>
                            <img src="<?= isset($produto['imagem']) ? '../../images/' . ($produto['imagem']) : ''; ?>" id="imagem" class="img-responsive">
                            <input type="file" name="imagemfile" id="imagemfile" class="form-control" accept="image/*" required>
                        </div>

                        <br>
                        <input type="submit" name="enviar" class="btn btn-danger btn-block" value="Atualizar"> <!-- Altera o valor do botão para "Atualizar" -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById("imagemfile").onchange = function() {
    var reader = new FileReader();
    var file = this.files[0];

    if (file.size > 512000) {
        alert("A imagem deve ter no máximo 500KB");
        resetImage();
        return false;
    }

    if (file.type.indexOf("image") === -1) {
        alert("Formato inválido, escolha uma imagem!");
        resetImage();
        return false;
    }

    reader.onload = function(e) {
        document.getElementById("imagem").src = e.target.result;
    };
    reader.readAsDataURL(file);

    function resetImage() {
        document.getElementById("imagem").src = "";
        document.getElementById("imagemfile").value = "";
    }
};
</script>
</body>
</html>
