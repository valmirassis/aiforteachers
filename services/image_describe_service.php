<?php
session_start();
require_once('../endpoints_api.php');
require_once('../functions.php');
require_once('../connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $language = $_POST['idioma'];
    $tom = $_POST['tom'];
    $words = $_POST['quantidade'];

   if (isset($_FILES["arquivo"])) {

     $tmpPath = $_FILES['arquivo']['tmp_name'];
        $origName = $_FILES['arquivo']['name'] ?? 'img_upload';
        $mime = $_FILES['arquivo']['type'] ?? 'application/octet-stream';
        $uploadDir = __DIR__ . '/uploads/img';
        if (!is_dir($uploadDir)) {
          @mkdir($uploadDir, 0775, true);
        }
        $nameImage= uniqid('img_', true) . '_' . basename($origName);
        $destPath = $uploadDir . '/' . $nameImage;
        if (!move_uploaded_file($tmpPath, $destPath)) {
          $errors[] = 'Falha ao copiar o arquivo para a pasta de upload.';
          return;
        }
        $tmpPath = $destPath;

        $file = new CURLFile($tmpPath, $mime, $origName);
        $data = [
            "token" => $API_TOKEN,
            "idioma_saida" => $language,
            "tom" => $tom,
            "quantidade_palavras" => $words,
            "arquivo" => $file
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_DESCRICAO_IMAGEM);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);
        salvar_log($_SESSION['id'], "Gerou descrição de imagem");
    }

    if (!empty($response)) {
        $result = json_decode($response, true);
    } else {
        $result = ["erro" => "Erro ao chamar a API"];
    }
}

 if (!empty($result) && isset($result['descricao'])) {
        $desc = $result['descricao'];
        $result['imagem'] = $nameImage; // Caminho da imagem salva no servidor
        $content = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $created = date('Y-m-d H:i:s');
        $type_rea = 6; // Define o tipo de REA
        $status = 1; // Define o status como ativo

    $tags = $desc['tags'] ?? '';
    if (is_array($tags)) {
        $tags = implode(', ', $tags);
    }
    $short = $desc['alt_text'] ?? '';
    $long = $desc['descricao_longa'] ?? '';
    $ocr = $desc['texto_detectado'] ?? '';
    // $qalt = strlen($alt);
    // $qlong = strlen($long);

       
        if($long || $short || $tags) {
         $stmt = $conn->prepare("INSERT INTO rea (fk_type_rea_id, content, status, created, fk_person_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $type_rea, $content, $status, $created, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();


        echo  "<article class='resultado-md'> <b>Tags: </b>" . ($tags ? $tags : "Não foi possível gerar tags.") . "</article>";
        echo "<article class='resultado-md'> <b>Descrição curta: </b>". ($short ? $short : "Não foi possível gerar descrição curta.") . "</article>";
    echo "<article class='resultado-md'> <b>Descrição longa: </b>" . ($long ? $long : "Não foi possível gerar descrição longa.") . "</article>";
        if (!empty($ocr)) {
            echo '<article class="resultado-md"><strong>Texto detectado na imagem:</strong><br>'.$ocr.'</article>';
        }
        
        echo '<article class="resultado-md"><strong>Imagem enviada:</strong><br><img src="services/uploads/img/'.$nameImage.'" alt="Imagem enviada" style="max-width:100%;height:auto;"></article>';
        } else {
            echo '<article class="resultado-md">Houveram problemas ao descrever a imagem, possivelmente por falta de conteúdo, ou conteúdo sensível</article>';
            unlink($destPath);
        }
 } else {
    echo "Houve um erro ao gerar a descrição da imagem.";
 }
