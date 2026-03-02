
    const arquivoInput = document.querySelector('input[name="arquivo"]');

        // exibir o resultado via AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const resultadoDiv = document.getElementById('resultado-ajax');
    
        form.addEventListener('submit', function(e) {
            e.preventDefault();
      console.log('Enviando formulário');
            if (arquivoInput.files[0] && arquivoInput.files[0].size > 10 * 1024 * 1024) {
                resultadoDiv.innerHTML = '<div class="alert alert-warning">A imagem deve ter no máximo 10MB.</div>';
                return false;
            }
            if (!arquivoInput.files || arquivoInput.files.length === 0) {
                e.preventDefault();
                resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, selecione um arquivo de imagem.</div>';
                return false;
            }
        
            if (arquivoInput.files[0] && !arquivoInput.files[0].type.startsWith('image/')) {
                resultadoDiv.innerHTML = '<div class="alert alert-warning">O arquivo selecionado não é uma imagem.</div>';
                return false;
            }
             

            resultadoDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Descrevendo imagem, aguarde...</div>';

            const formData = new FormData(form);

            fetch('services/image_describe_service.php', {
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
                resultadoDiv.innerHTML = '<div class="alert alert-danger">Erro ao descrever imagem.</div>';
            });
        });



    });