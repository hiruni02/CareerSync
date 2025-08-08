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
        include("components/navbar.php");
        ?>
        <div class='page-content'>
            <div class="container">
                <?php
                switch($role){
                    case 'candidate':
                        //html for candidate registration form
                        ?>
                        <h1>Register as a Candidate</h1>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-field">
                                <label for="firstName">Enter First Name</label>
                                <input 
                                    type="text" 
                                    placeholder="First Name" 
                                    name="firstName" 
                                    required
                                    value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="lastName">Enter Last Name</label>
                                <input 
                                    type="text"
                                    placeholder="Last Name" 
                                    name="lastName" 
                                    required
                                    value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="email">Enter Email Address</label>
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
                            </div>

                            <div class="input-field">
                                <label for="dob">Enter Date of Birth</label>
                                <input 
                                    type="date"
                                    placeholder="Date of Birth" 
                                    name="dob" 
                                    required
                                    value="<?= isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="address">Enter Residential Address</label>
                                <input 
                                    type="text"
                                    placeholder="Enter your full Address here " 
                                    name="address" 
                                    required
                                    value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>">
                            </div>

                            <div class="input-field">
                            <label for="candidate_photo_path" >Insert a photo of yourself</label>
                                <input 
                                    type="file"
                                    name="candidate_photo_path" 
                                    required
                                    accept=".pdf, .jpg, .jpeg, .png"
                                    style="<?= !empty($errors['candidate_photo_path']) ? 'border: 2px solid red;':'' ?>">

                                    <?php if (!empty($errors['candidate_photo_path'])): ?>
                                        <div style="color:red;" class="error"><?= $errors['candidate_photo_path'] ?></div>
                                    <?php endif; ?>
                            </div>

                            <div class="input-field">
                                <label for="contactNo">Enter Contact Number</label>
                                <input 
                                    type="tel"
                                    placeholder="Contact Number:07xxxxxxxx" 
                                    name="contactNo" 
                                    pattern="[0-9]{10}"
                                    required
                                    value="<?= isset($_POST['contactNo']) ? htmlspecialchars($_POST['contactNo']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="password" >Enter Password</label>
                                <input 
                                    type="password" 
                                    placeholder="Password" 
                                    name="password" 
                                    required>
                            </div>

                            <div class="input-field">
                                <label for="confirm_password" >Re-enter the Pasword</label>
                                <input 
                                    type="password" 
                                    placeholder="Confirm Password" 
                                    name="confirm_password" 
                                    required
                                    style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">

                                    <?php if (!empty($errors['confirm_password'])): ?>
                                        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                    <?php endif; ?>
                            </div>                         
                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'validator':
                        //html for validation team member registration form
                        ?>
                        <h1>Register as a Validation team member</h1>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-field">
                                <label for="firstName">Enter First Name</label>
                                <input 
                                    type="text" 
                                    placeholder="First Name" 
                                    name="firstName" 
                                    required
                                    value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">
                            </div>
                            
                            <div class="input-field">
                                <label for="lastName">Enter Last Name</label>
                                <input 
                                    type="text"
                                    placeholder="Last Name" 
                                    name="lastName" 
                                    required
                                    value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="email">Enter Email Address</label>
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
                            </div>

                            <div class="input-field">
                                <label for="contactNo">Enter Contact Number</label>
                                <input 
                                    type="text"
                                    placeholder="Contact Number:07xxxxxxxx"
                                    name="contactNo" 
                                    pattern="[0-9]{10}"
                                    required
                                    value="<?= isset($_POST['contactNo']) ? htmlspecialchars($_POST['contactNo']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="nic_no">Enter NIC Number</label>
                                <input 
                                    type="text"
                                    placeholder="NIC Number" 
                                    name="nic_no" 
                                    required
                                    value="<?= isset($_POST['nic_no']) ? htmlspecialchars($_POST['nic_no']) : '' ?>"
                                    style="<?= !empty($errors['nic_no']) ? 'border: 2px solid red;':'' ?>">

                                    <?php if (!empty($errors['nic_no'])): ?>
                                        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['nic_no'] ?></div>
                                    <?php endif; ?>
                            </div>

                            <div class="input-field">
                            <label for="nic_path" >Insert a photo of your National ID Card</label>
                                <input 
                                    type="file"
                                    placeholder="Insert a photo of your National ID Card" 
                                    name="nic_path" 
                                    required
                                    accept=".pdf, .jpg, .jpeg, .png"
                                    style="<?= !empty($errors['nic_path']) ? 'border: 2px solid red;':'' ?>">

                                    <?php if (!empty($errors['nic_path'])): ?>
                                        <div style="color:red;" class="error"><?= $errors['nic_path'] ?></div>
                                    <?php endif; ?>
                            </div>

                            <div class="input-field">
                                <label for="password" >Enter Password</label>
                                <input 
                                    type="password" 
                                    placeholder="Password" 
                                    name="password" 
                                    required>
                            </div>

                            <div class="input-field">
                                <label for="confirm_password" >Re-enter the Pasword</label>
                                <input 
                                    type="password" 
                                    placeholder="Confirm Password" 
                                    name="confirm_password" 
                                    required
                                    style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">
                                    <?php if (!empty($errors['confirm_password'])): ?>
                                        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                    <?php endif; ?>
                            </div>
                            <button type="submit">Register</button>
                        </form>
                    <?php
                        break;
                    case 'company':
                        //html for admin company registration form
                        ?>
                        <h1>Register as a Company</h1>
                        <form method="POST" enctype="multipart/form-data">
                            <input 
                                type="text" 
                                placeholder="Company name" 
                                name="companyname"
                                required
                                value="<?= isset($_POST['companyname']) ? htmlspecialchars($_POST['companyname']) : '' ?>">

                            <input 
                                type="email" 
                                placeholder="Company email" 
                                name="email" 
                                required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                                style="<?= !empty($errors['email']) ? 'border: 2px solid red;':'' ?>">

                                <?php if (!empty($errors['email'])): ?>
                                    <div style="color:red;" class="error"><?= $errors['email'] ?></div>
                                <?php endif; ?>

                            <input 
                                type="tel" 
                                placeholder="Contact number ex: 071 888 8888" 
                                name="contactNo" 
                                pattern="[0-9]{10}"
                                required>

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
                        <h1>Register as a Career Counselor</h1>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-field">
                                <label for="firstName">Enter First Name</label>
                                <input 
                                    type="text" 
                                    placeholder="First Name" 
                                    name="firstName" 
                                    required
                                    value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">
                            </div>
                            
                            <div class="input-field">
                                <label for="lastName">Enter Last Name</label>
                                <input 
                                    type="text"
                                    placeholder="Last Name" 
                                    name="lastName" 
                                    required
                                    value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">
                            </div>
                          
                            <div class="input-field">
                                <label for="email">Enter Email Address</label>
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
                            </div>

                            <div class="input-field">
                                <label for="contactNo">Enter Contact Number</label>
                                <input 
                                    type="text"
                                    placeholder="Contact Number:07xxxxxxxx"
                                    name="contactNo" 
                                    pattern="[0-9]{10}"
                                    required
                                    value="<?= isset($_POST['contactNo']) ? htmlspecialchars($_POST['contactNo']) : '' ?>">
                            </div>

                            <div class="input-field">
                                <label for="counselor_photo_path">Upload your Profile Picture</label>
                                <input 
                                    type="file" 
                                    name="counselor_photo_path" 
                                    required 
                                    accept=".pdf, .jpg, .jpeg, .png"
                                    style="<?= !empty($errors['counselor_photo_path']) ? 'border: 2px solid red;' : '' ?>">

                                    <?php if (!empty($errors['counselor_photo_path'])): ?>
                                        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['counselor_photo_path'] ?></div>
                                    <?php endif; ?>
                            </div>

                            <div class="input-field">
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
                            </div>

                            <div class="input-field">
                                <label for="password" >Enter Password</label>
                                <input 
                                    type="password" 
                                    placeholder="Password" 
                                    name="password" 
                                    required>
                            </div>

                            <div class="input-field">
                                <label for="confirm_password" >Re-enter the Pasword</label>
                                <input 
                                    type="password" 
                                    placeholder="Confirm Password" 
                                    name="confirm_password" 
                                    required
                                    style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;':'' ?>">
                                    <?php if (!empty($errors['confirm_password'])): ?>
                                        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
                                    <?php endif; ?>
                            </div>

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