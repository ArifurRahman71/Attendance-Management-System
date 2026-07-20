<div class="page-header">
    <h2>My Attendance</h2>
    <?php if ($student): ?>
        <p><?= e($student['full_name']) ?> &middot; <?= e($student['class_name']) ?> &middot; Overall: <strong><?= $rate ?>%</strong></p>
    <?php endif; ?>
</div>

<div class="content-card mb-4">
    <div class="card-body-custom">
        <div class="attendance-bar" style="height:12px"><div class="fill" style="width:<?= $rate ?>%"></div></div>
        <div class="d-flex justify-content-between mt-2 small text-muted">
            <span>Attendance Rate</span><span class="fw-bold"><?= $rate ?>%</span>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="table-responsive">
        <table class="table table-modern">
            <thead><tr><th>Date</th><th>Status</th><th>Marked By</th><th>Recorded At</th></tr></thead>
            <tbody>
            <?php foreach ($records as $row): ?>
                <tr>
                    <td class="fw-semibold"><?= e($row['attendance_date']) ?></td>
                    <td><span class="badge-status badge-<?= e($row['status']) ?>"><?= e(ucfirst($row['status'])) ?></span></td>
                    <td><?= e($row['marked_by_name']) ?></td>
                    <td class="text-muted small"><?= e($row['created_at'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($records)): ?>
                <tr><td colspan="4" class="text-muted text-center py-4">No attendance records</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
