<div class="page-header">
    <h2>Leave Requests</h2>
    <p>Review and process student leave applications</p>
</div>

<div class="content-card">
    <div class="table-responsive">
        <table class="table table-modern">
            <thead><tr><th>Student</th><th>Roll</th><th>Class</th><th>From</th><th>To</th><th>Reason</th><th>Action</th></tr></thead>
            <tbody>
            <?php if (empty($requests)): ?>
                <tr><td colspan="7" class="text-muted text-center py-4">No pending leave requests</td></tr>
            <?php endif; ?>
            <?php foreach ($requests as $req): ?>
                <tr>
                    <td class="fw-semibold"><?= e($req['full_name']) ?></td>
                    <td><?= e($req['roll_no']) ?></td>
                    <td><?= e($req['class_name']) ?></td>
                    <td><?= e($req['from_date']) ?></td>
                    <td><?= e($req['to_date']) ?></td>
                    <td class="small"><?= e($req['reason']) ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="request_id" value="<?= (int) $req['id'] ?>">
                            <input type="hidden" name="action" value="approved">
                            <button class="btn btn-sm btn-success">Approve</button>
                        </form>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="request_id" value="<?= (int) $req['id'] ?>">
                            <input type="hidden" name="action" value="rejected">
                            <button class="btn btn-sm btn-outline-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
