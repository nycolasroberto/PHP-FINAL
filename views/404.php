<?php include 'views/includes/header.php'; ?>

<section class="error-section">
    <div class="container">
        <div class="error-content">
            <h1>404</h1>
            <h2>Página não encontrada</h2>
            <p>A página que você está procurando não existe ou foi movida.</p>
            <div class="error-actions">
                <a href="index.php?page=home" class="btn btn-primary">Voltar ao Início</a>
                <a href="index.php?page=forum" class="btn btn-secondary">Ir para o Fórum</a>
            </div>
        </div>
    </div>
</section>

<style>
.error-section {
    padding: 4rem 0;
    text-align: center;
}

.error-content h1 {
    font-size: 8rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 1rem;
    opacity: 0.3;
}

.error-content h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #333;
}

.error-content p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 2rem;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}
</style>

<?php include 'views/includes/footer.php'; ?>