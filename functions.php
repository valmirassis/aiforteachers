<?php
if (session_status() === PHP_SESSION_NONE) {

// 4 horas
$lifetime = 4 * 60 * 60;

// Tempo de vida dos dados no servidor
ini_set('session.gc_maxlifetime', $lifetime);

// Tempo de vida do cookie no navegador
session_set_cookie_params([
    'lifetime' => $lifetime,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax'
]);

    session_start();
}

include_once 'connection.php';
function salvar_log($id, $comentario) {
  global $conn;
    // $conn = getConnection($conn, $servername, $username, $password, $dbname);
    $stmt = $conn->prepare("INSERT INTO log (fk_person_id, comment, created) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $id, $comentario);
    $resultado = $stmt->execute();
    $stmt->close();
    return $resultado;
}

// function getConnection($conn, $host, $user, $pass, $db) {
//     if (!$conn || !$conn->ping()) {
//         if ($conn) { $conn->close(); }
//         $conn = new mysqli($host, $user, $pass, $db);
//         if ($conn->connect_errno) {
//             die("Erro ao conectar ao MySQL: " . $conn->connect_error);
//         }
//     }
//     return $conn;
// }
?>
