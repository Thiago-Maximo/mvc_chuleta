<!-- CONECTAR COM O BANCO E SELECIONAR AS INFORMAÇÕES -->

<?php
class Usuario {

    public function login($login, $senha) {
        global $pdo;
        include '../model/connect.php';
        

            if($_POST){
                $login = $_POST['login'];
                $senha = md5($_POST['senha']);
                $loginRes = $conn->query("Select * from usuarios where login = '$login' and senha = '$senha'");
                $rowLogin = $loginRes->fetch_assoc();
                $numRow = $loginRes->num_rows;
                //se a sessão não existir
                if(!isset($_SESSION)){
                    $sessaoAntiga = session_name('chulettaaa');
                    session_start();
                    $session_name_new = session_name();
                }
                if ($numRow > 0) {
                    $_SESSION['login_usuario'] = $login;
                    $_SESSION['nivel_usuario'] = $rowLogin['nivel'];
                    $_SESSION['nome_da_sessao'] = session_name();
                    if ($rowLogin['nivel'] == 'sup') {
                        echo "<script>window.open('index.php','_self')</script>";
                    } else {
                        echo "<script>window.open('../view/cliente/index.php?cliente=" . $login . "','_self')</script>"; // Corrigido aqui
                    }
                } else {
                    echo "<script>window.open('Controller_invasor.php','_self')</script>";
                }
                
            }
    }
}
?>