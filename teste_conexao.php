<?php
$host = 'localhost';
$db = 'socars'; // nome do banco
$user = 'root';
$pass = ''; // sem senha!

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexão com o banco de dados realizada com sucesso!";
} catch (PDOException $e) {
    die("❌ Erro na conexão: " . $e->getMessage());
}
?>
