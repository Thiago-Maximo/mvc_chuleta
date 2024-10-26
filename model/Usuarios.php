<?php
require_once __DIR__ . '/../model/connectPDO.php';

class Usuarios {
    private $pdo;

    public function __construct($pdo) { //conexão com o banco de dados
        $this->pdo = $pdo;
    }

    public function listar() {//listagem dos usuarios
        $sql = "SELECT * FROM usuarios"; //comando mysql
        $stmt = $this->pdo->prepare($sql); //preparando o comando para ser executado
        $stmt->execute(); //executando o comando
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorna os usuarios
    }

    public function listarNivel() {//listagem dos niveis
        $sql = "SELECT DISTINCT nivel FROM usuarios"; //comando mysql
        $stmt = $this->pdo->prepare($sql); //preparando o comando para ser executado
        $stmt->execute(); //executando o comando
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorna os usuarios
    }

    public function inserirUsuario($login, $senha, $nivel) {//inserção dos niveis
        $senha_cripto = md5($senha); // Criptografar senha

        $sql = "INSERT INTO usuarios (login, senha, nivel) VALUES (:login, :senha, :nivel)"; //comando mysql
        $stmt = $this->pdo->prepare($sql); //preparando o comando para ser executado

        $stmt->bindParam(':login', $login); //bind para previnir injeções mysql
        $stmt->bindParam(':senha', $senha_cripto); 
        $stmt->bindParam(':nivel', $nivel); 

        $stmt->execute();//executando o comando
        return $this->pdo->lastInsertId(); // Retorna o ID do usuario inserido
    }
}
