<?php
require 'header.php';
// session_start();
if (isset($_SESSION['email'])) {
    header('Location: my_account.php');
}
?>
<section>
       <div class="container mt-5">
           <h1><i class="fas fa-user"></i> Login</h1>
           <hr>
            <p>Para utilizar a plataforma é necessário realizar um cadastro. É possível realizar um cadastro inserindo seus dados pessoais clicando em criar conta. Ou realizar o login através dos serviços de autenticação
              oferecidos pela Microsoft ou Google.
            </p>
           <a href="login_microsoft/login.php" class="btn btn-secondary mt-3"> <i class="fab fa-microsoft"></i> Login com Microsoft</a>
           <a href="login_google/login.php" class="btn btn-secondary mt-3"><i class="fab fa-google"></i> Login com Google</a>

           <h4 class="mt-4">Ou faça login com suas Credenciais:</h4>
           <form method="POST" action="authentication.php" autocomplete="off">
               <div class="mb-3">
                   <label for="email" class="form-label">Email</label>
                   <input type="email" name="email" id="email" class="form-control" required autocomplete="new-username">
                   <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_GET['redirect'] ?? ''); ?>">
               </div>
               <div class="mb-3">
                   <label for="password" class="form-label">Senha</label>
                   <input type="password" name="password" id="password" class="form-control" required autocomplete="off">
               </div>
               <button type="submit" class="btn btn-primary">Entrar</button>
               <a href="#" class="btn btn-success" id="create-account-btn">Criar conta</a> 
               <a href="#" class="" id="forgot-password-btn">Esqueci minha senha</a>
           </form>
              <div id="login-msg" class="mt-3">
                <?php
                if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                     echo '<div class="alert alert-danger">Dados inválidos.</div>';
                }
                ?></div>
           <!-- Recuperação de Senha -->
        <div class="forgot-password-form" style="display: none;">
            <form method="POST" action="forgot_password.php">
                
                <div class="mb-3"><br><br>
                    <label for="forgot_email" class="form-label">Informe o email cadastrado</label>
                    <input type="email" name="forgot_email" id="forgot_email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Enviar nova senha</button>
                <div id="forgot-password-msg" class="mt-3"></div>
            </form>
        </div>

        <!-- Criar Conta    -->
           <div class="form_create_account" style="display: none;">
        <form method="POST" action="create_account.php">
            <h4>Criar Conta</h4>
            <div class="mb-3">
                <label for="new_name" class="form-label">Nome</label>
                <input type="text" name="new_name" id="new_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_email" class="form-label">Email</label>
                <input type="email" name="new_email" id="new_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Senha</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required autocomplete="off">
            </div>
             <div class="mb-3">
                <label for="new_password_confirm" class="form-label">Confirmar senha</label>
                <input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-success">Criar Conta</button> 
            <div id="create-account-msg" class="mt-3"></div>
       </div>
              </form>
              
       </div>

</section>

       <script src="js/account.js"></script>



<?php
require 'footer.php';
?>