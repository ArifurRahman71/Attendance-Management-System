<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

$pdo = db();
$studentCount = (int) $pdo->query('SELECT COUNT(*) FROM students')->fetchColumn();
$classCount = SchoolClass::count($pdo);

view('public/home', compact('studentCount', 'classCount'));
