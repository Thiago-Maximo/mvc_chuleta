<?php

    class ListaDestaque{
        private $conexao;
        private $resultado;

        public function __construct(){
            //fazendo a conexão com o banco de dados (eu sei que é esquisito eu usar mysqli e pdo em 
            //arquivos diferentes,
            //fiz isso para treinar e sei que poderia apenas fazer o include do arquivo de conexao)
            $this->conexao = new mysqli('localhost', 'root', '', 'tincphpdb01');
            if($this->conexao->connect_error){
                die("Erro de Conexão: ". $this->conexao->connect_error);
            }
        }

        public function ListarProdutos(){// função para listar todos os produtos
            $sql = "SELECT * FROM vw_produtos WHERE destaque = 'Sim'";
            $this -> resultado = $this -> conexao -> query($sql);
            return $this-> resultado;
        }

        public function getNumLinhas(){// função para pegar todas as linhas do banco de dados
            return $this -> resultado ? $this -> resultado->num_rows : 0;
        }

        public function fetchAssoc(){// função para passar por cada linha do banco
            return $this -> resultado->fetch_assoc();
        }
    }
?>