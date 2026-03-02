<?php
session_start();
if (isset($_SESSION['email'])) {
    if ($_SESSION['type_account'] == 'email') {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
    } else if ($_SESSION['type_account'] == 'google') {
        header('Location: login_google/logout.php');
    } else if ($_SESSION['type_account'] == 'microsoft') {
        header('Location: login_microsoft/logout.php');
    }
}


exit;
