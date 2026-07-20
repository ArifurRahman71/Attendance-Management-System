<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('admin');

$pdo = db();
$students = Student::getAll($pdo);
$studentCount = count($students);
$classCount = SchoolClass::count($pdo);
$pendingLeave = LeaveRequest::countPending($pdo);
$today = date('Y-m-d');
$stats = attendance_stats($pdo, $today);
$logs = get_recent_activity_logs($pdo, 8);
$pageTitle = 'Dashboard';

view('admin/dashboard', compact('students', 'studentCount', 'classCount', 'pendingLeave', 'stats', 'today', 'logs'), 'dashboard');
