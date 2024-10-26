<?php
require_once __DIR__ . '/../model/Usuarios.php'; // Caminho corrigido
require_once __DIR__ . '/../model/connectPDO.php'; // Conexão com banco

class UsuariosListaController {
    private $model;

    public function __construct($pdo) { // Recebe a conexão PDO
        $this->model = new Usuarios($pdo); // Instancia o model
    }

    public function obterUsuarios() { // Função para obter usuários
        return $this->model->listar(); // Chama a função listar do model
    }
}
