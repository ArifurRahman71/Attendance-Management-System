<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h2>Student Directory</h2>
        <p>Search and browse enrolled students</p>
    </div>
    <?php if (current_user()['role'] === 'admin'): ?>
        <a href="<?= BASE_URL ?>/admin/add_student.php" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i> Register Student</a>
    <?php endif; ?>
</div>

<div class="content-card mb-4">
    <div class="card-body-custom">
        <form method="get">
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="q" class="form-control" placeholder="Search by name, roll number, class, or username..." value="<?= e($q) ?>">
                <button class="btn btn-primary px-4">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="content-card">
    <div class="card-header-custom">
        <h5><?= $q !== '' ? 'Search Results' : 'All Students' ?></h5>
        <span class="text-muted small"><?= $q !== '' ? count($results) : count($allStudents ?? $results) ?> found</span>
    </div>
    <div class="table-responsive">
        <table class="table table-modern">
            <thead><tr><th>Roll No</th><th>Full Name</th><th>Username</th><th>Class</th><th>Email</th></tr></thead>
            <tbody>
            <?php
                $display = $q !== '' ? $results : ($allStudents ?? []);
                foreach ($display as $row):
                    $email = $row['email'] ?? '—';
            ?>
                <tr>
                    <td class="fw-semibold"><?= e($row['roll_no']) ?></td>
                    <td><?= e($row['full_name']) ?></td>
                    <td class="text-muted"><?= e($row['username']) ?></td>
                    <td><span class="badge bg-light text-dark"><?= e($row['class_name']) ?></span></td>
                    <td class="text-muted small"><?= e($email) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($display)): ?>
                <tr><td colspan="5" class="text-muted text-center py-4">No students found</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
