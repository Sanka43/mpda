<?php

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

$db = getDB();

$stats = [
    'registrations' => $db->query('SELECT COUNT(*) FROM registrations')->fetchColumn(),
    'pending' => $db->query("SELECT COUNT(*) FROM registrations WHERE status = 'pending'")->fetchColumn(),
    'testimonials' => $db->query('SELECT COUNT(*) FROM testimonials WHERE is_approved = 0')->fetchColumn(),
    'messages' => $db->query('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0')->fetchColumn(),
];

$pageTitle = 'Dashboard';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="card-grid" style="margin-bottom:2rem;">
    <div class="admin-card">
        <h3 style="color:var(--gold-dark);font-size:2rem;"><?= (int)$stats['registrations'] ?></h3>
        <p>Total Registrations</p>
    </div>
    <div class="admin-card">
        <h3 style="color:var(--gold-dark);font-size:2rem;"><?= (int)$stats['pending'] ?></h3>
        <p>Pending Registrations</p>
    </div>
    <div class="admin-card">
        <h3 style="color:var(--gold-dark);font-size:2rem;"><?= (int)$stats['testimonials'] ?></h3>
        <p>Pending Feedback</p>
    </div>
    <div class="admin-card">
        <h3 style="color:var(--gold-dark);font-size:2rem;"><?= (int)$stats['messages'] ?></h3>
        <p>Unread Messages</p>
    </div>
</div>

<div class="admin-card">
    <h3 style="margin-bottom:1rem;">Quick Links</h3>
    <div style="display:flex;flex-wrap:wrap;gap:1rem;">
        <a href="registrations.php" class="btn btn-primary">View Registrations</a>
        <a href="feedback-manage.php" class="btn btn-dark">Manage Feedback</a>
        <a href="blog-manage.php" class="btn btn-dark">Manage Blog</a>
        <a href="<?= url('home') ?>" class="btn btn-outline" style="color:var(--black);border-color:var(--black);">View Website</a>
    </div>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
