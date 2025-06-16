<?php include 'views/includes/header.php'; ?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form">
            <h2>Recuperar Senha</h2>
            <p>Para recuperar sua senha, informe seus dados de cadastro:</p>
            
            <form method="POST" action="index.php?page=forgot-password&action=process">
                <?php echo getCSRFField(); ?>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required maxlength="14" 
                           placeholder="000.000.000-00">
                </div>
                
                <div class="form-group">
                    <label for="birth_date">Data de nascimento:</label>
                    <input type="date" id="birth_date" name="birth_date" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">Nova senha:</label>
                    <input type="password" id="new_password" name="new_password" required minlength="6">
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">Alterar Senha</button>
            </form>
            
            <div class="auth-links">
                <p><a href="index.php?page=login">Voltar ao login</a></p>
            </div>
        </div>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>