<?php 
include 'views/includes/header.php';
require_once 'models/Post.php';
require_once 'models/Comment.php';

$database = new Database();
$db = $database->getConnection();
$postModel = new Post($db);
$commentModel = new Comment($db);

$post_id = $_GET['id'] ?? 0;
$post = $postModel->getById($post_id);

if (!$post) {
    header('Location: index.php?page=forum');
    exit;
}

$comments_stmt = $commentModel->getByPostId($post_id);
$comments = $comments_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="post-detail-section">
    <div class="container">
        <div class="post-header">
            <a href="index.php?page=forum" class="btn btn-secondary">← Voltar ao Fórum</a>
        </div>

        <article class="post-detail">
            <header class="post-header">
                <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                <div class="post-meta">
                    <span class="post-category"><?php echo htmlspecialchars($post['category']); ?></span>
                    <span class="post-author">Por: <?php echo htmlspecialchars($post['author_name']); ?></span>
                    <span class="post-date"><?php echo date('d/m/Y H:i', strtotime($post['created_at'])); ?></span>
                </div>
            </header>
            
            <div class="post-content">
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            </div>
        </article>

        <section class="comments-section">
            <h3>Comentários (<?php echo count($comments); ?>)</h3>
            
            <form method="POST" action="index.php?page=post&action=comment" class="comment-form">
                <?php echo getCSRFField(); ?>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                
                <div class="form-group">
                    <label for="content">Adicionar comentário:</label>
                    <textarea id="content" name="content" required rows="4" 
                              placeholder="Compartilhe sua opinião ou esclareça dúvidas..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Comentar</button>
            </form>

            <div class="comments-list">
                <?php if (empty($comments)): ?>
                    <p class="no-comments">Nenhum comentário ainda. Seja o primeiro a comentar!</p>
                <?php else: ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <div class="comment-header">
                                <span class="comment-author"><?php echo htmlspecialchars($comment['author_name']); ?></span>
                                <span class="comment-date"><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></span>
                                <?php if ($comment['user_id'] == $_SESSION['user_id']): ?>
                                    <a href="index.php?page=post&action=delete-comment&id=<?php echo $comment['id']; ?>&post_id=<?php echo $post_id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" 
                                       class="comment-delete" onclick="return confirm('Tem certeza que deseja deletar este comentário?')">Deletar</a>
                                <?php endif; ?>
                            </div>
                            <div class="comment-content">
                                <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>