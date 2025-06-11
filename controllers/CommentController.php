<?php
require_once 'models/Comment.php';

class CommentController {
    private $db;
    private $comment;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->comment = new Comment($this->db);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = "Token CSRF inválido.";
                header('Location: index.php?page=post&id=' . $_POST['post_id']);
                return;
            }

            $this->comment->content = trim($_POST['content']);
            $this->comment->post_id = $_POST['post_id'];
            $this->comment->user_id = $_SESSION['user_id'];

            if (empty($this->comment->content)) {
                $_SESSION['error'] = "Conteúdo do comentário é obrigatório.";
                header('Location: index.php?page=post&id=' . $_POST['post_id']);
                return;
            }

            if ($this->comment->create()) {
                $_SESSION['success'] = "Comentário adicionado com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao adicionar comentário.";
            }
            header('Location: index.php?page=post&id=' . $_POST['post_id']);
        }
    }

    public function delete() {
        if (!validateCSRFToken($_GET['csrf_token'])) {
            $_SESSION['error'] = "Token CSRF inválido.";
            header('Location: index.php?page=forum');
            return;
        }

        $this->comment->id = $_GET['id'];
        $this->comment->user_id = $_SESSION['user_id'];
        $post_id = $_GET['post_id'];

        if ($this->comment->delete()) {
            $_SESSION['success'] = "Comentário deletado com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao deletar comentário.";
        }
        header('Location: index.php?page=post&id=' . $post_id);
    }
}
?>