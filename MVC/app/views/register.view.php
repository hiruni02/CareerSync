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
            <div class="name">CareerSync</div>
            <ul class="navlinks">
                <li><a href="home"><button class="navbtn">Home</button></a></li>
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
                        <h1>Register as a Company</h1>
                        <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                            <input type="text" placeholder="First Name" name="firstName" required>
                            <input type="text" placeholder="Last Name" name="lastName" required>
                            <input type="email" placeholder="Email" name="email" required>
                            <input type="password" placeholder="Password" name="password" required>
                            <button type="submit">Register</button>
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
        </div>
    </body>
</html>