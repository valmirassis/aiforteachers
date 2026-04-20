<?php
session_start();
require_once('../endpoints_api.php');
require_once('../functions.php');
require_once('../connection.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $base_type = $_POST['tipo_base'];
    $question_type = $_POST['tipo_questao'];
    $amount = $_POST['quantidade'];
    $difficulty = $_POST['dificuldade'];
    $infos_extras = $_POST['infos_extras'];

    if ($base_type === "tema") {
        $theme = $_POST['tema'];

        $data = [
            "token" => $API_TOKEN,
            "tema" => $theme,
            "tipo" => $question_type,
            "qtd" => $amount,
            "dificuldade" => $difficulty,
            "infos_extras" => $infos_extras
        ];

        $options = [
            "http" => [
                "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method"  => "POST",
                "content" => http_build_query($data),
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($API_QUESTAO_TEMA, false, $context);
       salvar_log($_SESSION['id'], "Gerou questão baseada em tema");
    } elseif ($base_type === "pdf" && isset($_FILES["arquivo"])) {
        $query = $_POST['consulta'];

        $file = new CURLFile($_FILES["arquivo"]["tmp_name"], $_FILES["arquivo"]["type"], $_FILES["arquivo"]["name"]);

        $data = [
            "token" => $API_TOKEN,
            "tipo" => $question_type,
            "qtd" => $amount,
            "dificuldade" => $difficulty,
            "infos_extras" => $infos_extras,
            "consulta" => $query,
            "arquivo" => $file
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_QUESTAO_PDF);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);
        salvar_log($_SESSION['id'], "Gerou questão baseada em PDF");
    }

    if (!empty($response)) {
        $result = json_decode($response, true);
    } else {
        $result = ["erro" => "Erro ao chamar a API"];
    }
}

 if (!empty($result) && isset($result['questoes'])): 
          require_once '../vendor/autoload.php';
        $md = $result['questoes'];
        $created = date('Y-m-d H:i:s');
        $type_rea = 1; // Define o tipo de REA
        $status = 1; // Define o status como ativo
        
        $md = preg_replace('/\binserir uma linha horizontal\b/i', "\n---\n", $md);
 
        $stmt = $conn->prepare("INSERT INTO rea (fk_type_rea_id, content, status, created, fk_person_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $type_rea, $md, $status, $created, $_SESSION['id']);
        $stmt->execute()
        or die("Erro ao salvar REA: " . $stmt->error);

        $Parsedown = new Parsedown();
        $Parsedown->setSafeMode(true); // evita HTML malicioso
        echo '<article class="resultado-md">'.$Parsedown->text($md).'</article>';
  
 endif;