<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

// Intentional SQLi lab endpoint — do NOT cast id to int / use prepared statements.
$id = $_GET['id'] ?? '1';
$users = [];
$error = '';
$pageTitle = 'User Directory';

$conn = mysqli_db();
$sql = "SELECT id, username, full_name, role, email FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result === false) {
    $error = 'Database error: ' . $conn->error;
} else {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

view('public/user', compact('id', 'users', 'error'));
