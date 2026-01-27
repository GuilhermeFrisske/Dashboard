<?php
require_once '../config.php'; // Voltando uma pasta para achar o config

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // password_verify checa a senha digitada contra o hash do banco
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        $_SESSION['user_role'] = $user['cargo'];
        header("Location: ../index.php"); // Login com sucesso!
        exit();
    } else {
        header("Location: login.html?error=invalid"); // Erro de credenciais
        exit();
    }
}
?>