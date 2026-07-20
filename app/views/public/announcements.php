<div class="container py-5">
    <div class="page-header text-center mb-5">
        <h2 class="fw-bold">Announcements</h2>
        <p>Latest news and updates from the institution</p>
    </div>

    <?php if ($highlight !== ''): ?>
        <div class="alert alert-info">Showing results for: <?= $highlight ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="card-body-custom">
                    <?php if (empty($announcements)): ?>
                        <p class="text-muted text-center py-4">No announcements at this time.</p>
                    <?php else: ?>
                        <?php foreach ($announcements as $ann): ?>
                            <div class="announcement-item">
                                <div class="ann-title"><?= e($ann['title']) ?></div>
                                <div class="ann-meta">
                                    <i class="bi bi-person"></i> <?= e($ann['author_name']) ?>
                                    &middot; <?= e($ann['created_at']) ?>
                                    &middot; <span class="badge bg-light text-dark"><?= e(ucfirst($ann['target_role'])) ?></span>
                                </div>
                                <div class="ann-body"><?= $ann['body'] ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
