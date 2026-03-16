<?php
session_start();
require_once('../endpoints_api.php');
require_once('../functions.php');
require_once('../connection.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $type_transformation = $_POST['tipo_transformacao'];
    $extra_infs = $_POST['infos_extras'];
    $base_type = isset($_POST['tipo_base']) ? $_POST['tipo_base'] : null;
if ($base_type <> "pdf") {


if ($type_transformation === "A") { // Tradução
        $transformer = "tradução";
        $API_TRANSFORMER = $API_TRANSLATE_TEXT;
        $text = $_POST['texto'];
        $language = $_POST['idioma'];
        $data = [
            "token" => $API_TOKEN,
            "texto" => $text,
            "tipo" => $type_transformation,
            "idioma" => $language,
            "infos_extras" => $extra_infs
        ];

      }  elseif ($type_transformation === "B") { // Reescrita
        $transformer = "reescrita";
        $API_TRANSFORMER = $API_REWRITE_TEXT;
        $text = $_POST['texto'];
        $tone = $_POST['tom'];
        $data = [
            "token" => $API_TOKEN,
            "texto" => $text,
            "tipo" => $type_transformation,
            "tom" => $tone,
            "infos_extras" => $extra_infs
        ];
      } elseif ($type_transformation === "C" && $base_type === "texto") { // Resumo
        $transformer = "resumo";
        $API_TRANSFORMER = $API_SUMMARIZE_TEXT;
        $text = $_POST['texto'];
        $format = $_POST['formato_resumo'];
        $data = [
            "token" => $API_TOKEN,
            "texto" => $text,
            "tipo" => $type_transformation,
            "formato" => $format,
            "infos_extras" => $extra_infs
        ];
      }elseif ($type_transformation === "D") { // Revisão
        $transformer = "revisão";
        $API_TRANSFORMER = $API_REVIEW_TEXT;
        $text = $_POST['texto'];
        $data = [
            "token" => $API_TOKEN,
            "texto" => $text,
            "tipo" => $type_transformation,
            "infos_extras" => $extra_infs
        ];

      } elseif ($type_transformation === "E") { // Expansão
        $transformer = "expansão";
        $API_TRANSFORMER = $API_EXPAND_TEXT;
        $text = $_POST['texto'];
        $amount = $_POST['quantidade'];

        $data = [
            "token" => $API_TOKEN,
            "texto" => $text,
            "tipo" => $type_transformation,
            "quantidade" => $amount,
            "infos_extras" => $extra_infs
        ];

      } elseif ($type_transformation === "F") { // Criação de texto
        $transformer = "criação";
        $API_TRANSFORMER = $API_CREATE_TEXT;
        $theme = $_POST['tema'];
        $format = $_POST['formato_texto'];
        $amount = $_POST['quantidade_texto'];

        $data = [
            "token" => $API_TOKEN,
            "tema" => $theme,
            "tipo" => $type_transformation,
            "quantidade" => $amount,
            "formato" => $format,
            "infos_extras" => $extra_infs
        ];

      }

        $options = [
            "http" => [
                "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method"  => "POST",
                "content" => http_build_query($data),
            ]
        ];

    
        $context = stream_context_create($options);
        $response = file_get_contents($API_TRANSFORMER, false, $context);
        salvar_log($_SESSION['id'], "Transformou texto: $transformer");
    } elseif ($type_transformation === "C" && $base_type === "pdf" && isset($_FILES["arquivo"])) {

        $file = new CURLFile($_FILES["arquivo"]["tmp_name"], $_FILES["arquivo"]["type"], $_FILES["arquivo"]["name"]);
          $format = $_POST['formato_resumo'];
          $API_TRANSFORMER = $API_SUMMARIZE_PDF;
          $type_transformation = "CPDF"; // Resumo
          $data = [
            "token" => $API_TOKEN,
            "tipo" => $type_transformation,
            "formato" => $format,
            "infos_extras" => $extra_infs,
            "arquivo" => $file
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_TRANSFORMER);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);
        salvar_log($_SESSION['id'], "Gerou resumo baseado em PDF");
    }


    if (!empty($response)) {
        $result = json_decode($response, true);
    } else {
        $result = ["erro" => "Erro ao chamar a API"];
    }
}

 if (!empty($result) && isset($result['texto'])) {
          require_once '../vendor/autoload.php';
        $md = $result['texto'];
        $content = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $created = date('Y-m-d H:i:s');
        $type_rea = 7; // Define o tipo de REA
        $status = 1; // Define o status como ativo
        

        $md = preg_replace('/\binserir uma linha horizontal\b/i', "\n---\n", $md);


        $stmt = $conn->prepare("INSERT INTO rea (fk_type_rea_id, content, status, created, fk_person_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $type_rea, $content, $status, $created, $_SESSION['id']);
        $stmt->execute();

        $Parsedown = new Parsedown();
        $md = $Parsedown->text($md);
        $md = preg_replace('/<table>/', "<table class='table table-striped'>", $md);
        echo '<article class="resultado-md">'.$md.'</article>';

  } else {
    echo "Houve um erro ao transformar o texto.";
  }