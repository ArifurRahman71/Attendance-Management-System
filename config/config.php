<?php

declare(strict_types=1);

require_once __DIR__ . '/env.php';
load_env(__DIR__ . '/.env');

define('DB_HOST', (string) env('DB_HOST', '127.0.0.1'));
define('DB_PORT', (string) env('DB_PORT', '3306'));
define('DB_NAME', (string) env('DB_NAME', 'Attendance_system_db'));
define('DB_USER', (string) env('DB_USER', 'root'));
define('DB_PASS', (string) env('DB_PASS', ''));

define('APP_NAME', (string) env('APP_NAME', 'EduTrack Attendance'));
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', (string) env('BASE_URL', '/attendance_system/public'));

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'use_strict_mode' => true,
    ]);
}
