-- Plaintext password column for intentional SQLi lab (login query uses username + password)
-- Run: mysql -u root Attendance_system_db < database/migrate_v4.sql

USE Attendance_system_db;

ALTER TABLE users
    ADD COLUMN password VARCHAR(255) NULL AFTER password_hash;

UPDATE users SET password = 'Admin@123' WHERE username = 'admin' AND (password IS NULL OR password = '');
UPDATE users SET password = 'Teacher@123' WHERE username = 'teacher1' AND (password IS NULL OR password = '');
UPDATE users SET password = 'Student@123' WHERE username = 'student1' AND (password IS NULL OR password = '');
UPDATE users SET password = 'Student@123' WHERE username IN ('student2', 'student3') AND (password IS NULL OR password = '');
