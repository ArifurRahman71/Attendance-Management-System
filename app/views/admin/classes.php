<div class="page-header">
    <h2>Class Management</h2>
    <p>Organize classes, sections, and assigned teachers</p>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header-custom"><h5>Add New Class</h5></div>
            <div class="card-body-custom">
                <form method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Class Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Class 10" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Section</label>
                        <input type="text" name="section" class="form-control" placeholder="e.g. A">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Room Number</label>
                        <input type="text" name="room_no" class="form-control" placeholder="e.g. 201">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Assigned Teacher</label>
                        <select name="teacher_id" class="form-select">
                            <option value="">— Select —</option>
                            <?php foreach ($teachers as $t): ?>
                                <option value="<?= (int) $t['id'] ?>"><?= e($t['full_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100">Create Class</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header-custom"><h5>All Classes</h5></div>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead><tr><th>Class</th><th>Section</th><th>Room</th><th>Teacher</th></tr></thead>
                    <tbody>
                    <?php foreach ($classes as $c): ?>
                        <tr>
                            <td class="fw-semibold"><?= e($c['name']) ?></td>
                            <td><?= e($c['section']) ?></td>
                            <td><?= e($c['room_no']) ?></td>
                            <td><?= e($c['teacher_name'] ?? 'Unassigned') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($classes)): ?>
                        <tr><td colspan="4" class="text-muted text-center py-3">No classes yet</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
