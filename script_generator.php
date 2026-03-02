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
    <h1> <i class="fas fa-file-alt"></i> Gerador de Roteiros</h1>

    <hr>
     <div class="card">
    <div class="card-body">
    <p>Esta ferramenta permite gerar roteiros. Você pode escolher entre gerar roteiros baseados em um tema ou enviar um arquivo PDF contendo o conteúdo desejado.</p>
<p class="alert alert-info">Antes de gerar os roteiros, consulte a página de <strong><a href="tutoriais.php?tutorial=script_generator"> informações sobre a ferramenta</a>.</strong></p>
    <form method="POST" enctype="multipart/form-data" action="services/script_generator_service.php">
        <div class="row">
            <div class="col-12 mb-3">
                <label for="tipo_roteiro">Escolha o tipo de roteiro:</label><br>
                <input type="radio" name="tipo_roteiro" id="A" value="A" checked>
                Apresentação de slides
                <input type="radio" name="tipo_roteiro" id="B" value="B">
                Aula
                <input type="radio" name="tipo_roteiro" id="C" value="C">
                Vídeo aula              
            </div>
            <div class="col-12 mb-3">
                <label for="tempo">Quantidade de slides:</label><br>
                <input type="number" name="tempo" id="tempo" min="1" class="form-control">
            </div>
            <div class="col-12 mb-3">
                <label>Como deseja gerar o roteiro?</label><br>
                <input type="radio" name="tipo_base" value="tema" required> Baseado em Tema
                <input type="radio" name="tipo_base" value="pdf" required> Baseado em arquivo PDF
            </div>

            <div class="col-12 mb-3" id="tema-section">
                <label for="tema">Informe o tema do roteiro:</label><br>
                <input type="text" name="tema" id="tema" placeholder="Ex: Inteligência Artificial" class="form-control">
            </div>

            <div class="col-12 mb-3" id="pdf-section" style="display:none;">
                <label for="arquivo">Envie um arquivo em PDF (máximo 20MB):</label><br>
                <input type="file" name="arquivo" id="arquivo" accept="application/pdf" class="form-control"><br>
                <label for="consulta">Sobre o que o roteiro deve tratar? (Deixe em branco para o LLM escolher):</label><br>
                <input type="text" name="consulta" id="consulta" placeholder="Um subtópico presente do arquivo" class="form-control">
            </div>
            <div class="col-12 mb-3">
                <label for="infos_extras">Instruções extras (opcional):</label><br>
                <textarea name="infos_extras" id="infos_extras" placeholder="Caso queira, adicione mais instruções aqui." class="form-control"></textarea>
            </div>
            

            <div class="col-3 mb-3">
                <button type="submit" class="btn btn-success">Gerar roteiro</button>
            </div>
        </div>
        
    </form>
 

    <hr>

<div id="resultado-ajax">


</div>
   <button onclick="copyREA()" class="btn btn-info btn-copy" style="display: none;"><i class="fas fa-copy"></i> Copiar conteúdo gerado</button>
    </div></div>

          </div>
</section>

<script src="js/script_generator.js"></script>



<?php
require_once('footer.php');