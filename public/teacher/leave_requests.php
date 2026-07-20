<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('teacher');

$pdo = db();
$pageTitle = 'Leave Requests';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['request_id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($id > 0 && in_array($action, ['approved', 'rejected'], true)) {
        LeaveRequest::updateStatus($pdo, $id, $action, current_user()['id']);
        log_activity($pdo, current_user()['id'], 'review_leave', "Leave #$id $action");
        set_flash('success', 'Leave request ' . $action . '.');
        redirect(BASE_URL . '/teacher/leave_requests.php');
    }
}

$requests = LeaveRequest::getPending($pdo);

view('teacher/leave_requests', compact('requests'), 'dashboard');
