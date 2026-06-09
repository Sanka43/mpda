<?php

require_once __DIR__ . '/../includes/bootstrap.php';

if (isAdminLoggedIn()) {
    header('Location: ' . BASE_URL . '/admin/');
    exit;
}

$error = '';

if (isPost()) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: ' . BASE_URL . '/admin/');
        exit;
    }

    $error = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | <?= e(APP_SHORT) ?></title>
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="admin-body">
    <div class="login-box">
        <h2><?= e(APP_NAME) ?></h2>
        <p style="text-align:center;color:var(--gray-600);margin-bottom:1.5rem;">Admin Panel</p>

        <?php if ($error): ?>
        <div class="alert alert-error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group" style="margin-bottom:1.25rem;">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            <div class="form-group" style="margin-bottom:1.5rem;">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
        </form>
        <p style="text-align:center;margin-top:1rem;">
            <a href="<?= url('home') ?>" style="color:var(--gray-600);font-size:0.9rem;">← Back to website</a>
        </p>
    </div>
</body>
</html>
