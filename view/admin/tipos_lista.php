<?php
    require_once __DIR__ . '/../../controller/Controller_tipos_lista.php';
    require_once __DIR__ . '/../../model/tipos_lista.php';

    // Criação do controller e obtenção dos tipos
    $controller = new TipoController();
    $lista = $controller->obterTipos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Lista</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilo.css">
</head>
<body>
    <?php include 'menu_adm.php'; ?>

    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Produtos</h2>

        <table class="table table-hover table-condensed tb-opacidade bg-warning">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>TIPO</th>
                    <th>DESCRIÇÃO</th>
                    <th>
                        <a href="tipos_insere.php" class="btn btn-block btn-primary">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            <span class="hidden-xs">ADICIONAR</span>
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php if ($lista->num_rows > 0): ?>
                    <!-- Loop para exibir cada linha -->
                    <?php while ($row = $lista->fetch_assoc()): ?>
                        <tr>
                            <td class="hidden"><?php echo $row['id']; ?></td>
                            <td><?php echo $row['sigla']; ?></td>
                            <td><?php echo $row['rotulo']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- Mensagem caso não haja registros -->
                    <tr>
                        <td colspan="3" class="text-center">Nenhum tipo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
