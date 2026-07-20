<div class="page-header">
    <h2>Take Attendance</h2>
    <p>Select class & course, then mark present with one click</p>
</div>

<div class="content-card mb-4">
    <div class="card-body-custom">
        <form method="get" id="filterForm" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Date</label>
                <input type="date" class="form-control" name="date" value="<?= e($date) ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Class</label>
                <select class="form-select" name="class_id" id="classSelect" required>
                    <option value="">Select class</option>
                    <?php foreach ($classes as $cls): ?>
                        <option value="<?= (int) $cls['id'] ?>" <?= $classId === (int) $cls['id'] ? 'selected' : '' ?>>
                            <?= e(class_label($cls)) ?> <?= $cls['room_no'] ? '(Room ' . e($cls['room_no']) . ')' : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Course</label>
                <select class="form-select" name="course_id" id="courseSelect" required>
                    <option value="">Select course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= (int) $course['id'] ?>" <?= $courseId === (int) $course['id'] ? 'selected' : '' ?>>
                            <?= e($course['name']) ?> <?= $course['code'] ? '(' . e($course['code']) . ')' : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-people me-1"></i> Load Students
                </button>
            </div>
        </form>
    </div>
</div>

<?php if ($ready): ?>
<div class="content-card">
    <div class="card-header-custom">
        <div>
            <h5 class="mb-0"><?= e($classLabel) ?> — <?= e($selectedCourse['name']) ?></h5>
            <small class="text-muted"><?= e($date) ?> &middot; <?= count($students) ?> students</small>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-success" id="presentCount">0 Present</span>
            <span class="badge bg-danger" id="absentCount"><?= count($students) ?> Absent</span>
        </div>
    </div>
    <div class="card-body-custom">
        <?php if (empty($students)): ?>
            <p class="text-muted text-center py-4">No students found in this class.</p>
        <?php else: ?>
            <p class="text-muted small mb-3">
                <i class="bi bi-info-circle"></i> Click the circle button to mark <strong>Present</strong>. Unmarked students will be saved as <strong>Absent</strong>.
            </p>
            <form method="post" id="attendanceForm">
                <input type="hidden" name="attendance_date" value="<?= e($date) ?>">
                <input type="hidden" name="class_id" value="<?= $classId ?>">
                <input type="hidden" name="course_id" value="<?= $courseId ?>">

                <div class="attendance-grid">
                    <?php foreach ($students as $student): ?>
                        <?php
                            $sid = (int) $student['id'];
                            $isPresent = ($existing[$sid] ?? 'absent') === 'present';
                        ?>
                        <div class="attendance-student-row" data-student-id="<?= $sid ?>">
                            <div class="student-info">
                                <div class="student-roll"><?= e($student['roll_no']) ?></div>
                                <div class="student-name"><?= e($student['full_name']) ?></div>
                            </div>
                            <div class="student-status-label <?= $isPresent ? 'text-success' : 'text-danger' ?>">
                                <?= $isPresent ? 'Present' : 'Absent' ?>
                            </div>
                            <button type="button"
                                    class="borat-btn<?= $isPresent ? ' active' : '' ?>"
                                    data-id="<?= $sid ?>"
                                    aria-label="Mark present"
                                    title="Click to mark present">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <input type="checkbox"
                                   class="d-none present-input"
                                   name="present[]"
                                   value="<?= $sid ?>"
                                   <?= $isPresent ? 'checked' : '' ?>>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="markAllPresent">
                        <i class="bi bi-check-all"></i> Mark All Present
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Save Attendance
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const allCourses = <?= json_encode(array_map(fn($c) => [
        'id' => (int) $c['id'],
        'class_id' => (int) $c['class_id'],
        'name' => $c['name'],
        'code' => $c['code'] ?? '',
    ], $allCourses)) ?>;

    const classSelect = document.getElementById('classSelect');
    const courseSelect = document.getElementById('courseSelect');
    const selectedCourse = <?= (int) $courseId ?>;

    function fillCourses(classId) {
        courseSelect.innerHTML = '<option value="">Select course</option>';
        allCourses.filter(c => c.class_id === classId).forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.id;
            opt.textContent = c.name + (c.code ? ' (' + c.code + ')' : '');
            if (c.id === selectedCourse) opt.selected = true;
            courseSelect.appendChild(opt);
        });
    }

    classSelect.addEventListener('change', function () {
        fillCourses(parseInt(this.value) || 0);
    });

    function updateCounts() {
        const total = document.querySelectorAll('.attendance-student-row').length;
        const present = document.querySelectorAll('.borat-btn.active').length;
        document.getElementById('presentCount').textContent = present + ' Present';
        document.getElementById('absentCount').textContent = (total - present) + ' Absent';
    }

    document.querySelectorAll('.borat-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = this.closest('.attendance-student-row');
            const input = row.querySelector('.present-input');
            const label = row.querySelector('.student-status-label');
            const active = this.classList.toggle('active');
            input.checked = active;
            label.textContent = active ? 'Present' : 'Absent';
            label.className = 'student-status-label ' + (active ? 'text-success' : 'text-danger');
            updateCounts();
        });
    });

    document.getElementById('markAllPresent')?.addEventListener('click', function () {
        document.querySelectorAll('.borat-btn').forEach(btn => {
            if (!btn.classList.contains('active')) btn.click();
        });
    });

    updateCounts();
});
</script>
<?php endif; ?>
