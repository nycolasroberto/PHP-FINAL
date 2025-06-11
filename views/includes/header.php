<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum Universitário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-brand">
                <h1>🎓 Fórum Universitário</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php?page=home">Início</a></li>
                <li><a href="index.php?page=about">Sobre</a></li>
                <li><a href="index.php?page=rules">Regulamento</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?page=forum">Fórum</a></li>
                    <li><a href="index.php?page=profile">Perfil</a></li>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <li><a href="index.php?page=admin">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="index.php?page=logout">Sair</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=login">Login</a></li>
                    <li><a href="index.php?page=register">Cadastrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>