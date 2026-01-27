<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Dados de conexão
$host = 'localhost';
$db   = 'test_dashboard';
$user = 'root';
$pass = '';

try {
    // 3. Conexão PDO com suporte a caracteres especiais (UTF-8)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
    // 4. Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 5. Define o fuso horário para os relatórios de logística
    date_default_timezone_set('America/Sao_Paulo');

} catch (PDOException $e) {
    // Em produção, não exiba o erro detalhado por segurança
    die("Erro crítico no sistema de telemetria: " . $e->getMessage());
}
?>