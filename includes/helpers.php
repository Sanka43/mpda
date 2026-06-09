<?php

function url(string $page = 'home', array $params = []): string
{
    $query = http_build_query(array_merge(['page' => $page], $params));
    return BASE_URL . '/index.php?' . $query;
}

function asset(string $path): string
{
    return BASE_URL . '/assets/' . ltrim($path, '/');
}

function galleryAsset(string $category, string $fileName): string
{
    return asset('images/galery-categorized/' . rawurlencode($category) . '/' . rawurlencode($fileName));
}

function galleryImages(string $category): array
{
    static $cache = [];

    if (isset($cache[$category])) {
        return $cache[$category];
    }

    $dir = dirname(__DIR__) . '/assets/images/galery-categorized/' . $category;
    if (!is_dir($dir)) {
        return $cache[$category] = [];
    }

    $files = glob($dir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
    sort($files, SORT_NATURAL | SORT_FLAG_CASE);

    return $cache[$category] = array_map('basename', $files);
}

function galleryImage(string $category, int $index = 0): string
{
    $images = galleryImages($category);
    if (!$images) {
        return asset('images/logo.png');
    }

    $selected = $images[$index % count($images)];
    return galleryAsset($category, $selected);
}

function backgroundImage(string $url): string
{
    return "background-image:url('" . e($url) . "');";
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $page, array $params = []): void
{
    header('Location: ' . url($page, $params));
    exit;
}

function isPost(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(?string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrfToken()) . '">';
}

function isAdminLoggedIn(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

function requireAdmin(): void
{
    if (!isAdminLoggedIn()) {
        header('Location: ' . BASE_URL . '/admin/login.php');
        exit;
    }
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }

    if (!empty($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }

    return null;
}

function formatDate(?string $date): string
{
    if (!$date) {
        return '';
    }
    return date('M j, Y', strtotime($date));
}
