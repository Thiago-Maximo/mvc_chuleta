<?php
function conectar() {
    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'tincphpdb01';

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    return $conexao;
}
?>
