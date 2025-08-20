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
            <div class="settings_btn" onclick="toggleSettings()">
                <img src="<?= ROOT ?>assets/images/settings_icon.png" alt="settings_btn">
            </div>
            <?php
            switch ($_SESSION['USER']->role) {
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
    <script>
        function toggleSettings() {
            const menu = document.getElementById('settings_menu');
            menu.classList.toggle('active');
        }
    </script>
</body>

</html>