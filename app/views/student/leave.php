<div class="page-header">
    <h2>Leave Application</h2>
    <p>Submit and track your leave requests</p>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="content-card">
            <div class="card-header-custom"><h5>New Request</h5></div>
            <div class="card-body-custom">
                <form method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">From Date</label>
                        <input type="date" name="from_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">To Date</label>
                        <input type="date" name="to_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reason</label>
                        <textarea name="reason" class="form-control" rows="4" required placeholder="Describe your reason for leave..."></textarea>
                    </div>
                    <button class="btn btn-primary w-100">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="content-card">
            <div class="card-header-custom"><h5>My Leave History</h5></div>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead><tr><th>From</th><th>To</th><th>Reason</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php foreach ($leaves as $lv): ?>
                        <tr>
                            <td><?= e($lv['from_date']) ?></td>
                            <td><?= e($lv['to_date']) ?></td>
                            <td class="small"><?= e($lv['reason']) ?></td>
                            <td><span class="badge-status badge-<?= e($lv['status']) ?>"><?= e(ucfirst($lv['status'])) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($leaves)): ?>
                        <tr><td colspan="4" class="text-muted text-center py-3">No leave requests yet</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
