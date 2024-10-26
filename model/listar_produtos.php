<?php

 
class Lista {
    private $conexao;
    private $resultado;
 
    public function __construct() {//Conexão com o banco de dados
        $this->conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }
 
    public function listarProdutos() {//Função para listar os produtos
        $sql = "SELECT * FROM vw_produtos";
        $this->resultado = $this->conexao->query($sql);
        return $this->resultado;
    }
 
    public function getNumLinhas() {// função para pegar o numero de linhas que retornou do banco de dados
        return $this->resultado ? $this->resultado->num_rows : 0;
    }
 
    public function fetchAssoc() {//função para passar por cada linha do banco de dados
        return $this->resultado->fetch_assoc();
    }
}
?>