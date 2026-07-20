<?php

declare(strict_types=1);

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function require_login(): void
{
    if (!is_logged_in()) {
        redirect(BASE_URL . '/index.php');
    }
}

function require_role(string ...$roles): void
{
    require_login();
    $user = current_user();

    if (!in_array($user['role'], $roles, true)) {
        http_response_code(403);
        exit('Access denied.');
    }
}

function login_user(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'username' => $user['username'],
        'role' => $user['role'],
        'full_name' => $user['full_name'],
    ];
}

function logout_user(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function check_login_rate_limit(): bool
{
    $key = 'login_attempts';
    $window = 300;
    $maxAttempts = 5;

    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = ['count' => 0, 'first_attempt' => time()];
    }

    $data = &$_SESSION[$key];

    if (time() - $data['first_attempt'] > $window) {
        $data = ['count' => 0, 'first_attempt' => time()];
    }

    if ($data['count'] >= $maxAttempts) {
        return false;
    }

    $data['count']++;
    return true;
}

function reset_login_attempts(): void
{
    unset($_SESSION['login_attempts']);
}

function dashboard_url_for_role(string $role): string
{
    return match ($role) {
        'admin' => BASE_URL . '/admin/dashboard.php',
        'teacher' => BASE_URL . '/teacher/dashboard.php',
        'student' => BASE_URL . '/student/dashboard.php',
        default => BASE_URL . '/index.php',
    };
}
