# EduTrack Attendance

A full-featured PHP + MySQL attendance management platform for educational institutions.

## Setup (XAMPP)

1. Edit `config/.env` with your database credentials
2. Import: `/opt/lampp/bin/mysql -u root < database/schema.sql`
3. Migrate (if upgrading): `/opt/lampp/bin/mysql -u root Attendance_system_db < database/migrate_v2.sql`
4. Symlink: `ln -sfn "/path/to/project" /opt/lampp/htdocs/attendance_system`
5. Open: **http://localhost/attendance_system/public/home.php**

## Default Accounts

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | Admin@123 |
| Teacher | teacher1 | Teacher@123 |
| Student | student1 | Student@123 |

## Features

- Public landing page, about, contact, announcements
- Admin: dashboard, student registration, class management, reports, activity log, settings
- Teacher: attendance marking, reports, student search, leave request review
- Student: attendance tracking, leave application, feedback board, profile
- Role-based sidebar navigation with modern UI

> For local / isolated use only.
