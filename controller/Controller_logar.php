<?php
session_name('chulettaaa');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
require_once __DIR__ . '/../controller/Controller_login.php';
require_once __DIR__ . '/../model/connectPDO.php';
 
$loginController = new LoginController($pdo);
$loginController->handleLogin();