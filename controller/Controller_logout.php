<?php
session_name('chulettaaa');
session_start();
session_destroy();
header("Location: ../view/index.php");
exit;
?>