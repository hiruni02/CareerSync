<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/test.css">
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
        <div class="login-container">
            <h1>Register</h1>
            <form method="POST" action="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                <select name="role" id="role" onchange="this.style.color = this.value === 'placeholder' ? '#888' : '#000'" style="color: #888;">
                    <option disabled selected hidden>Select role</option>
                    <option value="admin">Admin</option>
                    <option value="candidate">Candidate</option>
                    <option value="validation team member">Validation Team Member</option>
                    <option value="company">Company</option>
                    <option value="counselor">Career-Counselor</option>
                </select>
                <input type="text" placeholder="First Name" name="firstName" required>
                <input type="text" placeholder="Last Name" name="lastName" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit">Register</button>
            </form>
            <div class="links">
                <a href="login">Sign in instead</a></t>
            </div>
        </div>
    </body>
</html>