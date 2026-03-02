    
    
    document.getElementById('create-account-btn').addEventListener('click', function() {
               if (document.querySelector('.form_create_account').style.display === 'block') {
                   document.querySelector('.form_create_account').style.display = 'none';
               } else {
                   document.querySelector('.form_create_account').style.display = 'block';
               }
           });

          //  Create Account
    document.querySelector('.form_create_account form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const msgDiv = document.getElementById('create-account-msg');
        const password = formData.get('new_password');
        const confirmPassword = formData.get('new_password_confirm');

        if (password.length < 6) {
            msgDiv.innerHTML = '<div class="alert alert-danger">A senha deve ter pelo menos 6 caracteres.</div>';
            return;
        }

        if (password !== confirmPassword) {
            msgDiv.innerHTML = '<div class="alert alert-danger">As senhas não coincidem.</div>';
            return;
        }
        msgDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Criando conta, aguarde...</div>';
     fetch('create_account.php', { method: 'POST', body: formData })
  .then(async (response) => {
    const text = await response.text();
    console.log('RETORNO DO SERVIDOR:', text); // veja o que chegou
    return text.trim(); // remove \r\n, espaços, BOM etc.
  })
  .then((data) => {
    if (data === 'sucesso') {
      msgDiv.innerHTML = '<div class="alert alert-success">Conta criada com sucesso!</div>';
        form.reset();
    } else if (data === 'erro1') {
      msgDiv.innerHTML = '<div class="alert alert-danger">Email já cadastrado.</div>';
    } else if (data === 'erro2') {
      msgDiv.innerHTML = '<div class="alert alert-danger">Erro ao criar conta. Tente novamente.</div>';
    } else {
      msgDiv.innerHTML = `<div class="alert alert-danger">Retorno inesperado: ${data}</div>`;
    }
  })
  .catch(() => {
    msgDiv.innerHTML = '<div class="alert alert-danger">Erro na requisição.</div>';
  });
    });
    // Forgot Password
            document.getElementById('forgot-password-btn').addEventListener('click', function() {
                if (document.querySelector('.forgot-password-form').style.display === 'block') {
                   document.querySelector('.forgot-password-form').style.display = 'none';
               } else {
                   document.querySelector('.forgot-password-form').style.display = 'block';
               }
            });

        document.querySelector('.forgot-password-form form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const msgDiv = document.getElementById('forgot-password-msg');
        const email = formData.get('forgot_email');

        if (!email) {
            msgDiv.innerHTML = '<div class="alert alert-danger">Por favor, insira seu email.</div>';
            return;
        }

        msgDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Enviando nova senha, aguarde...</div>';
        fetch('forgot_password.php', { method: 'POST', body: formData })
            .then(async (response) => {
                const text = await response.text();
                console.log('RETORNO DO SERVIDOR:', text);
                return text.trim();
            })
            .then((data) => {
               if (data === 'sucesso') {
                msgDiv.innerHTML = '<div class="alert alert-success">A nova senha foi enviada para o seu email.</div>';
                  form.reset();
              } else if (data === 'erro1') {
                msgDiv.innerHTML = '<div class="alert alert-danger">Email não encontrado.</div>';
              } else if (data === 'erro2') {
                msgDiv.innerHTML = '<div class="alert alert-danger">Erro ao resetar a senha. Tente novamente.</div>';
              } else if (data === 'erro3') {
                msgDiv.innerHTML = '<div class="alert alert-danger">Conta criada com o Google. Faça login com sua conta Google.</div>';
              } else if (data === 'erro4') {
                msgDiv.innerHTML = '<div class="alert alert-danger">Conta criada com o Microsoft. Faça login com sua conta Microsoft.</div>';
              } else {
                msgDiv.innerHTML = `<div class="alert alert-danger">Retorno inesperado: ${data}</div>`;
              }
            })
            .catch(() => {
                msgDiv.innerHTML = '<div class="alert alert-danger">Erro na requisição.</div>';
            });
    });


