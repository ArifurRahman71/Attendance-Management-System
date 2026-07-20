<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('student');

$pdo = db();
$student = Student::findByUserId($pdo, current_user()['id']);
$records = $student ? Attendance::getByStudent($pdo, (int) $student['id']) : [];
$rate = $student ? student_attendance_rate($pdo, (int) $student['id']) : 0;
$leaves = $student ? LeaveRequest::getByStudent($pdo, (int) $student['id']) : [];
$announcements = array_slice(Announcement::getAll($pdo, 'student'), 0, 3);
$pageTitle = 'Dashboard';

view('student/dashboard', compact('student', 'records', 'rate', 'leaves', 'announcements'), 'dashboard');
