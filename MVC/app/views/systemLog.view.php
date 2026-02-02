<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/systemLog.css">
    <title>System Logs</title>
</head>

<body>

<div class="page-content">

    <h1>System Logs</h1>

    <?php if (!empty($syslogs)) : ?>
        <div class="table-wrapper">
            <table class="syslog-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Time</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($syslogs as $log) : ?>
                        <tr class="role-<?= htmlspecialchars($log->role) ?> <?= $log->action === 'ALERT' ? 'alert' : '' ?>">
                            <td><?= $log->log_id ?></td>
                            <td><?= $log->user_id ?? '-' ?></td>
                            <td><?= ucfirst($log->role) ?></td>
                            <td class="action"><?= $log->action ?></td>
                            <td class="desc"><?= $log->description ?? '-' ?></td>
                            <td><?= $log->ip_address ?></td>
                            <td class="agent" title="<?= htmlspecialchars($log->user_agent) ?>">
                                <?= substr($log->user_agent, 0, 30) ?>...
                            </td>
                            <td><?= date('Y-m-d H:i', strtotime($log->created_at)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="empty-state">
            <p>No system logs available.</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
