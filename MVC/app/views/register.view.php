<?php
$role = $_GET['role'];
?>
<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/common.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/forms.css">
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
        <?php
        include("navbar.php");
        ?>
        <div class='page-content'>
            <div class="container">
                <?php
                switch($role){
                    case 'admin':
                        //html for admin registration form
                        ?>
                        <h1>Register as an Admin</h1>
                        <form method="POST">
                            <input 
                                type="text" 
                                placeholder="First Name" 
                                name="firstName" 
                                required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="Last Name" 
                                name="lastName" 
                                required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

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
                                required>
                            
                            <input 
                                type="password" 
                                placeholder="Confirm Password" 
                                name="confirm_password" 
                                required
                                style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">
                                <?php if (!empty($errors['confirm_password'])): ?>
                                    <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                <?php endif; ?>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'candidate':
                        //html for candidate registration form
                        ?>
                        <h1>Register as a Candidate</h1>
                        <form method="POST">
                            <input 
                                type="text" 
                                placeholder="First Name" 
                                name="firstName" 
                                required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="Last Name" 
                                name="lastName" 
                                required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

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
                                required>
                            
                            <input 
                                type="password" 
                                placeholder="Confirm Password" 
                                name="confirm_password" 
                                required
                                style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">
                                <?php if (!empty($errors['confirm_password'])): ?>
                                    <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                <?php endif; ?>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'validator':
                        //html for validation team member registration form
                        ?>
                        <h1>Register as a Validation team member</h1>
                        <form method="POST">
                            <input 
                                type="text" 
                                placeholder="First Name" 
                                name="firstName" 
                                required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="Last Name" 
                                name="lastName" 
                                required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

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
                                required>
                            
                            <input 
                                type="password" 
                                placeholder="Confirm Password" 
                                name="confirm_password" 
                                required
                                style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">
                                <?php if (!empty($errors['confirm_password'])): ?>
                                    <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                <?php endif; ?>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'company':
                        //html for admin company registration form
                        ?>
                        <h1>Register as a Company</h1>
                        <form method="POST">
                            <input 
                                type="text" 
                                placeholder="First Name" 
                                name="firstName" 
                                required
                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="Last Name" 
                                name="lastName" 
                                required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

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
                                required>

                            <input 
                                type="password" 
                                placeholder="Confirm Password" 
                                name="confirm_password" 
                                required
                                style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">
                                <?php if (!empty($errors['confirm_password'])): ?>
                                    <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                <?php endif; ?>

                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'counselor':
                        //html for admin career-counselor registration form
                        ?>
                        <?php
    // Assume $errors is already defined as an array and being filled in your backend controller
?>
                        <h1>Register as a Career Counselor</h1>

                        <form method="POST" enctype="multipart/form-data">

                            <input 
                                type="text" 
                                placeholder="First Name" 
                                name="first_name" 
                                required
                                value="<?= isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="Last Name" 
                                name="last_name" 
                                required
                                value="<?= isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>">

                            <input 
                                type="email" 
                                placeholder="Email" 
                                name="email" 
                                required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                                style="<?= !empty($errors['email']) ? 'border: 2px solid red;' : '' ?>">

                            <?php if (!empty($errors['email'])): ?>
                                <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                            <?php endif; ?>

                            <input 
                                type="text"
                                placeholder="Phone Number" 
                                name="phone" 
                                required
                                value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="NIC Number" 
                                name="nic" 
                                required
                                value="<?= isset($_POST['nic']) ? htmlspecialchars($_POST['nic']) : '' ?>">

                            <!-- Proof of Identity -->
                            <label for="proof">Upload Proof of National Identity</label>
                            <input 
                                id="proof"
                                type="file" 
                                name="proof" 
                                required 
                                accept=".pdf, .jpg, .jpeg, .png"
                                style="<?= !empty($errors['proof']) ? 'border: 2px solid red;' : '' ?>">

                            <?php if (!empty($errors['proof'])): ?>
                                <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['proof'] ?></div>
                            <?php endif; ?>

                            <!-- Certificate -->
                            <label for="certificate">Upload your Certificate</label>
                            <input 
                                id="certificate"
                                type="file" 
                                name="certificate" 
                                required 
                                accept=".pdf, .jpg, .jpeg, .png"
                                style="<?= !empty($errors['certificate']) ? 'border: 2px solid red;' : '' ?>">

                            <?php if (!empty($errors['certificate'])): ?>
                                <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['certificate'] ?></div>
                            <?php endif; ?>

                            <input 
                                type="password" 
                                placeholder="Password" 
                                name="password" 
                                required>

                            <input 
                                type="password" 
                                placeholder="Confirm Password" 
                                name="confirm_password" 
                                required
                                style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;' : '' ?>">

                            <?php if (!empty($errors['confirm_password'])): ?>
                                <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                            <?php endif; ?>

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