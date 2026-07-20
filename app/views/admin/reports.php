<div class="page-header">
    <h2>Reports</h2>
    <p>Institution-wide attendance analytics</p>
</div>

<div class="content-card mb-4">
    <div class="card-body-custom">
        <form method="get" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Date</label>
                <input type="date" class="form-control" name="date" value="<?= e($date) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Filter by Class</label>
                <input type="text" class="form-control" name="class" value="<?= e($classFilter ?? '') ?>" placeholder="e.g. Class 10-A">
            </div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Generate</button></div>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card text-center"><div class="stat-label">Present</div><div class="stat-value text-success"><?= (int) $summary['present'] ?></div></div></div>
    <div class="col-md-4"><div class="stat-card text-center"><div class="stat-label">Absent</div><div class="stat-value text-danger"><?= (int) $summary['absent'] ?></div></div></div>
    <div class="col-md-4"><div class="stat-card text-center"><div class="stat-label">Late</div><div class="stat-value text-warning"><?= (int) $summary['late'] ?></div></div></div>
</div>

<div class="content-card">
    <div class="card-header-custom"><h5>Records</h5></div>
    <div class="table-responsive">
        <table class="table table-modern">
            <thead><tr><th>Roll</th><th>Student</th><th>Class</th><th>Status</th></tr></thead>
            <tbody>
            <?php foreach ($records as $row): ?>
                <tr>
                    <td><?= e($row['roll_no'] ?? '') ?></td>
                    <td><?= e($row['student_name'] ?? '') ?></td>
                    <td><?= e($row['class_name'] ?? '') ?></td>
                    <td><span class="badge-status badge-<?= e($row['status'] ?? 'present') ?>"><?= e(ucfirst($row['status'] ?? '')) ?></span></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($records)): ?>
                <tr><td colspan="4" class="text-muted text-center py-4">No records</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
