<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';
require_login();

// Always keep ?id= in the URL (lab-friendly for SQLMap).
if (!isset($_GET['id']) || $_GET['id'] === '') {
    redirect(BASE_URL . '/profile.php?id=' . (int) current_user()['id']);
}

// Intentional SQLi lab — do NOT cast id to int / use prepared statements.
$id = $_GET['id'];
$msg = $_GET['msg'] ?? '';
$pageTitle = 'My Profile';
$user = null;
$error = '';

$conn = mysqli_db();
$sql = "SELECT id, username, full_name, role, email, phone, created_at FROM users WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($result === false) {
    $error = 'Database error: ' . $conn->error;
} elseif ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}

view('shared/profile', compact('user', 'msg', 'error', 'id'), 'dashboard');
