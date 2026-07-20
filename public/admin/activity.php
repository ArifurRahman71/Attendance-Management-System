<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
require_role('admin');

$logs = get_recent_activity_logs(db(), 50);
$pageTitle = 'Activity Log';

view('admin/activity', compact('logs'), 'dashboard');
