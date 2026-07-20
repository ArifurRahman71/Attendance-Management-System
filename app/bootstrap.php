<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

require_once __DIR__ . '/helpers/sanitize.php';
require_once __DIR__ . '/helpers/csrf.php';
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/helpers/activity_log.php';
require_once __DIR__ . '/helpers/flash.php';
require_once __DIR__ . '/helpers/nav.php';

require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Student.php';
require_once __DIR__ . '/models/Attendance.php';
require_once __DIR__ . '/models/Announcement.php';
require_once __DIR__ . '/models/SchoolClass.php';
require_once __DIR__ . '/models/LeaveRequest.php';
require_once __DIR__ . '/models/Course.php';

function class_label(array $class): string
{
    $section = trim($class['section'] ?? '');

    return trim($class['name'] . ($section !== '' ? '-' . $section : ''));
}

function view(string $template, array $data = [], string $layout = 'main'): void
{
    extract($data, EXTR_SKIP);
    $templatePath = BASE_PATH . '/app/views/' . $template . '.php';

    if (!file_exists($templatePath)) {
        http_response_code(500);
        exit('View not found: ' . e($template));
    }

    if ($layout === 'guest') {
        require BASE_PATH . '/app/views/layout/guest.php';
        return;
    }

    if ($layout === 'dashboard') {
        require BASE_PATH . '/app/views/layout/dashboard.php';
        return;
    }

    require BASE_PATH . '/app/views/layout/header.php';
    require $templatePath;
    require BASE_PATH . '/app/views/layout/footer.php';
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function attendance_stats(PDO $pdo, string $date): array
{
    return Attendance::getSummaryByDate($pdo, $date);
}

function student_attendance_rate(PDO $pdo, int $studentId): int
{
    $stmt = $pdo->prepare(
        "SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) AS present
         FROM attendance WHERE student_id = ?"
    );
    $stmt->execute([$studentId]);
    $row = $stmt->fetch();

    if (!$row || (int) $row['total'] === 0) {
        return 0;
    }

    return (int) round(((int) $row['present'] / (int) $row['total']) * 100);
}
