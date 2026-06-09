<?php
if (!defined('ADMIN_PAGE')) {
    define('ADMIN_PAGE', true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin') ?> | <?= e(APP_SHORT) ?> Admin</title>
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="admin-body">
    <header class="admin-header">
        <h1><?= e(APP_SHORT) ?> Admin</h1>
        <nav class="admin-nav">
            <a href="index.php">Dashboard</a>
            <a href="registrations.php">Registrations</a>
            <a href="feedback-manage.php">Feedback</a>
            <a href="blog-manage.php">Blog</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main class="admin-content">
