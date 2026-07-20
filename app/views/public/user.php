<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="card-body-custom p-5">
                    <h1 class="fw-bold mb-2">User Directory</h1>
                    <p class="text-muted mb-4">Looking up profile for ID: <?= e((string) $id) ?></p>

                    <?php if ($error !== ''): ?>
                        <div class="alert alert-danger"><?= e($error) ?></div>
                    <?php elseif (empty($users)): ?>
                        <div class="alert alert-warning">No user found for this ID.</div>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <div class="border rounded-3 p-4 mb-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small mb-0">ID</label>
                                        <div class="fw-semibold"><?= e((string) $user['id']) ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small mb-0">Username</label>
                                        <div class="fw-semibold"><?= e($user['username']) ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small mb-0">Full Name</label>
                                        <div class="fw-semibold"><?= e($user['full_name']) ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small mb-0">Role</label>
                                        <div class="fw-semibold"><?= e(ucfirst((string) $user['role'])) ?></div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-muted small mb-0">Email</label>
                                        <div class="fw-semibold"><?= e($user['email'] ?? 'Not set') ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <p class="text-muted small mb-0 mt-3">
                        Try another profile:
                        <a href="<?= BASE_URL ?>/user.php?id=1">id=1</a> ·
                        <a href="<?= BASE_URL ?>/user.php?id=2">id=2</a> ·
                        <a href="<?= BASE_URL ?>/user.php?id=3">id=3</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
