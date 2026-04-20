
    <main class="container my-5">
      <!-- Título -->
      <header class="mb-4">
        <h1 class="h3">
         <i class="fas fa-tasks"></i> Informações Gerador de Questões Múltipla Escolha
        </h1>
      </header>

      <!-- Alerta principal -->
      <div class="alert alert-warning" role="alert">
        <strong>Professor</strong>, ao usar este sistema, é essencial revisar cuidadosamente cada questão gerada,
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
          Esta ferramenta utiliza o modelo de linguagem <strong>Gemini</strong> integrado via <strong>LangChain</strong>.
        </p>
        <p class="mb-0">
          O objetivo é auxiliar professores na <strong>geração de questões de múltipla escolha</strong> com diferentes
          estruturas, usando temas ou arquivos como base.
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
                  <li>Campos guiados (tema, quantidade, tipo de questão) tornam o uso mais rápido.</li>
                  <li>Reduz a curva de aprendizado e o risco de comandos mal interpretados.</li>
                  <li>Garante consistência na apresentação e estrutura das questões.</li>
                  <li>Permite gerar questões com base em <strong>conteúdos reais</strong> (apostilas, artigos, capítulos).</li>
                  <li>Utiliza embeddings e recuperação semântica para focar nos trechos mais relevantes.</li>
                  <li>Aplicação de níveis com base na Taxonomia de Bloom*.</li>
                </ul>
      </section>
<section class="mb-5">
              <h2 class="h4 fw-semibold">  <i class="fas fa-cog"></i> Como utilizar o gerador de questões</h2>

     <div class="accordion" id="accordionExample">

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         <i class="fas fa-folder"></i> Modo: Baseado em Tema
        </h5>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="mb-2">
                  <li>O modelo usará seu <strong>conhecimento prévio</strong> (base de dados de treinamento) para gerar a questão.</li>
                  <li>Informe um <strong>tema objetivo</strong>, como:</li>
                  <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">“Sustentabilidade”</li>
                  <li class="list-group-item">“Reforma tributária”</li>
                  <li class="list-group-item">“Programação orientada a objetos”</li>
                </ul>
                <li>Caso queira, é possível dar informações extras ao modelo, por exemplo, 
                  supondo que tenha colocado o tema como "Implantação da LGPD" no campo instruções extras pode colocar um informação extra como 
                  "A questão deve ser e abordar os impactos da LGPD no setor médico". Ou ainda, coloque uma citação direta no enunciado para contextualizar a questão.
                </ul>
                
                <p class="mb-0">Clique em <strong>Gerar questão</strong> para obter o resultado.</p>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
 <h5 class="collapsed"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">       
          <i class="fas fa-file-pdf"></i> Modo: Baseado em Arquivo PDF
        </h5>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <ul>
                  <li>O modelo utilizará o conteúdo <strong>presente no arquivo</strong> para gerar a questão.</li>
                  <li>É possível informar um assunto presente no arquivo para direcionar a geração (campo
                    <em>“Sobre o que a questão deve tratar?”</em>).</li>
                    <li>Caso queira, é possível dar informações extras ao modelo, por exemplo, 
                  supondo que tenha colocado o tema como "Implantação da LGPD" no campo instruções extras pode colocar um informação extra como 
                  "A questão deve ser e abordar os impactos da LGPD no setor médico". Ou ainda, coloque uma citação direta no enunciado para contextualizar a questão.
                </ul>

                <div class="alert alert-info small" role="alert">
                  <strong>Importante:</strong> o modelo pode gerar conteúdo irrelevante (alucinação) se o texto não fornecer base suficiente.
                </div>

                <ul class="mb-0">
                  <li><strong>Recomendação:</strong> use arquivos entre <strong>2 e 20 páginas</strong>.</li>
                  <li><strong>Observação:</strong> páginas com menos de <strong>300 caracteres</strong> são <strong>descartadas pelo sistema</strong>.</li>
                  <li>O sistema lê apenas os textos presentes no arquivo, sem considerar o conteúdo gráfico.</li>
                </ul>
      </div>
    </div>
  </div>
</div>
       
         
      </section>

      <hr class="my-5" />

      <!-- Estruturas de questões -->
      <section class="mb-5">
        <h2 class="h4 fw-semibold d-flex align-items-center ">
          <i class="fas fa-cog"></i> &nbsp; Estruturas de questões suportadas
        </h2>

        <div class="row g-4">
          <div class="col-12 col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h3 class="h5"><i class="fas fa-check-square"></i> Múltipla Escolha Simples</h3>
                <ul class="mb-0">
                  <li>Enunciado com <strong>pelo menos 40 palavras</strong>.</li>
                  <li>5 alternativas (<strong>a–e</strong>) — apenas 1 correta.</li>
                  <li>O sistema indicará a alternativa correta e justificará as incorretas.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h3 class="h5"><i class="fas fa-check-square"></i> Múltipla Escolha com Afirmativas</h3>
                <ul class="mb-0">
                  <li>Enunciado com <strong>pelo menos 40 palavras</strong>.</li>
                  <li>4 afirmativas sobre o tema (I a IV).</li>
                  <li>5 alternativas de combinação (<strong>a–e</strong>) — apenas 1 correta.</li>
                  <li>O sistema indicará a alternativa correta e justificará as incorretas.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h3 class="h5"><i class="fas fa-check-square"></i> Múltipla Escolha Asserção-Razão</h3>
                <ul class="mb-0">
                  <li>Enunciado com <strong>pelo menos 40 palavras</strong>.</li>
                  <li>1 <strong>asserção</strong> e 1 <strong>razão</strong>.</li>
                  <li>5 alternativas (<strong>a–e</strong>) sobre a relação entre as proposições.</li>
                  <li>O sistema indicará a alternativa correta e justificará as incorretas.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h3 class="h5"><i class="fas fa-check-square"></i> Número de questões</h3>
                <ul class="mb-0">
                  <li>É possível gerar 1, 2 ou 3 questões por solicitação.</li>
                  <li class="small text-body-secondary">Na geração por arquivos, recomenda-se gerar apenas 1 questão.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h3 class="h5 mb-2"><i class="fas fa-check-square"></i> Nível de dificuldade</h3>
                <ul class="mb-2">
                  <li>Se a opção <em>“Gerar questão com versões em nível de dificuldade fácil e difícil?”</em> for marcada,
                    serão geradas duas versões (fácil e difícil) por questão.</li>
                  <li>Os níveis e dificuldades são definidos a partir da <strong>Taxonomia de Bloom</strong>.</li>
                </ul>
                <div class="row">
                  <div class="col-md-6">
                    <div class="border rounded p-3 mb-2">
                      <strong>Fácil:</strong>
                      níveis 1 (lembrança) ou 2 (compreensão).
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="border rounded p-3 mb-2">
                      <strong>Difícil:</strong> níveis 3 (aplicação), 4 (análise) ou 5 (avaliação).
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <hr class="my-5" />

      <!-- Taxonomia de Bloom -->
      <section class="mb-5">
        <h2 class="h4 fw-semibold"><i class="fas fa-bookmark"></i> Taxonomia de Bloom</h2>
        <div class="card">
          <div class="card-body">
            <p class="mb-3">
              A Taxonomia de Bloom, conforme discutida por Faraon, Granlund e Rönkkö (2023), é uma estrutura hierárquica
              que organiza os objetivos educacionais em diferentes níveis de complexidade cognitiva, sendo amplamente
              utilizada no planejamento e avaliação da aprendizagem no ensino superior. Originalmente composta por categorias
              como conhecimento, compreensão e aplicação, a taxonomia foi posteriormente revisada, substituindo os
              substantivos por verbos de ação e incorporando a metacognição como elemento essencial para o desenvolvimento
              de habilidades cognitivas. Com a crescente presença da tecnologia na educação, surgiu a taxonomia digital de
              Bloom, que mantém os mesmos seis níveis – lembrar, compreender, aplicar, analisar, avaliar e criar – mas os
              adapta ao uso de ferramentas tecnológicas para promover o aprendizado. Essa versão digital oferece orientações
              práticas para integrar recursos digitais ao ensino, ajudando educadores a planejar atividades que estimulem
              tanto habilidades de ordem inferior quanto de ordem superior, com base no uso crítico e criativo da tecnologia.
            </p>
            <p class="mb-0 small text-body-secondary">
              FARAON, M.; GRANLUND, V.; RÖNKKÖ, K. (2023). <em>Artificial Intelligence Practices in Higher Education Using
              Bloom’s Digital Taxonomy</em>. 2023 5th International Workshop on Artificial Intelligence and Education (WAIE).
              DOI: https://doi.org/10.1109/WAIE60568.2023.00017
            </p>
          </div>
        </div>
      </section>

       <a href="question_generator.php" class="btn btn-primary mb-4"> Gerar Questões</a>
    </main>

    <?php
require_once('footer.php');
?>
