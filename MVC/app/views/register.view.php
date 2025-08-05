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
                        <form method="POST" enctype="multipart/form-data">
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
                                type="text"
                                placeholder="Phone Number" 
                                name="phoneNo" 
                                required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <input 
                                type="text"
                                placeholder="NIC Number" 
                                name="nic_no" 
                                required
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

                            <label for="id_proof" >Insert a photo of your National ID Card</label>
                            <input 
                                id="id_proof"
                                type="file"
                                placeholder="Insert a photo of your National ID Card" 
                                name="nic_path" 
                                required
                                accept=".pdf, .jpg, .jpeg, .png"
                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">

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
                        <h1>Register as a Career Colunselor</h1>
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
                }
                ?>
                <div class="links">
                    <a href="login">Sign in instead</a></t>
                </div>
            </div>
        </div>
    </body>
</html>