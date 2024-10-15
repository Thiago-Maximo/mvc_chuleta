<?php 
include 'conn/connect.php';
$lista = $conn->query('select * from vw_produtos');
$row_produtos = $lista->fetch_assoc();
$num_linhas = $lista->num_rows;
?>