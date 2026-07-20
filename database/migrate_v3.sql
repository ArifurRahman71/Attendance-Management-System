-- /opt/lampp/bin/mysql -u root Attendance_system_db < database/migrate_v3.sql

USE Attendance_system_db;

CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(20) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE
);

INSERT IGNORE INTO courses (class_id, name, code) VALUES
(1, 'Mathematics', 'MATH10'),
(1, 'English', 'ENG10'),
(1, 'Physics', 'PHY10'),
(1, 'Bangla', 'BAN10'),
(2, 'Mathematics', 'MATH9'),
(2, 'English', 'ENG9'),
(2, 'Science', 'SCI9');

INSERT IGNORE INTO students (user_id, roll_no, class_name)
SELECT u.id, 'STU002', 'Class 10-A' FROM users u WHERE u.username = 'student2' LIMIT 0;

-- Extra demo students (only if not exists)
INSERT INTO users (username, password_hash, role, full_name, email)
SELECT 'student2', '$2y$12$SbZC4vCEfy8b19nv/AyJnuYE9Qfh3JSKiogb4mdhSEpZCQdF6Vz4O', 'student', 'Bob Student', 'bob@edutrack.edu'
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'student2');

INSERT INTO students (user_id, roll_no, class_name)
SELECT u.id, 'STU002', 'Class 10-A' FROM users u WHERE u.username = 'student2'
AND NOT EXISTS (SELECT 1 FROM students WHERE roll_no = 'STU002');

INSERT INTO users (username, password_hash, role, full_name, email)
SELECT 'student3', '$2y$12$SbZC4vCEfy8b19nv/AyJnuYE9Qfh3JSKiogb4mdhSEpZCQdF6Vz4O', 'student', 'Charlie Student', 'charlie@edutrack.edu'
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'student3');

INSERT INTO students (user_id, roll_no, class_name)
SELECT u.id, 'STU003', 'Class 9-B' FROM users u WHERE u.username = 'student3'
AND NOT EXISTS (SELECT 1 FROM students WHERE roll_no = 'STU003');
