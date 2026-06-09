<?php
$pageTitle = __('blog_title');
$metaDescription = __('blog_subtitle');

$posts = getBlogPosts();
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('blog_title')) ?></h1>
        <p><?= e(__('blog_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <?php if ($posts): ?>
        <div class="blog-grid fade-in">
            <?php foreach ($posts as $index => $post): ?>
            <article class="card blog-card">
                <?php if ($post['image_url']): ?>
                <div class="card-image" style="background-image:url('<?= e($post['image_url']) ?>');"></div>
                <?php else: ?>
                <div class="card-image" style="<?= backgroundImage(galleryImage('04-outdoor-group-showcase', $index)) ?>"></div>
                <?php endif; ?>
                <div class="card-body">
                    <?php if ($post['published_at']): ?>
                    <div class="blog-date"><?= e(formatDate($post['published_at'])) ?></div>
                    <?php endif; ?>
                    <h3><?= e(blogTitle($post)) ?></h3>
                    <p><?= e(blogExcerpt($post)) ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state fade-in"><?= e(__('blog_no_posts')) ?></div>
        <?php endif; ?>
    </div>
</section>
