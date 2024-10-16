<?php

 
class Lista {
    private $conexao;
    private $resultado;
 
    public function __construct() {
        $this->conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }
 
    public function listarProdutos() {
        $sql = "SELECT * FROM vw_produtos";
        $this->resultado = $this->conexao->query($sql);
        return $this->resultado;
    }
 
    public function getNumLinhas() {
        return $this->resultado ? $this->resultado->num_rows : 0;
    }
 
    public function fetchAssoc() {
        return $this->resultado->fetch_assoc();
    }
}
?>