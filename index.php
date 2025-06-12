<?php
session_start();
require_once 'config/database.php';
require_once 'config/csrf.php';
require_once 'controllers/UserController.php';
require_once 'controllers/PostController.php';
require_once 'controllers/CommentController.php';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCSRFToken();
}

$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? '';

switch ($page) {
    case 'home':
        include 'views/home.php';
        break;
        
    case 'about':
        include 'views/about.php';
        break;
        
    case 'rules':
        include 'views/rules.php';
        break;
        
    case 'login':
        if ($action === 'process') {
            $userController = new UserController();
            $userController->login();
        } else {
            include 'views/login.php';
        }
        break;
        
    case 'register':
        if ($action === 'process') {
            $userController = new UserController();
            $userController->register();
        } else {
            include 'views/register.php';
        }
        break;
        
    case 'forgot-password':
        if ($action === 'process') {
            $userController = new UserController();
            $userController->forgotPassword();
        } else {
            include 'views/forgot-password.php';
        }
        break;
        
    case 'logout':
        $userController = new UserController();
        $userController->logout();
        break;
        
    case 'profile':
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }
        include 'views/profile.php';
        break;
        
    case 'forum':
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }
        $postController = new PostController();
        if ($action === 'create') {
            $postController->create();
        } elseif ($action === 'edit') {
            $postController->edit();
        } elseif ($action === 'delete') {
            $postController->delete();
        } else {
            $postController->index();
        }
        break;
        
    case 'post':
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }
        $postController = new PostController();
        $commentController = new CommentController();
        
        if ($action === 'comment') {
            $commentController->create();
        } elseif ($action === 'delete-comment') {
            $commentController->delete();
        } else {
            include 'views/post-detail.php';
        }
        break;
        
    case 'admin':
        if (!isLoggedIn() || !isAdmin()) {
            header('Location: index.php?page=login');
            exit;
        }
        include 'views/admin.php';
        break;
        
    default:
        include 'views/404.php';
        break;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}
?>