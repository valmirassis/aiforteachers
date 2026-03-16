<?php
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="img/AiForTeachers_favicon.png" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    
     <title>Ai For Teachers</title>
  </head>
  <body>
    <div id="main">
    <header>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><img src="img/AiForTeachers_nav.png" alt="Logo barra de navegação" width="100px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(Página atual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sobre.php">Sobre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tutoriais.php">Tutoriais</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ferramentas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                
          <a class="dropdown-item" href="activity_generator.php">Gerador de Atividades</a>
          <a class="dropdown-item" href="question_generator.php">Gerador de Questões Múltipla Escolha</a>
          <a class="dropdown-item" href="script_generator.php">Gerador de Roteiros</a>
          <a class="dropdown-item" href="text_transformer.php">Transformador de textos</a>
          <a class="dropdown-item" href="image_describe.php">Descritor de Imagens</a>
          <a class="dropdown-item" href="audio_text_converter.php">Conversor/Gerador de Áudio</a>

        </div>
      </li>
      <?php 
       if (isset($_SESSION['level']) && $_SESSION['level'] == 2): ?>
      <li class="nav-item">
        <a class="nav-link" href="reas.php">REA</a>
      </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="my_account.php">Minha conta</a>
      </li>
      
    </ul>
  </div>
</nav>
</header>