<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('student');

$pdo = db();
$student = Student::findByUserId($pdo, current_user()['id']);
$pageTitle = 'Apply Leave';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $student) {
    csrf_verify();
    $reason = trim($_POST['reason'] ?? '');
    $fromDate = $_POST['from_date'] ?? '';
    $toDate = $_POST['to_date'] ?? '';

    if ($reason && $fromDate && $toDate) {
        LeaveRequest::create($pdo, (int) $student['id'], $reason, $fromDate, $toDate);
        log_activity($pdo, current_user()['id'], 'apply_leave', "Leave $fromDate to $toDate");
        set_flash('success', 'Leave request submitted successfully.');
        redirect(BASE_URL . '/student/leave.php');
    }
    set_flash('danger', 'Please fill all fields.');
    redirect(BASE_URL . '/student/leave.php');
}

$leaves = $student ? LeaveRequest::getByStudent($pdo, (int) $student['id']) : [];

view('student/leave', compact('leaves'), 'dashboard');
