
        const tipoBaseRadios = document.querySelectorAll('input[name="tipo_base"]');
     
        const temaSection = document.getElementById('tema-section');
        const pdfSection = document.getElementById('pdf-section');

        tipoBaseRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'tema') {
                    temaSection.style.display = 'block';
                    pdfSection.style.display = 'none';
                } else {
                    temaSection.style.display = 'none';
                    pdfSection.style.display = 'block';
                }
            });
        });
        
   const tipoRoteiroRadios = document.querySelectorAll('input[name="tipo_roteiro"]');
        tipoRoteiroRadios.forEach(radio => {
            radio.addEventListener('change', () => {
              
                if (radio.value === 'A') {
                    document.querySelector('label[for="tempo"]').textContent = 'Quantidade de slides:';
                } else if (radio.value === 'B') {
                    document.querySelector('label[for="tempo"]').textContent = 'Tempo em minutos da aula:';
                }else if (radio.value === 'C') {
                    document.querySelector('label[for="tempo"]').textContent = 'Tempo em minutos do vídeo:';
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
            } else if (tipoBase && tipoBase.value === 'tema') {
                const temaInput = form.querySelector('input[name="tema"]');
                if (!temaInput.value.trim()) {
                    e.preventDefault();
                    resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, informe um tema.</div>';
                    return false;
                }
            }

            resultadoDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Gerando roteiro, aguarde...</div>';

            const formData = new FormData(form);

            fetch('services/script_generator_service.php', {
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
                resultadoDiv.innerHTML = '<div class="alert alert-danger">Erro ao gerar roteiro.</div>';
            });
        });



    });