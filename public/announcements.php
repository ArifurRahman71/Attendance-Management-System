<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

$pdo = db();
$role = is_logged_in() ? current_user()['role'] : null;
$announcements = Announcement::getAll($pdo, $role === 'admin' ? null : $role);
$highlight = $_GET['highlight'] ?? '';

view('public/announcements', compact('announcements', 'highlight'));
