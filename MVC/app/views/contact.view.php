<html>
    <head>
        <link rel="stylesheet" href="<?=ROOT?>assets/css/navbar.css">
        <link rel="stylesheet" href="<?=ROOT?>assets/css/contact.css">
        <title>Login</title>
    </head>
    <body>
        <nav class="navbar">
            <div class="navbar-left">
                <div class="name">CareerSync</div>
                <ul class="navbar_links">
                <li><a href="home"><button class="navbtn">Home</button></a></li>
                <li><a href="about"><button class="navbtn">About</button></a></li>
                <li><a href="contact"><button class="navbtn" disabled>Contact</button></a></li>
                </ul>
            </div>

            <ul class="navbar_right">
                <li><a href="login"><button class="navbtn">Login</button></a></li>
                <li><a href="welcome"><button class="navbtn">Register</button></a></li>
            </ul>
        </nav>
        <div class='page-content'>
            <div class="contact-container">
                <h2>Contact Us</h2>
                <p style="font-size: 20px;">If you have any questions, suggestions, or need support, feel free to reach out to us using the form below.</p>

                <form action="#" method="post" class="contact-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </body>
</html>