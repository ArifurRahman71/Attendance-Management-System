<?php if ($student): ?>
<div class="page-header">
    <h2>Welcome, <?= e($student['full_name']) ?></h2>
    <p>Roll <?= e($student['roll_no']) ?> &middot; <?= e($student['class_name']) ?></p>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card text-center">
            <div class="stat-label">Attendance Rate</div>
            <div class="stat-value text-primary"><?= $rate ?>%</div>
            <div class="attendance-bar mt-2"><div class="fill" style="width:<?= $rate ?>%"></div></div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card text-center">
            <div class="stat-label">Total Records</div>
            <div class="stat-value"><?= count($records) ?></div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card text-center">
            <div class="stat-label">Leave Requests</div>
            <div class="stat-value"><?= count($leaves) ?></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="content-card">
            <div class="card-header-custom">
                <h5>Recent Attendance</h5>
                <a href="<?= BASE_URL ?>/student/attendance.php" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead><tr><th>Date</th><th>Status</th><th>Marked By</th></tr></thead>
                    <tbody>
                    <?php foreach (array_slice($records, 0, 7) as $row): ?>
                        <tr>
                            <td><?= e($row['attendance_date']) ?></td>
                            <td><span class="badge-status badge-<?= e($row['status']) ?>"><?= e(ucfirst($row['status'])) ?></span></td>
                            <td class="text-muted"><?= e($row['marked_by_name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="3" class="text-muted text-center py-3">No records yet</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="content-card mb-4">
            <div class="card-header-custom"><h5>Quick Links</h5></div>
            <div class="card-body-custom d-grid gap-2">
                <a href="<?= BASE_URL ?>/student/leave.php" class="btn btn-outline-primary"><i class="bi bi-envelope-paper me-1"></i> Apply for Leave</a>
                <a href="<?= BASE_URL ?>/student/feedback.php" class="btn btn-outline-primary"><i class="bi bi-chat-dots me-1"></i> Submit Feedback</a>
                <a href="<?= BASE_URL ?>/profile.php?id=<?= (int) current_user()['id'] ?>" class="btn btn-outline-secondary"><i class="bi bi-person me-1"></i> My Profile</a>
            </div>
        </div>
        <div class="content-card">
            <div class="card-header-custom"><h5>Announcements</h5></div>
            <div class="card-body-custom">
                <?php foreach ($announcements as $ann): ?>
                    <div class="announcement-item">
                        <div class="ann-title"><?= e($ann['title']) ?></div>
                        <div class="ann-meta"><?= e($ann['created_at']) ?></div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($announcements)): ?>
                    <p class="text-muted mb-0">No announcements</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
