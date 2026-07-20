</main>
<footer class="public-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5><i class="bi bi-mortarboard-fill"></i> <?= e(APP_NAME) ?></h5>
                <p class="text-muted">Comprehensive attendance management for schools and colleges.</p>
            </div>
            <div class="col-md-4">
                <h6>Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= BASE_URL ?>/home.php">Home</a></li>
                    <li><a href="<?= BASE_URL ?>/announcements.php">Announcements</a></li>
                    <li><a href="<?= BASE_URL ?>/user.php?id=1">Directory</a></li>
                    <li><a href="<?= BASE_URL ?>/contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact</h6>
                <p class="text-muted mb-0"><i class="bi bi-envelope me-1"></i> support@edutrack.edu</p>
                <p class="text-muted"><i class="bi bi-telephone me-1"></i> +880 1700-000000</p>
            </div>
        </div>
        <hr>
        <p class="text-center text-muted small mb-0">&copy; <?= date('Y') ?> <?= e(APP_NAME) ?>. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
