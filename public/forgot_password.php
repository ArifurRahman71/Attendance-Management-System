<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (is_logged_in()) {
    redirect(dashboard_url_for_role(current_user()['role']));
}

$pageTitle = 'Forgot Password';
$error = '';
$step = 'lookup';
$resetUser = null;
$username = $_GET['user'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'lookup';

    if ($action === 'lookup') {
        $username = $_POST['username'] ?? '';

        if ($username === '') {
            $error = 'Please enter your username or email.';
        } else {
            $conn = mysqli_db();
            $sql = "SELECT id, username, email, full_name FROM users WHERE username = '$username' OR email = '$username' LIMIT 1";
            $result = $conn->query($sql);

            if ($result === false) {
                $error = 'Database error: ' . $conn->error;
            } elseif ($result->num_rows > 0) {
                $resetUser = $result->fetch_assoc();
                $username = $resetUser['username'];
                $step = 'reset';
            } else {
                $error = 'No account found for that username or email.';
            }
        }
    } elseif ($action === 'reset') {
        $username = $_POST['username'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($username === '') {
            $error = 'Invalid reset request.';
        } elseif ($newPassword === '' || $confirmPassword === '') {
            $error = 'Please enter and confirm your new password.';
            $step = 'reset';
        } elseif ($newPassword !== $confirmPassword) {
            $error = 'Passwords do not match.';
            $step = 'reset';
        } elseif (!validate_password($newPassword)) {
            $error = 'Password must be at least 8 characters with uppercase, lowercase, and a number.';
            $step = 'reset';
        } else {
            $pdo = db();
            $stmt = $pdo->prepare('SELECT id, full_name FROM users WHERE username = ? LIMIT 1');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if (!$user) {
                $error = 'Account not found.';
            } else {
                $hash = password_hash($newPassword, PASSWORD_BCRYPT);
                $update = $pdo->prepare('UPDATE users SET password = ?, password_hash = ? WHERE id = ?');
                $update->execute([$newPassword, $hash, (int) $user['id']]);
                log_activity($pdo, null, 'password_reset', "Password reset for {$username}");
                $step = 'done';
                $resetUser = ['username' => $username, 'full_name' => $user['full_name']];
            }
        }

        if ($step === 'reset' && $resetUser === null && $username !== '') {
            $pdo = db();
            $stmt = $pdo->prepare('SELECT username, full_name FROM users WHERE username = ? LIMIT 1');
            $stmt->execute([$username]);
            $resetUser = $stmt->fetch() ?: ['username' => $username, 'full_name' => ''];
        }
    }
}

view('auth/forgot_password', compact('error', 'step', 'resetUser', 'username'), 'guest');
