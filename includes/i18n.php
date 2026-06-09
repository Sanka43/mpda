<?php

$allowedLangs = ['en', 'si'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLangs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
    setcookie('mpda_lang', $_GET['lang'], time() + (86400 * 365), BASE_URL . '/');
}

if (empty($_SESSION['lang'])) {
    $_SESSION['lang'] = $_COOKIE['mpda_lang'] ?? 'en';
}

if (!in_array($_SESSION['lang'], $allowedLangs, true)) {
    $_SESSION['lang'] = 'en';
}

$lang = require __DIR__ . '/../lang/' . $_SESSION['lang'] . '.php';

/**
 * @return string|array<int|string, mixed>
 */
function __($key, ...$args)
{
    global $lang;

    $value = $lang[$key] ?? $key;

    if (is_array($value)) {
        return $value;
    }

    if ($args) {
        return vsprintf((string) $value, $args);
    }

    return (string) $value;
}

function currentLang(): string
{
    return $_SESSION['lang'] ?? 'en';
}

function langSwitchUrl(string $langCode): string
{
    $params = $_GET;
    $params['lang'] = $langCode;
    if (isset($params['page'])) {
        return BASE_URL . '/index.php?' . http_build_query($params);
    }
    return BASE_URL . '/index.php?page=' . ($params['page'] ?? 'home') . '&lang=' . $langCode;
}
