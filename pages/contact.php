<?php
$pageTitle = __('contact_title');
$metaDescription = __('contact_subtitle');

$success = flash('contact_success');
$error = flash('contact_error');

if (isPost() && verifyCsrf($_POST['csrf_token'] ?? '')) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $db = getDB();
            $stmt = $db->prepare('INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$name, $email, $phone, $subject, $message]);
            flash('contact_success', __('contact_success'));
            redirect('contact');
        } catch (Exception $e) {
            flash('contact_error', __('register_error'));
            redirect('contact');
        }
    } else {
        flash('contact_error', __('register_error'));
        redirect('contact');
    }
}
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('contact_title')) ?></h1>
        <p><?= e(__('contact_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <div class="contact-grid fade-in">
            <div>
                <div class="contact-info-card">
                    <h4><?= e(__('contact_phone_label')) ?></h4>
                    <p><a href="tel:<?= e(CONTACT_PHONE) ?>"><?= e(CONTACT_PHONE) ?></a></p>
                </div>
                <div class="contact-info-card">
                    <h4><?= e(__('contact_whatsapp_label')) ?></h4>
                    <p><a href="https://wa.me/94<?= ltrim(CONTACT_WHATSAPP, '0') ?>" target="_blank" rel="noopener"><?= e(CONTACT_WHATSAPP) ?></a></p>
                </div>
                <div class="contact-info-card">
                    <h4><?= e(__('contact_email_label')) ?></h4>
                    <p><a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a></p>
                </div>
                <div class="contact-info-card">
                    <h4><?= e(__('contact_address_label')) ?></h4>
                    <p><?= e(CONTACT_ADDRESS) ?></p>
                </div>

                <div class="social-icons" style="margin-top:1.5rem;">
                    <a href="<?= e(SOCIAL_FACEBOOK) ?>" target="_blank" rel="noopener">FB</a>
                    <a href="<?= e(SOCIAL_INSTAGRAM) ?>" target="_blank" rel="noopener">IG</a>
                    <a href="<?= e(SOCIAL_TIKTOK) ?>" target="_blank" rel="noopener">TT</a>
                    <a href="<?= e(SOCIAL_YOUTUBE) ?>" target="_blank" rel="noopener">YT</a>
                </div>

                <div class="map-embed">
                    <iframe
                        src="https://maps.google.com/maps?q=Moratuwa+Sri+Lanka&output=embed"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Map"></iframe>
                </div>
            </div>

            <div>
                <h2 class="contact-form-title"><?= e(__('contact_form_title')) ?></h2>

                <?php if ($success): ?>
                <div class="alert alert-success"><?= e($success) ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                <div class="alert alert-error"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="<?= url('contact') ?>">
                    <?= csrfField() ?>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label for="name"><?= e(__('field_name')) ?> *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label for="email"><?= e(__('field_email')) ?> *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label for="phone"><?= e(__('field_phone')) ?></label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label for="subject"><?= e(__('field_subject')) ?></label>
                        <input type="text" id="subject" name="subject">
                    </div>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label for="message"><?= e(__('field_message')) ?> *</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= e(__('contact_submit')) ?></button>
                </form>
            </div>
        </div>
    </div>
</section>
