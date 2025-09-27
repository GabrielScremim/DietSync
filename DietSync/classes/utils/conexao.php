<?php

$dbname = 'dietsync2';
$host = 'localhost';
$user = 'segobinho';
$senha = '123';

try {
    $pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
    exit();
}
