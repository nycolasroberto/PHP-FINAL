<?php include 'views/includes/header.php'; ?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form">
            <h2>Cadastro</h2>
            <form method="POST" action="index.php?page=register&action=process">
                <?php echo getCSRFField(); ?>
                
                <div class="form-group">
                    <label for="name">Nome completo:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required maxlength="14" 
                           placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                </div>
                
                <div class="form-group">
                    <label for="birth_date">Data de nascimento:</label>
                    <input type="date" id="birth_date" name="birth_date" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required minlength="6">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar senha:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">Cadastrar</button>
            </form>
            
            <div class="auth-links">
                <p>Já tem uma conta? <a href="index.php?page=login">Faça login</a></p>
            </div>
        </div>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>