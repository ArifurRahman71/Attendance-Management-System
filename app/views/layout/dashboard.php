<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? APP_NAME) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/custom.css" rel="stylesheet">
</head>
<body class="dashboard-body">
<?php
    $role = current_user()['role'];
    $navItems = nav_items_for_role($role);
    $currentPath = $_SERVER['PHP_SELF'] ?? '';
?>
<div class="dashboard-wrapper">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-mortarboard-fill"></i>
            <span><?= e(APP_NAME) ?></span>
        </div>
        <div class="sidebar-user">
            <div class="avatar"><?= strtoupper(substr(current_user()['full_name'], 0, 1)) ?></div>
            <div>
                <div class="name"><?= e(current_user()['full_name']) ?></div>
                <div class="role"><?= e(ucfirst($role)) ?></div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <?php foreach ($navItems as $item): ?>
                <?php $active = str_contains($currentPath, basename($item['url'])); ?>
                <a href="<?= e($item['url']) ?>" class="sidebar-link<?= $active ? ' active' : '' ?>">
                    <i class="bi <?= e($item['icon']) ?>"></i>
                    <span><?= e($item['label']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
        <div class="sidebar-footer">
            <a href="<?= BASE_URL ?>/logout.php" class="sidebar-link text-danger">
                <i class="bi bi-box-arrow-left"></i><span>Sign Out</span>
            </a>
        </div>
    </aside>
    <div class="dashboard-main">
        <header class="topbar">
            <button class="btn btn-link sidebar-toggle d-lg-none" type="button" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="topbar-title"><?= e($pageTitle ?? page_title_for($role)) ?></div>
            <div class="topbar-actions">
                <span class="text-muted small d-none d-md-inline"><?= date('l, F j, Y') ?></span>
            </div>
        </header>
        <div class="dashboard-content">
            <?php $flash = get_flash(); if ($flash): ?>
                <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
                    <?= e($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php require $templatePath; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
