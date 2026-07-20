<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('teacher', 'admin');

$q = $_GET['q'] ?? '';
$results = [];
$pageTitle = 'Student Search';

if ($q !== '') {
    $conn = mysqli_db();
    $sql = "SELECT s.roll_no, s.class_name, u.full_name, u.username, u.email
            FROM students s
            JOIN users u ON u.id = s.user_id
            WHERE s.roll_no LIKE '%$q%' OR u.full_name LIKE '%$q%' OR u.username LIKE '%$q%' OR s.class_name LIKE '%$q%'
            ORDER BY s.class_name, s.roll_no";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
}

$allStudents = Student::getAll(db());

view('shared/student_search', compact('q', 'results', 'allStudents'), 'dashboard');
