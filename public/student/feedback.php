<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('student');

$pdo = db();
$pageTitle = 'Feedback';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'] ?? '';
    if (trim($comment) !== '') {
        $stmt = $pdo->prepare('INSERT INTO feedback (user_id, comment) VALUES (?, ?)');
        $stmt->execute([current_user()['id'], $comment]);
        log_activity($pdo, current_user()['id'], 'submit_feedback', 'Feedback submitted');
        set_flash('success', 'Thank you! Your feedback has been submitted.');
        redirect(BASE_URL . '/student/feedback.php');
    }
}

$feedbacks = $pdo->query(
    'SELECT f.*, u.full_name FROM feedback f LEFT JOIN users u ON u.id = f.user_id ORDER BY f.created_at DESC LIMIT 30'
)->fetchAll();

view('student/feedback', compact('feedbacks'), 'dashboard');
