<?php
session_start();
$_SESSION = [];           // limpa array da sessão
session_destroy();        // destrói a sessão no servidor

// destruir cookie também
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redireciona para home ou página de login
header("Location: /");
exit;