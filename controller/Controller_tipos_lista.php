<?php

 
require_once __DIR__ .'../../model/tipos_lista.php';
 
    class TipoController {
        private $lista;
    
        public function __construct() {//instanciando um objeto da classe
            $this->lista = new ListaTipos();
        }
    
        public function obterTipos() {//recebendo uma função da classe
            return $this->lista->ListarTipos();
        }
    
        public function contarTipos() {//recebendo uma função da classe
            return $this->lista->getNumLinhas();
        }
    
        public function proximoTipo() {//recebendo uma função da classe
            return $this->lista->fetchAll();
        }
    }
?>