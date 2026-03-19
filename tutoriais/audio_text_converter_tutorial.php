
    <main class="container my-5">
      <!-- Título -->
      <header class="mb-4">
        <h1 class="h3">
         <i class="fas fa-file-audio"></i> Informações Conversor/Gerador de Áudio
        </h1>
      </header>

      <!-- Alerta principal -->
      <div class="alert alert-warning" role="alert">
        <strong>Professor</strong>, ao usar este sistema, é essencial revisar cuidadosamente o áudio ou descrição gerada,
        analisando o contexto e as informações apresentadas. A <strong>IA Generativa é uma ferramenta auxiliar</strong>,
        mas o conteúdo final é sua responsabilidade. Sempre supervisione o que será apresentado aos alunos.
      </div>
      <hr class="my-5" />

      <!-- Sobre o sistema -->
      <section class="mb-5">
        <h2 class="h4 fw-semibold d-flex align-items-center gap-2">
          <i class="fas fa-lightbulb"> </i> &nbsp; Sobre a ferramenta
        </h2>
        <p class="mb-2">
          Esta ferramenta utiliza o modelo de linguagem <strong>Gemini</strong> para transcição do áudio em texto e do serviço <b>Google Cloud Text-to-Speech</b> para conversão de texto em áudio.
        </p>
        <p class="mb-0">
          O objetivo é auxiliar professores na <strong>conversão de texto para áudio e na geração de áudio a partir de textos</strong>.
        </p>
      </section>

      <!-- Diferencial -->
      <section class="mb-5">
        <h2 class="h4 fw-semibold"><i class="fas fa-hand-point-right"></i> Diferencial da ferramenta em relação ao uso direto em um LLM</h2>
        <p>
          Este sistema foi desenvolvido para transformar um modelo de linguagem (LLM) genérico em uma
          ferramenta educacional específica e acessível para professores.
        </p>
       <h5 class="fw-semibold"><i class="fas fa-star"></i> Vantagens</h5>

          <ul class="mb-0">
                  <li>Interface simples e orientada para professores.</li>
                  <li>Não é necessário ter conhecimento técnico de <strong>engenharia de prompt</strong>.</li>
                  <li>Campos guiados (texto, idioma e voz) tornam o uso mais rápido.</li>
                  <li>Reduz a curva de aprendizado e o risco de comandos mal interpretados.</li>
                  <li>Garante consistência na apresentação e estrutura da conversão.</li>
                  <li>Permite fazer transcrições de <strong>conteúdos reais</strong>.</li>
                  <li>Geração de conteúdos com <b>acessibilidade</b>.</li>
                </ul>
      </section>
<section class="mb-5">
              <h2 class="h4 fw-semibold">  <i class="fas fa-cog"></i> Como utilizar o gerador Conversor/Gerador de Áudio</h2>

     <div class="accordion" id="accordionExample">

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fas fa-folder"></i> Modo: Transcrever Áudio
        </h5>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">Selecione um arquivo de áudio ou vídeo para upload.</li>
                  <li class="list-group-item"> O sistema suporta diversos formatos de áudio e vídeo comuns.</li>
                  <li class="list-group-item">O processo de conversão em arquivos grandes tende a ser mais demorado</li>
                  <li class="list-group-item"> O sistema realiza a transcrição apenas para o idioma <strong>português (pt-BR)</strong>.</li>
                  <li class="list-group-item"> O retorno do sistema é em texto corrido e em texto separado por frases.</li>           
</ul>
                
                <p class="mb-0">Clique em <strong>Transcrever</strong> para obter a transcrição.</p>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <i class="fas fa-folder"></i> Modo: Converter texto em áudio
        </h5>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item"> Insira o texto que deseja converter em áudio.</li>
                  <li class="list-group-item"> Escolha o idioma do texto (português ou inglês).</li>
                  <li class="list-group-item"> Selecione a voz <b>(masculina ou feminina)</b>.</li>
                  <li class="list-group-item">  O processo de conversão em textos grandes tende a ser mais demorado</li>
                  <li class="list-group-item"> O sistema realiza a transcrição apenas para o idioma do texto informado <b>(português ou inglês)</b>.</li>
                  <li class="list-group-item"> O retorno do sistema é um player com o áudio gerado, pode-se fazer download do áudio.</li>

           
                </ul>
                
                <p class="mb-0">Clique em <strong>Gerar áudio </strong> para obter o áudio.</p>
      </div>
    </div>
  </div>

</div>
    
      </section>

      <hr class="my-5" />


       <a href="audio_text_converter.php" class="btn btn-primary mb-4"> Gerar/converter aúdio</a>
    </main>

    <?php
require_once('footer.php');
?>
