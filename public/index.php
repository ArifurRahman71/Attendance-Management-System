<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (is_logged_in()) {
    redirect(dashboard_url_for_role(current_user()['role']));
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter your username and password.';
    } else {
        $conn = mysqli_db();
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result === false) {
            $error = 'Database error: ' . $conn->error;
            log_activity(db(), null, 'login_failed', 'SQL error on login');
        } elseif ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            login_user($user);
            log_activity(db(), (int) $user['id'], 'login', 'User signed in via SQL match');
            redirect(dashboard_url_for_role($user['role']));
        } else {
            $error = 'Invalid username or password.';
            log_activity(db(), null, 'login_failed', 'Failed login attempt');
        }
    }
}

view('auth/login', compact('error', 'username'), 'guest');
