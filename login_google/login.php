<?php
session_start();
require '../vendor/autoload.php';
require 'config.php';

use Jumbojett\OpenIDConnectClient;

// Descoberta automática OIDC do Google:
$oidc = new OpenIDConnectClient(
    'https://accounts.google.com',
    $GOOGLE_CLIENT_ID,
    $GOOGLE_CLIENT_SECRET
);
$oidc->setRedirectURL($GOOGLE_REDIRECT_URI);
$oidc->addScope(['openid','email','profile']);

// Opcional: força consentimento/conta
// $oidc->addAuthParam(['prompt' => 'select_account']);

$oidc->authenticate(); // redireciona p/ Google
// Se voltar logado, você cai direto aqui (com tokens)
$claims = $oidc->requestUserInfo(); // pega claims do id_token/userinfo

 require '../connection.php'; 
 require '../functions.php'; 
    $name = $claims->name;
    $email = $claims->email;
    $id= "";
    $stmt = $conn->prepare("SELECT id, email FROM person WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $typeAccount = 'google'; 
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
// Salva sessão
// $typeAccount = 'google';    
// $_SESSION['email'] = $claims->email ?? null;
// $_SESSION['name']  = $claims->name  ?? null;
// $_SESSION['type_account'] = $typeAccount;
// $_SESSION['level'] = $level;
header('Location: ../my_account.php'); // vai para sua home
exit;