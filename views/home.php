<?php include 'views/includes/header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <h2>Bem-vindo ao Fórum Universitário</h2>
        <p>O espaço ideal para discussões acadêmicas, troca de conhecimentos e networking entre estudantes.</p>
        <div class="hero-buttons">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="index.php?page=register" class="btn btn-primary">Cadastre-se</a>
                <a href="index.php?page=login" class="btn btn-secondary">Fazer Login</a>
            <?php else: ?>
                <a href="index.php?page=forum" class="btn btn-primary">Acessar Fórum</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <h3>Funcionalidades do Fórum</h3>
        <div class="features-grid">
            <div class="feature-card">
                <h4>💬 Discussões</h4>
                <p>Participe de debates acadêmicos e troque experiências com outros estudantes.</p>
            </div>
            <div class="feature-card">
                <h4>📚 Categorias</h4>
                <p>Organize suas discussões por área de conhecimento e disciplina.</p>
            </div>
            <div class="feature-card">
                <h4>👥 Comunidade</h4>
                <p>Conecte-se com estudantes de diferentes cursos e universidades.</p>
            </div>
            <div class="feature-card">
                <h4>🔒 Seguro</h4>
                <p>Ambiente protegido com sistema de autenticação e moderação.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>