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
    <h1> <i class="fas fa-book"></i> Gerador de Atividades</h1>
  
    <hr>
     <div class="card">
    <div class="card-body">
    <p>Esta ferramenta permite gerar enunciados de atividades discursivas. Você pode escolher entre gerar atividades baseadas em um tema ou enviar um arquivo PDF contendo o conteúdo desejado.</p>
 <p class="alert alert-info">Antes de gerar as atividades, consulte a página de <strong><a href="tutoriais.php?tutorial=activity_generator"> informações sobre a ferramenta</a>.</strong></p> 
    <form method="POST" enctype="multipart/form-data" action="services/activity_generator_service.php">
        <div class="row">
            <div class="col-12 mb-3">
                <label for="tipo_atividade">Escolha o tipo de atividade:</label><br>
                <input type="radio" name="tipo_atividade" id="A" value="A" checked>
                Estudo de caso
                <input type="radio" name="tipo_atividade" id="B" value="B">
                Quadro comparativo
                <input type="radio" name="tipo_atividade" id="C" value="C">
                Questões discursivas
                <input type="radio" name="tipo_atividade" id="D" value="D">
                Mapa mental
              
            </div>
            <div class="col-12 mb-3">
                <label>Como deseja gerar a atividade?</label><br>
                <input type="radio" name="tipo_base" value="tema" required> Baseado em Tema
                <input type="radio" name="tipo_base" value="pdf" required> Baseado em arquivo PDF
            </div>

            <div class="col-12 mb-3" id="tema-section">
                <label for="tema">Informe o tema da atividade:</label><br>
                <input type="text" name="tema" id="tema" placeholder="Ex: Inteligência Artificial" class="form-control">
            </div>

            <div class="col-12 mb-3" id="pdf-section" style="display:none;">
                <label for="arquivo">Envie um arquivo em PDF (máximo 20MB):</label><br>
                <input type="file" name="arquivo" id="arquivo" accept="application/pdf" class="form-control"><br>
                <label for="consulta">Sobre o que a atividade deve tratar? (Deixe em branco para o LLM escolher):</label><br>
                <input type="text" name="consulta" id="consulta" placeholder="Um subtópico presente do arquivo" class="form-control">
            </div>
            <div class="col-12 mb-3">
                <label for="infos_extras">Instruções extras (opcional):</label><br>
                <textarea name="infos_extras" id="infos_extras" placeholder="Caso queira, adicione mais instruções aqui." class="form-control"></textarea>
            </div>

            <div class="col-12 mb-3" id="quantidade-section" style="display: none;">
                <label for="quantidade_range">Quantas questões deseja gerar, no máximo 3 (funciona melhor com 1)?</label><br>
                <input type="number" name="quantidade" id="quantidade_range" min="1" max="3" value="1" class="form-control" >
                
            </div>
            
            <div class="col-12 mb-3">
                <label for="dificuldade">Nível de dificuldade? Com base na Taxonomia de Bloom</label><br>
                <input type="radio" name="dificuldade" id="dificuldade_facil" value="Fácil" checked>
               Fácil
                <input type="radio" name="dificuldade" id="dificuldade_dificil" value="Difícil">
                Difícil
            </div>

            <div class="col-3 mb-3">
                <button type="submit" class="btn btn-success">Gerar atividade</button>
            </div>
        </div>
        
    </form>

    <hr>

<div id="resultado-ajax">
</div>
<button onclick="copyREA()" class="btn btn-info btn-copy" style="display: none;"><i class="fas fa-copy"></i> Copiar conteúdo gerado</button>

          </div>
</section>

<script src="js/activity_generator.js"></script>

<?php
require_once('footer.php');