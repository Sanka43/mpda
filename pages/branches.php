<?php
$pageTitle = __('branches_title');
$metaDescription = __('branches_subtitle');

$branches = getBranches();

$disciplines = [
    [
        'title' => __('home_style_udarata'),
        'desc' => __('branches_discipline_udarata_desc'),
        'tag' => __('branches_discipline_udarata_tag'),
        'image' => galleryImage('01-featured-website', 0),
    ],
    [
        'title' => __('home_style_pahatharata'),
        'desc' => __('branches_discipline_pahatharata_desc'),
        'tag' => __('branches_discipline_pahatharata_tag'),
        'image' => galleryImage('02-cultural-ceremony', 0),
    ],
    [
        'title' => __('home_style_bollywood'),
        'desc' => __('branches_discipline_bollywood_desc'),
        'tag' => __('branches_discipline_bollywood_tag'),
        'image' => galleryImage('03-dance-classes-training', 10),
    ],
];
?>

<section class="classes-hero fade-in">
    <div class="container">
        <span class="classes-hero__label"><?= e(__('branches_hero_label')) ?></span>
        <h1><?= e(__('branches_title')) ?></h1>
        <p class="classes-hero__intro"><?= e(__('branches_subtitle')) ?></p>
    </div>
</section>

<section class="classes-section">
    <div class="container">
        <div class="classes-disciplines__intro fade-in">
            <div>
                <h2><?= e(__('branches_disciplines_title')) ?></h2>
                <div class="classes-disciplines__line"></div>
            </div>
            <p><?= e(__('branches_disciplines_intro')) ?></p>
        </div>
        <div class="classes-disciplines__grid fade-in">
            <?php foreach ($disciplines as $discipline): ?>
            <article class="classes-discipline-card">
                <div class="classes-discipline-card__image">
                    <img src="<?= e($discipline['image']) ?>" alt="<?= e($discipline['title']) ?>" loading="lazy">
                </div>
                <div class="classes-discipline-card__body">
                    <h3><?= e($discipline['title']) ?></h3>
                    <p><?= e($discipline['desc']) ?></p>
                    <span class="classes-discipline-card__tag"><?= e($discipline['tag']) ?></span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="classes-section classes-section--alt" id="schedule">
    <div class="container">
        <div class="classes-schedule__header fade-in">
            <h2><?= e(__('branches_schedule_title')) ?></h2>
            <p><?= e(__('branches_schedule_subtitle')) ?></p>
        </div>
        <?php if ($branches): ?>
        <div class="classes-table-wrap fade-in">
            <table class="classes-table">
                <thead>
                    <tr>
                        <th><?= e(__('branches_col_branch')) ?></th>
                        <th><?= e(__('branches_col_venue')) ?></th>
                        <th><?= e(__('branches_col_day')) ?></th>
                        <th><?= e(__('branches_col_time')) ?></th>
                        <th><?= e(__('branches_col_action')) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($branches as $branch): ?>
                    <tr>
                        <td class="classes-table__branch"><?= e($branch['name']) ?></td>
                        <td><?= e($branch['venue']) ?></td>
                        <td><?= e($branch['day_of_week']) ?></td>
                        <td><?= e(formatBranchTime($branch['start_time'], $branch['end_time'])) ?></td>
                        <td>
                            <a href="<?= url('register', ['branch' => $branch['id']]) ?>" class="classes-table__join">
                                <?= e(__('branches_join')) ?> →
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state"><?= e(__('branches_schedule_subtitle')) ?></div>
        <?php endif; ?>
    </div>
</section>

<section class="classes-cta">
    <div class="container">
        <div class="classes-cta__box fade-in">
            <h2><?= e(__('branches_cta_title')) ?></h2>
            <p><?= e(__('branches_cta_text')) ?></p>
            <div class="classes-cta__actions">
                <a href="<?= url('register') ?>" class="btn-gold"><?= e(__('branches_cta_register')) ?></a>
                <a href="<?= url('about') ?>" class="btn-outline"><?= e(__('branches_cta_faq')) ?></a>
            </div>
        </div>
    </div>
</section>
