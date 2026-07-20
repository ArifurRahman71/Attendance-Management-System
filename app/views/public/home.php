<section class="hero">
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1>Manage Attendance<br>Smarter & Faster</h1>
                <p>A complete platform for schools to track student presence, manage classes, handle leave requests, and generate insightful reports — all in one place.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="<?= BASE_URL ?>/index.php" class="btn btn-light btn-lg px-4 fw-semibold">Get Started</a>
                    <a href="<?= BASE_URL ?>/about.php" class="btn btn-outline-light btn-lg px-4">Learn More</a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat"><div class="num"><?= $studentCount ?>+</div><div class="lbl">Students</div></div>
                    <div class="hero-stat"><div class="num"><?= $classCount ?>+</div><div class="lbl">Classes</div></div>
                    <div class="hero-stat"><div class="num">99%</div><div class="lbl">Uptime</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Everything You Need</h2>
            <p class="text-muted">Powerful features designed for modern educational institutions</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon purple"><i class="bi bi-calendar-check"></i></div>
                    <h5 class="fw-bold">Daily Attendance</h5>
                    <p class="text-muted mb-0">Mark present, absent, or late status for entire classes in seconds with an intuitive interface.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon blue"><i class="bi bi-bar-chart-line"></i></div>
                    <h5 class="fw-bold">Analytics & Reports</h5>
                    <p class="text-muted mb-0">Generate date-wise attendance reports with detailed breakdowns and export capabilities.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon green"><i class="bi bi-building"></i></div>
                    <h5 class="fw-bold">Class Management</h5>
                    <p class="text-muted mb-0">Organize students into classes and sections with assigned teachers and room numbers.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon orange"><i class="bi bi-envelope-paper"></i></div>
                    <h5 class="fw-bold">Leave Management</h5>
                    <p class="text-muted mb-0">Students can apply for leave and teachers can review and approve requests seamlessly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon cyan"><i class="bi bi-megaphone"></i></div>
                    <h5 class="fw-bold">Announcements</h5>
                    <p class="text-muted mb-0">Broadcast important notices to students, teachers, or the entire institution.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon rose"><i class="bi bi-chat-dots"></i></div>
                    <h5 class="fw-bold">Feedback System</h5>
                    <p class="text-muted mb-0">Collect student feedback to continuously improve the learning experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-4 text-center">
        <h2 class="fw-bold mb-3">Ready to streamline your institution?</h2>
        <p class="text-muted mb-4">Join hundreds of schools already using <?= e(APP_NAME) ?></p>
        <a href="<?= BASE_URL ?>/index.php" class="btn btn-primary btn-lg px-5">Sign In to Portal</a>
    </div>
</section>
