<?php
session_start();
if(!isset($_SESSION['email'])){
    $filename = basename($_SERVER['PHP_SELF']);
    header('Location: login.php?redirect=' . urlencode($filename));
    exit;
} 
require_once('header.php');
?>

    <section>
       <div class="container mt-5"> 
  <h1 class="mb-4"> <i class="fas fa-file-audio"></i> Conversor/Gerador de Áudio</h1>
  <hr>
    <div class="card">
    <div class="card-body">
  <p> Esta ferramenta permite transcrever áudio e sintetizar fala. Utilize as opções abaixo para começar. 
    A transcrição para texto funciona apenas para o idioma <b>português (pt-BR)</b> usando arquivos de áudio ou vídeo. A transcrição para áudio funciona para <b>português (pt-BR)</b> e <b>inglês (en-US)</b>.</p>
    <p class="alert alert-info">Antes de converter/gerar áudio, consulte a página de <strong><a href="tutoriais.php?tutorial=audio_text_converter"> informações sobre a ferramenta</a>.</strong></p>
  <!-- STT -->

      <form method="post" enctype="multipart/form-data" action="services/audio_text_converter_service.php">
      <div class="row">   
      <div class="col-12">
                <label>O que deseja fazer?</label><br>
                <input type="radio" name="modo" value="stt" required> Transcrever áudio
                <input type="radio" name="modo" value="tts" required> Converter texto em áudio
            </div>
</div>
<br><br>
            <div class="row" id="audio-section">
        <div class="col-12">
          <label class="form-label">Arquivo de áudio</label>
          <input type="file" name="arquivo" accept="audio/*, .mp4" class="form-control">
        </div>
        <div class="col-md-3 align-self-end"><br>
          <button type="submit" class="btn btn-success w-100">Transcrever</button>
        </div>
      </div>
      <div id="text-section" style="display: none;">
      <div class="row">
        <div class="col-md-12">
          <label class="form-label">Texto</label>
          <textarea name="texto" class="form-control" rows="4" placeholder="Digite o texto para narrar..." ><?=htmlspecialchars($_POST['texto'] ?? '')?></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">Idioma</label> (Deve ser igual ao idioma do texto) <br>
         <input type="radio" name="idioma" value="pt-BR" required  checked> Português (pt-BR)
         <input type="radio" name="idioma" value="en" required > Inglês (en)
        </div>
        <div class="col-md-6">
          <label class="form-label">Voz</label>
          <select name="voz" class="form-control" id="select-voz" required>
           <option></option>
            <option value="pt-BR-Wavenet-A">Voz feminina</option>
            <option value="pt-BR-Wavenet-B">Voz masculina</option>
          </select>
        </div>
  
        <div class="col-md-3 align-self-end"> <br>
          <button type="submit" class="btn btn-success">Gerar Áudio</button>
        </div>
      </div>
      </div>
      </form><br>
  <hr>    
<div id="resultado-ajax">


</div>
   <button onclick="copyREA()" class="btn btn-info btn-copy" style="display: none;"><i class="fas fa-copy"></i> Copiar conteúdo gerado</button>

<br>

    </section>
    <script src="js/audio_text_converter.js"></script>
<?php
require_once('footer.php');

