<?php
include_once 'functions.php';

function login($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT password, type_account, name, level, id FROM person WHERE email = ?");
    if (!$stmt) return false;

    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $hashedPassword = '';
    $typeAccount = '';
    $name = '';
    $level = '';
    $id = '';
    $stmt->bind_result($hashedPassword, $typeAccount, $name, $level, $id);
    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION['email'] = $username;
        $_SESSION['type_account'] = $typeAccount;
        $_SESSION['name'] = $name;
        $_SESSION['level'] = $level;
        $_SESSION['id'] = $id;
        $stmt->close();
        return true;
    }

    $stmt->close();
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'];
    $password = $_POST['password'];
    $redirect = $_POST['redirect'];

    if (login($conn, $username, $password)) {
        salvar_log($_SESSION['id'], "Login realizado");
        if (empty($redirect)) {
            $redirect = 'my_account.php';
        } else {
            $redirect = filter_var($redirect, FILTER_SANITIZE_URL);
        }


        header('Location: ' . $redirect);
        
        exit;
    } else {
        if (empty($redirect)) {
            $redirect = 'my_account.php';
        } else {
            $redirect = filter_var($redirect, FILTER_SANITIZE_URL);
        }
        // echo "<script>alert('Credenciais inválidas.');</script>";
       
        $redirectUrl = "login.php?erro=1&redirect=" . urlencode($redirect);
        echo "<script> window.location.replace(" . json_encode($redirectUrl) . ");</script>";
            exit;

    }
}