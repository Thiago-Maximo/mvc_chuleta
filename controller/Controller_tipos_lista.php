<?php

 
require_once('../model/tipos_lista.php');
 
    class TipoController {
        private $lista;
    
        public function __construct() {
            $this->lista = new ListaTipos();
        }
    
        public function obterTipos() {
            return $this->lista->ListarTipos();
        }
    
        public function contarTipos() {
            return $this->lista->getNumLinhas();
        }
    
        public function proximoTipo() {
            return $this->lista->fetchAll();
        }
    }
?>