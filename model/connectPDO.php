<?php
    $localhost = "localhost";
    $user = "root";
    $passw = "";
    $banco = "tincphpdb01";
    
    global $pdo;
    try{
        //orientado a objetos
        $pdo = new PDO("mysql:dbname=".$banco."; host=".$localhost,$user,$passw);
        $pdo -> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    }catch(PDOException $erro){
        echo "Erro".$erro->getmessage();
        exit;
    }
?>