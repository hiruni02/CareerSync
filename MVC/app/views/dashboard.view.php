<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
    <link rel="stylesheet" href="<?=ROOT?>assets/css/dashboard/dash.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="page-wrapper">
        <?php
        include("components/navbar.php");
        ?>
        <div class="page-content">
            <?php
            switch($_SESSION['role']){
                case 'admin':
                    ?>
                    <!--admin dashboard elements go here-->
                    <link rel="stylesheet" href="<?=ROOT?>assets/css/dashboard/adminDash.css">
                    <h1>This is the admin dashboard</h1>
                    <?php
                break;
                case 'candidate':
                    ?>
                    <!--candidate dashboard elements go here-->
                    <link rel="stylesheet" href="<?=ROOT?>assets/css/dashboard/candidateDash.css">
                    <h1>This is the candidate dashboard</h1>
                    <?php
                break;
                case 'counselor':
                    ?>
                    <!--counselor dashboard elements go here-->
                    <link rel="stylesheet" href="<?=ROOT?>assets/css/dashboard/counselorDash.css">
                    <h1>This is the counselor dashboard</h1>
                    <?php
                break;
                case 'validator':
                    ?>
                    <!--validator dashboard elements go here-->
                    <link rel="stylesheet" href="<?=ROOT?>assets/css/dashboard/validatorDash.css">
                    <h1>This is the validator dashboard</h1>
                    <?php
                break;
                case 'company':
                    ?>
                    <!--company dashboard elements go here-->
                    <link rel="stylesheet" href="<?=ROOT?>assets/css/dashboard/companyDash.css">
                    <h1>This is the validator dashboard</h1>
                    <div class="list_btn_container">
                        <label for="list_btn">Insert job or internship position: </label>
                        <a href="">
                            <button class="list_btn">List Position</button>
                        </a>
                    </div>
                    <?php
                break;
            }
        ?>
        </div>
    </div>
</body>
</html>