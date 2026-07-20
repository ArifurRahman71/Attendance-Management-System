<div class="page-header"><h2>Settings</h2><p>System configuration and preferences</p></div>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="content-card">
            <div class="card-header-custom"><h5>Institution Info</h5></div>
            <div class="card-body-custom">
                <div class="mb-3"><label class="form-label fw-semibold">Institution Name</label><input class="form-control" value="<?= e(APP_NAME) ?>" readonly></div>
                <div class="mb-3"><label class="form-label fw-semibold">Academic Year</label><input class="form-control" value="2025-2026" readonly></div>
                <div class="mb-3"><label class="form-label fw-semibold">Timezone</label><input class="form-control" value="Asia/Dhaka" readonly></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="content-card">
            <div class="card-header-custom"><h5>System Status</h5></div>
            <div class="card-body-custom">
                <div class="d-flex justify-content-between py-2 border-bottom"><span>Database</span><span class="badge bg-success">Connected</span></div>
                <div class="d-flex justify-content-between py-2 border-bottom"><span>Version</span><span class="text-muted">2.0.0</span></div>
                <div class="d-flex justify-content-between py-2"><span>Environment</span><span class="text-muted">Production</span></div>
            </div>
        </div>
    </div>
</div>
