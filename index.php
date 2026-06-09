<?php

require_once __DIR__ . '/includes/bootstrap.php';

$allowedPages = [
    'home', 'about', 'branches', 'gallery', 'events', 'teachers',
    'register', 'contact', 'blog', 'founder', 'feedback',
];

$page = $_GET['page'] ?? 'home';
if (!in_array($page, $allowedPages, true)) {
    $page = 'home';
}

$pageFile = __DIR__ . '/pages/' . $page . '.php';
if (!file_exists($pageFile)) {
    $page = 'home';
    $pageFile = __DIR__ . '/pages/home.php';
}

require __DIR__ . '/includes/layout-start.php';
require __DIR__ . '/includes/header.php';
require $pageFile;
require __DIR__ . '/includes/footer.php';
