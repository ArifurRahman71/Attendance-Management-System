<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('admin');

$pdo = db();
$form = [];
$pageTitle = 'Register Student';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $form = [
        'full_name' => trim($_POST['full_name'] ?? ''),
        'username' => trim($_POST['username'] ?? ''),
        'roll_no' => trim($_POST['roll_no'] ?? ''),
        'class_name' => trim($_POST['class_name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
    ];
    $password = $_POST['password'] ?? '';

    if ($form['full_name'] === '' || $form['class_name'] === '') {
        set_flash('danger', 'Full name and class are required.');
    } elseif ($form['username'] === '' || $password === '') {
        set_flash('danger', 'Username and password are required.');
    } elseif (User::usernameExists($pdo, $form['username'])) {
        set_flash('danger', 'Username already exists.');
    } elseif (Student::rollNoExists($pdo, $form['roll_no'])) {
        set_flash('danger', 'Roll number already exists.');
    } else {
        try {
            $pdo->beginTransaction();
            $userId = User::create($pdo, $form['username'], $password, 'student', $form['full_name']);
            if ($form['email']) {
                $pdo->prepare('UPDATE users SET email = ? WHERE id = ?')->execute([$form['email'], $userId]);
            }
            Student::create($pdo, $userId, $form['roll_no'], $form['class_name']);
            $pdo->commit();
            log_activity($pdo, current_user()['id'], 'add_student', 'Added: ' . $form['roll_no']);
            set_flash('success', 'Student registered successfully.');
            redirect(BASE_URL . '/admin/dashboard.php');
        } catch (Throwable $e) {
            $pdo->rollBack();
            set_flash('danger', 'Registration failed.');
        }
    }
}

$classes = SchoolClass::getAll($pdo);

view('admin/add_student', compact('form', 'classes'), 'dashboard');
