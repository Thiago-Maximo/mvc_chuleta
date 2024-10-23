<?php

 
include("../model/login.php");
 
    class LoginController {
        private $lista;
    
        public function __construct() {
            $this->lista = new Login();
        }
    
        public function realizarLogin() {
            return $this->lista->realizarLogin();
        }
    
        public function contarUser() {
            return $this->lista->NumLinhas();
        }
    
        public function proximoUserFetchAll() {
            return $this->lista->fetchAll();
        }

        public function proximoUserFetchAssoc(){
            return $this->lista->fetchAssoc;
        }
    }
?>