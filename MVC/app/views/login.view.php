<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/styles.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/navbar.css">
        <title>Login</title>
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
                <li><a href="login"><button class="navbtn" disabled>Login</button></a></li>
                <li><a href="welcome"><button class="navbtn">Register</button></a></li>
            </ul>
        </nav>
        <div class='page-content'>
            <div class="container">
                <h1>Login</h1>
                <form method="POST">

                    <input type="email" placeholder="Email" name="email" required
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    <?php if (!empty($errors['email'])): ?>
                        <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                    <?php endif; ?>

                    <input type="password" placeholder="Password" name="password" required
                        value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
                    <?php if (!empty($errors['password'])): ?>
                        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['password'] ?></div>
                    <?php endif; ?>

                    <button type="submit">Log In</button>
                </form>
                <div class="links">
                    <a href="welcome">Create Account</a></t>
                    <a href="">Forgot password?</a>
            </div>
        </div>
        </div>
    </body>
</html>