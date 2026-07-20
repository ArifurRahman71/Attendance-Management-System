<?php

declare(strict_types=1);

class Course
{
    public static function getAll(PDO $pdo): array
    {
        return $pdo->query(
            'SELECT c.*, cl.name AS class_name, cl.section AS class_section
             FROM courses c
             JOIN classes cl ON cl.id = c.class_id
             ORDER BY cl.name, c.name'
        )->fetchAll();
    }

    public static function getByClassId(PDO $pdo, int $classId): array
    {
        $stmt = $pdo->prepare('SELECT * FROM courses WHERE class_id = ? ORDER BY name');
        $stmt->execute([$classId]);
        return $stmt->fetchAll();
    }

    public static function find(PDO $pdo, int $id): ?array
    {
        $stmt = $pdo->prepare(
            'SELECT c.*, cl.name AS class_name, cl.section AS class_section
             FROM courses c JOIN classes cl ON cl.id = c.class_id WHERE c.id = ?'
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
