<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Sign In - ' . APP_NAME) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/custom.css" rel="stylesheet">
</head>
<body class="auth-body">
<div class="auth-wrapper">
    <div class="auth-visual d-none d-lg-flex">
        <div class="auth-visual-content">
            <div class="auth-logo"><i class="bi bi-mortarboard-fill"></i></div>
            <h1><?= e(APP_NAME) ?></h1>
            <p>Smart attendance tracking for modern educational institutions. Manage classes, monitor presence, and generate insightful reports.</p>
            <ul class="auth-features">
                <li><i class="bi bi-check-circle-fill"></i> Real-time attendance</li>
                <li><i class="bi bi-check-circle-fill"></i> Class management</li>
                <li><i class="bi bi-check-circle-fill"></i> Leave & feedback system</li>
                <li><i class="bi bi-check-circle-fill"></i> Detailed analytics</li>
            </ul>
        </div>
    </div>
    <div class="auth-form-panel">
        <?php require $templatePath; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
