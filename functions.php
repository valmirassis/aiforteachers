<?php
if (session_status() === PHP_SESSION_NONE) {

// 8 horas
$lifetime = 8 * 60 * 60;

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
    $stmt = $conn->prepare("INSERT INTO log (fk_person_id, comment, created) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $id, $comentario);
    $resultado = $stmt->execute();
    $stmt->close();
    return $resultado;
}

?>
