<?php

declare(strict_types=1);

class SchoolClass
{
    public static function getAll(PDO $pdo): array
    {
        return $pdo->query(
            'SELECT c.*, u.full_name AS teacher_name
             FROM classes c
             LEFT JOIN users u ON u.id = c.teacher_id
             ORDER BY c.name, c.section'
        )->fetchAll();
    }

    public static function create(PDO $pdo, string $name, string $section, string $roomNo, ?int $teacherId): void
    {
        $stmt = $pdo->prepare(
            'INSERT INTO classes (name, section, room_no, teacher_id) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$name, $section, $roomNo, $teacherId]);
    }

    public static function count(PDO $pdo): int
    {
        return (int) $pdo->query('SELECT COUNT(*) FROM classes')->fetchColumn();
    }
}
