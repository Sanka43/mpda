<?php
$pageTitle = __('about_title');
$metaDescription = __('about_who_text');
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('about_title')) ?></h1>
        <p><?= e(__('home_about_text')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <div class="about-intro fade-in">
            <div class="about-intro__image">
                <img
                    src="<?= galleryImage('01-featured-website', 5) ?>"
                    alt="<?= e(__('about_title')) ?>"
                    loading="eager"
                    decoding="async"
                >
            </div>
            <div class="about-section">
                <h2><?= e(__('about_who_title')) ?></h2>
                <p><?= e(__('about_who_text')) ?></p>
            </div>
        </div>

        <div class="about-section fade-in">
            <h2><?= e(__('about_mission_title')) ?></h2>
            <p><?= e(__('about_mission_text')) ?></p>
        </div>

        <div class="about-section fade-in">
            <h2><?= e(__('about_offer_title')) ?></h2>
            <p><?= e(__('about_offer_text')) ?></p>
            <p style="margin-top:1rem;font-style:italic;color:var(--gold);"><?= e(__('about_family')) ?></p>
        </div>

        <div class="about-section fade-in">
            <h2><?= e(__('about_values_title')) ?></h2>
            <ul class="values-list">
                <?php foreach (__('about_values') as $value): ?>
                <li><?= e($value) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="about-section fade-in">
            <h2><?= e(__('about_vision_title')) ?></h2>
            <p><?= e(__('about_vision_text')) ?></p>
        </div>
    </div>
</section>

<section class="bg-dark">
    <div class="container" style="text-align:center;">
        <h2 class="section-title"><?= e(__('home_cta_register')) ?></h2>
        <div class="gold-line"></div>
        <p class="section-subtitle"><?= e(__('register_subtitle')) ?></p>
        <a href="<?= url('register') ?>" class="btn btn-primary"><?= e(__('home_cta_register')) ?></a>
    </div>
</section>
