<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/forms.css">
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
                        style="<?= !empty($errors['email']) ? 'border: 2px solid red;' : '' ?> width: 100%">
                </div>
                <?php if (!empty($errors['email'])): ?>
                    <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['email'] ?></div>
                <?php endif; ?>

                <div class="input-field-login">
                    <input
                        id="pass"
                        type="password"
                        placeholder="Password"
                        name="password"
                        required
                        value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>"
                        style="<?= !empty($errors['password']) ? 'border: 2px solid red;' : '' ?> width: 100%">
                    <button onclick="show_password()" class="eye" type="button" id="eye"></button>
                </div>
                <?php if (!empty($errors['password']) && empty($is_locked)): ?>
                    <div id="error-msg" class="error" style="color:red; padding-bottom:15px;">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($is_locked)): ?>
                    <div id="countdown" style="color:red; padding-bottom:15px;"></div>
                <?php endif; ?>


                <button type="submit" <?= !empty($is_locked) ? 'disabled' : '' ?>>
                    Log In
                </button>
            </form>
            <div class="links">
                <a href="welcome">Create Account</a></t>
                <a href="">Forgot password?</a>
            </div>
        </div>
    </div>
</body>
<script>
    function show_password() {
        console.log(document.getElementById("pass").type);
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
            document.getElementById("eye").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
        } else {
            x.type = "password";
            document.getElementById("eye").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";

        }
    }

    <?php if (!empty($is_locked)): ?>
        let lockoutUntil = <?= (int)$lockout_until ?> * 1000;
        let countdownEl = document.getElementById("countdown");

        function updateCountdown() {
            let now = Date.now();
            let remaining = Math.ceil((lockoutUntil - now) / 1000);

            if (remaining <= 0) {
                countdownEl.innerHTML = "You may try logging in again.";
                location.reload();
                return;
            }

            countdownEl.innerHTML = "Too many failed attempts. Try again in " + remaining + " seconds.";
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    <?php endif; ?>
</script>

</html>