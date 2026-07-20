<div class="auth-card">
    <h2 class="mb-1">Welcome back</h2>
    <p class="text-muted mb-4">Sign in to continue to your portal</p>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger py-2"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label fw-semibold" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required
                   value="<?= e($username ?? '') ?>" placeholder="Enter username">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required
                   placeholder="Enter password">
            <div class="text-end mt-2">
                <a href="<?= BASE_URL ?>/forgot_password.php" class="small text-decoration-none">Forgot password?</a>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2 mt-1">Sign In</button>
    </form>

    <p class="text-center mt-4 mb-0">
        <a href="<?= BASE_URL ?>/home.php" class="text-muted small text-decoration-none">&larr; Back to homepage</a>
    </p>
</div>
