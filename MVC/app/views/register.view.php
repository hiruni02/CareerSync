<?php
$role = $_GET['role'];
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/forms.css">
    <script src="<?= ROOT ?>assets/JS/toggle_pw_visibility.js"></script>
    <title>Register</title>
    <script>
        // Set correct color on load
        window.onload = function() {
            const select = document.getElementById('role');
            select.style.color = select.value === 'placeholder' ? '#888' : '#000';
        };
    </script>
</head>

<body>
    <?php
    include("components/navbar.php");
    ?>
    <div class='page-content'>
        <div class="container">
            <?php
            switch ($role) {
                case 'candidate':
                    include("registration_forms/candidate.php");
                    break;
                case 'validator':
                    include("registration_forms/validator.php");
                    break;
                case 'company':
                    include("registration_forms/company.php");
                    break;
                case 'counselor':
                    include("registration_forms/counselor.php");
                    break;
            }
            ?>
            <div class="links">
                <a href="login">Sign in instead</a></t>
            </div>
        </div>
    </div>
</body>

</html>