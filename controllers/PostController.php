<?php
require_once 'models/Post.php';

class PostController {
    private $db;
    private $post;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->post = new Post($this->db);
    }

    public function index() {
        $stmt = $this->post->getAll();
        include 'views/forum.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = "Token CSRF inválido.";
                header('Location: index.php?page=forum');
                return;
            }

            $this->post->title = trim($_POST['title']);
            $this->post->content = trim($_POST['content']);
            $this->post->category = trim($_POST['category']);
            $this->post->user_id = $_SESSION['user_id'];

            if (empty($this->post->title) || empty($this->post->content)) {
                $_SESSION['error'] = "Título e conteúdo são obrigatórios.";
                header('Location: index.php?page=forum');
                return;
            }

            if ($this->post->create()) {
                $_SESSION['success'] = "Post criado com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao criar post.";
            }
            header('Location: index.php?page=forum');
        } else {
            include 'views/create-post.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = "Token CSRF inválido.";
                header('Location: index.php?page=forum');
                return;
            }

            $this->post->id = $id;
            $this->post->title = trim($_POST['title']);
            $this->post->content = trim($_POST['content']);
            $this->post->category = trim($_POST['category']);
            $this->post->user_id = $_SESSION['user_id'];

            if ($this->post->update()) {
                $_SESSION['success'] = "Post atualizado com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao atualizar post.";
            }
            header('Location: index.php?page=forum');
        } else {
            $post_data = $this->post->getById($id);
            if (!$post_data || $post_data['user_id'] != $_SESSION['user_id']) {
                $_SESSION['error'] = "Post não encontrado ou você não tem permissão.";
                header('Location: index.php?page=forum');
                return;
            }
            include 'views/edit-post.php';
        }
    }

    public function delete() {
        if (!validateCSRFToken($_GET['csrf_token'])) {
            $_SESSION['error'] = "Token CSRF inválido.";
            header('Location: index.php?page=forum');
            return;
        }

        $this->post->id = $_GET['id'];
        $this->post->user_id = $_SESSION['user_id'];

        if ($this->post->delete()) {
            $_SESSION['success'] = "Post deletado com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao deletar post.";
        }
        header('Location: index.php?page=forum');
    }
}
?>