<?php
require_once('header.php');

if (isset($_GET['tutorial'])) {
    $tutorial = $_GET['tutorial'];
    if ($tutorial === 'question_generator') {
        require_once('tutoriais/question_generator_tutorial.php');
    } 
    else if ($tutorial === 'audio_text_converter') {
        require_once('tutoriais/audio_text_converter_tutorial.php');
    }
     else if ($tutorial === 'image_describe') {
        require_once('tutoriais/image_describe_tutorial.php');
    }
    else if ($tutorial === 'activity_generator') {
        require_once('tutoriais/activity_generator_tutorial.php');
    }
    else if ($tutorial === 'script_generator') {
        require_once('tutoriais/script_generator_tutorial.php');
    }
    else if ($tutorial === 'text_transformer') {
        require_once('tutoriais/text_transformer_tutorial.php');
    }
    else {
        echo '<div class="alert alert-danger">Tutorial não encontrado.</div>';
    }
} else {
    echo '<div class="container mt-5"><h1> <i class="fas fa-clipboard-list"></i> Tutoriais</h1><hr>';
    echo '<p>Selecione um tutorial para visualizar as informações.</p>';
    echo '<ul class="list-group">';
    
    
    echo '<li class="list-group-item"><i class="fas fa-book"></i> <a href="?tutorial=activity_generator">Gerador de Atividades</a></li>';
    echo '<li class="list-group-item"><i class="fas fa-tasks"></i> <a href="?tutorial=question_generator">Gerador de Questões Múltipla Escolha</a></li>';
    echo '<li class="list-group-item"><i class="fas fa-file-alt"></i> <a href="?tutorial=script_generator">Gerador de Roteiros</a></li>';
    echo '<li class="list-group-item"><i class="fas fa-align-left"></i> <a href="?tutorial=text_transformer">Transformador de Textos</a></li>';
    echo '<li class="list-group-item"><i class="fas fa-images"></i> <a href="?tutorial=image_describe">Descritor de Imagens</a></li>';
    echo '<li class="list-group-item"><i class="fas fa-file-audio"></i> <a href="?tutorial=audio_text_converter">Conversor/Gerador de Áudio</a></li>'; 

    echo '</ul></div>';
}

require_once('footer.php');
?>