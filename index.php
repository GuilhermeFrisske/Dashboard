<?php
require_once 'config.php';

// Proteção: Se não houver sessão, manda para o login
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.html");
    exit();
}

$nomeUsuario = $_SESSION['user_name'] ?? 'Operador';
$cargoUsuario = $_SESSION['user_role'] ?? 'Logistics Staff';
?>
<!DOCTYPE html>
<html lang="en">