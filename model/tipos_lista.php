<?php

 
class ListaTipos {
    private $conexao;
    private $resultado;
 
    public function __construct() {//conexão com o banco de dados
        $this->conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }
 
    public function ListarTipos() {//lista todos os tipos
        
        $sql = "SELECT * FROM tipos";
        $this->resultado = $this->conexao->query($sql);
        return $this->resultado;
    }
    
    public function ListarProduto(){//lista os produtos com base no seu tipo
        $idTipo = $_GET['id_tipo'];
        
        $sql = "SELECT * FROM vw_produtos INNER JOIN tipos ON vw_produtos.tipo_id = tipos.id'";
        $this->resultado = $this->conexao->query($sql);
        return $this->resultado;
    }

    public function getNumLinhas() {//retorna a quantidade de linhas do banco de dados
        return $this->resultado ? $this->resultado->num_rows : 0;
    }
 
    public function fetchAll() {//retona todas as strings do banco
        return $this->resultado->fetch_all();
    }

    public function fetchAssoc() {//passa por cada linha do banco de dados
        return $this->resultado->fetch_assoc();
    }
}
?>