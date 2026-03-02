<?php
declare(strict_types=1);
mb_internal_encoding('UTF-8');
require_once('../endpoints_api.php');
require_once('../functions.php');
require_once('../connection.php');

$API_BASE = $URL;

$DOWNLOAD_DIR = __DIR__ . '/downloads';
if (!is_dir($DOWNLOAD_DIR)) {
    @mkdir($DOWNLOAD_DIR, 0775, true);
}

$errors = [];
$sttResult = null;
$ttsResultPath = null;
$ttsResultName = null;

/**
 * Helper: POST multipart para a API
 */
function api_post_multipart(string $url, array $fields, array $files = [], bool $expectBinary = false): array {
    $ch = curl_init($url);

    $postfields = $fields;
    foreach ($files as $fieldName => $info) {
        // $info = ['path' => '/tmp/file', 'mime' => 'audio/m4a', 'name' => 'gravacao.m4a']
        $mime = $info['mime'] ?? (function_exists('mime_content_type') ? mime_content_type($info['path']) : 'application/octet-stream');
        $postfields[$fieldName] = new CURLFile($info['path'], $mime, $info['name'] ?? basename($info['path']));
    }

    curl_setopt_array($ch, [
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => $postfields,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_FOLLOWLOCATION  => true,
        CURLOPT_TIMEOUT         => 120,
    ]);

    $body = curl_exec($ch);
    $errno = curl_errno($ch);
    $err   = curl_error($ch);
    $code  = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $ctype = (string) curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    if ($errno) {
        return ['ok' => false, 'error' => "Erro cURL: $err", 'status' => 0];
    }
    if ($code >= 400) {
        return ['ok' => false, 'error' => "HTTP $code: $body", 'status' => $code];
    }

    return [
        'ok' => true,
        'status' => $code,
        'content_type' => $ctype,
        'body' => $body,
        'is_binary' => $expectBinary && strpos($ctype, 'audio/') === 0
    ];
}

/**
 * Processamento STT
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['modo'] ?? '') === 'stt') {
    if (empty($_FILES['arquivo']['tmp_name'])) {
        $errors[] = 'Selecione um arquivo de áudio.';
    } else {
        // $idioma = $_POST['idioma'] ?? 'pt';
        $idioma = 'pt';

        $tmpPath = $_FILES['arquivo']['tmp_name'];
        $origName = $_FILES['arquivo']['name'] ?? 'audio_upload';
        $mime = $_FILES['arquivo']['type'] ?? 'application/octet-stream';
        $uploadDir = __DIR__ . '/uploads';
        if (!is_dir($uploadDir)) {
          @mkdir($uploadDir, 0775, true);
        }
        $destPath = $uploadDir . '/' . uniqid('audio_', true) . '_' . basename($origName);
        if (!move_uploaded_file($tmpPath, $destPath)) {
          $errors[] = 'Falha ao copiar o arquivo para a pasta de upload.';
          return;
        }
        $tmpPath = $destPath;
        // Chama o endpoint /transcrever-audio
        $resp = api_post_multipart(
            rtrim($API_BASE, '/') . '/transcrever-audio',
            [
                'token'  => $API_TOKEN ,
                'idioma' => $idioma,
            ],
            [
                'arquivo' => ['path' => $tmpPath, 'mime' => $mime, 'name' => $origName]
            ],
            false
        );

        if ($resp['ok']) {
          $tmpUrl = 'services/uploads/' . basename($tmpPath);
          $json = json_decode($resp['body'], true);
          if (is_array($json)) {
            $json['result']['uploaded_file_path'] = $tmpUrl;
          }

            if (json_last_error() === JSON_ERROR_NONE) {
                $lang = $json['result']['language'] ?? '';
                $text = $json['result']['text'] ?? '';
                $segments = $json['result']['segments'] ?? [];  
            } else {
                $errors[] = 'Não foi possível interpretar a resposta JSON da API.';
            }
        } else {
            $errors[] = $resp['error'];
        }
    }
}

/**
 * Processamento TTS
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['modo'] ?? '') === 'tts') {
    $text   = trim($_POST['texto'] ?? '');
    $voice     = $_POST['voz'] ?? 'pt-BR-Wavenet-A';
    $format = $_POST['formato'] ?? 'mp3';
    $language  = $_POST['idioma'] ?? 'pt-BR';

    if ($text === '') {
        $errors[] = 'Informe um texto para sintetizar.';
    } else {
        // Chama o endpoint /audio-sintetizar
        $resp = api_post_multipart(
            rtrim($API_BASE, '/') . '/audio-sintetizar',
            [
                'token'   => $API_TOKEN ,
                'texto'   => $text,
                'voz'     => $voice,
                'idioma'  => $language,
                'formato' => $format,
            ],
            [],
            true
        );

        if ($resp['ok']) {
            $ext = ($resp['content_type'] === 'audio/wav') ? 'wav' : 'mp3';
            $fname = 'tts_' . date('Ymd_His') . '.' . $ext;
            $savePath = $GLOBALS['DOWNLOAD_DIR'] . '/' . $fname;
            file_put_contents($savePath, $resp['body']);
            $ttsResultPath = 'services/downloads/' . $fname;
            $ttsResultName = $fname;
        } else {
            $errors[] = $resp['error'];
        }
    }
}
?>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <strong>Erros:</strong>
      <ul class="mb-0">
        <?php foreach ($errors as $e): ?>
          <li><?=htmlspecialchars($e)?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

      <?php if (isset($json)): 
        require_once('../connection.php');
        if (isset($json['result'])) {
          $content = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
          $status = 1;
          $created = date('Y-m-d H:i:s');
          $fk_person_id = $_SESSION['id'] ?? null;
          $fk_type_rea_id = 2; 

          $stmt = $conn->prepare("INSERT INTO rea (content, status, created, fk_person_id, fk_type_rea_id) VALUES (?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssi", $content, $status, $created, $fk_person_id, $fk_type_rea_id);
          $stmt->execute();
          $stmt->close();
        }
        
        
        
        ?>


        <hr>
        <h6>Transcrição</h6>
        <p><strong>Idioma detectado:</strong> <?=htmlspecialchars($lang ?? '-')?></p>
        <div class="code p-2 bg-dark text-white rounded"><?=htmlspecialchars($text ?? '')?></div>

        <?php if (!empty($segments) && is_array($segments)): ?>
          <div class="table-responsive mt-3">
            <table class="table table-sm table-striped segments-table">
              <thead>
                <tr><th>#</th><th>Texto</th></tr>
              </thead>
              <tbody>
              <?php foreach ($segments as $i => $seg): ?>
                <tr>
                  <td><?=($i+1)?></td>
                  <td><?=htmlspecialchars(is_array($seg) ? ($seg['text'] ?? '') : $seg)?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      <?php endif; ?>
   
       <?php if ($ttsResultPath):
        require_once('../connection.php');
        if (isset($ttsResultPath)) {
          $content = $ttsResultPath."|".$text;
          $status = 1;
          $created = date('Y-m-d H:i:s');
          $fk_person_id = $_SESSION['id'] ?? null;
          $fk_type_rea_id = 3; 

          $stmt = $conn->prepare("INSERT INTO rea (content, status, created, fk_person_id, fk_type_rea_id) VALUES (?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssi", $content, $status, $created, $fk_person_id, $fk_type_rea_id);
          $stmt->execute();
          $stmt->close();
        }
        
        ?>
        <hr>
        <h6>Resultado</h6>
        <audio controls class="w-100" src="<?=htmlspecialchars($ttsResultPath)?>"></audio>
        <div class="mt-2">
          <a class="btn btn-outline-secondary" href="<?=htmlspecialchars($ttsResultPath)?>" download="<?=htmlspecialchars($ttsResultName)?>">Baixar arquivo</a>
        </div>
      <?php endif; ?>

