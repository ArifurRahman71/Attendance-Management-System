<?php

declare(strict_types=1);

class Announcement
{
    public static function getAll(PDO $pdo, ?string $role = null): array
    {
        if ($role === 'student' || $role === 'teacher') {
            $stmt = $pdo->prepare(
                "SELECT a.*, u.full_name AS author_name
                 FROM announcements a
                 JOIN users u ON u.id = a.posted_by
                 WHERE a.target_role IN ('all', ?)
                 ORDER BY a.created_at DESC"
            );
            $stmt->execute([$role]);
            return $stmt->fetchAll();
        }

        return $pdo->query(
            "SELECT a.*, u.full_name AS author_name
             FROM announcements a
             JOIN users u ON u.id = a.posted_by
             ORDER BY a.created_at DESC"
        )->fetchAll();
    }

    public static function create(PDO $pdo, string $title, string $body, int $postedBy, string $targetRole): void
    {
        $stmt = $pdo->prepare(
            'INSERT INTO announcements (title, body, posted_by, target_role) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$title, $body, $postedBy, $targetRole]);
    }
}
