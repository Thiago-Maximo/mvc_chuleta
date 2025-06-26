<?php
require_once __DIR__ . '/../../model/connectPDO.php';

// Busca os produtos
$stmt = $pdo->query("SELECT id, descricao FROM produtos ORDER BY descricao");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../../images/logo-chuleta.png" alt="Logo Chuleta" style="height:30px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#defaultNavbar" aria-controls="defaultNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="defaultNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button type="button" class="btn btn-danger navbar-btn" disabled style="cursor: default;">
                        Olá, <!-- USUÁRIO -->!
                    </button>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Atendente <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">
                        <span class="glyphicon glyphicon-home"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../controller/Controller_logout.php">
                        <span class="glyphicon glyphicon-log-out"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Novo Pedido</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="../../processa_pedido.php">
                <div class="form-group">
                    <label for="cliente">Nome do Cliente</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" required placeholder="Digite o nome do cliente" />
                </div>

                <div class="form-group">
                    <label for="mesa">Mesa</label>
                    <input type="text" class="form-control" id="mesa" name="mesa" required placeholder="Número ou identificador da mesa" />
                </div>

                <div class="form-group">
                    <label for="pedido">Pedido</label>
                    <select class="form-control" id="pedido" name="pedido" required>
                        <option value="">Selecione um produto</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto['id'] ?>"><?= htmlspecialchars($produto['descricao']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" required min="1" placeholder="Ex: 1, 2, 3..." />
                </div>

                <button type="submit" class="btn btn-success">Registrar Pedido</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
