<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('admin');

$pdo = db();
$pageTitle = 'Announcements';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $title = trim($_POST['title'] ?? '');
    $body = $_POST['body'] ?? '';
    $target = $_POST['target_role'] ?? 'all';

    if ($title !== '' && $body !== '') {
        Announcement::create($pdo, $title, $body, current_user()['id'], $target);
        log_activity($pdo, current_user()['id'], 'post_announcement', $title);
        set_flash('success', 'Announcement published.');
        redirect(BASE_URL . '/admin/announcements.php');
    }
}

$announcements = Announcement::getAll($pdo);

view('admin/announcements', compact('announcements'), 'dashboard');
