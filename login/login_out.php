<?php
// 1. Volta uma pasta para achar o config
require_once '../config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    // 2. Busca o usuário no banco
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // 3. Verifica a senha (precisa estar criptografada no banco com password_hash)
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        $_SESSION['user_role'] = $user['cargo'];
        
        header("Location: ../index.php"); // Sucesso! Vai para o dashboard
        exit();
    } else {
        header("Location: login.html?error=invalid"); // Erro! Volta para o formulário
        exit();
    }
}
?>