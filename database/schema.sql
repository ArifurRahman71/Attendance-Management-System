-- Attendance Management System - Database Schema
-- Run: mysql -u root -p < database/schema.sql

CREATE DATABASE IF NOT EXISTS Attendance_system_db;
USE Attendance_system_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    password VARCHAR(255) NULL,
    role ENUM('admin', 'teacher', 'student') NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    roll_no VARCHAR(20) NOT NULL UNIQUE,
    class_name VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    marked_by INT NOT NULL,
    attendance_date DATE NOT NULL,
    status ENUM('present', 'absent', 'late') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_daily (student_id, attendance_date),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (marked_by) REFERENCES users(id)
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    details TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Default credentials:
-- admin    / Admin@123
-- teacher1 / Teacher@123
-- student1 / Student@123

INSERT INTO users (username, password_hash, password, role, full_name) VALUES
('admin', '$2y$12$zfyBQ0OJ8yuDF5B0mB7ds.SU4bxIN92LJoX4TL2QETUCCk1JLaMTm', 'Admin@123', 'admin', 'System Admin'),
('teacher1', '$2y$12$pP/2ZJoYvocCdvVTX6YT1uDitUP6.eRJzLzu6p84IxDzjDapEvAky', 'Teacher@123', 'teacher', 'John Teacher');

INSERT INTO users (username, password_hash, password, role, full_name) VALUES
('student1', '$2y$12$SbZC4vCEfy8b19nv/AyJnuYE9Qfh3JSKiogb4mdhSEpZCQdF6Vz4O', 'Student@123', 'student', 'Alice Student');

INSERT INTO students (user_id, roll_no, class_name) VALUES
(3, 'STU001', 'Class 10-A');
