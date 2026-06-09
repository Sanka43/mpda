<?php
$pageTitle = __('gallery_title');
$metaDescription = __('gallery_subtitle');

$galleryCategories = [
    '01-featured-website' => 'Featured',
    '02-cultural-ceremony' => 'Cultural Ceremony',
    '03-dance-classes-training' => 'Classes & Training',
    '04-outdoor-group-showcase' => 'Outdoor Showcase',
    '05-stage-performances' => 'Stage Performances',
    '06-awards-and-details' => 'Awards & Details',
];

$galleryBaseDir = dirname(__DIR__) . '/assets/images/galery-categorized';
$galleryBaseUrl = 'images/galery-categorized';
$galleryImages = [];

foreach ($galleryCategories as $folder => $label) {
    $folderPath = $galleryBaseDir . '/' . $folder;

    if (!is_dir($folderPath)) {
        continue;
    }

    $files = glob($folderPath . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
    sort($files, SORT_NATURAL | SORT_FLAG_CASE);

    foreach ($files as $file) {
        $fileName = basename($file);
        $galleryImages[] = [
            'url' => asset($galleryBaseUrl . '/' . rawurlencode($folder) . '/' . rawurlencode($fileName)),
            'alt' => APP_SHORT . ' ' . $label . ' photo',
            'category' => $label,
        ];
    }
}
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('gallery_title')) ?></h1>
        <p><?= e(__('gallery_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <div class="gallery-category-list fade-in">
            <?php foreach ($galleryCategories as $label): ?>
                <span><?= e($label) ?></span>
            <?php endforeach; ?>
        </div>

        <div class="gallery-grid fade-in">
            <?php foreach ($galleryImages as $img): ?>
            <div class="gallery-item">
                <img src="<?= e($img['url']) ?>" alt="<?= e($img['alt']) ?>" loading="lazy">
                <div class="overlay"><?= e($img['category']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
