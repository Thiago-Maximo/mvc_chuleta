<?php
require_once __DIR__ . '/../../controller/Controller_usuarios_lista.php';
require_once __DIR__ . '/../../model/connectPDO.php';


$controller = new UsuariosListaController($pdo); // Instancia o controller

// Obtém a lista de usuários
$lista = $controller->obterUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilo.css">
</head>
<body>
    <?php include 'menu_adm.php'; ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Usuários</h2>
        <table class="table table-hover table-condensed tb-opacidade bg-warning">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>Usuários</th>
                    <th>Níveis</th>
                    <th>
                        <a href="usuarios_insere.php" target="_self" class="btn btn-block btn-primary" role="button">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            <span class="hidden-xs">ADICIONAR</span>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $row) { ?> <!-- Laço para exibir cada usuário -->
                    <tr>
                        <td class="hidden"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['login']; ?></td>
                        <td><?php echo $row['nivel']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
