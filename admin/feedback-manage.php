<?php

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

$db = getDB();

if (isPost()) {
    if (isset($_POST['approve'])) {
        $stmt = $db->prepare('UPDATE testimonials SET is_approved = 1 WHERE id = ?');
        $stmt->execute([(int)$_POST['id']]);
    } elseif (isset($_POST['delete'])) {
        $stmt = $db->prepare('DELETE FROM testimonials WHERE id = ?');
        $stmt->execute([(int)$_POST['id']]);
    }
    header('Location: feedback-manage.php');
    exit;
}

$pending = $db->query('SELECT * FROM testimonials WHERE is_approved = 0 ORDER BY created_at DESC')->fetchAll();
$approved = $db->query('SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC LIMIT 20')->fetchAll();

$pageTitle = 'Manage Feedback';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-card">
    <h2 style="margin-bottom:1rem;">Pending Feedback (<?= count($pending) ?>)</h2>
    <?php if ($pending): ?>
    <?php foreach ($pending as $t): ?>
    <div style="padding:1rem;border:1px solid var(--gray-200);border-radius:8px;margin-bottom:1rem;">
        <p><strong><?= e($t['parent_name']) ?></strong><?= $t['student_name'] ? ' — ' . e($t['student_name']) : '' ?></p>
        <p style="color:var(--gray-600);margin:0.5rem 0;"><?= e($t['content_en']) ?></p>
        <p style="font-size:0.85rem;color:var(--gray-400);"><?= str_repeat('★', (int)$t['rating']) ?> · <?= e(formatDate($t['created_at'])) ?></p>
        <form method="POST" style="display:flex;gap:0.5rem;margin-top:0.75rem;">
            <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
            <button type="submit" name="approve" value="1" class="btn btn-primary" style="padding:0.4rem 1rem;font-size:0.85rem;">Approve</button>
            <button type="submit" name="delete" value="1" class="btn btn-dark" style="padding:0.4rem 1rem;font-size:0.85rem;" onclick="return confirm('Delete this feedback?')">Delete</button>
        </form>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p style="color:var(--gray-600);">No pending feedback.</p>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2 style="margin-bottom:1rem;">Approved Feedback</h2>
    <?php if ($approved): ?>
    <?php foreach ($approved as $t): ?>
    <div style="padding:0.75rem 0;border-bottom:1px solid var(--gray-200);">
        <strong><?= e($t['parent_name']) ?></strong> — <?= e(substr($t['content_en'], 0, 100)) ?>...
        <form method="POST" style="display:inline;margin-left:1rem;">
            <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
            <button type="submit" name="delete" value="1" style="background:none;border:none;color:#c00;cursor:pointer;font-size:0.8rem;" onclick="return confirm('Delete?')">Delete</button>
        </form>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p style="color:var(--gray-600);">No approved feedback yet.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
