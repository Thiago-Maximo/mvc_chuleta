<?php
$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "tincphpdb01";

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$banco", $user, $passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    echo "Erro na conexão: " . $erro->getMessage();
    exit;
}
?>
