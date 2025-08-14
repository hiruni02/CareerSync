<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/dash.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="page-wrapper">
        <?php
        include("components/navbar.php");
        ?>
        <div class="page-content">
            <?php
            switch ($_SESSION['role']) {
                case 'admin':
                    include("dashboards/adminDash.php");
                    break;
                case 'candidate':
                    include("dashboards/candidateDash.php");
                    break;
                case 'counselor':
                    include("dashboards/counselorDash.php");
                    break;
                case 'validator':
                    include("dashboards/validatorDash.php");
                    break;
                case 'company':
                    include("dashboards/companyDash.php");
                    break;
            }
            ?>
        </div>
    </div>
</body>

</html>