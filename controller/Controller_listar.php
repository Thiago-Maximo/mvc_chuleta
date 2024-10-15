<?php
require_once('../model/init.php');

Class listarController{
    private $lista;

    public function __construct(){
        $this-> lista = new Lista();
        $this-> criarTabela();
    }

    private function criarTabela(){
        $dados = $this-> lista-> getLivro();
        foreach($dados as $dado){
            echo"<tr>";0
            echo"<th>".$dado['descricao']."</th>";
            echo"<td>".$dado['resumo']."</td>";
            echo"<td>".number_format($dado['preco'],2,",",".")."</td>";
            echo"<td>".$dado['imagem']."</td>";
            echo"<td>
                <a class= ' btn btn-warning' href='editar.php?id=".$dado['nome']."'>
                    Editar
                </a>
                &nbsp&nbsp
                <a class='btn btn-danger' href='../controller/ControllerDeletar.php?id=".$dado['nome']."'>
                    Excluir
                </a></td>";
            echo"</tr>";
        }
    }
}
?>