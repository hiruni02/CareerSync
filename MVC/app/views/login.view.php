<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/forms.css">
        <title>Login</title>
    </head>
    <body>
        <?php
        include("components/navbar.php");
        ?>
        <div class='page-content'>
            <div class="login-container">
                <h1>Login</h1>
                <form method="POST">
                    <div class="input-field">
                        <input 
                            type="email" 
                            placeholder="Email" 
                            name="email" 
                            required
                            value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                            style="width: 100%">
                    </div>

                    <div class="input-field">
                        <input 
                            type="password" 
                            placeholder="Password" 
                            name="password" 
                            required
                            value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>"
                            style="<?= !empty($errors['password']) ? 'border: 2px solid red;':'' ?> width: 100%">
                    </div>
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
