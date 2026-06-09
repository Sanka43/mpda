<?php

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

$db = getDB();

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="registrations_' . date('Y-m-d') . '.csv"');

    $rows = $db->query('
        SELECT r.*, b.name AS branch_name
        FROM registrations r
        LEFT JOIN branches b ON r.preferred_branch_id = b.id
        ORDER BY r.created_at DESC
    ')->fetchAll();

    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Student', 'Parent', 'Gender', 'Age', 'Phone', 'School', 'Branch', 'Status', 'Date']);

    foreach ($rows as $row) {
        fputcsv($out, [
            $row['id'], $row['student_name'], $row['parent_name'], $row['gender'],
            $row['age'], $row['phone'], $row['school'], $row['branch_name'],
            $row['status'], $row['created_at']
        ]);
    }
    fclose($out);
    exit;
}

if (isPost() && isset($_POST['update_status'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'] ?? 'pending';
    $valid = ['pending', 'reviewed', 'approved', 'rejected'];
    if (in_array($status, $valid, true)) {
        $stmt = $db->prepare('UPDATE registrations SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }
    header('Location: registrations.php');
    exit;
}

$filterBranch = (int)($_GET['branch'] ?? 0);
$sql = 'SELECT r.*, b.name AS branch_name FROM registrations r LEFT JOIN branches b ON r.preferred_branch_id = b.id';
$params = [];

if ($filterBranch) {
    $sql .= ' WHERE r.preferred_branch_id = ?';
    $params[] = $filterBranch;
}

$sql .= ' ORDER BY r.created_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute($params);
$registrations = $stmt->fetchAll();
$branches = getBranches($db);

$pageTitle = 'Registrations';
require __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-card">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;margin-bottom:1.5rem;">
        <h2>Student Registrations (<?= count($registrations) ?>)</h2>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
            <form method="GET" style="display:flex;gap:0.5rem;">
                <select name="branch" onchange="this.form.submit()">
                    <option value="">All Branches</option>
                    <?php foreach ($branches as $b): ?>
                    <option value="<?= (int)$b['id'] ?>" <?= $filterBranch === (int)$b['id'] ? 'selected' : '' ?>><?= e($b['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <a href="?export=csv" class="btn btn-primary">Export CSV</a>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Parent</th>
                    <th>Age</th>
                    <th>Phone</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($registrations): ?>
                <?php foreach ($registrations as $r): ?>
                <tr>
                    <td><?= (int)$r['id'] ?></td>
                    <td><?= e($r['student_name']) ?></td>
                    <td><?= e($r['parent_name']) ?></td>
                    <td><?= (int)$r['age'] ?></td>
                    <td><?= e($r['phone']) ?></td>
                    <td><?= e($r['branch_name'] ?? '—') ?></td>
                    <td><span class="badge badge-<?= $r['status'] === 'approved' ? 'approved' : 'pending' ?>"><?= e($r['status']) ?></span></td>
                    <td><?= e(formatDate($r['created_at'])) ?></td>
                    <td>
                        <form method="POST" style="display:flex;gap:0.25rem;">
                            <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                            <select name="status" style="padding:0.25rem;font-size:0.8rem;">
                                <?php foreach (['pending','reviewed','approved','rejected'] as $s): ?>
                                <option value="<?= $s ?>" <?= $r['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" name="update_status" value="1" class="btn btn-dark" style="padding:0.25rem 0.5rem;font-size:0.75rem;">Save</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="9" style="text-align:center;padding:2rem;">No registrations yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
