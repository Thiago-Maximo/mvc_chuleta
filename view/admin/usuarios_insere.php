<?php
require_once __DIR__ . '/../../controller/Controller_usuarios_insere.php';
require_once __DIR__ . '/../../model/connectPDO.php';

$controller = new UsuariosInsereController($pdo);

$listaNiveis = $controller->listarNiveis();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['Login'];
    $senha = $_POST['Senha'];
    $nivel = $_POST['nivel'];

    $controller->inserirUsuario($login, $senha, $nivel);

    echo "<script>
        alert('Usuário cadastrado com sucesso!');
        window.location.href = 'usuarios_lista.php'; 
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
    <title>Inserir Usuário</title>
</head>
<body>
    <?php include "menu_adm.php"; ?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="usuarios_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Usuário
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="usuarios_insere.php" method="post" 
                            name="form_insere" enctype="multipart/form-data" id="form_insere">
                            
                            <label for="id_tipo">Nível:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <select name="nivel" id="id_tipo" class="form-control" required>
                                    <?php foreach ($listaNiveis as $nivel) { ?>
                                        <option value="<?php echo $nivel['nivel']; ?>">
                                            <?php echo $nivel['nivel']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label for="Login">Login:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="Login" id="Login" 
                                    class="form-control" placeholder="Digite o Login" maxlength="100" required>
                            </div>

                            <label for="Senha">Senha:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                </span>
                                <input type="password" name="Senha" id="Senha" 
                                    class="form-control" placeholder="Digite a Senha" maxlength="100" required>
                            </div>

                            <br>
                            <input type="submit" name="enviar" id="enviar" 
                                class="btn btn-danger btn-block" value="Cadastrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
