<?php
require 'connection.php';
include 'functions.php';
if(isset($_POST['new_name'])) {
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    // Verifica se as senhas coincidem
    if($new_password !== $new_password_confirm) {
        die('As senhas não coincidem.');
    }

    // Verifica se o email já está cadastrado
    $stmt = $conn->prepare("SELECT * FROM person WHERE email = ?");
    $stmt->bind_param("s", $new_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        die('erro1'); // Email já cadastrado
    }
    $type_account = "email";
    $status = "1";
    $level = "1";
    $created = date("Y-m-d H:i:s");
    // Cria a conta
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO person (name, email, password, type_account, status, created, level) VALUES (?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssss", $new_name, $new_email, $hashed_password, $type_account, $status, $created, $level);
    if (!$stmt) {
        die('erro2'); // Erro ao preparar a consulta
    }
    if ($stmt->execute()) {

        echo 'sucesso';
        $usuario_id = $conn->insert_id; // Obtém o ID do usuário recém-criado
        $comentario = "Conta criada.";
        salvar_log($usuario_id, $comentario);
    } else {
        echo 'erro2'; // Erro ao criar conta
    }
}