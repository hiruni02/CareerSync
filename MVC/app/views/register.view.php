<?php
$role = $_GET['role'];
?>
<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/styles.css">
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
        <div class="container">
            <?php
            switch($role){
                case 'admin':
                    //html for admin registration form
                    echo
                    '
                    <h1>Register as the Admin</h1>
                    <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                        <input type="text" placeholder="First Name" name="firstName" required>
                        <input type="text" placeholder="Last Name" name="lastName" required>
                        <input type="email" placeholder="Email" name="email" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit">Register</button>
                    </form>';
                    break;
                case 'candidate':
                    //html for candidate registration form
                    echo
                    '
                    <h1>Register as a Candidate</h1>
                    <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                        <input type="text" placeholder="First Name" name="firstName" required>
                        <input type="text" placeholder="Last Name" name="lastName" required>
                        <input type="email" placeholder="Email" name="email" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit">Register</button>
                    </form>';
                    break;
                case 'validation team member':
                    //html for validation team member registration form
                    echo
                    '
                    <h1>Register as a Validation-team member</h1>
                    <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                        <input type="text" placeholder="First Name" name="firstName" required>
                        <input type="text" placeholder="Last Name" name="lastName" required>
                        <input type="email" placeholder="Email" name="email" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit">Register</button>
                    </form>';
                    break;
                case 'company':
                    //html for admin company registration form
                    echo
                    '
                    <h1>Company Registration</h1>
                    <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                            <input type="text" placeholder="Company Name" name="companyName" required>
                            <input type="email" placeholder="Company Email" name="companyEmail" required>
                            <input type="password" placeholder="Password" name="password" required>
                            <input type="text" placeholder="Contact Person Name" name="contactName" required>
                            <input type="tel" placeholder="Phone Number (optional)" name="phone">
                            <input type="url" placeholder="Company Website (optional)" name="website">
                            <input type="text" placeholder="Your Position (e.g. HR, Manager)" name="position">
                            <button type="submit">Register Company</button>
                    </form>';
                    break;
                case 'counselor':
                    //html for admin career-counselor registration form
                    echo
                    '
                    <h1>Register as a CareerCounselor</h1>
                    <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                        <input type="text" placeholder="First Name" name="firstName" required>
                        <input type="text" placeholder="Last Name" name="lastName" required>
                        <input type="email" placeholder="Email" name="email" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit">Register</button>
                    </form>';
                    break;
            }
            ?>
            <div class="links">
                <a href="login">Sign in instead</a></t>
            </div>
        </div>
    </body>
</html>