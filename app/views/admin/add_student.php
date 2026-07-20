<div class="page-header">
    <h2>Register Student</h2>
    <p>Create a new student account</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-body-custom">
                <form method="post">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="full_name" class="form-control" required value="<?= e($form['full_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= e($form['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control" required value="<?= e($form['username'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Roll Number</label>
                            <input type="text" name="roll_no" class="form-control" required value="<?= e($form['roll_no'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Class</label>
                            <input type="text" name="class_name" class="form-control" list="classList" required value="<?= e($form['class_name'] ?? '') ?>">
                            <datalist id="classList">
                                <?php foreach ($classes as $c): ?>
                                    <option value="<?= e($c['name'] . ($c['section'] ? '-' . $c['section'] : '')) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Register Student</button>
                        <a href="<?= BASE_URL ?>/admin/dashboard.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
