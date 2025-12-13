<!DOCTYPE html>
<html>
<head>
    <title>System Report</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/report.css">
</head>

<body>

    <h1 class="title">Monthly System Report</h1>

    <table class="info-table">
        <tr>
            <td><strong>Month:</strong></td>
            <td><?= date("F Y") ?></td>
            <td><strong>Prepared By:</strong></td>
            <td><?= $_SESSION['USER']->email ?? "Admin" ?></td>
        </tr>
    </table>

    <h2 class="section-title">Summary</h2>

    <table class="summary-table">
        <tr>
            <td>Newly registered companies</td>
            <td class="amount"><?= $totalUsers ?? 69 ?></td>
        </tr>
        <tr>
            <td>Newly registered candidates</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>Newly registered counselors</td>
            <td class="amount"><?= $pendingRequests ?? 22 ?></td>
        </tr>
        <tr>
            <td>Total users</td>
            <td class="amount"><?= $alerts ?? 26 ?></td>
        </tr>
        <tr>
            <td>Active users</td>
            <td class="amount"><?= $feedback ?? 2 ?></td>
        </tr>
        <tr>
            <td>No of feedback emails</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>Scheduled company interviews</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>Scheduled counselor meetings</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>total earnings in LKR</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>Scheduled company interviews</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>System alerts</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
    </table>

    <p class="footer">
        Report generated on <?= date("Y-m-d H:i") ?>  
    </p>

</body>

<script>
    window.onload = () => window.print();
</script>

</html>
