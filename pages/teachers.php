<?php
$pageTitle = __('teachers_title');
$metaDescription = __('teachers_subtitle');
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('teachers_title')) ?></h1>
        <p><?= e(__('teachers_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <div class="founder-block fade-in">
            <div class="founder-image">
                <img
                    src="<?= asset('images/Founder.jpg') ?>"
                    alt="<?= e(FOUNDER_NAME) ?>"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div>
                <span class="hero-badge" style="margin-bottom:1rem;"><?= e(__('teachers_founder_role')) ?></span>
                <h2><?= e(FOUNDER_NAME) ?></h2>
                <div class="gold-line" style="margin-left:0;"></div>
                <?php
                $bioParts = explode("\n\n", trim(__('founder_bio')));
                $shortBio = array_slice($bioParts, 0, 2);
                foreach ($shortBio as $para):
                ?>
                <p class="text-muted"><?= e(trim($para)) ?></p>
                <?php endforeach; ?>
                <a href="<?= url('founder') ?>" class="btn btn-dark"><?= e(__('read_more')) ?></a>
            </div>
        </div>
    </div>
</section>

<section class="bg-light">
    <div class="container">
        <h2 class="section-title fade-in"><?= e(__('teachers_awards_title')) ?></h2>
        <div class="gold-line"></div>
        <ul class="awards-list fade-in" style="max-width:700px;margin:2rem auto 0;">
            <?php foreach (__('awards') as $award): ?>
            <li><?= e($award) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section>
    <div class="container" style="text-align:center;">
        <p class="section-subtitle"><?= e(__('teachers_subtitle')) ?></p>
        <a href="<?= url('register') ?>" class="btn btn-primary"><?= e(__('home_cta_register')) ?></a>
    </div>
</section>
