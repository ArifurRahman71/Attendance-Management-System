<div class="page-header">
    <h2>Announcements</h2>
    <p>Publish notices to students and teachers</p>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="content-card">
            <div class="card-header-custom"><h5>Create Announcement</h5></div>
            <div class="card-body-custom">
                <form method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Audience</label>
                        <select name="target_role" class="form-select">
                            <option value="all">Everyone</option>
                            <option value="student">Students Only</option>
                            <option value="teacher">Teachers Only</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message</label>
                        <textarea name="body" class="form-control" rows="5" required></textarea>
                    </div>
                    <button class="btn btn-primary w-100">Publish</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="content-card">
            <div class="card-header-custom"><h5>Published Announcements</h5></div>
            <div class="card-body-custom">
                <?php foreach ($announcements as $ann): ?>
                    <div class="announcement-item">
                        <div class="ann-title"><?= e($ann['title']) ?></div>
                        <div class="ann-meta"><?= e($ann['created_at']) ?> &middot; <?= e(ucfirst($ann['target_role'])) ?></div>
                        <div class="mt-2"><?= $ann['body'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
