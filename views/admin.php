<?php 
include 'views/includes/header.php';

// Verificar se é admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: index.php?page=home');
    exit;
}

require_once 'models/User.php';
require_once 'models/Post.php';
require_once 'models/Comment.php';

$database = new Database();
$db = $database->getConnection();
$userModel = new User($db);
$postModel = new Post($db);
$commentModel = new Comment($db);

// Buscar estatísticas
$users_stmt = $userModel->getAll();
$users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);

$posts_stmt = $postModel->getAll();
$posts = $posts_stmt->fetchAll(PDO::FETCH_ASSOC);

$comments_stmt = $commentModel->getAll();
$comments = $comments_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="admin-section">
    <div class="container">
        <div class="admin-header">
            <h2>Painel Administrativo</h2>
        </div>

        <div class="admin-stats">
            <div class="stat-card">
                <span class="stat-number"><?php echo count($users); ?></span>
                <span class="stat-label">Usuários</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo count($posts); ?></span>
                <span class="stat-label">Posts</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo count($comments); ?></span>
                <span class="stat-label">Comentários</span>
            </div>
        </div>

        <div class="admin-content">
            <div class="admin-section-content">
                <h3>Usuários Recentes</h3>
                <div class="table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Função</th>
                                <th>Data de Cadastro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($users, 0, 10) as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo $user['role'] === 'admin' ? 'Admin' : 'Usuário'; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="admin-section-content">
                <h3>Posts Recentes</h3>
                <div class="table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Categoria</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($posts, 0, 10) as $post): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars(substr($post['title'], 0, 50)) . '...'; ?></td>
                                    <td><?php echo htmlspecialchars($post['author_name']); ?></td>
                                    <td><?php echo htmlspecialchars($post['category']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.admin-section {
    padding: 2rem 0;
}

.admin-header {
    margin-bottom: 2rem;
}

.admin-header h2 {
    color: #333;
    font-size: 2rem;
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border-left: 4px solid #667eea;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #667eea;
}

.stat-label {
    color: #666;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.admin-content {
    display: grid;
    gap: 2rem;
    grid-template-columns: 1fr 1fr;
}

.admin-section-content {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.admin-section-content h3 {
    margin-bottom: 1.5rem;
    color: #333;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
}

.table-container {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th,
.admin-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e9ecef;
}

.admin-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.admin-table tbody tr:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .admin-content {
        grid-template-columns: 1fr;
    }
    
    .admin-stats {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'views/includes/footer.php'; ?>