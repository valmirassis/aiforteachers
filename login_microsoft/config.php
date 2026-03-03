<?php

$rootPath = dirname(__DIR__);

require $rootPath . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();

$CLIENT_ID     = $_ENV['MICROSOFT_CLIENT_ID'];
$CLIENT_SECRET = $_ENV['MICROSOFT_CLIENT_SECRET'];
$REDIRECT_URI  = 'https://aiforteachers.com.br/login_microsoft/callback.php';
$POST_LOGOUT_REDIRECT = 'https://aiforteachers.com.br/';

// Authority “v2.0” (pode usar tenant específico em vez de common)
$TENANT_ID     = 'common'; // ou seu tenant específico
$AUTHORITY     = 'https://login.microsoftonline.com/'.$TENANT_ID.'/v2.0';
$DISCOVERY_URL = $AUTHORITY.'/.well-known/openid-configuration';

// Ajuste cookies de sessão (evita loops em ambiente cross-site)
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.cookie_secure', '1');
    ini_set('session.cookie_samesite', 'None');
    ini_set('session.cookie_httponly', '1');
    session_start();
}