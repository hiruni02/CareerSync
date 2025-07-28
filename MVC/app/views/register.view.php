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
                    <label>First Name:</label><br>
                    <input type="text" name="firstName" placeholder="First Name" pattern="[A-Za-z]{2,}" title="Enter at least 2 letters" required><br><br>
                    <label>Last Name:</label><br>
                    <input type="text" name="lastName" placeholder="Last Name" pattern="[A-Za-z]{2,}" title="Enter at least 2 letters" required><br><br>
                    <label>Email:</label><br>
                    <input type="email" name="email" placeholder="Email" required><br><br>
                    <label>Password:</label><br>
                    <input type="password" name="password" placeholder="Password" minlength="6" title="At least 6 characters" required><br><br>
                    <label>Phone Number:</label><br>
                    <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" title="Enter 10-digit phone number" required><br><br>
                    <label>Role (type your role):</label><br>
                    <input type="text" name="role" placeholder="e.g. Developer, Tester" required><br><br>
                    <label>Upload CV:</label><br>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx" required><br><br>
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
                    <input type="text" name="firstName" placeholder="First Name" required>
                    <input type="text" name="lastName" placeholder="Last Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" required>           
                    <input type="text" name="qualification" placeholder="Highest Qualification" required>          
                    <input type="text" name="specialization" placeholder="Specialization (e.g., IT, Finance)" required>
                    <label>
                        Upload Resume (PDF):
                        <input type="file" name="resume" accept=".pdf">
                    </label>

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