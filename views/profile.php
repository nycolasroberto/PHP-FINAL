<?php include 'views/includes/header.php'; ?>

<section class="profile-section">
    <div class="container">
        <div class="profile-header">
            <h2>Meu Perfil</h2>
        </div>

        <div class="profile-content">
            <div class="profile-info">
                <h3>Informações do Usuário</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nome:</strong>
                        <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Email:</strong>
                        <span><?php echo htmlspecialchars($_SESSION['user_email']); ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Função:</strong>
                        <span><?php echo $_SESSION['user_role'] === 'admin' ? 'Administrador' : 'Usuário'; ?></span>
                    </div>
                </div>
            </div>

            <div class="profile-stats">
                <h3>Estatísticas</h3>
                <?php
                require_once 'models/Post.php';
                require_once 'models/Comment.php';
                
                $database = new Database();
                $db = $database->getConnection();
                $postModel = new Post($db);
                $commentModel = new Comment($db);
                
                // Contar posts do usuário
                $query = "SELECT COUNT(*) as total FROM posts WHERE user_id = :user_id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':user_id', $_SESSION['user_id']);
                $stmt->execute();
                $userPosts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                
                // Contar comentários do usuário
                $query = "SELECT COUNT(*) as total FROM comments WHERE user_id = :user_id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':user_id', $_SESSION['user_id']);
                $stmt->execute();
                $userComments = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-number"><?php echo $userPosts; ?></span>
                        <span class="stat-label">Posts Criados</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number"><?php echo $userComments; ?></span>
                        <span class="stat-label">Comentários</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.profile-section {
    padding: 2rem 0;
}

.profile-header {
    margin-bottom: 2rem;
}

.profile-header h2 {
    color: #333;
    font-size: 2rem;
}

.profile-content {
    display: grid;
    gap: 2rem;
    grid-template-columns: 1fr 1fr;
}

.profile-info,
.profile-stats {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.profile-info h3,
.profile-stats h3 {
    margin-bottom: 1.5rem;
    color: #667eea;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
}

.info-grid {
    display: grid;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .profile-content {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'views/includes/footer.php'; ?>