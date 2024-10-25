<?php
session_name('chulettaaa');
session_start();
session_unset();
session_destroy();
header("Location: ../view/index.php"); // Redireciona para a página de login
exit;
?>
