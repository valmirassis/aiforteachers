<?php
require '../vendor/autoload.php';
require 'config.php';

use Jumbojett\OpenIDConnectClient;

try {
    $oidc = new OpenIDConnectClient(null, $CLIENT_ID, $CLIENT_SECRET);

    // >>> Config manual para multitenant (common v2.0)
    $issuer = 'https://login.microsoftonline.com/common/v2.0';
    $oidc->setIssuer($issuer);
    $oidc->setProviderURL($issuer); 
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
    // $oidc->addAuthParam('prompt','select_account'); // opcional

    $oidc->authenticate();

    $name  = $oidc->requestUserInfo('name') ?? '';
    $email = $oidc->requestUserInfo('email') 
          ?? $oidc->requestUserInfo('preferred_username') 
          ?? '';
    $oid   = $oidc->requestUserInfo('oid') ?? '';

   if (empty($email)) {
        throw new Exception('Email não encontrado no perfil do usuário.');
    }

    require '../connection.php'; 
    require '../functions.php'; 
    $id= "";
    $stmt = $conn->prepare("SELECT id, email FROM person WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $typeAccount = 'microsoft';
    $status = "1";
    $level = "1";
    $created = date("Y-m-d H:i:s");
    $password = "";
    if (!$result->num_rows) {
        $stmt = $conn->prepare("INSERT INTO person (name, email, password, type_account, status, created, level) VALUES (?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("sssssss", $name, $email, $password, $typeAccount, $status, $created, $level);
        $stmt->execute();
        $id = $conn->insert_id; // Obtém o ID do usuário recém-criado
        if ($stmt->error) {
            throw new Exception('Erro ao criar conta: ' . $stmt->error);
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['type_account'] = $typeAccount;
            $_SESSION['name'] = $name;
            $_SESSION['level'] = $level;
            $_SESSION['id'] = $id;
        }
    } else {
            $_SESSION['email'] = $email;
            $_SESSION['type_account'] = $typeAccount;
            $_SESSION['name'] = $name;
            $_SESSION['level'] = $level;
            $_SESSION['id'] = $id;
    }
    salvar_log($id, "Login realizado");
    session_regenerate_id(true);

    header('Location: ../my_account.php');
    exit;
} catch (Exception $e) {
    http_response_code(500);
    echo "Erro no login: ".$e->getMessage();
}