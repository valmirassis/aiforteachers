<?php
require 'config.php';

// Destrói sessão local
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();

// URL de logout da Microsoft com post_logout_redirect_uri
$POST_LOGOUT_REDIRECT = 'https://aiforteachers.com.br/'; 
$logoutUrl = 'https://login.microsoftonline.com/common/oauth2/v2.0/logout?post_logout_redirect_uri='
           . urlencode($POST_LOGOUT_REDIRECT);

header('Location: '.$logoutUrl);
exit;