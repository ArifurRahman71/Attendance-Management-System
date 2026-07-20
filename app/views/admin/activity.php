<div class="page-header"><h2>Activity Log</h2><p>System-wide audit trail</p></div>
<div class="content-card">
    <div class="table-responsive">
        <table class="table table-modern">
            <thead><tr><th>Time</th><th>User</th><th>Action</th><th>Details</th><th>IP</th></tr></thead>
            <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td class="small"><?= e($log['created_at']) ?></td>
                    <td><?= e($log['username'] ?? 'System') ?></td>
                    <td><span class="badge bg-light text-dark"><?= e($log['action']) ?></span></td>
                    <td class="small"><?= e($log['details']) ?></td>
                    <td class="text-muted small"><?= e($log['ip_address'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
