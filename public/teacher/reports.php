<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('teacher');

$pdo = db();
$date = $_GET['date'] ?? date('Y-m-d');
$classFilter = $_GET['class'] ?? '';
$pageTitle = 'Reports';

$records = Attendance::getByDate($pdo, $date);
$summary = Attendance::getSummaryByDate($pdo, $date);

if ($classFilter !== '') {
    $conn = mysqli_db();
    $sql = "SELECT a.id, a.status, a.attendance_date, s.roll_no, s.class_name, u.full_name AS student_name, m.full_name AS marked_by_name
            FROM attendance a
            JOIN students s ON s.id = a.student_id
            JOIN users u ON u.id = s.user_id
            JOIN users m ON m.id = a.marked_by
            WHERE a.attendance_date = '$date' AND s.class_name LIKE '%$classFilter%'
            ORDER BY s.roll_no";
    $result = $conn->query($sql);
    $records = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
}

view('teacher/reports', compact('date', 'records', 'summary', 'classFilter'), 'dashboard');
