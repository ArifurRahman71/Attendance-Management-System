<?php

declare(strict_types=1);

class Student
{
    public static function create(PDO $pdo, int $userId, string $rollNo, string $className): int
    {
        $stmt = $pdo->prepare(
            'INSERT INTO students (user_id, roll_no, class_name) VALUES (?, ?, ?)'
        );
        $stmt->execute([$userId, $rollNo, $className]);

        return (int) $pdo->lastInsertId();
    }

    public static function rollNoExists(PDO $pdo, string $rollNo): bool
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM students WHERE roll_no = ?');
        $stmt->execute([$rollNo]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public static function getAll(PDO $pdo): array
    {
        return $pdo->query(
            'SELECT s.*, u.username, u.full_name
             FROM students s
             JOIN users u ON u.id = s.user_id
             ORDER BY s.class_name, s.roll_no'
        )->fetchAll();
    }

    public static function getByClassName(PDO $pdo, string $className): array
    {
        $stmt = $pdo->prepare(
            'SELECT s.*, u.username, u.full_name
             FROM students s
             JOIN users u ON u.id = s.user_id
             WHERE s.class_name = ?
             ORDER BY s.roll_no'
        );
        $stmt->execute([$className]);

        return $stmt->fetchAll();
    }

    public static function findByUserId(PDO $pdo, int $userId): ?array
    {
        $stmt = $pdo->prepare(
            'SELECT s.*, u.username, u.full_name
             FROM students s
             JOIN users u ON u.id = s.user_id
             WHERE s.user_id = ?
             LIMIT 1'
        );
        $stmt->execute([$userId]);
        $student = $stmt->fetch();

        return $student ?: null;
    }
}
