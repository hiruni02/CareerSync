<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
    
    <title>Dashboard</title>
</head>
<body>
    <?php
    include("components/navbar.php");
    switch($_SESSION['role']){
        case 'admin':
            ?>
            <!--admin dashboard elements go here-->
            <h1>This is the admin dashboard</h1>
            <?php
        break;
        case 'candidate':
            ?>
            <!--candidate dashboard elements go here-->
            <h1>This is the candidate dashboard</h1>
            <?php
        break;
        case 'counselor':
            ?>
            <!--counselor dashboard elements go here-->
            <h1>This is the counselor dashboard</h1>
            <?php
        break;
        case 'validator':
            ?>
            <!--validator dashboard elements go here-->
            <h1>This is the validator dashboard</h1>
            <?php
        break;
        case 'company':
            ?>
            <!--company dashboard elements go here-->
            <h1>This is the company dashboard</h1>
            <?php
        break;
    }
    ?>
     
</body>
</html>