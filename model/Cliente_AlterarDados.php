<?php
require_once __DIR__ . '/../model/connectPDO.php';

class Usuarios {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarPorLogin($login) {
        $sql = "SELECT * FROM clientes WHERE login = :login LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $login, $senha, $cpf) {
        $senhaCripto = md5($senha); // ⚠️ Recomendado migrar para password_hash()

        $sql = "UPDATE clientes SET login = :login, senha = :senha, cpf = :cpf WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senhaCripto);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
