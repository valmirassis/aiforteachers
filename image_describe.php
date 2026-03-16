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
    <h1> <i class="fas fa-images"></i> Descritor de imagens</h1>

    <hr>
     <div class="card">
    <div class="card-body">
    <p>Esta ferramenta permite descrever imagem para texto. Com o objetivo de facilitar o acesso à informação visual para pessoas com deficiência visual auxiliando na criação de descrições para materiais didáticos. </p>
 <p class="alert alert-info">Antes de descrever as imagens, consulte a página de <strong><a href="tutoriais.php?tutorial=image_describe"> informações sobre a ferramenta</a>.</strong></p>
    <form method="POST" enctype="multipart/form-data" action="services/image_describe_service.php">
        <div class="row">
            <div class="col-md-12 mb-3">
      <label class="form-label">Imagem</label>
      <input type="file" name="arquivo" accept="image/*" class="form-control" required>
    </div>
    <div class="col-md-4 mb-3">
      <label class="form-label">Idioma</label>
      <select name="idioma" class="form-control">
        <option value="pt-BR">Português Brasil</option>
        <option value="en-US">Inglês (EUA)</option>
      </select>
    </div>
    <div class="col-md-4 mb-3">
      <label class="form-label">Tom</label>
      <select name="tom" class="form-control">
        <option value="neutro">Neutro</option>
        <option value="didatico">Didático</option>
        <option value="conciso">Conciso</option>
        <option value="criativo">Criativo</option>
      </select>
    </div>
            <div class="col-md-4 mb-3">
      <label class="form-label">Quantidade de palavras (aproximado):</label>
        <input type="number" name="quantidade" min="50" max="2000" value="100" class="form-control">
    </div>  

            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-success">Descrever imagem</button>
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

<script src="js/image_describe.js"></script>
<?php
require_once('footer.php');