<?php
require 'config.php';

if (empty($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

echo "<h2>Olá, ".$_SESSION['name']."</h2>";
echo "<p>Email: ".$_SESSION['email']."</p>";
echo "<p>Tipo de Conta: ".$_SESSION['type_account']."</p>";
echo "<p>Nível: ".$_SESSION['level']."</p>";
echo '<a href="logout.php">Sair</a>';