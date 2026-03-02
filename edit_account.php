<?php
require 'connection.php';
include 'functions.php';
if(isset($_POST['new_name'])) {
    $id = $_POST['id'];
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    // Verifica se as senhas coincidem
    if($new_password !== $new_password_confirm) {
        die('As senhas não coincidem.');
    }

    // Verifica se o email já está cadastrado
    $stmt = $conn->prepare("SELECT * FROM person WHERE email = ? AND id != ?");
    $stmt->bind_param("ss", $new_email, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        die('erro1'); // Email já cadastrado para outro usuário
    }

        // Se a senha não for fornecida, mantenha a senha atual 
    if (empty($new_password)) {
        $stmt = $conn->prepare("UPDATE person SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $new_name, $new_email, $id);
    } else {
       $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
   
    $stmt = $conn->prepare("UPDATE person SET name=?, email=?, password=? WHERE id=?");
    $stmt->bind_param("ssss", $new_name, $new_email, $hashed_password, $id);
    }
    
    if (!$stmt) {
        die('erro2'); // Erro ao preparar a consulta
    }
    if ($stmt->execute()) {

        echo 'sucesso';
        $comentario = "Conta atualizada.";
        salvar_log($id, $comentario);
    } else {
        echo 'erro2'; // Erro ao criar conta
    }
}