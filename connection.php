<?php
// Conexão com o banco de dados

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

date_default_timezone_set('America/Sao_Paulo');

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];



// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset('utf8mb4'); 
// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$conn->query('SET wait_timeout = 300');
$conn->query('SET interactive_timeout = 300');