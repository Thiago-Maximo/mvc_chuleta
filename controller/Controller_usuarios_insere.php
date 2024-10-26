<?php
require_once __DIR__ . '/../model/Usuarios.php';
require_once __DIR__ . '/../model/connectPDO.php';

class UsuariosInsereController {
    private $model;

    public function __construct($pdo) {//instanciando um objeto da classe
        $this->model = new Usuarios($pdo);
    }

    public function inserirUsuario($login, $senha, $nivel) {//função de login
        return $this->model->inserirUsuario($login, $senha, $nivel);
    }

    public function listarNiveis() {//função de listar niveis
        return $this->model->listarNivel();
    }
}
