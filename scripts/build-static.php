<?php

/**
 * Build static HTML files for GitHub Pages.
 * GitHub Pages does not run PHP — this exports every page as .html.
 */

define('STATIC_BUILD', true);

$root = dirname(__DIR__);
$outputDir = $root;

$allowedPages = [
    'home', 'about', 'branches', 'gallery', 'events', 'teachers',
    'register', 'contact', 'blog', 'founder', 'feedback',
];

$langs = ['en', 'si'];

$_SERVER['REQUEST_METHOD'] = 'GET';

require_once $root . '/includes/bootstrap.php';

function renderPage(string $pageSlug): string
{
    global $root, $allowedPages;

    $page = $pageSlug;
    if (!in_array($page, $allowedPages, true)) {
        $page = 'home';
    }

    $pageFile = $root . '/pages/' . $page . '.php';
    if (!file_exists($pageFile)) {
        $page = 'home';
        $pageFile = $root . '/pages/home.php';
    }

    $GLOBALS['page'] = $page;
    $_GET = [];

    ob_start();
    require $root . '/includes/layout-start.php';
    require $root . '/includes/header.php';
    require $pageFile;
    require $root . '/includes/footer.php';

    return ob_get_clean();
}

$built = 0;

foreach ($langs as $langCode) {
    $_SESSION['lang'] = $langCode;
    reloadLang();

    foreach ($allowedPages as $pageSlug) {
        $html = renderPage($pageSlug);
        $relativePath = staticPagePath($pageSlug, $langCode);
        $path = $outputDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $dir = dirname($path);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($path, $html);
        $built++;
        echo "Built {$relativePath}\n";
    }
}

$legacyFiles = ['index-si.html'];
foreach ($allowedPages as $pageSlug) {
    if ($pageSlug === 'home') {
        continue;
    }
    $legacyFiles[] = "{$pageSlug}.html";
    $legacyFiles[] = "{$pageSlug}-si.html";
}

foreach ($legacyFiles as $legacyFile) {
    $legacyPath = $outputDir . DIRECTORY_SEPARATOR . $legacyFile;
    if (file_exists($legacyPath)) {
        unlink($legacyPath);
        echo "Removed legacy {$legacyFile}\n";
    }
}

touch($outputDir . DIRECTORY_SEPARATOR . '.nojekyll');

echo "Done. {$built} HTML files generated.\n";
