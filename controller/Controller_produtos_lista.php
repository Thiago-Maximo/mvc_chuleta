<?php
    include 'Controller_acesso_com.php';
    include '../conn/connect.php';

    $lista = $conn->query("select * from vw_produtos");
    $row = $lista->fetch_assoc();
    $rows = $lista->num_rows;
?>