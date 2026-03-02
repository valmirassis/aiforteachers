
       const tipoBaseRadios = document.querySelectorAll('input[name="modo"]');
        const audioSection = document.getElementById('audio-section');
        const textSection = document.getElementById('text-section');
        const idiomaRadios = document.querySelectorAll('input[name="idioma"]');
        const vozSelect = document.getElementById('select-voz');

        idiomaRadios.forEach(radio => {
            radio.addEventListener('change', () => {

                if (radio.value === 'pt-BR') {
                    vozSelect.options[1].value = 'pt-BR-Standard-A';
                    vozSelect.options[2].value = 'pt-BR-Standard-B';
                } else if (radio.value === 'en') {
                        vozSelect.options[1].value = 'en-US-Standard-C';
                        vozSelect.options[2].value = 'en-US-Standard-D';

                    }
                    // Você pode adicionar mais idiomas conforme necessário
                
            });
        });

        tipoBaseRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'stt') {
                    audioSection.style.display = 'block';
                    textSection.style.display = 'none';
                } else {
                    audioSection.style.display = 'none';
                    textSection.style.display = 'block';
                }
            });
        });
        // exibir o resultado via AJAX
    document.addEventListener('DOMContentLoaded', function() {
       document.querySelector('.btn-copy').style.display = 'none';
        const form = document.querySelector('form');
        const resultadoDiv = document.getElementById('resultado-ajax');
    
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            //Verifica se o texto foi preenchido ou se o arquivo PDF foi enviado
             const tipoConversao = form.querySelector('input[name="modo"]:checked');
            if (tipoConversao && tipoConversao.value === 'stt') {
            const arquivoInput = form.querySelector('input[name="arquivo"]');
            if (arquivoInput.files[0] && arquivoInput.files[0].size > 50 * 1024 * 1024) {
                resultadoDiv.innerHTML = '<div class="alert alert-warning">O arquivo de áudio deve ter no máximo 50MB.</div>';
                return false;
            }
            if (!arquivoInput.files || arquivoInput.files.length === 0) {
                e.preventDefault();
                resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, selecione um áudio.</div>';
                return false;
            }
            } else if (tipoConversao && tipoConversao.value === 'tts') {
                const textoInput = form.querySelector('textarea[name="texto"]');
                if (!textoInput.value.trim()) {
                    e.preventDefault();
                    resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, informe um texto.</div>';
                    return false;
                }
            }

            resultadoDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Convertendo, aguarde...</div>';
            const formData = new FormData(form);

            fetch('services/audio_text_converter_service.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                resultadoDiv.innerHTML = data;
                 // Exibir o botão de copiar após gerar o conteúdo
                 console.log(tipoConversao.value);
                 console.log("teste");
                 if (tipoConversao.value === 'stt') { 
                document.querySelector('.btn-copy').style.display = 'block';
                 }
            })
            .catch(error => {
                resultadoDiv.innerHTML = '<div class="alert alert-danger">Erro ao converter.</div>';
            });
        });
    });