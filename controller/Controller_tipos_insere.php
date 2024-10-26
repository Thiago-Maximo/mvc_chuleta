<?php
require_once __DIR__ . '/../model/Tipos_Inserir.php';

require_once __DIR__ . '/../model/connectPDO.php'; // Conexão com banco

class InserirTipoController {
    private $model;

    public function __construct($pdo) { // Recebe a conexão PDO
        $this->model = new InserirTipo($pdo); // Instancia o model
    }

    public function inserirTipo($sigla, $rotulo) { // Função para inserir tipo
        return $this->model->inserirTipo($sigla, $rotulo); // Insere o tipo
    }
}
