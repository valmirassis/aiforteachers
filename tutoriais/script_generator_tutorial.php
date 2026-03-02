
    <main class="container my-5">
      <!-- Título -->

        <h1 class="h3">
         <i class="fas fa-list-ul"></i> Informações Gerador de Roteiros
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
          Esta ferramenta utiliza o modelo de linguagem <strong>Gemini</strong> para gerar roteiros para apresentação de slides, Aula ou Vídeo aula.
        </p>
        <p class="mb-2">
          O objetivo é auxiliar professores na <strong>criação de roteiros</strong> facilitando a criação de recursos educacionais.
        </p>
        <p class="mb-2">
         <b> Importante:</b> a ferramenta gera roteiros para criação de materiais, ou seja, o resultado é um roteiro para o professor seguir e criar o material posteriormente, não é gerado o material em si.
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
                  <li>Auxilia no planejamento das atividades ao fornecer o tempo estimado do vídeo.</li>
                  <li>Permite gerar roteiros com base em conteúdos reais (apostilas, artigos, capítulos).</li>
                  <li>Utiliza embeddings e recuperação semântica para focar nos trechos mais relevantes.</li>
                  <li>Possui filtro para conteúdos sensíveis.</li>
                </ul>
      </section>
<section class="mb-5">
              <h2 class="h4 fw-semibold">  ⚙️ Como utilizar o gerador de Roteiros</h2>

     <div class="accordion" id="accordionExample">

   <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          📂 Modo: Baseado em Tema
        </h5>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="mb-2">
                <li>Selecione o tipo de roteiro que deseja gerar <b> apresentação de slides, aula ou vídeo aula </b>.</li>
                  <li>O modelo usará seu <strong>conhecimento prévio</strong> (base de dados de treinamento) para gerar a atividade.</li>
                   <li>Informe a quantidade de slides para a apresentação ou o tempo em minutos para a aula ou vídeo aula.</li>
                  <li>Informe um <strong>tema objetivo</strong>, como:</li>
                  <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">“Sustentabilidade”</li>
                  <li class="list-group-item">“Reforma tributária”</li>
                  <li class="list-group-item">“Programação orientada a objetos”</li>
                </ul>
                <li>Caso queira, é possível dar <b>informações extras</b> ao modelo, por exemplo, supondo que tenha colocado o tema como "Implantação da LGPD", no campo instruções extras pode colocar
                    um informação extra como "o roteiro deve ser e abordar os impactos da LGPD no setor médico".</li>
                
                </ul>

                <p class="mb-0">Clique em <strong>Gerar roteiro</strong> para obter o resultado.</p>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
 <h5 class="collapsed"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">       
          📄 Modo: Baseado em Arquivo PDF
        </h5>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <ul>    
             <li>Selecione o tipo de roteiro que deseja gerar <b> apresentação de slides, aula ou vídeo aula </b>.</li>
             <li>Informe a quantidade de slides para a apresentação ou o tempo em minutos para a aula ou vídeo aula.</li>
                  <li>O modelo utilizará o conteúdo <strong>presente no arquivo</strong> para gerar o roteiro.</li>
                  <li>É possível informar um assunto presente no arquivo para direcionar a geração (campo
                    <em>“Sobre o que o roteiro deve tratar?”</em>).</li>
                </ul>

                <div class="alert alert-info small" role="alert">
                  <strong>Importante:</strong> o modelo pode gerar conteúdo irrelevante (alucinação) se o texto não
                  fornecer base suficiente.
                </div>

                <ul class="mb-0">
                  <li><strong>Recomendação:</strong> use arquivos entre <strong>2 e 20 páginas</strong>.</li>
                  <li><strong>Observação:</strong> páginas com menos de <strong>300 caracteres</strong> são
                    <strong>descartadas pelo sistema</strong>.</li>
                  <li>O sistema lê apenas os textos presentes no arquivo, sem considerar o conteúdo gráfico.</li>
                  <li>Caso queira, é possível dar <b>informações extras</b> ao modelo, por exemplo, supondo que tenha colocado o tema como "Implantação da LGPD" no campo instruções extras pode colocar
                    uma informação extra como "o roteiro deve ser e abordar os impactos da LGPD no setor médico" ou ainda apresente o padrão de respostas em tópicos, construa o padrão de respostas usando rubricas.</li>

              
                    
                </ul>
                <p class="mb-0">Clique em <strong>Gerar roteiro</strong> para obter o resultado.</p>
      </div>
    </div>
    
  </div>
<br>
     <h5 class="fw-semibold">📚 Dicas</h5>
  <ul class="list-group list-group-flush small mb-3">
      <li class="list-group-item">Para apresentação de slides, o modelo gera um roteiro com os tópicos de cada slide e o tempo estimado para cada um. </li>
      <li class="list-group-item">Para aula ou vídeo aula, o modelo gera um roteiro com os tópicos a serem abordados e o tempo estimado para cada um.</li>
      <li class="list-group-item">O tempo total do roteiro é baseado na quantidade de slides ou no tempo informado pelo usuário, mas pode variar dependendo do conteúdo gerado.</li>
      <li class="list-group-item">Para a apresentação funciona melhor com até 10 slides.   </li>
       <li class="list-group-item">Para vídeo aula funciona melhor com até 30 minutos de duração. </li>
        <li class="list-group-item">Para aula funciona melhor com até 60 minutos de duração. </li>
    </ul>


      </div>
       




       
      
      </section>

      <hr class="my-5" />



       <a href="script_generator.php" class="btn btn-primary mb-4"> Gerar Roteiro</a>
    </main>

    <?php
require_once('footer.php');
?>
