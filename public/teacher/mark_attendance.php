<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('teacher');

$pdo = db();
$date = $_GET['date'] ?? $_POST['attendance_date'] ?? date('Y-m-d');
$classId = (int) ($_GET['class_id'] ?? $_POST['class_id'] ?? 0);
$courseId = (int) ($_GET['course_id'] ?? $_POST['course_id'] ?? 0);

$classes = SchoolClass::getAll($pdo);
$allCourses = Course::getAll($pdo);
$courses = $classId > 0 ? Course::getByClassId($pdo, $classId) : [];

$selectedClass = null;
$classLabel = '';
$selectedCourse = null;
$students = [];
$existing = [];
$ready = false;

if ($classId > 0) {
    foreach ($classes as $cls) {
        if ((int) $cls['id'] === $classId) {
            $selectedClass = $cls;
            $classLabel = class_label($cls);
            break;
        }
    }
}

if ($courseId > 0) {
    $selectedCourse = Course::find($pdo, $courseId);
}

if ($selectedClass && $selectedCourse && $classLabel !== '') {
    $ready = true;
    $students = Student::getByClassName($pdo, $classLabel);

    $records = Attendance::getByDate($pdo, $date);
    foreach ($records as $record) {
        $existing[(int) $record['student_id']] = $record['status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $ready) {
    $date = $_POST['attendance_date'] ?? date('Y-m-d');
    $classId = (int) ($_POST['class_id'] ?? 0);
    $courseId = (int) ($_POST['course_id'] ?? 0);
    $presentIds = array_map('intval', $_POST['present'] ?? []);
    $teacherId = current_user()['id'];

    foreach ($students as $student) {
        $studentId = (int) $student['id'];
        $status = in_array($studentId, $presentIds, true) ? 'present' : 'absent';
        Attendance::mark($pdo, $studentId, $teacherId, $date, $status);
    }

    $courseName = $selectedCourse['name'] ?? '';
    log_activity($pdo, $teacherId, 'mark_attendance', "Class $classLabel, $courseName, $date");
    set_flash('success', 'Attendance saved successfully.');
    redirect(BASE_URL . '/teacher/mark_attendance.php?date=' . urlencode($date) . '&class_id=' . $classId . '&course_id=' . $courseId);
}

$pageTitle = 'Take Attendance';

view('teacher/mark_attendance', compact(
    'date', 'classId', 'courseId', 'classes', 'courses', 'allCourses',
    'selectedClass', 'selectedCourse', 'classLabel', 'students', 'existing', 'ready'
), 'dashboard');
