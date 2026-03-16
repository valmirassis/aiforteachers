<?php
require 'connection.php';
include 'functions.php';
 require __DIR__ . '/vendor/autoload.php';
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if(isset($_POST['forgot_email'])) {
 
    $email = $_POST['forgot_email'];

    // Verifica se o email já está cadastrado
    $stmt = $conn->prepare("SELECT * FROM person WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows < 1) {
        die('erro1'); // Email não cadastrado
    } else {
        $dados = $result->fetch_assoc();
        $type_account = $dados['type_account'];
        if($type_account == "google") {
            die('erro3'); // Conta criada com Google
        } else if($type_account == "microsoft") {
            die('erro4'); // Conta criada com Microsoft
        } else {

       $nova_senha = bin2hex(random_bytes(4)); // Gera uma nova senha
       $hashed_password = password_hash($nova_senha, PASSWORD_DEFAULT);
       $stmt = $conn->prepare("UPDATE person SET password = ? WHERE email = ?");
       $stmt->bind_param("ss", $hashed_password, $email);
       if ($stmt->execute()) {

                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host       = $_ENV['SMTP_HOST'];
                        $mail->SMTPAuth   = true;
                        $mail->Username   = $_ENV['SMTP_USER'];
                        $mail->Password   = $_ENV['SMTP_PASS'];
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;
                        $mail->setFrom('noreply@aiforteachers.com.br', 'AiForTeachers');
                        $mail->addAddress($email);

                        $mail->Subject = 'Nova Senha - AiForTeachers';
                        $mail->Body    = "Olá professor,\n\nSua nova senha é: $nova_senha";

                        $mail->send();
                        echo 'sucesso';

                    } catch (Exception $e) {
                        echo "Erro ao enviar: {$mail->ErrorInfo}";
                    }

        //    echo 'sucesso';
       } else {
           die('erro2'); // Erro ao atualizar token
       }
    }
}
} else {
    echo "Acesso inválido.";
}