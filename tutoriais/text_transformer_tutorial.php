
    <main class="container my-5">
      <!-- Título -->

        <h1 class="h3">
         <i class="fas fa-list-ul"></i> Informações Transformador de Texto
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
          Esta ferramenta utiliza o modelo de linguagem <strong>Gemini</strong> para realizar diferentes transformações em textos.
        </p>
        <p class="mb-0">
          O objetivo é auxiliar professores na <strong>transformação de textos</strong> facilitando a craiação de recursos educacionais.
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
                  <li>Campos guiados ( Tradução, Reescrita, Resumo, Revisão/correção, Expansão, Criaçã de texto ) tornam o uso mais rápido.</li>
                  <li>Reduz a curva de aprendizado e o risco de comandos mal interpretados.</li>
                  <li>Garante consistência na apresentação e estrutura do material gerado.</li>
                  <li>Permite fazer transformações de textos reais.</li>
                  <li>Utiliza embeddings e recuperação semântica para focar nos trechos mais relevantes.</li>
                  <li>Possui filtro para conteúdos sensíveis.</li>

                </ul>
      </section>
<section class="mb-5">
              <h2 class="h4 fw-semibold">  ⚙️ Como utilizar o transformador de texto</h2>

     <div class="accordion" id="accordionExample">
<!-- ------------------------------ -->
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          📂 Tradução de texto
        </h5>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">Informe um texto para tradução.</li>
                  <li class="list-group-item">O sistema suporta tradução de textos em <b>português</b>, <b>inglês</b> e <b>espanhol</b>.</li>
                  <li class="list-group-item">O processo de tradução pode levar alguns segundos.</li>
                  <li class="list-group-item">É possível dar instruções extras, por exemplo, traduza usando um tom acadêmico ou traduza de forma literal, sem interpretações.</li>
           
</ul>
                
                <p class="mb-0">Clique em <strong>Transformar texto</strong> para obter a tradução.</p>
      </div>
    </div>
  </div>

 <!-- ------------------------------ -->
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          📂 Reescrita de texto
        </h5>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">Informe um texto para reescrita.</li>
                  <li class="list-group-item">O sistema suporta reescrita de textos para os tons <b>neutro</b>, <b>didático</b>, <b>conciso</b>, <b>criativo</b> e <b>acadêmico</b>.</li>
                  <li class="list-group-item">O processo de reescrita pode levar alguns segundos.</li>
                  <li class="list-group-item">É possível dar instruções extras, por exemplo, não aumente o tamanho do texto ou aumente o tamanho do texto em x palavras.</li>
           
</ul>
                
                <p class="mb-0">Clique em <strong>Transformar texto</strong> para obter a reescrita.</p>
      </div>
    </div>
  </div>
<!-- ------------------------------ -->
  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          📂 Resumo de texto
        </h5>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">Informe um texto para resumo ou faça upload de um arquivo PDF.</li>
                  <li class="list-group-item">O sistema suporta resumo de textos em <b>paragráfos</b>, <b>tópicos</b> e <b>ideias principais</b>.</li>
                  <li class="list-group-item">O processo de resumo pode levar alguns segundos.</li>
                  <li class="list-group-item">É possível dar instruções extras, por exemplo, resuma o texto em 50 palavras, ou resuma o texto em 3 parágrafos, ou resuma no idioma inglês.</li>
           
</ul>
                
                <p class="mb-0">Clique em <strong>Transformar texto</strong> para obter o resumo.</p>
      </div>
    </div>
  </div>

<!-- ------------------------------ -->
  <div class="card">
    <div class="card-header" id="headingFive">
      <h5 class="mb-0">
       <h5 class=" collapsed"  data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          📂 Revisão/correção de texto
        </h5>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body">
        <ul class="list-group list-group-flush small mb-3">
                  <li class="list-group-item">Essa opção realiza correções gramaticais e ortográficas.</li>
                  <li class="list-group-item">Informe um texto para revisão/correção.</li>
                  <li class="list-group-item">O processo de revisão/correção pode levar alguns segundos.</li>
                  <li class="list-group-item">É possível dar instruções extras, por exemplo, mantenha o sentido do texto original.</li>
           
</ul>
                
                <p class="mb-0">Clique em <strong>Transformar texto</strong> para obter a revisão/correção.</p>
      </div>
    </div>
  </div>


  <!--  -->
</div>
       
      
      </section>

      <hr class="my-5" />



       <a href="text_transformer.php" class="btn btn-primary mb-4"> Transformar Texto</a>
    </main>

    <?php
require_once('footer.php');
?>
