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
    <h1> <i class="fas fa-align-left"></i> Transformador de Texto</h1>

    <hr>
     <div class="card">
    <div class="card-body">
    <p>Esta ferramenta permite transformar textos de diferentes maneiras.</p>
 <p class="alert alert-info">Antes de gerar as atividades, consulte a página de <strong><a href="tutoriais.php?tutorial=text_transformer"> informações sobre a ferramenta</a>.</strong></p>
    <form method="POST" enctype="multipart/form-data" action="services/text_transformer_service.php">
        <div class="row">
            <div class="col-12 mb-3">
                <label for="tipo_transformacao">Escolha o tipo de transformação:</label><br>
                <input type="radio" name="tipo_transformacao" id="A" value="A" checked>
                Tradução
                <input type="radio" name="tipo_transformacao" id="B" value="B">
                Reescrita
                <input type="radio" name="tipo_transformacao" id="C" value="C">
                Resumo 
                <input type="radio" name="tipo_transformacao" id="D" value="D">  
                Revisão/correção
                <input type="radio" name="tipo_transformacao" id="E" value="E">  
                Expansão      
                <input type="radio" name="tipo_transformacao" id="F" value="F">  
                Criação de texto     
            </div>
 <!-- RESUMO -->
             <div class="col-12 mb-3" id="tipo_base_section" style="display: none;">
                <label>Como deseja gerar o resumo?</label><br>
                <input type="radio" name="tipo_base" value="texto"> Baseado em Texto
                <input type="radio" name="tipo_base" value="pdf"> Baseado em arquivo PDF
            </div>
<!-- TEXTO -->
            <div class="col-12 mb-3" id="texto-section" style="display: block;">
                <label for="texto">Texto a ser traduzido:</label><br>
                <textarea name="texto" id="texto" placeholder="Coloque o seu texto aqui" class="form-control" style="height: 300px;"></textarea>
            </div>
<!-- TRADUÇÃO -->
             <div class="col-md-12 mb-3" id="idioma-section" style="display: block;">
            <label class="form-label">Traduzir para:</label>
            <select name="idioma" class="form-control">
                <option value="pt-BR">Português</option>
                <option value="en-US">Inglês (EUA)</option>
                <option value="es">Espanhol</option>
            </select>
            </div>
<!-- REESCRITA -->
            <div class="col-md-12 mb-3" id="tom-section" style="display: none;">
            <label class="form-label">Tom:</label>
            <select name="tom" class="form-control">
                <option value="neutro">Neutro</option>
                <option value="didatico">Didático</option>
                <option value="conciso">Conciso</option>
                <option value="criativo">Criativo</option>
                <option value="academico">Acadêmico</option>
            </select>
            </div>
<!-- EXPANSÃO -->
            <div class="col-md-12 mb-3" id="quantidade-section" style="display: none;">
            <label class="form-label">Quantidade de palavras a mais (aproximado):</label>
            <input type="number" name="quantidade" min="50" max="10000" value="400" class="form-control">
            </div> 

            
<!-- RESUMO -->
           
            <div class="col-12 mb-3" id="pdf-section" style="display:none;">
                <label for="arquivo">Envie um arquivo em PDF (máximo 20MB):</label><br>
                <input type="file" name="arquivo" id="arquivo" accept="application/pdf" class="form-control"><br>
            </div>

            <div class="col-md-12 mb-3" id="formato-section" style="display: none;">
            <label class="form-label">Formato do resumo:</label>
            <select name="formato_resumo" class="form-control">
                <option value="parágrafos">Texto em parágrafos</option>
                <option value="tópicos">Tópicos</option>
                <option value="ideias principais">Ideias principais</option>
            </select>
            </div>
 <!-- CRIAÇÃO -->
            <div class="col-12 mb-3" id="tema-section" style="display:none;">
                <label for="tema">Informe o tema do texto:</label><br>
                <input type="text" name="tema" id="tema" placeholder="Ex: Inteligência Artificial" class="form-control">
            </div>
             <div class="col-md-12 mb-3" id="formato-texto-section" style="display: none;">
            <label class="form-label">Formato do texto:</label>
            <select name="formato_texto" class="form-control">
                <option value="parágrafos">Texto em parágrafos</option>
                <option value="tópicos">Tópicos</option>
            </select>
            </div>
            <div class="col-md-12 mb-3" id="quantidade-texto-section" style="display: none;">
            <label class="form-label">Tamanho do texto em palavras (aproximado):</label>
            <input type="number" name="quantidade_texto" min="50" max="10000" value="800" class="form-control">
            </div>
<!-- INSTRUÇÕES EXTRAS -->
            <div class="col-12 mb-3">
                <label for="infos_extras">Instruções extras (opcional):</label><br>
                <textarea name="infos_extras" id="infos_extras" placeholder="Caso queira, adicione mais instruções aqui." class="form-control"></textarea>
            </div>
            

            <div class="col-3 mb-3">
                <button type="submit" class="btn btn-success">Transformar texto</button>
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

<script src="js/text_transformer.js"></script>



<?php
require_once('footer.php');