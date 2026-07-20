<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('teacher');

$pdo = db();
$studentCount = count(Student::getAll($pdo));
$pendingLeave = LeaveRequest::countPending($pdo);
$today = date('Y-m-d');
$stats = attendance_stats($pdo, $today);
$announcements = array_slice(Announcement::getAll($pdo, 'teacher'), 0, 3);
$pageTitle = 'Dashboard';

view('teacher/dashboard', compact('studentCount', 'pendingLeave', 'stats', 'today', 'announcements'), 'dashboard');
