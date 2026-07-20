<div class="page-header">
    <h2>Good <?= date('H') < 12 ? 'morning' : (date('H') < 17 ? 'afternoon' : 'evening') ?>, <?= e(current_user()['full_name']) ?></h2>
    <p>Here's what's happening today — <?= date('l, F j, Y') ?></p>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">My Students</div>
            <div class="stat-value"><?= $studentCount ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Present Today</div>
            <div class="stat-value text-success"><?= (int) $stats['present'] ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Absent Today</div>
            <div class="stat-value text-danger"><?= (int) $stats['absent'] ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Leave Requests</div>
            <div class="stat-value text-warning"><?= $pendingLeave ?></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="content-card">
            <div class="card-header-custom">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body-custom">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <a href="<?= BASE_URL ?>/teacher/mark_attendance.php" class="feature-card d-block text-decoration-none text-dark">
                            <div class="feature-icon purple"><i class="bi bi-calendar-check"></i></div>
                            <h6 class="fw-bold">Take Attendance</h6>
                            <p class="text-muted small mb-0">Mark today's student attendance</p>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= BASE_URL ?>/teacher/reports.php" class="feature-card d-block text-decoration-none text-dark">
                            <div class="feature-icon blue"><i class="bi bi-bar-chart"></i></div>
                            <h6 class="fw-bold">View Reports</h6>
                            <p class="text-muted small mb-0">Date-wise attendance analytics</p>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= BASE_URL ?>/teacher/students.php" class="feature-card d-block text-decoration-none text-dark">
                            <div class="feature-icon green"><i class="bi bi-search"></i></div>
                            <h6 class="fw-bold">Search Students</h6>
                            <p class="text-muted small mb-0">Find students by roll or name</p>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= BASE_URL ?>/teacher/leave_requests.php" class="feature-card d-block text-decoration-none text-dark">
                            <div class="feature-icon orange"><i class="bi bi-envelope-paper"></i></div>
                            <h6 class="fw-bold">Leave Requests</h6>
                            <p class="text-muted small mb-0"><?= $pendingLeave ?> pending review</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="content-card">
            <div class="card-header-custom">
                <h5>Latest Announcements</h5>
                <a href="<?= BASE_URL ?>/announcements.php" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body-custom">
                <?php if (empty($announcements)): ?>
                    <p class="text-muted">No announcements</p>
                <?php else: ?>
                    <?php foreach ($announcements as $ann): ?>
                        <div class="announcement-item">
                            <div class="ann-title"><?= e($ann['title']) ?></div>
                            <div class="ann-meta"><?= e($ann['created_at']) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
