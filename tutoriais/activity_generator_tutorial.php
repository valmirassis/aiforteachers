
    <div class="container my-5">
      <!-- Título -->

        <h1 class="h3">
         <i class="fas fa-list-ul"></i> Informações Gerador de Atividades
        </h1>


      <!-- Alerta principal -->
      <div class="alert alert-warning" role="alert">
        <strong>Professor</strong>, ao usar este sistema, é essencial revisar cuidadosamente a atividade gerada,
        analisando o contexto e as informações apresentadas. A <strong>IA Generativa é uma ferramenta auxiliar</strong>,
        mas o conteúdo final é sua responsabilidade. Sempre supervisione o que será apresentado aos alunos.
      </div>
      <hr class="my-5" />

      <!-- Sobre o sistema -->
      <div class="mb-5">
        <h2 class="h4 fw-semibold d-flex align-items-center gap-2">
          <span aria-hidden="true">💡</span> Sobre a ferramenta
        </h2>
        <p class="mb-2">
          Esta ferramenta utiliza o modelo de linguagem <strong>Gemini</strong> para geração de atividades.
        </p>
        <p class="mb-0">
          O objetivo é auxiliar professores na <strong>criação de enunciados para atividades educacionais</strong> como estudo de caso, quadro comparativo, questões discursivas e mapas mentais.
        </p>
      </div>

      <!-- Diferencial -->
      <div class="mb-5">
        <h2 class="h4 fw-semibold">🎯 Diferencial da ferramenta em relação ao uso direto em um LLM</h2>
        <p>
          Este sistema foi desenvolvido para transformar um modelo de linguagem (LLM) genérico em uma
          ferramenta educacional específica e acessível para professores.
        </p>
       <h5 class="fw-semibold">📚 Vantagens</h5>

          <ul class="mb-0">
                  <li>Interface simples e orientada para professores.</li>
                  <li>Não é necessário ter conhecimento técnico de <strong>engenharia de prompt</strong>.</li>
                  <li>Campos guiados (tipo de atividade, tema ou arquivo e nível de dificuldade) tornam o uso mais rápido.</li>
                  <li>Reduz a curva de aprendizado e o risco de comandos mal interpretados.</li>
                  <li>Garante consistência na apresentação e estrutura da conversão.</li>
                  <li>Permite fazer transcrições de <strong>conteúdos reais</strong>.</li>
                  <li>Geração de diversos tipos de atividades <b>estudo de caso, quadro comparativo, questões discursivas ou mapa mental</b>.</li>
                  <li>Utilização da <b>Taxonomia de Bloom</b> para geração das atividades.</li>
                </ul>
      </div>
<div class="mb-5">
              <h2 class="h4 fw-semibold">  ⚙️ Como utilizar o gerador Gerador de Atividades</h2>
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
                <li>Selecione o tipo de atividade que deseja gerar <b>estudo de caso, quadro comparativo, questões discursivas ou mapa mental</b>.</li>
                  <li>O modelo usará seu <strong>conhecimento prévio</strong> (base de dados de treinamento) para gerar a atividade.</li>
                  <li>Informe um <strong>tema objetivo</strong>, como:</li>
                  <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">“Sustentabilidade”</li>
                  <li class="list-group-item">“Reforma tributária”</li>
                  <li class="list-group-item">“Programação orientada a objetos”</li>
                </ul>
                <li>Caso queira, é possível dar <b>informações extras</b> ao modelo, por exemplo, supondo que tenha colocado o tema como "Implantação da LGPD" no campo instruções extras pode colocar
                    um informação extra como "A atividade deve ser e abordar os impactos da LGPD no setor médico".</li>
                <li>Defina o nível de dificuldade da atividade (fácil ou difícil), os níveis são definidos pela <b>Taxonomia de Bloom</b>.</li>
                    <ul class="list-group list-group-flush small mb-3">
                        <li class="list-group-item"><b>Dificuldade fácil:</b> níveis 1 ou 2 (lembrança ou compreensão)</li>
                        <li class="list-group-item"><b>Dificuldade difícil:</b> níveis 3, 4 ou 5 (aplicação, análise ou avaliação).</li>
                    </ul>
                    <li>Na opção questões discursivas, é possível informar o número de questões desejadas.</li>
                </ul>

                <p class="mb-0">Clique em <strong>Gerar atividade</strong> para obter o resultado.</p>
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
             <li>Selecione o tipo de atividade que deseja gerar <b>estudo de caso, quadro comparativo, questões discursivas ou mapa mental.</b></li>
                  <li>O modelo utilizará o conteúdo <strong>presente no arquivo</strong> para gerar a questão.</li>
                  <li>É possível informar um assunto presente no arquivo para direcionar a geração (campo
                    <em>“Sobre o que a questão deve tratar?”</em>).</li>
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
                    uma informação extra como "A atividade deve ser e abordar os impactos da LGPD no setor médico" ou ainda apresente o padrão de respostas em tópicos, construa o padrão de respostas usando rubricas. .</li>
                <li>Defina o nível de dificuldade da atividade (fácil ou difícil), os níveis são definidos pela <b>Taxonomia de Bloom</b>.</li>
                    <ul class="list-group list-group-flush small mb-3">
                         <li class="list-group-item"><b>Dificuldade fácil:</b> níveis 1 ou 2 (lembrança ou compreensão)</li>
                        <li class="list-group-item"><b>Dificuldade difícil:</b> níveis 3, 4 ou 5 (aplicação, análise ou avaliação).</li>
                    </ul>
                    <li>Na opção questões discursivas, é possível informar o número de questões desejadas.</li>
                </ul>
                <p class="mb-0">Clique em <strong>Gerar atividade</strong> para obter o resultado.</p>
      </div>
    </div>
  </div>

</div>
       


      </div>
         <hr class="my-5" />



       <a href="activity_generator.php" class="btn btn-primary mb-4"> Gerar atividade</a>
     
</div>

    <?php
require_once('footer.php');
?>
