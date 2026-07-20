<div class="page-header">
    <h2>Feedback Board</h2>
    <p>Share your thoughts and read community feedback</p>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header-custom"><h5>Write Feedback</h5></div>
            <div class="card-body-custom">
                <form method="post">
                    <textarea name="comment" class="form-control mb-3" rows="5" placeholder="Share your experience, suggestions, or concerns..." required></textarea>
                    <button class="btn btn-primary w-100">Post Feedback</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header-custom"><h5>Community Feedback</h5></div>
            <div class="card-body-custom">
                <?php if (empty($feedbacks)): ?>
                    <p class="text-muted">No feedback yet. Be the first to share!</p>
                <?php else: ?>
                    <?php foreach ($feedbacks as $fb): ?>
                        <div class="announcement-item">
                            <div class="d-flex justify-content-between ann-meta">
                                <span><i class="bi bi-person-circle"></i> <?= e($fb['full_name'] ?? 'Anonymous') ?></span>
                                <span><?= e($fb['created_at']) ?></span>
                            </div>
                            <div class="mt-2"><?= $fb['comment'] ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
