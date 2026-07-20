<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

$name = $_GET['name'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    if ($name !== '') {
        redirect(BASE_URL . '/contact.php?name=' . urlencode($name));
    }
}

view('contact', compact('name'));
