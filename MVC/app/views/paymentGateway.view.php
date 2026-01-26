<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/about.css">
    <title>Payment</title>
</head>

<body>
    <?php
    include("components/navbar.php");
    ?>
    <div class='page-content'>
        <h2>Company Subscription</h2>
        <p>Amount: LKR <?= $amount ?></p>
        <p><?= htmlspecialchars($description) ?></p>

        <form method="POST" action="<?= ROOT ?>paymentGateway/process">
            <button type="submit">Confirm Payment</button>
        </form>

    </div>
</body>

</html>