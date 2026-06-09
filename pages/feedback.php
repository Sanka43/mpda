<?php
$pageTitle = __('feedback_title');
$metaDescription = __('feedback_subtitle');

$success = flash('feedback_success');
$error = flash('feedback_error');

$testimonials = getTestimonials();

if ((!defined('STATIC_BUILD') || !STATIC_BUILD) && isPost() && verifyCsrf($_POST['csrf_token'] ?? '')) {
    $parentName = trim($_POST['parent_name'] ?? '');
    $studentName = trim($_POST['student_name'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $rating = min(5, max(1, (int)($_POST['rating'] ?? 5)));

    if ($parentName && $content) {
        $message = "MPDA Parent Feedback\n\n"
            . "Parent: {$parentName}\n"
            . "Student: " . ($studentName ?: 'N/A') . "\n"
            . "Rating: {$rating}/5\n\n"
            . $content;

        header('Location: ' . whatsappUrl($message));
        exit;
    }

    flash('feedback_error', __('register_error'));
    redirect('feedback');
}
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('feedback_title')) ?></h1>
        <p><?= e(__('feedback_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <?php if ($testimonials): ?>
        <div class="testimonial-grid fade-in" style="margin-bottom:3rem;">
            <?php foreach ($testimonials as $t): ?>
            <div class="testimonial-card">
                <div class="stars"><?= str_repeat('★', (int)$t['rating']) ?></div>
                <p class="testimonial-text"><?= e(testimonialContent($t)) ?></p>
                <div class="testimonial-author">
                    <strong><?= e($t['parent_name']) ?></strong>
                    <?php if ($t['student_name']): ?>
                    <span> — <?= e($t['student_name']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state fade-in" style="margin-bottom:3rem;"><?= e(__('feedback_no_items')) ?></div>
        <?php endif; ?>

        <div class="form-section fade-in">
            <h2 style="margin-bottom:1.5rem;text-align:center;"><?= e(__('feedback_submit_title')) ?></h2>

            <?php if ($success): ?>
            <div class="alert alert-success"><?= e($success) ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
            <div class="alert alert-error"><?= e($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= url('feedback') ?>"<?= (defined('STATIC_BUILD') && STATIC_BUILD) ? ' data-mpda-form="feedback"' : '' ?>>
                <?php if (!defined('STATIC_BUILD') || !STATIC_BUILD): ?><?= csrfField() ?><?php endif; ?>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="parent_name"><?= e(__('field_parent_name')) ?> *</label>
                        <input type="text" id="parent_name" name="parent_name" required maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="student_name"><?= e(__('field_student_name')) ?></label>
                        <input type="text" id="student_name" name="student_name" maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="rating"><?= e(__('field_rating')) ?></label>
                        <select id="rating" name="rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                            <option value="<?= $i ?>"><?= str_repeat('★', $i) ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="content"><?= e(__('field_message')) ?> *</label>
                        <textarea id="content" name="content" required minlength="10"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:1.5rem;width:100%;"><?= e(__('feedback_submit')) ?></button>
            </form>
        </div>
    </div>
</section>
