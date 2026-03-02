<?php
require '../vendor/autoload.php';
require 'config.php';
use Jumbojett\OpenIDConnectClient;

if (!empty($_SESSION['email'])) {
    header('Location: ../my_account.php');
    exit;
}

$oidc = new OpenIDConnectClient(null, $CLIENT_ID, $CLIENT_SECRET);

// issuer/provider para 'common' (multitenant)
$issuer = 'https://login.microsoftonline.com/common/v2.0';
// $oidc->setIssuer($issuer);
$oidc->setProviderURL($issuer); // <-- necessário para a checagem interna

// endpoints manuais
$oidc->providerConfigParam([
  'authorization_endpoint' => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
  'token_endpoint'         => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
  'userinfo_endpoint'      => 'https://graph.microsoft.com/oidc/userinfo',
  'jwks_uri'               => 'https://login.microsoftonline.com/common/discovery/v2.0/keys'
]);

$oidc->setIssuerValidator(function ($iss) {
        return preg_match('#^https://login\.microsoftonline\.com/[0-9a-fA-F-]+/v2\.0$#', $iss) === 1;
    });

$oidc->setRedirectURL($REDIRECT_URI);
$oidc->addScope(['openid','profile','email','offline_access']);


// opcional: força seleção da conta
$oidc->addAuthParam(['prompt','select_account']);

$oidc->authenticate(); // redireciona para Microsoft