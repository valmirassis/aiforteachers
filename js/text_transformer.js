
        const tipoBaseRadios = document.querySelectorAll('input[name="tipo_base"]');
    
        const temaSection = document.getElementById('tema-section');
        const pdfSection = document.getElementById('pdf-section');
        const textoSection = document.getElementById('texto-section');
        const tomSection = document.getElementById('tom-section');
        const quantidadeSection = document.getElementById('quantidade-section');
        const idiomaSection = document.getElementById('idioma-section');
        const formatoSection = document.getElementById('formato-section');
        const tipoBaseSection = document.getElementById('tipo_base_section');
        const quantidadeTextoSection = document.getElementById('quantidade-texto-section');
        const formatoTextoSection = document.getElementById('formato-texto-section');

        tipoBaseRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'texto') {
                    textoSection.style.display = 'block';
                    pdfSection.style.display = 'none';
                } else {
                    textoSection.style.display = 'none';
                    pdfSection.style.display = 'block';
                }
            });
        });
        
   const tipoRoteiroRadios = document.querySelectorAll('input[name="tipo_transformacao"]');
        tipoRoteiroRadios.forEach(radio => {
            radio.addEventListener('change', () => {
              if (document.querySelector('input[name="tipo_base"]:checked')) {
                document.querySelector('input[name="tipo_base"]:checked').checked = false;
              }
                if (radio.value === 'A') {
                    document.querySelector('label[for="texto"]').textContent = 'Texto a ser traduzido:';
                    textoSection.style.display = 'block';
                    idiomaSection.style.display = 'block';
                    pdfSection.style.display = 'none';
                    tomSection.style.display = 'none';
                    quantidadeSection.style.display = 'none';
                    temaSection.style.display = 'none';
                    formatoSection.style.display = 'none';
                    tipoBaseSection.style.display = 'none';
                    formatoTextoSection.style.display = 'none';
                    quantidadeTextoSection.style.display = 'none';
                } else if (radio.value === 'B') {
                    document.querySelector('label[for="texto"]').textContent = 'Texto a ser reescrito:';
                    textoSection.style.display = 'block';
                    tomSection.style.display = 'block';
                    idiomaSection.style.display = 'none';
                    pdfSection.style.display = 'none';
                    quantidadeSection.style.display = 'none';
                    temaSection.style.display = 'none';
                    formatoSection.style.display = 'none';
                    tipoBaseSection.style.display = 'none';
                    formatoTextoSection.style.display = 'none';
                    quantidadeTextoSection.style.display = 'none';
                } else if (radio.value === 'C') {
                    document.querySelector('label[for="texto"]').textContent = 'Texto a ser resumido:';
                    textoSection.style.display = 'none';
                    idiomaSection.style.display = 'none';
                    pdfSection.style.display = 'none';
                    tomSection.style.display = 'none';
                    quantidadeSection.style.display = 'none';
                    temaSection.style.display = 'none';
                    formatoSection.style.display = 'block';
                    tipoBaseSection.style.display = 'block';
                    formatoTextoSection.style.display = 'none';
                    quantidadeTextoSection.style.display = 'none';
                } else if (radio.value === 'D') {
                    document.querySelector('label[for="texto"]').textContent = 'Texto a ser revisado/corrigido:';
                    textoSection.style.display = 'block';
                    idiomaSection.style.display = 'none';
                    pdfSection.style.display = 'none';
                    tomSection.style.display = 'none';
                    quantidadeSection.style.display = 'none';
                    temaSection.style.display = 'none';
                    formatoSection.style.display = 'none';
                    tipoBaseSection.style.display = 'none';
                    formatoTextoSection.style.display = 'none';
                    quantidadeTextoSection.style.display = 'none';
                } else if (radio.value === 'E') {
                    document.querySelector('label[for="texto"]').textContent = 'Texto a ser expandido:';
                    textoSection.style.display = 'block';
                    quantidadeSection.style.display = 'block';
                    idiomaSection.style.display = 'none';
                    pdfSection.style.display = 'none';
                    tomSection.style.display = 'none';
                    temaSection.style.display = 'none';
                    formatoSection.style.display = 'none';
                    tipoBaseSection.style.display = 'none';
                    formatoTextoSection.style.display = 'none';
                    quantidadeTextoSection.style.display = 'none';
                }else if (radio.value === 'F') {           
                    formatoTextoSection.style.display = 'block';
                    quantidadeTextoSection.style.display = 'block';  
                    textoSection.style.display = 'none';
                    idiomaSection.style.display = 'none';
                    pdfSection.style.display = 'none';
                    tomSection.style.display = 'none';
                    quantidadeSection.style.display = 'none';
                    temaSection.style.display = 'block';
                    formatoSection.style.display = 'none';
                    tipoBaseSection.style.display = 'none';

                }
            });
        });


        // exibir o resultado via AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const resultadoDiv = document.getElementById('resultado-ajax');
    
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            //Verifica se o tema foi preenchido ou se o arquivo PDF foi enviado
            const tipoBase = form.querySelector('input[name="tipo_base"]:checked');
            const tipoTransformacao = form.querySelector('input[name="tipo_transformacao"]:checked');
            const textoInput = form.querySelector('textarea[name="texto"]');
            const temaInput = form.querySelector('input[name="tema"]');
            if (tipoTransformacao.value === 'C' && tipoBase === null) {
                e.preventDefault();
                resultadoDiv.innerHTML = '<div class="alert alert-warning">Selecione um tipo de resumo.</div>';
                return false;
            }
            if (tipoBase && tipoBase.value === 'pdf') {
            const arquivoInput = form.querySelector('input[name="arquivo"]');
            if (arquivoInput.files[0] && arquivoInput.files[0].size > 20 * 1024 * 1024) {
                resultadoDiv.innerHTML = '<div class="alert alert-warning">O arquivo PDF deve ter no máximo 20MB.</div>';
                return false;
            }
            if (!arquivoInput.files || arquivoInput.files.length === 0) {
                e.preventDefault();
                resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, selecione um arquivo PDF.</div>';
                return false;
            }
            } 
           
            if (tipoTransformacao && textoInput.value.trim() === '' && (tipoTransformacao.value !== 'C' && tipoTransformacao.value !== 'F')) {
                e.preventDefault();
                resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, preencha o campo de texto.</div>';
                return false;
            }
            if (tipoTransformacao && tipoTransformacao.value === 'F' && temaInput.value.trim() === '') {
                e.preventDefault();
                resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, preencha o campo de tema.</div>';
                return false;
            }

            resultadoDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Transformando texto, aguarde...</div>';

            const formData = new FormData(form);

            fetch('services/text_transformer_service.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                resultadoDiv.innerHTML = data;
                 // Exibir o botão de copiar após gerar o conteúdo
                document.querySelector('.btn-copy').style.display = 'block';
            })
            .catch(error => {
                resultadoDiv.innerHTML = '<div class="alert alert-danger">Erro ao transformar texto.</div>';
            });
        });



    });