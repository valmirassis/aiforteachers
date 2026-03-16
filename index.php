<?php
require_once('header.php');
?>

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h5><b>AiForTeachers:</b> Plataforma para criação de <b>Recursos Educacionais abertos (REA)</b> baseados em <b>Inteligência Artificial Generativa</b>
para Professores do Ensino Superior.</h5> <br>
                <p>Esta plataforma oferece diversas ferramentas baseadas em Inteligência Artificial Generativa para auxiliar professores na criação de REAs. Selecione a seguir qual ferramenta deseja utilizar:</p>
            </div>
            <div class="col-md-4 text-center">
                <a href="activity_generator.php"><img src="img/Tool_activity_generator.png" class="img-fluid mb-3" alt="Imagem 3">   
                <h5>Gerador de Atividades</h5>
                <p>Ferramentas para geração de atividades com base em tema ou conteúdo do professor.</p></a>
            </div>
            <div class="col-md-4 text-center">
               <a href="question_generator.php"><img src="img/Tool_question_generator.png" class="img-fluid mb-3" alt="Imagem 1">
                <h5>Gerador de Questões Múltipla Escolha</h5>
                <p>Ferramenta para geração de questões Múltipla Escolha com base em tema ou conteúdo do professor</p></a>
            </div>
                 
            <div class="col-md-4 text-center">
                <a href="script_generator.php">
                <img src="img/Tool_script_generator.png" class="img-fluid mb-3" alt="Imagem 4">
                <h5>Gerador de Roteiros</h5>
                <p>Ferramenta para criação de roteiros de aulas, vídeos e apresentações.</p></a>
            </div>
              <div class="col-md-4 text-center">
                <a href="text_transformer.php">
                <img src="img/Tool_text_transformer.png" class="img-fluid mb-3" alt="Imagem 6">
                <h5>Transformador de Textos</h5>
                <p>Ferramenta para transformação de textos em diferentes formatos e estilos.</p></a>
            </div>
            <div class="col-md-4 text-center">
                <a href="image_describe.php">
                <img src="img/Tool_image_describe.png" class="img-fluid mb-3" alt="Imagem 5">
                <h5>Descritor de Imagens</h5>
                <p>Ferramenta para descrição de imagens para acessibilidade.</p></a>
            </div>
            <div class="col-md-4 text-center">
                <a href="audio_text_converter.php"><img src="img/Tool_audio_text_converter.png" class="img-fluid mb-3" alt="Imagem 2">
                <h5>Conversor/Gerador de Áudio</h5>
                <p>Ferramenta para transcrição de áudio em texto ou geração de áudio a partir de texto.</p></a>
            </div>
            
          
        </div>
    </div>

</section>

<?php
require_once('footer.php');

?>