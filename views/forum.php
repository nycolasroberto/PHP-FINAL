<?php 
include 'views/includes/header.php';
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="forum-section">
    <div class="container">
        <div class="forum-header">
            <h2>Discussões do Fórum</h2>
            <a href="index.php?page=forum&action=create" class="btn btn-primary">Nova Discussão</a>
        </div>

        <div class="forum-stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo count($posts); ?></span>
                <span class="stat-label">Tópicos</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário'; ?></span>
                <span class="stat-label">Bem-vindo</span>
            </div>
        </div>

        <div class="posts-list">
            <?php if (empty($posts)): ?>
                <div class="no-posts">
                    <p>Nenhuma discussão encontrada. Seja o primeiro a criar um tópico!</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <article class="post-card">
                        <div class="post-header">
                            <h3><a href="index.php?page=post&id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
                            <span class="post-category"><?php echo htmlspecialchars($post['category']); ?></span>
                        </div>
                        <div class="post-content">
                            <p><?php echo htmlspecialchars(substr($post['content'], 0, 200)) . '...'; ?></p>
                        </div>
                        <div class="post-meta">
                            <span class="post-author">Por: <?php echo htmlspecialchars($post['author_name']); ?></span>
                            <span class="post-date"><?php echo date('d/m/Y H:i', strtotime($post['created_at'])); ?></span>
                            <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
                                <div class="post-actions">
                                    <a href="index.php?page=forum&action=edit&id=<?php echo $post['id']; ?>" class="btn btn-small">Editar</a>
                                    <a href="index.php?page=forum&action=delete&id=<?php echo $post['id']; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" 
                                       class="btn btn-small btn-danger" onclick="return confirm('Tem certeza que deseja deletar este post?')">Deletar</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>