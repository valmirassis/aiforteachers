
    <main class="container my-5">
      <!-- Título -->

        <h1 class="h3">
         <i class="fas fa-list-ul"></i> Informações Descritor de Imagens
        </h1>
 

      <!-- Alerta principal -->
      <div class="alert alert-warning" role="alert">
        <strong>Professor</strong>, ao usar este sistema, é essencial revisar cuidadosamente a descrição gerada,
        analisando o contexto e as informações apresentadas. A <strong>IA Generativa é uma ferramenta auxiliar</strong>,
        mas o conteúdo final é sua responsabilidade. Sempre supervisione o que será apresentado aos alunos.
      </div>
      <hr class="my-5" />

      <!-- Sobre o sistema -->
      <section class="mb-5">
        <h2 class="h4 fw-semibold d-flex align-items-center gap-2">
          <span aria-hidden="true">💡</span> Sobre a ferramenta
        </h2>
        <p class="mb-2">
          Esta ferramenta utiliza o modelo de linguagem <strong>Gemini</strong> para descrever imagens de forma detalhada e acessível.
        </p>
        <p class="mb-0">
          O objetivo é auxiliar professores na <strong>descrição de imagens</strong> facilitando a criação de materiais acessíveis.
        </p>
      </section>

      <!-- Diferencial -->
      <section class="mb-5">
        <h2 class="h4 fw-semibold">🎯 Diferencial da ferramenta em relação ao uso direto em um LLM</h2>
        <p>
          Este sistema foi desenvolvido para transformar um modelo de linguagem (LLM) genérico em uma
          ferramenta educacional específica e acessível para professores.
        </p>
       <h5 class="fw-semibold">📚 Vantagens</h5>

          <ul class="mb-0">
                  <li>Interface simples e orientada para professores.</li>
                  <li>Não é necessário ter conhecimento técnico de <strong>engenharia de prompt</strong>.</li>
                  <li>Campos guiados (arquivo de imagem, idioma, tom e quantidade de palavras) tornam o uso mais rápido.</li>
                  <li>Reduz a curva de aprendizado e o risco de comandos mal interpretados.</li>
                  <li>Garante consistência na apresentação e estrutura da descrição.</li>
                  <li>Permite fazer descrições de <strong>imagens reais</strong>.</li>
                  <li>Geração de conteúdos com <b>acessibilidade</b>.</li>
                  <li>Possui filtro para conteúdos sensíveis.</li>
                </ul>
      </section>
<section class="mb-5">
              <h2 class="h4 fw-semibold">  ⚙️ Como utilizar o Descritor de Imagens</h2>

     <div class="accordion" id="accordionExample">

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          📂 Descrição de imagem
        </h5>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">Selecione um arquivo de imagem para upload.</li>
                  <li class="list-group-item">O sistema suporta diversos formatos de imagens comuns como jpg e png.</li>
                  <li class="list-group-item">O processo de descriação em arquivos grandes pode ser mais demorado.</li>
                  <li class="list-group-item">O sistema realiza a transcrição apenas para o idioma <strong>português (pt-BR)</strong> ou <strong>inglês (en-US)</strong>.</li>
                  <li class="list-group-item">É possível escolher o tom da descrição (neutro, didático, conciso e criativo)</li>
                  <li class="list-group-item">É possível definir a quantidade de palavras da descrição, esse número é um valor aproximaddo tanto para cima como para baixo.</li>
                  <li class="list-group-item">O retorno do sistema é uma descrição da imagem com uma descrição curta e uma descrição detalhada.</li>           
</ul>
                
                <p class="mb-0">Clique em <strong>Descrever imagem</strong> para obter a descrição.</p>
      </div>
    </div>
  </div>


</div>
       
      
      </section>

      <hr class="my-5" />

       <a href="image_describe.php" class="btn btn-primary mb-4"> Descrever Imagens</a>
    </main>

    <?php
require_once('footer.php');
?>
