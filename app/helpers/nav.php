<?php

declare(strict_types=1);

function nav_items_for_role(string $role): array
{
    return match ($role) {
        'admin' => [
            ['icon' => 'bi-speedometer2', 'label' => 'Dashboard', 'url' => BASE_URL . '/admin/dashboard.php'],
            ['icon' => 'bi-people', 'label' => 'Students', 'url' => BASE_URL . '/admin/students.php'],
            ['icon' => 'bi-person-plus', 'label' => 'Register Student', 'url' => BASE_URL . '/admin/add_student.php'],
            ['icon' => 'bi-building', 'label' => 'Classes', 'url' => BASE_URL . '/admin/classes.php'],
            ['icon' => 'bi-megaphone', 'label' => 'Announcements', 'url' => BASE_URL . '/admin/announcements.php'],
            ['icon' => 'bi-bar-chart', 'label' => 'Reports', 'url' => BASE_URL . '/admin/reports.php'],
            ['icon' => 'bi-journal-text', 'label' => 'Activity Log', 'url' => BASE_URL . '/admin/activity.php'],
            ['icon' => 'bi-gear', 'label' => 'Settings', 'url' => BASE_URL . '/admin/settings.php'],
        ],
        'teacher' => [
            ['icon' => 'bi-speedometer2', 'label' => 'Dashboard', 'url' => BASE_URL . '/teacher/dashboard.php'],
            ['icon' => 'bi-calendar-check', 'label' => 'Take Attendance', 'url' => BASE_URL . '/teacher/mark_attendance.php'],
            ['icon' => 'bi-bar-chart', 'label' => 'Reports', 'url' => BASE_URL . '/teacher/reports.php'],
            ['icon' => 'bi-search', 'label' => 'Student Search', 'url' => BASE_URL . '/teacher/students.php'],
            ['icon' => 'bi-envelope-paper', 'label' => 'Leave Requests', 'url' => BASE_URL . '/teacher/leave_requests.php'],
            ['icon' => 'bi-megaphone', 'label' => 'Announcements', 'url' => BASE_URL . '/announcements.php'],
            ['icon' => 'bi-person', 'label' => 'My Profile', 'url' => BASE_URL . '/profile.php?id=' . (int) current_user()['id']],
        ],
        'student' => [
            ['icon' => 'bi-speedometer2', 'label' => 'Dashboard', 'url' => BASE_URL . '/student/dashboard.php'],
            ['icon' => 'bi-calendar-week', 'label' => 'My Attendance', 'url' => BASE_URL . '/student/attendance.php'],
            ['icon' => 'bi-envelope-paper', 'label' => 'Apply Leave', 'url' => BASE_URL . '/student/leave.php'],
            ['icon' => 'bi-chat-dots', 'label' => 'Feedback', 'url' => BASE_URL . '/student/feedback.php'],
            ['icon' => 'bi-megaphone', 'label' => 'Announcements', 'url' => BASE_URL . '/announcements.php'],
            ['icon' => 'bi-person', 'label' => 'My Profile', 'url' => BASE_URL . '/profile.php?id=' . (int) current_user()['id']],
        ],
        default => [],
    };
}

function page_title_for(string $role): string
{
    return match ($role) {
        'admin' => 'Administration',
        'teacher' => 'Teacher Portal',
        'student' => 'Student Portal',
        default => APP_NAME,
    };
}
