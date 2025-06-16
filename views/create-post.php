<?php include 'views/includes/header.php'; ?>

<section class="form-section">
    <div class="container">
        <div class="form-header">
            <h2>Nova Discussão</h2>
            <a href="index.php?page=forum" class="btn btn-secondary">Voltar ao Fórum</a>
        </div>

        <form method="POST" action="index.php?page=forum&action=create" class="post-form">
            <?php echo getCSRFField(); ?>
            
            <div class="form-group">
                <label for="title">Título da discussão:</label>
                <input type="text" id="title" name="title" required maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select id="category" name="category" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="Matemática">Matemática</option>
                    <option value="Física">Física</option>
                    <option value="Química">Química</option>
                    <option value="Biologia">Biologia</option>
                    <option value="História">História</option>
                    <option value="Geografia">Geografia</option>
                    <option value="Literatura">Literatura</option>
                    <option value="Filosofia">Filosofia</option>
                    <option value="Programação">Programação</option>
                    <option value="Engenharia">Engenharia</option>
                    <option value="Medicina">Medicina</option>
                    <option value="Direito">Direito</option>
                    <option value="Administração">Administração</option>
                    <option value="Psicologia">Psicologia</option>
                    <option value="Geral">Geral</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="content">Conteúdo:</label>
                <textarea id="content" name="content" required rows="10" 
                          placeholder="Descreva sua questão, dúvida ou tópico de discussão..."></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Criar Discussão</button>
                <a href="index.php?page=forum" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>