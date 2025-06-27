<?php
require_once __DIR__ . '/../model/Cliente_AlterarDados.php';

class UsuariosListaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Usuarios($pdo);
    }

    public function obterUsuarioPorLogin($login) {
        return $this->model->buscarPorLogin($login);
    }

    public function atualizarUsuario($id, $login, $senha, $cpf) {
        return $this->model->atualizar($id, $login, $senha, $cpf);
    }
}
