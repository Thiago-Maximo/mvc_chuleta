<?php
    //tenho que iniciar uma sessão aqui na conexão já que estou trabalhando com sessões
    //session_start();

//classe de conexão com o banco de dados orientada a objetos

$dsn= 'mysql:host=localhost;dbname=tincphpdb01';
$user='root';
$pass='';

global $pdo;
//Tratamento de erro na conexão com o banco de dados
try {
    $pdo = new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $erro) {
    echo "Erro:".$erro->getMessage();
    exit;
}
?>