<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="card-body-custom p-5">
                    <h1 class="fw-bold mb-2">Contact Us</h1>
                    <p class="text-muted mb-4">Have questions? We'd love to hear from you.</p>

                    <?php if ($name !== ''): ?>
                        <div class="alert alert-success">
                            Thank you, <?= $name ?>! Your message has been received. We'll respond within 24 hours.
                        </div>
                    <?php endif; ?>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4 text-center">
                            <i class="bi bi-envelope fs-3 text-primary"></i>
                            <p class="mt-2 mb-0 small text-muted">support@edutrack.edu</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-telephone fs-3 text-primary"></i>
                            <p class="mt-2 mb-0 small text-muted">+880 1700-000000</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-geo-alt fs-3 text-primary"></i>
                            <p class="mt-2 mb-0 small text-muted">Dhaka, Bangladesh</p>
                        </div>
                    </div>

                    <form method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea name="message" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mt-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
