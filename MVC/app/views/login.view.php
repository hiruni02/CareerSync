<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/forms.css">
        <title>Login</title>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class='page-content'>
            <div class="container">
                <h1>Login</h1>
                <form method="POST">

                    <input 
                        type="email" 
                        placeholder="Email" 
                        name="email" 
                        required
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                        style="<?= !empty($errors['email']) ? 'border: 2px solid red;':'' ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                        <?php endif; ?>

                    <input 
                        type="password" 
                        placeholder="Password" 
                        name="password" 
                        required
                        value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>"
                        style="<?= !empty($errors['password']) ? 'border: 2px solid red;':'' ?>">
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
        <?php
            include("footer.php");
        ?>
    </body>
</html>