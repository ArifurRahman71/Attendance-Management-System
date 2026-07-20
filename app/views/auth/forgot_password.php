<div class="auth-card">
    <h2 class="mb-1">Forgot password?</h2>

    <?php if ($step === 'done' && is_array($resetUser)): ?>
        <p class="text-muted mb-4">Your password has been updated successfully.</p>
        <div class="alert alert-success py-3">
            <p class="mb-1 fw-semibold"><?= e($resetUser['full_name']) ?></p>
            <p class="mb-0 small">You can now sign in with username <strong><?= e($resetUser['username']) ?></strong> and your new password.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php" class="btn btn-primary w-100 py-2">Back to Sign In</a>

    <?php elseif ($step === 'reset' && is_array($resetUser)): ?>
        <p class="text-muted mb-4">Set a new password for <strong><?= e($resetUser['full_name']) ?></strong></p>

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger py-2"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="action" value="reset">
            <input type="hidden" name="username" value="<?= e($resetUser['username']) ?>">
            <div class="mb-3">
                <label class="form-label fw-semibold" for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required
                       placeholder="Min 8 chars, upper, lower, number">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required
                       placeholder="Re-enter new password">
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Update Password</button>
        </form>

        <p class="text-center mt-4 mb-0">
            <a href="<?= BASE_URL ?>/index.php" class="text-muted small text-decoration-none">&larr; Back to Sign In</a>
        </p>

    <?php else: ?>
        <p class="text-muted mb-4">Enter your username or email to reset your password</p>

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger py-2"><?= e($error) ?></div>
        <?php endif; ?>

        <?php if ($username !== '' && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
            <div class="alert alert-info py-2">Looking up account for: <?= $username ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="action" value="lookup">
            <div class="mb-3">
                <label class="form-label fw-semibold" for="username">Username or Email</label>
                <input type="text" class="form-control" id="username" name="username" required
                       value="<?= e($username) ?>" placeholder="Enter username or email">
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Continue</button>
        </form>

        <p class="text-center mt-4 mb-0">
            <a href="<?= BASE_URL ?>/index.php" class="text-muted small text-decoration-none">&larr; Back to Sign In</a>
        </p>
    <?php endif; ?>
</div>
