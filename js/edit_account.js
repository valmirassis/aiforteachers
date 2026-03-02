    
    
    document.getElementById('edit-account-btn').addEventListener('click', function() {
               if (document.querySelector('.form_edit_account').style.display === 'block') {
                   document.querySelector('.form_edit_account').style.display = 'none';
               } else {
                   document.querySelector('.form_edit_account').style.display = 'block';
               }
           });

          //  edit Account
    document.querySelector('.form_edit_account form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const msgDiv = document.getElementById('edit-account-msg');
        const password = formData.get('new_password');
        const confirmPassword = formData.get('new_password_confirm');

        if (password !== '' && password.length < 6) {
            msgDiv.innerHTML = '<div class="alert alert-danger">A senha deve ter pelo menos 6 caracteres.</div>';
            return;
        }

        if (password !== confirmPassword) {
            msgDiv.innerHTML = '<div class="alert alert-danger">As senhas não são iguais.</div>';
            return;
        }
        msgDiv.innerHTML = '<div class="loading"> <div class="spinner2"></div>  Atualizando conta, aguarde...</div>';
     fetch('edit_account.php', { method: 'POST', body: formData })
  .then(async (response) => {
    const text = await response.text();
    console.log('RETORNO DO SERVIDOR:', text); // veja o que chegou
    return text.trim(); // remove \r\n, espaços, BOM etc.
  })
  .then((data) => {
    if (data === 'sucesso') {
      msgDiv.innerHTML = '<div class="alert alert-success">Conta atualizada com sucesso! Faça login novamente para confirmar as alterações.</div>';
        form.reset();
    } else if (data === 'erro1') {
      msgDiv.innerHTML = '<div class="alert alert-danger">Email já cadastrado para outro usuário</div>';
    } else if (data === 'erro2') {
      msgDiv.innerHTML = '<div class="alert alert-danger">Erro ao atualizar conta. Tente novamente.</div>';
    } else {
      msgDiv.innerHTML = `<div class="alert alert-danger">Retorno inesperado: ${data}</div>`;
    }
  })
  .catch(() => {
    msgDiv.innerHTML = '<div class="alert alert-danger">Erro na requisição.</div>';
  });
    });
    