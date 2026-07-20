-- Run on existing database: /opt/lampp/bin/mysql -u root Attendance_system_db < database/migrate_v2.sql

USE Attendance_system_db;

CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL,
    section VARCHAR(20) DEFAULT '',
    room_no VARCHAR(20) DEFAULT '',
    teacher_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    body TEXT NOT NULL,
    posted_by INT NOT NULL,
    target_role ENUM('all', 'student', 'teacher') DEFAULT 'all',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (posted_by) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS leave_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    reason TEXT NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    reviewed_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (reviewed_by) REFERENCES users(id) ON DELETE SET NULL
);

ALTER TABLE users
    ADD COLUMN IF NOT EXISTS email VARCHAR(120) NULL AFTER full_name,
    ADD COLUMN IF NOT EXISTS phone VARCHAR(20) NULL AFTER email;

INSERT IGNORE INTO classes (id, name, section, room_no, teacher_id) VALUES
(1, 'Class 10', 'A', '201', 2),
(2, 'Class 9', 'B', '105', 2);

INSERT INTO announcements (title, body, posted_by, target_role) VALUES
('Welcome to New Semester', 'Classes begin Monday. Please check your attendance regularly.', 1, 'all'),
('Parent-Teacher Meeting', 'Scheduled for next Friday at 10:00 AM in the main hall.', 1, 'all');

UPDATE users SET email = 'admin@edutrack.edu', phone = '01700000001' WHERE username = 'admin';
UPDATE users SET email = 'john.teacher@edutrack.edu', phone = '01700000002' WHERE username = 'teacher1';
UPDATE users SET email = 'alice.student@edutrack.edu', phone = '01700000003' WHERE username = 'student1';
