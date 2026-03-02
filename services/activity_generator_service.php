<?php
session_start();
require_once('../endpoints_api.php');
require_once('../functions.php');
require_once('../connection.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $base_type = $_POST['tipo_base'];
    $activity_type = $_POST['tipo_atividade'];
    $amount = $_POST['quantidade'];
    $extra_infs = $_POST['infos_extras'];
    $difficulty = $_POST['dificuldade'];

    if ($base_type === "tema") {
        $theme = $_POST['tema'];
        $extra_infs =  $extra_infs;

        $data = [
            "token" => $API_TOKEN,
            "tema" => $theme,
            "tipo" => $activity_type,
            "quantidade" => $amount,
            "infos_extras" => $extra_infs,
            "nivel" => $difficulty
        ];

        $options = [
            "http" => [
                "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method"  => "POST",
                "content" => http_build_query($data),
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($API_ATIVIDADE_TEMA, false, $context);
        salvar_log($_SESSION['id'], "Gerou atividade baseada em tema");
    } elseif ($base_type === "pdf" && isset($_FILES["arquivo"])) {
        $query = $_POST['consulta'];

        $file = new CURLFile($_FILES["arquivo"]["tmp_name"], $_FILES["arquivo"]["type"], $_FILES["arquivo"]["name"]);

        $data = [
            "token" => $API_TOKEN,
            "tipo" => $activity_type,
            "quantidade" => $amount,
            "infos_extras" => $extra_infs,
            "nivel" => $difficulty,
            "consulta" => $query,
            "arquivo" => $file
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_ATIVIDADE_PDF);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);
        salvar_log($_SESSION['id'], "Gerou atividade baseada em PDF");
    }

    if (!empty($response)) {
        $result = json_decode($response, true);
    } else {
        $result = ["erro" => "Erro ao chamar a API"];
    }
}

 if (!empty($result) && isset($result['atividade'])) { 
          require_once '../vendor/autoload.php';
        $md = $result['atividade']; 
        $tema = $result['tema'];
        $nivel = $result['nivel'];
        $content = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $created = date('Y-m-d H:i:s');
        $type_rea = 4; // Define o tipo de REA
        $status = 1; // Define o status como ativo
        

        $md = preg_replace('/\binserir uma linha horizontal\b/i', "\n---\n", $md);

        $title_activity = "<p><strong>Tema:</strong> $tema <strong>Nível:</strong> $nivel</p>";

        $stmt = $conn->prepare("INSERT INTO rea (fk_type_rea_id, content, status, created, fk_person_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $type_rea, $content, $status, $created, $_SESSION['id']);
        $stmt->execute();

        $Parsedown = new Parsedown();
        $md = $Parsedown->text($md);
        $md = preg_replace('/<table>/', "<table class='table table-striped'>", $md);
        // $Parsedown->setSafeMode(true); // evita HTML malicioso
        echo '<article class="resultado-md">'.$title_activity.$md.'</article>';

  }