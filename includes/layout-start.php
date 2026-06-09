<!DOCTYPE html>
<html lang="<?= e(currentLang()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($metaDescription ?? __('meta_description')) ?>">
    <meta name="keywords" content="<?= e(__('meta_keywords')) ?>">
    <meta property="og:title" content="<?= e($pageTitle ?? APP_NAME) ?>">
    <meta property="og:description" content="<?= e($metaDescription ?? __('meta_description')) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://<?= e(DOMAIN) ?>">
    <title><?= e(($pageTitle ?? APP_NAME) . ' | ' . APP_SHORT) ?></title>
    <link rel="icon" type="image/png" href="<?= asset('images/logo.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <?php if (($page ?? '') === 'home'): ?>
    <link rel="stylesheet" href="<?= asset('css/home.css') ?>">
    <?php endif; ?>
</head>
<body class="site-theme<?= ($page ?? '') === 'home' ? ' page-home' : ' page-inner' ?>">
