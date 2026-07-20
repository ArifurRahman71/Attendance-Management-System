<?php

declare(strict_types=1);

class LeaveRequest
{
    public static function create(PDO $pdo, int $studentId, string $reason, string $fromDate, string $toDate): void
    {
        $stmt = $pdo->prepare(
            'INSERT INTO leave_requests (student_id, reason, from_date, to_date) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$studentId, $reason, $fromDate, $toDate]);
    }

    public static function getByStudent(PDO $pdo, int $studentId): array
    {
        $stmt = $pdo->prepare('SELECT * FROM leave_requests WHERE student_id = ? ORDER BY created_at DESC');
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    }

    public static function getPending(PDO $pdo): array
    {
        return $pdo->query(
            'SELECT lr.*, s.roll_no, u.full_name, s.class_name
             FROM leave_requests lr
             JOIN students s ON s.id = lr.student_id
             JOIN users u ON u.id = s.user_id
             WHERE lr.status = \'pending\'
             ORDER BY lr.created_at ASC'
        )->fetchAll();
    }

    public static function updateStatus(PDO $pdo, int $id, string $status, int $reviewedBy): void
    {
        $stmt = $pdo->prepare(
            'UPDATE leave_requests SET status = ?, reviewed_by = ? WHERE id = ?'
        );
        $stmt->execute([$status, $reviewedBy, $id]);
    }

    public static function countPending(PDO $pdo): int
    {
        return (int) $pdo->query("SELECT COUNT(*) FROM leave_requests WHERE status = 'pending'")->fetchColumn();
    }
}
