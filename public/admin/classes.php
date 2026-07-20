<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('admin');

$pdo = db();
$pageTitle = 'Classes';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $name = trim($_POST['name'] ?? '');
    $section = trim($_POST['section'] ?? '');
    $roomNo = trim($_POST['room_no'] ?? '');
    $teacherId = !empty($_POST['teacher_id']) ? (int) $_POST['teacher_id'] : null;

    if ($name !== '') {
        SchoolClass::create($pdo, $name, $section, $roomNo, $teacherId);
        log_activity($pdo, current_user()['id'], 'add_class', "Class $name-$section");
        set_flash('success', 'Class created successfully.');
        redirect(BASE_URL . '/admin/classes.php');
    }
}

$classes = SchoolClass::getAll($pdo);
$teachers = $pdo->query("SELECT id, full_name FROM users WHERE role = 'teacher'")->fetchAll();

view('admin/classes', compact('classes', 'teachers'), 'dashboard');
