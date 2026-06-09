<?php

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

$db = getDB();

if (isPost() && verifyCsrf($_POST['csrf_token'] ?? '')) {
    $titleEn = trim($_POST['title_en'] ?? '');
    $titleSi = trim($_POST['title_si'] ?? '');
    $excerptEn = trim($_POST['excerpt_en'] ?? '');
    $excerptSi = trim($_POST['excerpt_si'] ?? '');
    $contentEn = trim($_POST['content_en'] ?? '');
    $contentSi = trim($_POST['content_si'] ?? '');
    $publish = isset($_POST['is_published']) ? 1 : 0;

    if ($titleEn) {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $titleEn));
        $slug = trim($slug, '-') . '-' . time();

        $stmt = $db->prepare('
            INSERT INTO blog_posts (title_en, title_si, slug, excerpt_en, excerpt_si, content_en, content_si, is_published, published_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $titleEn, $titleSi ?: $titleEn, $slug,
            $excerptEn, $excerptSi ?: $excerptEn,
            $contentEn, $contentSi ?: $contentEn,
            $publish, $publish ? date('Y-m-d H:i:s') : null
        ]);
    }
    header('Location: blog-manage.php');
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $db->prepare('DELETE FROM blog_posts WHERE id = ?');
    $stmt->execute([(int)$_GET['delete']]);
    header('Location: blog-manage.php');
    exit;
}

$posts = $db->query('SELECT * FROM blog_posts ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Manage Blog';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-card">
    <h2 style="margin-bottom:1rem;">Add New Post</h2>
    <form method="POST">
        <?= csrfField() ?>
        <div class="form-grid">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" required>
            </div>
            <div class="form-group">
                <label>Title (Sinhala)</label>
                <input type="text" name="title_si">
            </div>
            <div class="form-group full-width">
                <label>Excerpt (English)</label>
                <textarea name="excerpt_en" rows="2"></textarea>
            </div>
            <div class="form-group full-width">
                <label>Excerpt (Sinhala)</label>
                <textarea name="excerpt_si" rows="2"></textarea>
            </div>
            <div class="form-group full-width">
                <label>Content (English)</label>
                <textarea name="content_en" rows="4"></textarea>
            </div>
            <div class="form-group full-width">
                <label>Content (Sinhala)</label>
                <textarea name="content_si" rows="4"></textarea>
            </div>
            <div class="form-group full-width">
                <label style="display:flex;align-items:center;gap:0.5rem;">
                    <input type="checkbox" name="is_published" value="1"> Publish immediately
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:1rem;">Add Post</button>
    </form>
</div>

<div class="admin-card">
    <h2 style="margin-bottom:1rem;">Existing Posts (<?= count($posts) ?>)</h2>
    <?php if ($posts): ?>
    <table class="admin-table">
        <thead>
            <tr><th>Title</th><th>Status</th><th>Date</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= e($post['title_en']) ?></td>
                <td><?= $post['is_published'] ? '<span class="badge badge-approved">Published</span>' : '<span class="badge badge-pending">Draft</span>' ?></td>
                <td><?= e(formatDate($post['created_at'])) ?></td>
                <td><a href="?delete=<?= (int)$post['id'] ?>" style="color:#c00;" onclick="return confirm('Delete this post?')">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="color:var(--gray-600);">No blog posts yet.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
