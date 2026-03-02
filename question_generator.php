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
    <h1> <i class="fas fa-tasks"></i> Gerador de Questões Múltipla Escolha</h1>
  
    <hr>
     <div class="card">
    <div class="card-body">
    <p>Esta ferramenta permite gerar questões de múltipla escolha. Você pode escolher entre gerar questões baseadas em um tema ou enviar um arquivo PDF contendo o conteúdo desejado.</p>
<p class="alert alert-info">Antes de gerar as questões, consulte a página de <strong><a href="../tutoriais.php?tutorial=question_generator"> informações sobre a ferramenta</a>.</strong></p>
    <form method="POST" enctype="multipart/form-data" action="services/question_generator_service.php">
        <div class="row">
             <div class="col-12 mb-3">
                <label for="tipo_questao">Escolha o tipo de questao:</label><br>
                <input type="radio" name="tipo_questao" id="A" value="A" checked>
                Múltipla escolha simples
                <input type="radio" name="tipo_questao" id="B" value="B">
               Múltipla escolha com afirmativas
                <input type="radio" name="tipo_questao" id="C" value="C">
                Múltipla escolha asserção-razão
            </div>
            <div class="col-12 mb-3">
                <label>Como deseja gerar a questão?</label><br>
                <input type="radio" name="tipo_base" value="tema" required> Baseado em Tema
                <input type="radio" name="tipo_base" value="pdf" required> Baseado em arquivo PDF
            </div>

            <div class="col-12 mb-3" id="tema-section">
                <label for="tema">Informe o tema da pergunta</label><br>
                <input type="text" name="tema" id="tema" placeholder="Ex: Inteligência Artificial" class="form-control">
            </div>

            <div class="col-12 mb-3" id="pdf-section" style="display:none;">
                <label for="arquivo">Envie um arquivo em PDF (máximo 20MB)</label><br>
                <input type="file" name="arquivo" id="arquivo" accept="application/pdf" class="form-control"><br>
                <label for="consulta">Sobre o que a questão deve tratar? (Deixe em branco para o LLM escolher):</label><br>
                <input type="text" name="consulta" id="consulta" placeholder="Algum subtópico presente no arquivo" class="form-control">
            </div>
           
     

            <div class="col-12 mb-3">
                <label for="quantidade_range">Quantas questões deseja gerar, no máximo 3 (funciona melhor com 1)?</label><br>
                <input type="number" name="quantidade" id="quantidade_range" min="1" max="3" value="1" class="form-control">

            </div>

            <div class="col-12 mb-3">
                <label for="dificuldade">Gerar questão com versões em nível de dificuldade fácil e difícil?</label><br>
                <input type="radio" name="dificuldade" id="dificuldade_nao" value="Não" checked>
               Não
                <input type="radio" name="dificuldade" id="dificuldade_sim" value="Sim">
                Sim
            </div>

            <div class="col-3 mb-3">
                <button type="submit" class="btn btn-success">Gerar questão</button>
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

<script src="js/question_generator.js"></script>



<?php
require_once('footer.php');
?>