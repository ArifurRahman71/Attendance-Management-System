<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (is_logged_in()) {
    log_activity(db(), current_user()['id'], 'logout', 'User logged out');
}

logout_user();
redirect(BASE_URL . '/index.php');
