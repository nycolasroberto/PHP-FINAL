<?php 
include 'views/includes/header.php';
// $post_data já foi definido no controller
?>

<section class="form-section">
    <div class="container">
        <div class="form-header">
            <h2>Editar Discussão</h2>
            <a href="index.php?page=forum" class="btn btn-secondary">Voltar ao Fórum</a>
        </div>

        <form method="POST" action="index.php?page=forum&action=edit&id=<?php echo $post_data['id']; ?>" class="post-form">
            <?php echo getCSRFField(); ?>
            
            <div class="form-group">
                <label for="title">Título da discussão:</label>
                <input type="text" id="title" name="title" required maxlength="255" 
                       value="<?php echo htmlspecialchars($post_data['title']); ?>">
            </div>
            
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select id="category" name="category" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="Matemática" <?php echo $post_data['category'] === 'Matemática' ? 'selected' : ''; ?>>Matemática</option>
                    <option value="Física" <?php echo $post_data['category'] === 'Física' ? 'selected' : ''; ?>>Física</option>
                    <option value="Química" <?php echo $post_data['category'] === 'Química' ? 'selected' : ''; ?>>Química</option>
                    <option value="Biologia" <?php echo $post_data['category'] === 'Biologia' ? 'selected' : ''; ?>>Biologia</option>
                    <option value="História" <?php echo $post_data['category'] === 'História' ? 'selected' : ''; ?>>História</option>
                    <option value="Geografia" <?php echo $post_data['category'] === 'Geografia' ? 'selected' : ''; ?>>Geografia</option>
                    <option value="Literatura" <?php echo $post_data['category'] === 'Literatura' ? 'selected' : ''; ?>>Literatura</option>
                    <option value="Filosofia" <?php echo $post_data['category'] === 'Filosofia' ? 'selected' : ''; ?>>Filosofia</option>
                    <option value="Programação" <?php echo $post_data['category'] === 'Programação' ? 'selected' : ''; ?>>Programação</option>
                    <option value="Engenharia" <?php echo $post_data['category'] === 'Engenharia' ? 'selected' : ''; ?>>Engenharia</option>
                    <option value="Medicina" <?php echo $post_data['category'] === 'Medicina' ? 'selected' : ''; ?>>Medicina</option>
                    <option value="Direito" <?php echo $post_data['category'] === 'Direito' ? 'selected' : ''; ?>>Direito</option>
                    <option value="Administração" <?php echo $post_data['category'] === 'Administração' ? 'selected' : ''; ?>>Administração</option>
                    <option value="Psicologia" <?php echo $post_data['category'] === 'Psicologia' ? 'selected' : ''; ?>>Psicologia</option>
                    <option value="Geral" <?php echo $post_data['category'] === 'Geral' ? 'selected' : ''; ?>>Geral</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="content">Conteúdo:</label>
                <textarea id="content" name="content" required rows="10"><?php echo htmlspecialchars($post_data['content']); ?></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="index.php?page=forum" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>