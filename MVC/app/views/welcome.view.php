<html>
<head>
    <link rel="stylesheet" href="<?=ROOT?>assets/css/styles.css">
    <link rel="stylesheet" href="<?=ROOT?>assets/css/navbar.css">
    <title>Welcome to CareerSync</title>
    <script>
        window.onload = function () {
            const select = document.getElementById('role');
            const button = document.getElementById('proceedBtn');
            button.disabled = true;
            select.addEventListener('change', function () {
                const selected = select.value;
                // Enable if a valid option is picked
                if (selected !== '') {
                    button.disabled = false;
                } else {
                    button.disabled = true;
                }
            });
        };
    </script>
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
            <li><a href="login"><button class="navbtn">Login</button></a></li>
            <li><a href="welcome"><button class="navbtn" disabled>Register</button></a></li>
        </ul>
    </nav>
    <div class='page-content'>
        <div class="container">
            <h1>Welcome to CareerSync</h1>
            <h3>please choose your role</h3>
            <form action="register" method="GET">
                <select name="role" id="role">
                    <option value="" disabled selected hidden>Your role</option>
                    <option value="admin">Admin</option>
                    <option value="candidate">Candidate</option>
                    <option value="validator">Validation Team Member</option>
                    <option value="company">Company</option>
                    <option value="counselor">Career-Counselor</option>
                </select>
                <button type="submit" id="proceedBtn">Proceed</button>
            </form>
            <div class="links">
                <a href="login">Sign in instead</a></t>
            </div>
        </div>
    </div>
</body>
</html>
