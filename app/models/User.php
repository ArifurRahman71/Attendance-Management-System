<?php

declare(strict_types=1);

class User
{
    public static function authenticate(PDO $pdo, string $username, string $password): ?array
    {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return null;
    }

    public static function findById(PDO $pdo, int $id): ?array
    {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public static function usernameExists(PDO $pdo, string $username): bool
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
        $stmt->execute([$username]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public static function create(PDO $pdo, string $username, string $password, string $role, string $fullName): int
    {
        $stmt = $pdo->prepare(
            'INSERT INTO users (username, password_hash, role, full_name) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([
            $username,
            password_hash($password, PASSWORD_BCRYPT),
            $role,
            $fullName,
        ]);

        return (int) $pdo->lastInsertId();
    }
}
