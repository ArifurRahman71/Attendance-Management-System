<div class="page-header">
    <h2>My Profile</h2>
    <p>Your account information<?= isset($id) ? ' (ID: ' . e((string) $id) . ')' : '' ?></p>
</div>

<?php if ($msg !== ''): ?>
    <div class="alert alert-info"><?= $msg ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php elseif ($user === null): ?>
    <div class="alert alert-warning">No user found for this ID.</div>
<?php else: ?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="content-card text-center">
            <div class="card-body-custom py-5">
                <div class="mx-auto mb-3" style="width:80px;height:80px;background:var(--primary);border-radius:20px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;font-weight:800">
                    <?= strtoupper(substr($user['full_name'] ?? 'U', 0, 1)) ?>
                </div>
                <h4 class="fw-bold mb-1"><?= e($user['full_name']) ?></h4>
                <p class="text-muted mb-0"><?= e(ucfirst($user['role'])) ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header-custom"><h5>Account Details</h5></div>
            <div class="card-body-custom">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Username</label>
                        <div class="fw-semibold"><?= e($user['username']) ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Role</label>
                        <div class="fw-semibold"><?= e(ucfirst($user['role'])) ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Email</label>
                        <div class="fw-semibold"><?= e($user['email'] ?? 'Not set') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Phone</label>
                        <div class="fw-semibold"><?= e($user['phone'] ?? 'Not set') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Member Since</label>
                        <div class="fw-semibold"><?= e($user['created_at']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
