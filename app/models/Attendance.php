<?php

declare(strict_types=1);

class Attendance
{
    public static function mark(PDO $pdo, int $studentId, int $markedBy, string $date, string $status): void
    {
        $stmt = $pdo->prepare(
            'INSERT INTO attendance (student_id, marked_by, attendance_date, status)
             VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE status = VALUES(status), marked_by = VALUES(marked_by)'
        );
        $stmt->execute([$studentId, $markedBy, $date, $status]);
    }

    public static function getByDate(PDO $pdo, string $date): array
    {
        $stmt = $pdo->prepare(
            'SELECT a.*, s.roll_no, s.class_name, u.full_name AS student_name, m.full_name AS marked_by_name
             FROM attendance a
             JOIN students s ON s.id = a.student_id
             JOIN users u ON u.id = s.user_id
             JOIN users m ON m.id = a.marked_by
             WHERE a.attendance_date = ?
             ORDER BY s.class_name, s.roll_no'
        );
        $stmt->execute([$date]);

        return $stmt->fetchAll();
    }

    public static function getByStudent(PDO $pdo, int $studentId): array
    {
        $stmt = $pdo->prepare(
            'SELECT a.*, m.full_name AS marked_by_name
             FROM attendance a
             JOIN users m ON m.id = a.marked_by
             WHERE a.student_id = ?
             ORDER BY a.attendance_date DESC'
        );
        $stmt->execute([$studentId]);

        return $stmt->fetchAll();
    }

    public static function getSummaryByDate(PDO $pdo, string $date): array
    {
        $stmt = $pdo->prepare(
            'SELECT status, COUNT(*) AS total
             FROM attendance
             WHERE attendance_date = ?
             GROUP BY status'
        );
        $stmt->execute([$date]);

        $summary = ['present' => 0, 'absent' => 0, 'late' => 0];
        foreach ($stmt->fetchAll() as $row) {
            $summary[$row['status']] = (int) $row['total'];
        }

        return $summary;
    }
}
