<?php

 
class ListaTipos {
    private $conexao;
    private $resultado;
 
    public function __construct() {
        $this->conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }
 
    public function ListarTipos() {
        $sql = "SELECT * FROM tipos";
        $this->resultado = $this->conexao->query($sql);
        return $this->resultado;
    }
 
    public function getNumLinhas() {
        return $this->resultado ? $this->resultado->num_rows : 0;
    }
 
    public function fetchAll() {
        return $this->resultado->fetch_all();
    }
}
?>