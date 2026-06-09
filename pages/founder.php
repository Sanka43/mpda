<?php
$pageTitle = __('founder_title');
$metaDescription = __('founder_bio');
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('founder_title')) ?></h1>
        <p><?= e(FOUNDER_NAME) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <div class="founder-block fade-in">
            <div class="founder-image">
                <img
                    src="<?= asset('images/Founder.jpg') ?>"
                    alt="<?= e(FOUNDER_NAME) ?>"
                    width="600"
                    height="800"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div>
                <?php
                $paragraphs = explode("\n\n", trim(__('founder_bio')));
                foreach ($paragraphs as $para):
                    if (trim($para)):
                ?>
                <p class="text-muted"><?= e(trim($para)) ?></p>
                <?php
                    endif;
                endforeach;
                ?>
                <blockquote class="founder-quote"><?= e(__('founder_quote')) ?></blockquote>
                <p class="founder-name"><?= e(__('home_founder_name')) ?></p>
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
