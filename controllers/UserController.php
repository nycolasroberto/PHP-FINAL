<?php
require_once 'models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = "Token CSRF inválido.";
                header('Location: index.php?page=register');
                return;
            }

            $this->user->name = trim($_POST['name']);
            $this->user->email = trim($_POST['email']);
            $this->user->password = $_POST['password'];
            $this->user->cpf = trim($_POST['cpf']);
            $this->user->birth_date = $_POST['birth_date'];

            // Validações
            if (empty($this->user->name) || empty($this->user->email) || empty($this->user->password)) {
                $_SESSION['error'] = "Todos os campos são obrigatórios.";
                header('Location: index.php?page=register');
                return;
            }

            if ($this->user->emailExists($this->user->email)) {
                $_SESSION['error'] = "Este email já está cadastrado.";
                header('Location: index.php?page=register');
                return;
            }

            if ($this->user->create()) {
                $_SESSION['success'] = "Cadastro realizado com sucesso! Faça login para continuar.";
                header('Location: index.php?page=login');
            } else {
                $_SESSION['error'] = "Erro ao cadastrar usuário.";
                header('Location: index.php?page=register');
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = "Token CSRF inválido.";
                header('Location: index.php?page=login');
                return;
            }

            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $remember = isset($_POST['remember']);

            if ($this->user->login($email, $password)) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_name'] = $this->user->name;
                $_SESSION['user_email'] = $this->user->email;
                $_SESSION['user_role'] = $this->user->role;

                if ($remember) {
                    setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 dias
                }

                header('Location: index.php?page=forum');
            } else {
                $_SESSION['error'] = "Email ou senha incorretos.";
                header('Location: index.php?page=login');
            }
        }
    }

    public function logout() {
        session_destroy();
        setcookie('user_email', '', time() - 3600, "/");
        header('Location: index.php?page=home');
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = "Token CSRF inválido.";
                header('Location: index.php?page=forgot-password');
                return;
            }

            $email = trim($_POST['email']);
            $cpf = trim($_POST['cpf']);
            $birth_date = $_POST['birth_date'];
            $new_password = $_POST['new_password'];

            if ($this->user->validateRecovery($email, $cpf, $birth_date)) {
                if ($this->user->updatePassword($email, $new_password)) {
                    $_SESSION['success'] = "Senha alterada com sucesso!";
                    header('Location: index.php?page=login');
                } else {
                    $_SESSION['error'] = "Erro ao alterar senha.";
                    header('Location: index.php?page=forgot-password');
                }
            } else {
                $_SESSION['error'] = "Dados não conferem.";
                header('Location: index.php?page=forgot-password');
            }
        }
    }
}
?>