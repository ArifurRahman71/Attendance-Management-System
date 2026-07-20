<div class="page-header">
    <h2>Dashboard</h2>
    <p>Overview of your institution at a glance</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Students</div>
                    <div class="stat-value"><?= $studentCount ?></div>
                </div>
                <div class="stat-icon" style="background:#ede9fe;color:#7c3aed"><i class="bi bi-people"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Classes</div>
                    <div class="stat-value"><?= $classCount ?></div>
                </div>
                <div class="stat-icon" style="background:#dbeafe;color:#2563eb"><i class="bi bi-building"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Present Today</div>
                    <div class="stat-value"><?= (int) $stats['present'] ?></div>
                </div>
                <div class="stat-icon" style="background:#d1fae5;color:#059669"><i class="bi bi-check-circle"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Pending Leave</div>
                    <div class="stat-value"><?= $pendingLeave ?></div>
                </div>
                <div class="stat-icon" style="background:#ffedd5;color:#ea580c"><i class="bi bi-envelope-paper"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header-custom">
                <h5>Student Roster</h5>
                <a href="<?= BASE_URL ?>/admin/add_student.php" class="btn btn-sm btn-primary">+ Register</a>
            </div>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead><tr><th>Roll</th><th>Name</th><th>Class</th><th>Username</th></tr></thead>
                    <tbody>
                    <?php foreach (array_slice($students, 0, 8) as $s): ?>
                        <tr>
                            <td><?= e($s['roll_no']) ?></td>
                            <td class="fw-semibold"><?= e($s['full_name']) ?></td>
                            <td><?= e($s['class_name']) ?></td>
                            <td class="text-muted"><?= e($s['username']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($students)): ?>
                        <tr><td colspan="4" class="text-muted text-center py-4">No students registered</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="content-card mb-4">
            <div class="card-header-custom"><h5>Today's Attendance</h5></div>
            <div class="card-body-custom">
                <div class="d-flex justify-content-between mb-2"><span>Present</span><strong class="text-success"><?= (int) $stats['present'] ?></strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Absent</span><strong class="text-danger"><?= (int) $stats['absent'] ?></strong></div>
                <div class="d-flex justify-content-between"><span>Late</span><strong class="text-warning"><?= (int) $stats['late'] ?></strong></div>
            </div>
        </div>
        <div class="content-card">
            <div class="card-header-custom"><h5>Recent Activity</h5></div>
            <div class="card-body-custom p-0">
                <?php foreach ($logs as $log): ?>
                    <div class="px-3 py-2 border-bottom" style="font-size:0.85rem">
                        <div class="fw-semibold"><?= e($log['action']) ?></div>
                        <div class="text-muted"><?= e($log['username'] ?? 'System') ?> &middot; <?= e($log['created_at']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
