<?php
session_start();
require_once('../endpoints_api.php');
require_once('../functions.php');
require_once('../connection.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $base_type = $_POST['tipo_base'];
    $script_type = $_POST['tipo_roteiro'];
    $time = $_POST['tempo'];
    $extra_infs = $_POST['infos_extras'];

    if ($base_type === "tema") {
        $theme = $_POST['tema'];
        $extra_infs =  $extra_infs;
        $data = [
            "token" => $API_TOKEN,
            "tema" => $theme,
            "tipo" => $script_type,
            "tempo" => $time,
            "infos_extras" => $extra_infs
        ];

        $options = [
            "http" => [
                "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method"  => "POST",
                "content" => http_build_query($data),
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($API_ROTEIRO_TEMA, false, $context);
        salvar_log($_SESSION['id'], "Gerou roteiro baseado em tema");
    } elseif ($base_type === "pdf" && isset($_FILES["arquivo"])) {
        $query = $_POST['consulta'];

        $file = new CURLFile($_FILES["arquivo"]["tmp_name"], $_FILES["arquivo"]["type"], $_FILES["arquivo"]["name"]);

        $data = [
            "token" => $API_TOKEN,
            "tipo" => $script_type,
            "tempo" => $time,
            "infos_extras" => $extra_infs,
            "consulta" => $query,
            "arquivo" => $file
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_ROTEIRO_PDF);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);
        salvar_log($_SESSION['id'], "Gerou roteiro baseado em PDF");
    }

    if (!empty($response)) {
        $result = json_decode($response, true);
    } else {
        $result = ["erro" => "Erro ao chamar a API"];
    }
}

 if (!empty($result) && isset($result['roteiro'])): 
          require_once '../vendor/autoload.php';
        $md = $result['roteiro'];
        $content = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $created = date('Y-m-d H:i:s');
        $type_rea = 5; // Define o tipo de REA
        $status = 1; // Define o status como ativo
        
        $md = preg_replace('/\binserir uma linha horizontal\b/i', "\n---\n", $md);

        $stmt = $conn->prepare("INSERT INTO rea (fk_type_rea_id, content, status, created, fk_person_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $type_rea, $content, $status, $created, $_SESSION['id']);
        $stmt->execute();

        $Parsedown = new Parsedown();
        $md = $Parsedown->text($md);
        $md = preg_replace('/<table>/', "<table class='table table-striped'>", $md);
        echo '<article class="resultado-md">'.$md.'</article>';

 endif;