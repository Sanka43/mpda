<?php
$pageTitle = __('branches_title');
$metaDescription = __('branches_subtitle');

try {
    $db = getDB();
    $branches = getBranches($db);
} catch (Exception $e) {
    $branches = [];
}
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('branches_title')) ?></h1>
        <p><?= e(__('branches_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <?php if ($branches): ?>
        <div class="card-grid">
            <?php foreach ($branches as $index => $branch): ?>
            <div class="card fade-in">
                <div class="card-image" style="<?= backgroundImage(galleryImage('03-dance-classes-training', $index)) ?>"></div>
                <div class="card-body">
                    <h3><?= e($branch['name']) ?></h3>
                    <div class="card-meta">
                        <span><strong><?= e(__('branches_day')) ?>:</strong> <?= e($branch['day_of_week']) ?></span>
                        <span><strong><?= e(__('branches_time')) ?>:</strong> <?= e(formatBranchTime($branch['start_time'], $branch['end_time'])) ?></span>
                        <span><strong><?= e(__('branches_venue')) ?>:</strong> <?= e($branch['venue']) ?></span>
                    </div>
                    <a href="<?= url('register', ['branch' => $branch['id']]) ?>" class="btn btn-primary" style="margin-top:1rem;width:100%;"><?= e(__('nav_register')) ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state"><?= e(__('branches_subtitle')) ?></div>
        <?php endif; ?>
    </div>
</section>
