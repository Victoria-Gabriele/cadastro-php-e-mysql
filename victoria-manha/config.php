<?php
$host = 'localhost'; // Host do banco de dados
$dbname = 'produtos_cad'; // Nome do banco de dados
$user = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>

