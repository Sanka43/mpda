<?php
$pageTitle = __('events_title');
$metaDescription = __('events_subtitle');

try {
    $db = getDB();
    $events = getEvents($db);
} catch (Exception $e) {
    $events = [];
}
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('events_title')) ?></h1>
        <p><?= e(__('events_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <?php if ($events): ?>
        <div class="card-grid fade-in">
            <?php foreach ($events as $index => $event): ?>
            <div class="card">
                <div class="card-image" style="<?= backgroundImage(galleryImage($event['is_featured'] ? '01-featured-website' : '05-stage-performances', $index)) ?>"></div>
                <div class="card-body">
                    <?php if ($event['is_featured']): ?>
                    <span class="hero-badge" style="margin-bottom:0.75rem;font-size:0.7rem;"><?= e(__('events_featured')) ?></span>
                    <?php endif; ?>
                    <h3><?= e(eventTitle($event)) ?></h3>
                    <p><?= e(eventDescription($event)) ?></p>
                    <div class="card-meta">
                        <?php if ($event['event_date']): ?>
                        <span><strong>📅</strong> <?= e(formatDate($event['event_date'])) ?></span>
                        <?php endif; ?>
                        <?php if ($event['venue']): ?>
                        <span><strong>📍</strong> <?= e($event['venue']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state fade-in"><?= e(__('events_no_events')) ?></div>
        <?php endif; ?>
    </div>
</section>

<section class="bg-light">
    <div class="container" style="text-align:center;">
        <p class="section-subtitle"><?= e(__('register_subtitle')) ?></p>
        <a href="<?= url('register') ?>" class="btn btn-primary"><?= e(__('home_cta_register')) ?></a>
    </div>
</section>
