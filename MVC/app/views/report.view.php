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
            <td>Total Users</td>
            <td class="amount"><?= $totalUsers ?? 170 ?></td>
        </tr>
        <tr>
            <td>Active Users</td>
            <td class="amount"><?= $activeUsers ?? 67 ?></td>
        </tr>
        <tr>
            <td>Pending Requests</td>
            <td class="amount"><?= $pendingRequests ?? 22 ?></td>
        </tr>
        <tr>
            <td>System Alerts</td>
            <td class="amount"><?= $alerts ?? 26 ?></td>
        </tr>
        <tr>
            <td>New Feedback Forms</td>
            <td class="amount"><?= $feedback ?? 2 ?></td>
        </tr>
    </table>

    <h2 class="section-title">Notes</h2>
    <p class="notes">
        • System activity increased compared to previous month.<br>
        • Pending requests should be cleared for improved response time.<br>
        • Alert volume includes automated system messages and flagged issues.<br>
        • Feedback submissions remain within expected range.
    </p>

    <p class="footer">
        Report generated on <?= date("Y-m-d H:i") ?>  
    </p>

</body>

<script>
    window.onload = () => window.print();
</script>

</html>
