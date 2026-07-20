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
<body class="public-body">
<nav class="navbar navbar-expand-lg public-navbar fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>/home.php">
            <i class="bi bi-mortarboard-fill"></i> <?= e(APP_NAME) ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pubNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="pubNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/announcements.php">Announcements</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/user.php?id=1">Directory</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/contact.php">Contact</a></li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-primary btn-sm px-4" href="<?= BASE_URL ?>/index.php">Sign In</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="public-main">
<?php $flash = get_flash(); if ($flash): ?>
    <div class="container pt-3">
        <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show">
            <?= e($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>
