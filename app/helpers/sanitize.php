<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function validate_password(string $password): bool
{
    return strlen($password) >= 8
        && preg_match('/[A-Z]/', $password)
        && preg_match('/[a-z]/', $password)
        && preg_match('/[0-9]/', $password);
}

function validate_username(string $username): bool
{
    return (bool) preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username);
}

function validate_roll_no(string $rollNo): bool
{
    return (bool) preg_match('/^[A-Za-z0-9-]{2,20}$/', $rollNo);
}
