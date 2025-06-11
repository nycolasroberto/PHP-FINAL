<?php include 'views/includes/header.php'; ?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form">
            <h2>Login</h2>
            <form method="POST" action="index.php?page=login&action=process">
                <?php echo getCSRFField(); ?>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo isset($_COOKIE['user_email']) ? htmlspecialchars($_COOKIE['user_email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember"> Lembrar-me
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">Entrar</button>
            </form>
            
            <div class="auth-links">
                <p>Não tem uma conta? <a href="index.php?page=register">Cadastre-se</a></p>
                <p><a href="index.php?page=forgot-password">Esqueceu sua senha?</a></p>
            </div>
        </div>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>