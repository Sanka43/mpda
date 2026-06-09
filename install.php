<?php
/**
 * One-time setup: visit http://localhost/mpda/install.php
 * Delete this file after successful installation.
 */

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $sql = file_get_contents(__DIR__ . '/database/schema.sql');
        $pdo->exec($sql);
        $message = 'Database installed successfully! You can now delete install.php and visit the website.';
        $success = true;
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPDA Install</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 4rem auto; padding: 2rem; }
        .ok { color: green; } .err { color: red; }
        button { padding: 0.75rem 1.5rem; background: #C9A227; border: none; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <h1>MPDA Database Setup</h1>
    <?php if ($message): ?>
    <p class="<?= $success ? 'ok' : 'err' ?>"><?= htmlspecialchars($message) ?></p>
    <?php if ($success): ?>
    <p><a href="<?= BASE_URL ?>/index.php">Go to Website</a> | <a href="<?= BASE_URL ?>/admin/login.php">Admin Login</a></p>
    <?php endif; ?>
    <?php else: ?>
    <p>Click below to create the database and seed initial data.</p>
    <form method="POST">
        <button type="submit">Install Database</button>
    </form>
    <?php endif; ?>
</body>
</html>
