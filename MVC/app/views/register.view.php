<?php
$role = $_GET['role'];
?>
<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/styles.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/navbar.css">
        <title>Register</title>
        <script>
            // Set correct color on load
            window.onload = function () {
            const select = document.getElementById('role');
            select.style.color = select.value === 'placeholder' ? '#888' : '#000';
            };
        </script>
    </head>
    <body>
        <nav class="navbar">
            <div class="navbar-left">
                <div class="name">CareerSync</div>
                <ul class="navbar_links">
                <li><a href="home"><button class="navbtn">Home</button></a></li>
                <li><a href="about"><button class="navbtn">About</button></a></li>
                <li><a href="contact"><button class="navbtn">Contact</button></a></li>
                </ul>
            </div>

            <ul class="navbar_right">
                <li><a href="login"><button class="navbtn">Login</button></a></li>
                <li><a href="welcome"><button class="navbtn">Register</button></a></li>
            </ul>
        </nav>
        <div class='page-content'>
            <div class="container">
                <?php
                switch($role){
                    case 'admin':
                        //html for admin registration form
                        ?>
                        <h1>Register as an Admin</h1>
                        <form method="POST">
                            <input type="text" placeholder="First Name" name="firstName" required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input type="text" placeholder="Last Name" name="lastName" required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <input type="email" placeholder="Email" name="email" required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

                            <?php if (!empty($errors['email'])): ?>
                                <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                            <?php endif; ?>

                            <input type="password" placeholder="Password" name="password" required>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'candidate':
                        //html for candidate registration form
                        ?>
                        <h1>Register as a Candidate</h1>
                        <form method="POST">
                            <input type="text" placeholder="First Name" name="firstName" required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input type="text" placeholder="Last Name" name="lastName" required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <input type="email" placeholder="Email" name="email" required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

                            <?php if (!empty($errors['email'])): ?>
                                <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                            <?php endif; ?>

                            <input type="password" placeholder="Password" name="password" required>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'validator':
                        //html for validation team member registration form
                        ?>
                        <h1>Register as a Vlidation team member</h1>
                        <form method="POST">
                            <input type="text" placeholder="First Name" name="firstName" required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input type="text" placeholder="Last Name" name="lastName" required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <input type="email" placeholder="Email" name="email" required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

                            <?php if (!empty($errors['email'])): ?>
                                <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                            <?php endif; ?>

                            <input type="password" placeholder="Password" name="password" required>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'company':
                        //html for admin company registration form
                        ?>
                        <h1>Register as a Company</h1>
                        <form method="POST">
                            <input type="text" placeholder="First Name" name="firstName" required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input type="text" placeholder="Last Name" name="lastName" required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <input type="email" placeholder="Email" name="email" required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

                            <?php if (!empty($errors['email'])): ?>
                                <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                            <?php endif; ?>

                            <input type="password" placeholder="Password" name="password" required>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'counselor':
                        //html for admin career-counselor registration form
                        ?>
                        <h1>Register as a Career Colunselor</h1>
                        <form method="POST">
                            <input type="text" placeholder="First Name" name="firstName" required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input type="text" placeholder="Last Name" name="lastName" required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <input type="email" placeholder="Email" name="email" required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

                            <?php if (!empty($errors['email'])): ?>
                                <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                            <?php endif; ?>

                            <input type="password" placeholder="Password" name="password" required>

                            <button type="submit">Register</button>
                        </form>
                    <?php
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